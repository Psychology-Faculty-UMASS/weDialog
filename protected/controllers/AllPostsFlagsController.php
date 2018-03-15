<?php

class AllPostsFlagsController extends Controller
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
		$model=new AllPostsFlags;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AllPostsFlags']))
		{
			$model->attributes=$_POST['AllPostsFlags'];
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

		if(isset($_POST['AllPostsFlags']))
		{
			$model->attributes=$_POST['AllPostsFlags'];
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
		$dataProvider=new CActiveDataProvider('AllPostsFlags');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	   
		$model=new AllPostsFlags('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AllPostsFlags']))
			$model->attributes=$_GET['AllPostsFlags'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AllPostsFlags the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AllPostsFlags::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AllPostsFlags $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='all-posts-flags-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    function actionManageallpostsflags(){
        $selected_ids = $_POST['selected_ids'];
        $action_type = $_POST['action_type'];
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
            $deleted = AllPostsFlags::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => USERS ==================//
		}else if(!empty($_POST['action_type']) && $_POST['action_type']=="hide_post" && !empty($_POST['selected_ids'])){
		  $modeltemp=AllPostsFlags::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
            if(count($modeltemp)>0){
                $ids=array();
                $ids_userflagcoment=array();
                foreach($modeltemp as $modeltemp1)
                {
                    $ids_userflagcoment[]=$modeltemp1->id;
                    $ids[]=$modeltemp1->all_posts_id;
                }
                $ids=implode(',',$ids);
                $ids_userflagcoment=implode(',',$ids_userflagcoment);
                $model_user_update = AllPosts::model()->updateAll(array("status"=>'0'),'id IN (' .$ids. ')');
                $model_usercomentflag_update = AllPostsFlags::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
                
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
			$updated = AllPostsFlags::model()->updateAll(array('flag_status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND flag_status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else if(!empty($_POST['action_type']) && $_POST['action_type']=="block_Users" && !empty($_POST['selected_ids'])){
            $modeltemp=AllPostsFlags::model()->findAll(array('condition'=>'id IN (' .$selected_ids. ')'));
            if(count($modeltemp)>0){
                $user_comment_ids=array();
                $ids_userflagcoment=array();
                foreach($modeltemp as $modeltemp1)
                {
                    $ids_userflagcoment[]=$modeltemp1->id;
                    $user_comment_ids[]=$modeltemp1->all_posts_id;
                }
                $ids_userflagcoment=implode(',',$ids_userflagcoment);
                $user_comment_ids=implode(',',$user_comment_ids);
                $mode_user_comment=AllPosts::model()->findAll(array('condition'=>'id IN (' .$user_comment_ids. ')'));
               //print "<pre>";print_r($user_comment_ids);exit;
                $ids=array();
                if(count($mode_user_comment)>0){
                    foreach($mode_user_comment as $mode_user_comment1)
                    {
                        $ids[]=$mode_user_comment1->user_id;
                    }
                    $ids=implode(',',$ids);
                    $model_user_update = Users::model()->updateAll(array("status"=>'Inactive'),'id IN (' .$ids. ')');
                    $model_usercomentflag_update = AllPostsFlags::model()->updateAll(array("adminprocess"=>'1'),'id IN (' .$ids_userflagcoment. ')');    
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
}
