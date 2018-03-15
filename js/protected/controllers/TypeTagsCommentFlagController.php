<?php

class TypeTagsCommentFlagController extends Controller
{
    public $layout='//layouts/column2';
    
	public function actionAdmin(){
	   $model=new TypeTagsCommentFlag('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TypeTagsCommentFlag']))
			$model->attributes=$_GET['TypeTagsCommentFlag'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    function actionManage_coment(){
        $selected_ids = $_POST['selected_ids'];
        $action_type = $_POST['action_type'];
        $modelname = 'TypeTagsCommentFlag';
        
        if(!empty($_POST['action_type']) && $_POST['action_type']=="hide_post" && !empty($_POST['selected_ids'])){
		  $modeltemp=TypeTagsCommentFlag::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
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
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => USERS =========//
            $new_status = '0';
			$old_status = '1';
			if($_POST['action_type'] == "active"){
				$new_status = '1';
				$old_status = '0';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = TypeTagsCommentFlag::model()->updateAll(array('flag_status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND flag_status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else if(!empty($_POST['action_type']) && $_POST['action_type']=="block_Users" && !empty($_POST['selected_ids'])){
            $modeltemp=TypeTagsCommentFlag::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
            if(count($modeltemp)>0){
                $user_comment_ids=array();
                $ids_userflagcoment=array();
                foreach($modeltemp as $modeltemp1)
                {
                    $ids_userflagcoment[]=$modeltemp1->id;
                    $user_comment_ids[]=$modeltemp1->type_tags_comment_id;
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
        else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}