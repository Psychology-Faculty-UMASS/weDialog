<?php

class UserCommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout = 'registration';
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
     
    public function actionManagetopiccomment($id=''){
        $this->layout = 'column2';
        $model=new UserComment('search');
        $model->topic_main_id=$id;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserComment']))
			$model->attributes=$_GET['UserComment'];
        
		$this->render('managetopiccomment',array(
			'model'=>$model,
		));
    }
     
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserComment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserComment']))
		{
			$model->attributes=$_POST['UserComment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserComment']))
		{
			$model->attributes=$_POST['UserComment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserComment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserComment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserComment']))
			$model->attributes=$_GET['UserComment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
 
    public function actionCreatenewcomment(){
      //  $this->render('/topics/topics_form',$this->data);
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserComment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserComment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserComment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    public function actionManagetopicscomment(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
            $deleted = UserComment::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
                $deleted = UserCommentFlag::model()->deleteAll('user_comment_id  IN (' . $_POST['selected_ids'] . ')');
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => USERS ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => USERS =========//
            
            $new_status = 0;
			$old_status = 1;
			if($_POST['action_type'] == "active"){
				$new_status = 1;
				$old_status = 0;
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = UserComment::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
        $this->redirect(CHttpRequest::getUrlReferrer());    
    }
    
    
    
    
    public function actionAllposts(){
        $this->layout = 'column2';
        $model=new UserComment('searchallposts');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserComment']))
			$model->attributes=$_GET['UserComment'];
            
        $this->data['model'] = $model;
		$this->render('all_posts',$this->data);        
    }

    public function actionManageallposts(){
        
	    $action_type = $_POST['action_type'];
        $selected_ids = explode(",",$_POST['selected_ids']);

        $main_array = array();
        $topic_array = array();
        $rule_array = array();
        $team_array = array();
        $topic_cnt = 1;
        $rule_cnt = 1; 
        $team_cnt = 1;
        foreach($selected_ids as $key =>$value){
            $value = explode("_",$value);
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
        
		if(!empty($action_type) && $action_type =="delete" && !empty($selected_ids)){
			//=== START: DELETE => PARENT TYPE ================//
			
            if(isset($topic_array['Topic']) && $topic_array['Topic']!=''){
                $deleted = UserCommentFlag::model()->deleteAll(array('condition'=>'user_comment_id IN ('.$topic_array['Topic'].')'));
                $deleted = UserComment::model()->deleteAll(array('condition'=>'id IN ('.$topic_array['Topic'].')'));
            }
            
            if(isset($rule_array['Rule']) && $rule_array['Rule']!=''){
                $deleted = TypeTagsCommentFlag::model()->deleteAll(array('condition'=>'type_tags_comment_id IN ('.$rule_array['Rule'].')'));
                $deleted = TypeTagsComment::model()->deleteAll(array('condition'=>'id IN ('.$rule_array['Rule'].')'));
            }
            
            if(isset($team_array['Team']) && $team_array['Team']!=''){
                $deleted = TeamCommentFlag::model()->deleteAll(array('condition'=>'team_comment_id IN ('.$team_array['Team'].')'));
                $deleted = TeamComment::model()->deleteAll(array('condition'=>'id IN ('.$team_array['Team'].')'));
            }
            
			
            if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => PARENT TYPE ==================//
		}else if(!empty($action_type) && !empty($selected_ids) && ($action_type =="active" || $action_type == "inactive")){
			//=== START: CHANGE STATUS => PARENT TYPE =========//
			$new_status = 0;
			$old_status = 1;
			if($action_type == "active"){
				$new_status = 1;
				$old_status = 0;
			}

            if(isset($topic_array['Topic']) && $topic_array['Topic']!=''){
    			$updated = UserComment::model()->updateAll(array("status"=>$new_status), 'id IN ('.$topic_array['Topic'].')');
            }
            
            if(isset($rule_array['Rule']) && $rule_array['Rule']!=''){
    			$updated = TypeTagsComment::model()->updateAll(array("status"=>$new_status), 'id IN ('.$rule_array['Rule'].')');
            }
            
            if(isset($team_array['Team']) && $team_array['Team']!=''){
    			$updated = TeamComment::model()->updateAll(array("status"=>$new_status), 'id IN ('.$team_array['Team'].')');
            }			
            
            if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: CHANGE STATUS => PARENT TYPE ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
        
        $this->redirect(CHttpRequest::getUrlReferrer());        
        
        
        
        
    }
       
    
    
    
}
