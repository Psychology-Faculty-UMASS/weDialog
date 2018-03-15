<?php

class TeamCommentController extends Controller
{
    public function actionManageteamcomment($id=''){
	   $this->layout = 'column2';  
        $model=new TeamComment('search');
        $model->team_main_id=$id;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TeamComment']))
			$model->attributes=$_GET['TeamComment'];
		$this->render('Manageteamcomment',array(
			'model'=>$model,
		));
	}
    
     public function actionManagecomment(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
            $deleted = TeamComment::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
                $deleted =  TeamCommentFlag::model()->deleteAll('team_comment_id IN (' . $_POST['selected_ids'] . ')');
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
			$updated = TeamComment::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
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