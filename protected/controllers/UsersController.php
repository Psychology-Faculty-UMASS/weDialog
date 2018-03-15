<?php

class UsersController extends Controller
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
		$model=new Users;
		//print 'here1';exit;	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			//print 'here';exit;	
			$model->attributes=$_POST['Users'];
			if(empty($model->created_date)){
				$model->created_date = date("Y-m-d H:i:s");
			}
			if($model->save()){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                $this->redirect(Yii::app()->createUrl('users/admin'));
            }else{
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                $this->redirect(Yii::app()->createUrl('users/update'));
            }
			$this->redirect(Yii::app()->createUrl('users/admin'));
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

		if(isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			$model->user_description = $_POST['Users']['user_description'];
			if($model->save()){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                $this->redirect(Yii::app()->createUrl('users/admin'));
            }else{
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                $this->redirect(Yii::app()->createUrl('users/update'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	//=== START: MANAGE STATUS AND DELETE => USERS ====================//

	function actionManage_users(){
//            print_R($_POST['action_type']);die;
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => USERS ================//
            $deleted = Users::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
           }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => USERS ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive" || $_POST['action_type']=="block_Users")){
			//=== START: CHANGE STATUS => USERS =========//
//            echo $_POST['action_type'];die;
//            print_r($_POST['selected_ids']);die;
            $new_status = 'Inactive';
			$old_status = 'Active';
			if($_POST['action_type'] == "active"){
				$new_status = 'Active';
				$old_status = 'Inactive';
			}else if($_POST['action_type'] == "block_Users"){
                            $new_status = 'Block';
//				$old_status = 'Inactive';
                                $updated = Users::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].')');
                        }
                        if($_POST['action_type'] != "block_Users"){
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = Users::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].')');
//			$updated = Users::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
                        }
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
            }else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active_admins" || $_POST['action_type']=="inactive_admins")){
                     
//				$old_status = 'Inactive';
                     if($_POST['action_type'] == "active_admins"){
                         $group_id = 3;
                     }else{
                         $group_id = 2;
                     }
                                $updated = Users::model()->updateAll(array('group_id'=>$group_id), 'id IN ('.$_POST['selected_ids'].')');
                    
                }else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
	//=== END: MANAGE STATUS AND DELETE => USERS ======================//
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            if(empty(Yii::app()->session['user_id']) || Yii::app()->session['user_id']=="" || (Yii::app()->session['group_id'] != 1 && Yii::app()->session['group_id'] != 3)){
                    $this->redirect(Yii::app()->createUrl(''));exit;
            }
		$model = new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users'])){
			//print_r($_GET['Users']);exit;
			$model->attributes = $_GET['Users'];
			//print_r($model->attributes);exit;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
     public function actionViewAdminList(){
		$model=new Users;
        $model_new=Users::model()->findAll(array("condition"=>"group_id=2 AND status=1"));
        $model->searchadmin();        
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
        
        if(isset($_POST["submit"])){
            if(isset($_POST["select_user"]) && $_POST["select_user"]!=""){
                $updatemodel=Users::model()->updateAll(array('group_id'=>3),'id='.$_POST["select_user"]);
                if($updatemodel){
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['make_admin']);
                    $this->redirect(array('viewAdminList'));
               }else{
    				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
    			}
            }else{
               Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']); 
            }
        }
        
		$this->render('viewAdminList',array(
			'model'=>$model,'model_new'=>$model_new,
		));
	}
    
    function actionRemoveAdmin(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
            //=== START: Make from Admin to User/Member ================//
            $updatemodel=Users::model()->updateAll(array('group_id'=>2),'id IN (' . $_POST['selected_ids'] . ')');
			if($updatemodel){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['remove_admin']);
           }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: Make from Admin to User/Member ================//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('viewAdminList'));
	}
    
         public static function actionBlockUser()
    {
        if(isset($_POST['id']))
        {
            $updatemodel=Users::model()->updateAll(array('status'=>'Block'),'id ='.$_POST['id']);
        }
        die;
    } 
}
