<?php

class UserCommentFlagController extends Controller
{

	public $layout='//layouts/column2';
    
    public function actionAdmin(){
		$model=new UserCommentFlag('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserCommentFlag']))
			$model->attributes=$_GET['UserCommentFlag'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    function actionManage_coment(){
        $selected_ids = $_POST['selected_ids'];
        $action_type = $_POST['action_type'];
        $modelname = 'UserCommentFlag';
        
        if(!empty($_POST['action_type']) && $_POST['action_type']=="hide_post" && !empty($_POST['selected_ids'])){
		  $modeltemp=UserCommentFlag::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
            if(count($modeltemp)>0){
                $ids=array();
                $ids_userflagcoment=array();
                foreach($modeltemp as $modeltemp1)
                {
                    $ids_userflagcoment[]=$modeltemp1->id;
                    $ids[]=$modeltemp1->user_comment_id;
                }
                $ids=implode(',',$ids);
                $ids_userflagcoment=implode(',',$ids_userflagcoment);
                $model_user_update = UserComment::model()->updateAll(array("status"=>'0'),'id IN (' .$ids. ')');
                $model_usercomentflag_update = UserCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                
                Yii::app()->user->setFlash('success_msg', Yii::app()->params['hide_comment_sucess']);
                
            }else{
                	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
            }
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => USERS =========//
            $new_status = '0';
			$old_status = '1';
			if($_POST['action_type'] == "active"){
				$new_status = '1';
				$old_status = '0';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = UserCommentFlag::model()->updateAll(array('flag_status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND flag_status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else if(!empty($_POST['action_type']) && $_POST['action_type']=="block_Users" && !empty($_POST['selected_ids'])){
            $modeltemp=UserCommentFlag::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
            if(count($modeltemp)>0){
                $user_comment_ids=array();
                $ids_userflagcoment=array();
                foreach($modeltemp as $modeltemp1)
                {
                    $ids_userflagcoment[]=$modeltemp1->id;
                    $user_comment_ids[]=$modeltemp1->user_comment_id;
                }
                $ids_userflagcoment=implode(',',$ids_userflagcoment);
                $user_comment_ids=implode(',',$user_comment_ids);
                $mode_user_comment=UserComment::model()->findAll(array('condition'=>'id IN (' .$user_comment_ids. ')'));
               //print "<pre>";print_r($user_comment_ids);exit;
                $ids=array();
                if(count($mode_user_comment)>0){
                    foreach($mode_user_comment as $mode_user_comment1)
                    {
                        $ids[]=$mode_user_comment1->user_id;
                    }
                    $ids=implode(',',$ids);
                    $model_user_update = Users::model()->updateAll(array("status"=>'Inactive'),'id IN (' .$ids. ')');
                    $model_usercomentflag_update = UserCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['block_user_sucess']);
                }
                
            }else{
                	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
            }
		}
        else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(CHttpRequest::getUrlReferrer()); 
	}
    
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new UserCommentFlag;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserCommentFlag']))
		{
			$model->attributes=$_POST['UserCommentFlag'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserCommentFlag']))
		{
			$model->attributes=$_POST['UserCommentFlag'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserCommentFlag');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	

	public function loadModel($id)
	{
		$model=UserCommentFlag::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-comment-flag-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    public function actionAllflags(){
        //echo "here";exit;
        $this->layout = 'column2';
        $model=new UserCommentFlag('searchallflag');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserCommentFlag']))
			$model->attributes=$_GET['UserCommentFlag'];
            
        $this->data['model'] = $model;
		$this->render('all_flag',$this->data);        
    }
    
    
    public function actionManageallflag(){
        $action_type = $_POST['action_type'];
        $selected_ids = explode(",",$_POST['selected_ids']);
        //echo "<pre>";
        //print_r($selected_ids);exit;
        $topic_array = array();
        $rule_array = array();
        $team_array = array();
        $topic_cnt = 1;
        $rule_cnt = 1; 
        $team_cnt = 1;
        foreach($selected_ids as $key =>$value){
            $value = explode("_",$value);
            //print_r($value);
            if($value[0] == 'Topic'){
                if($topic_cnt == 1){
                    $topic_array[$value[0]] = $value[1];
                }else{
                    $topic_array[$value[0]] = $topic_array[$value[0]].','.$value[1];
                }
                $topic_cnt++;
            }
            if($value[0] == 'Rule'){
                if($rule_cnt == 1){
                    $rule_array[$value[0]] = $value[1];
                }else{
                    $rule_array[$value[0]] = $rule_array[$value[0]].','.$value[1];
                }
                $rule_cnt++;
            }
            if($value[0] == 'Team'){
                if($team_cnt == 1){
                    $team_array[$value[0]] = $value[1];
                }else{
                    $team_array[$value[0]] = $team_array[$value[0]].','.$value[1];
                }
                $team_cnt++;
            }
        }        
        /*echo "<pre>";
        print_r($topic_array);
        print_r($rule_array);
        print_r($team_array);
        exit;     */  
        
        if(!empty($_POST['action_type']) && $_POST['action_type']=="hide_post" && !empty($_POST['selected_ids'])){
            if(isset($topic_array['Topic']) && $topic_array['Topic']!=''){
            	$modeltemp = UserCommentFlag::model()->findAll(array('condition'=>'id IN (' .$topic_array['Topic']. ')'));
                if(count($modeltemp)>0){
                    $ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $ids[]=$modeltemp1->user_comment_id;
                    }
                    $ids=implode(',',$ids);
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $model_user_update = UserComment::model()->updateAll(array("status"=>'0'),'id IN (' .$ids. ')');
                    $model_usercomentflag_update = UserCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                    
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['hide_comment_sucess']);
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }            
            }
            
            if(isset($rule_array['Rule']) && $rule_array['Rule']!=''){
            	$modeltemp = TypeTagsCommentFlag::model()->findAll(array('condition'=>'id IN (' .$rule_array['Rule']. ')'));
                if(count($modeltemp)>0){
                    $ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $ids[]=$modeltemp1->type_tags_comment_id;
                    }
                    $ids=implode(',',$ids);
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $model_user_update = TypeTagsComment::model()->updateAll(array("status"=>'0'),'id IN (' .$ids. ')');
                    $model_usercomentflag_update = TypeTagsCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                    
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['hide_comment_sucess']);
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }            
            }
            
            if(isset($team_array['Team']) && $team_array['Team']!=''){
            	$modeltemp = TeamCommentFlag::model()->findAll(array('condition'=>'id IN (' .$team_array['Team']. ')'));
                if(count($modeltemp)>0){
                    $ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $ids[]=$modeltemp1->team_comment_id;
                    }
                    $ids=implode(',',$ids);
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $model_user_update = TeamComment::model()->updateAll(array("status"=>'0'),'id IN (' .$ids. ')');
                    $model_usercomentflag_update = TeamCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                    
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['hide_comment_sucess']);
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }             
            
            }			
            
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => USERS =========//
            $new_status = '0';
			$old_status = '1';
			if($_POST['action_type'] == "active"){
				$new_status = '1';
				$old_status = '0';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			
            if(isset($topic_array['Topic']) && $topic_array['Topic']!=''){
    			$updated = UserCommentFlag::model()->updateAll(array("flag_status"=>$new_status), 'id IN ('.$topic_array['Topic'].')');
            }
            
            if(isset($rule_array['Rule']) && $rule_array['Rule']!=''){
    			$updated = TypeTagsCommentFlag::model()->updateAll(array("flag_status"=>$new_status), 'id IN ('.$rule_array['Rule'].')');
            }
            
            if(isset($team_array['Team']) && $team_array['Team']!=''){
    			$updated = TeamCommentFlag::model()->updateAll(array("flag_status"=>$new_status), 'id IN ('.$team_array['Team'].')');
            }			
            
            
            
            if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else if(!empty($_POST['action_type']) && $_POST['action_type']=="block_Users" && !empty($_POST['selected_ids'])){
            if(isset($topic_array['Topic']) && $topic_array['Topic']!=''){
    			$modeltemp = UserCommentFlag::model()->findAll(array('condition'=>'id IN (' .$topic_array['Topic']. ')'));
                if(count($modeltemp)>0){
                    $user_comment_ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $user_comment_ids[]=$modeltemp1->user_comment_id;
                    }
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $user_comment_ids=implode(',',$user_comment_ids);
                    $mode_user_comment=UserComment::model()->findAll(array('condition'=>'id IN (' .$user_comment_ids. ')'));
                   //print "<pre>";print_r($user_comment_ids);exit;
                    $ids=array();
                    if(count($mode_user_comment)>0){
                        foreach($mode_user_comment as $mode_user_comment1)
                        {
                            $ids[]=$mode_user_comment1->user_id;
                        }
                        $ids=implode(',',$ids);
                        $model_user_update = Users::model()->updateAll(array("status"=>'Inactive'),'id IN (' .$ids. ')');
                        $model_usercomentflag_update = UserCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                        Yii::app()->user->setFlash('success_msg', Yii::app()->params['block_user_sucess']);
                    }
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }            
            
            }
            
            if(isset($rule_array['Rule']) && $rule_array['Rule']!=''){
    			$modeltemp = TypeTagsCommentFlag::model()->findAll(array('condition'=>'id IN (' .$rule_array['Rule']. ')'));
                if(count($modeltemp)>0){
                    $user_comment_ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $user_comment_ids[]=$modeltemp1->user_comment_id;
                    }
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $user_comment_ids=implode(',',$user_comment_ids);
                    $mode_user_comment=TypeTagsComment::model()->findAll(array('condition'=>'id IN (' .$user_comment_ids. ')'));
                   //print "<pre>";print_r($user_comment_ids);exit;
                    $ids=array();
                    if(count($mode_user_comment)>0){
                        foreach($mode_user_comment as $mode_user_comment1)
                        {
                            $ids[]=$mode_user_comment1->user_id;
                        }
                        $ids=implode(',',$ids);
                        $model_user_update = Users::model()->updateAll(array("status"=>'Inactive'),'id IN (' .$ids. ')');
                        $model_usercomentflag_update = TypeTagsCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                        Yii::app()->user->setFlash('success_msg', Yii::app()->params['block_user_sucess']);
                    }
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }            
            
            }
            
            if(isset($team_array['Team']) && $team_array['Team']!=''){
    			$modeltemp = TeamCommentFlag::model()->findAll(array('condition'=>'id IN (' .$team_array['Team']. ')'));
                if(count($modeltemp)>0){
                    $user_comment_ids=array();
                    $ids_userflagcoment=array();
                    foreach($modeltemp as $modeltemp1)
                    {
                        $ids_userflagcoment[]=$modeltemp1->id;
                        $user_comment_ids[]=$modeltemp1->user_comment_id;
                    }
                    $ids_userflagcoment=implode(',',$ids_userflagcoment);
                    $user_comment_ids=implode(',',$user_comment_ids);
                    $mode_user_comment=TeamComment::model()->findAll(array('condition'=>'id IN (' .$user_comment_ids. ')'));
                   //print "<pre>";print_r($user_comment_ids);exit;
                    $ids=array();
                    if(count($mode_user_comment)>0){
                        foreach($mode_user_comment as $mode_user_comment1)
                        {
                            $ids[]=$mode_user_comment1->user_id;
                        }
                        $ids=implode(',',$ids);
                        $model_user_update = Users::model()->updateAll(array("status"=>'Inactive'),'id IN (' .$ids. ')');
                        $model_usercomentflag_update = TeamCommentFlag::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                        Yii::app()->user->setFlash('success_msg', Yii::app()->params['block_user_sucess']);
                    }
                    
                }else{
                    	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }            
            }            
		}
        else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(CHttpRequest::getUrlReferrer()); 
	}    
    
}
