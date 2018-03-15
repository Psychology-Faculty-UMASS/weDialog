<?php
class EmailTemplatesController extends Controller{
	public $layout='//layouts/column2';

    //================ START: EMAIL TEMPLATE VIEW =============================//
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    //================ END: EMAIL TEMPLATE VIEW =============================//

    //================ START: EMAIL TEMPLATE ADD =============================//
	public function actionCreate(){
		$model=new EmailTemplates;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailTemplates'])){
			$model->attributes=$_POST['EmailTemplates'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    //================ END: EMAIL TEMPLATE ADD =============================//

    //================ START: EMAIL TEMPLATE UPDATE =============================//
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		//print_r($_POST);exit;	
		if(isset($_POST['EmailTemplates']))
		{
			$model->attributes=$_POST['EmailTemplates'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    //================ END: EMAIL TEMPLATE UPDATE =============================//
	
    //================ START: EMAIL TEMPLATE MANAGE(LISTING) =============================//
	public function actionAdmin(){
		$model=new EmailTemplates('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmailTemplates']))
			$model->attributes=$_GET['EmailTemplates'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	//================ END: EMAIL TEMPLATE MANAGE(LISTING) =============================//
    
	public function loadModel($id){
		$model=EmailTemplates::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='email-templates-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
