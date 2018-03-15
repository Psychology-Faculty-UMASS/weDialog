<?php

class AllPostsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new AllPosts('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AllPosts']))
		{
			$model->attributes=$_POST['AllPosts'];
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

		if(isset($_POST['AllPosts']))
		{
			$model->attributes=$_POST['AllPosts'];
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
		$dataProvider=new CActiveDataProvider('AllPosts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AllPosts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AllPosts']))
			$model->attributes=$_GET['AllPosts'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AllPosts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AllPosts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AllPosts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='all-posts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    


    public function actionManageallposts(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
            $deleted = AllPosts::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
                $deleted = AllPostsFlags::model()->deleteAll('all_posts_id  IN (' . $_POST['selected_ids'] . ')');
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
			$updated = AllPosts::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
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
    
    
}
