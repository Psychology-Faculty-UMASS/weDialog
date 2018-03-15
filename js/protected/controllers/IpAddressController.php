<?php

class IpAddressController extends Controller
{
	public $layout='//layouts/column2';

		public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCreate()
	{
		$model=new IpAddress;
		if(isset($_POST['IpAddress']))
		{
			$model->attributes=$_POST['IpAddress'];
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
		if(isset($_POST['IpAddress']))
		{
			$model->attributes=$_POST['IpAddress'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionAdmin()
	{
		$model=new IpAddress('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IpAddress']))
			$model->attributes=$_GET['IpAddress'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function loadModel($id)
	{
		$model=IpAddress::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	function actionManage(){
		//print_r($_POST);exit;
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
          /*  $deleted = Users::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
           }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}*/
			//=== END: DELETE => USERS ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => USERS =========//
            $new_status = 'Inactive';
			$old_status = 'Active';
			if($_POST['action_type'] == "active"){
				$new_status = 'Active';
				$old_status = 'Inactive';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = IpAddress::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
            }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ip-address-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}