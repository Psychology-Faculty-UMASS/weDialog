<?php

class FlagReasonController extends Controller
{

	public $layout='//layouts/column2';

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCreate(){
		$model=new FlagReason;
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['FlagReason']))
		{
			$model->attributes=$_POST['FlagReason'];
			if($model->save()){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                $this->redirect(Yii::app()->createUrl('FlagReason/admin'));
            }else{
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                $this->redirect(Yii::app()->createUrl('FlagReason/update'));
            }
				//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['FlagReason']))
		{
			$model->attributes=$_POST['FlagReason'];
            
    			if($model->save()){
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                    $this->redirect(Yii::app()->createUrl('FlagReason/admin'));
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                    $this->redirect(Yii::app()->createUrl('FlagReason/update'));
                }
                 $this->redirect('Admin');
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
	public function actionAdmin()
	{
		$model=new FlagReason('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FlagReason']))
			$model->attributes=$_GET['FlagReason'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function loadModel($id)
	{
		$model=FlagReason::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='flag-reason-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    function actionManage_reson(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => reason ================//
            $deleted = FlagReason::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
           }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => reason ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => reason =========//
            
            $new_status = 'Inactive';
			$old_status = 'Active';
			if($_POST['action_type'] == "active"){
				$new_status = 'Active';
				$old_status = 'Inactive';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = FlagReason::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
            }else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => reason ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
    
}
