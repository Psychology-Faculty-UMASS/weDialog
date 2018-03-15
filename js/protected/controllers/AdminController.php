<?php

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Admin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Admin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Admin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	//=== START: CHECK WEATHER ADMIN HAS ALREADY LOGGED IN OR NOT, IF LOGGED IN THE MOVE ADMIN TO UPDATE PROFILE PAGE ========//
	public function actionIndex(){
		if(!empty($this->data['user_id'])){
			$this->redirect(Yii::app()->createUrl('admin/update?id='.$this->data['user_id']));exit;
		}else{
			$this->redirect(Yii::app()->createUrl('adminlogin'));exit;
		}
	}
	//=== END: CHECK WEATHER ADMIN HAS ALREADY LOGGED IN OR NOT, IF LOGGED IN THE MOVE ADMIN TO UPDATE PROFILE PAGE ==========//

	//=== START: SET ADMIN LOGIN AND LOGOUT PROCESS =========================//
	public function actionAdminlogin(){
	   
		if(!empty(Yii::app()->session['user_id']) && Yii::app()->session['user_id']!="" && Yii::app()->session['group_id'] == 1){
			$this->redirect(Yii::app()->createUrl('admin/update?id='.Yii::app()->session['user_id']));exit;
		}else if(!empty(Yii::app()->session['user_id']) && Yii::app()->session['user_id']!="" && Yii::app()->session['group_id'] == 3){
			$this->redirect(Yii::app()->createUrl('admin/updateAdmin?id='.Yii::app()->session['user_id']));exit;
		}else if(!empty(Yii::app()->session['user_id']) && Yii::app()->session['user_id']!="" && Yii::app()->session['group_id'] == 2){
			$this->redirect(Yii::app()->createUrl(''));
        }else{
    		if(!empty($_POST['Admin'])){
    			$model->attributes = $_POST['Admin'];
                
    			//if($model->validate()){
    				//=== START: CHECK POST VALUES AND SET ADMIN SESSION ===//
    				$username = $_POST['Admin']['login_username'];
    				$password = $_POST['Admin']['login_password'];
                    //echo $username."===".$password;exit;
       
                //print_r(addslashes($password));exit;
                    
                    // Start :for Admin//
    				$adminlogin_datamodel = Users::model()->find(array('condition'=>'email="'.$username.'" AND password="'.addslashes($password).'"'));
                    if(count($adminlogin_datamodel) > 0){
    				    if($adminlogin_datamodel->status=="Inactive"){
    				        Yii::app()->user->setFlash('failure_msg', "Your account is Inactive.so please contact super admin");
    				    }else{
    				        Yii::app()->session['user_id'] = $adminlogin_datamodel->id;
  					        Yii::app()->session['user_name'] = $adminlogin_datamodel->username;
                            Yii::app()->session['group_id'] = $adminlogin_datamodel->group_id;
                            Yii::app()->session['email'] = $adminlogin_datamodel->email;
        					$this->redirect(Yii::app()->createUrl('admin/updateAdmin?id='.Yii::app()->session['user_id']));
    				    }
    				}
    				// End :for Admin//
                    
                    // Start :for Super Admin//
    				$adminlogin_datamodel = Admin::model()->find(array('condition'=>'login_username="'.$username.'" AND login_password="'.addslashes($password).'"'));
    				if(count($adminlogin_datamodel) > 0){
    					Yii::app()->session['user_id'] = $adminlogin_datamodel->id;
    					Yii::app()->session['user_name'] = $adminlogin_datamodel->login_username;
                        Yii::app()->session['group_id'] = $adminlogin_datamodel->group_id;
                        Yii::app()->session['email'] = $adminlogin_datamodel->email;
                        
    					$this->redirect(Yii::app()->createUrl('admin/update?id='.Yii::app()->session['user_id']));
    				}else{
    					Yii::app()->user->setFlash('failure_msg', "Please provide correct detail.");
    				}
    				// End :for Super Admin//
                    
                    //=== END: CHECK POST VALUES AND SET ADMIN SESSION =====//
    			//}
    			$this->redirect(Yii::app()->createUrl('adminlogin'));
    		}
    	
    		$model = new Admin;
    		$this->data['model'] = $model;
    		$this->render('login', $this->data);
        }
	}
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('adminlogin'));
	}

	//=== END: SET ADMIN LOGIN AND LOGOUT PROCESS ===========================//

	//=== START: DISPLAY LOGGED IN ADMIN DETAIL =============================//
	public function actionView($id){
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}
	//=== END: DISPLAY LOGGED IN ADMIN DETAIL ===============================//

	//=== START: UPDATE Super ADMIN DETAIL ===============================//
	public function actionUpdate($id){
		$model = $this->loadModel($id);
		$this->performAjaxValidation($model);

		if(isset($_POST['Admin'])){
			$model->attributes = $_POST['Admin'];
			if($model->save()){
				Yii::app()->session['user_name'] = $_POST['Admin']['login_username'];
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
			}else{
				Yii::app()->user->setFlash('failure_msg', "Error while executing your request. Try again later.");
			}
			$this->redirect(Yii::app()->createUrl('admin/update?id='.$this->data['user_id']));
		}
        $this->data['model'] = $model;
		$this->render('update',$this->data);
	}
    //=== End: UPDATE Super ADMIN DETAIL ===============================//
    //=== START: UPDATE ADMIN DETAIL ===============================//    
    public function actionUpdateAdmin($id){
		$model =Users::model()->find(array("condition"=>"id=".$id." AND  group_id=3"));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
        //$this->performAjaxValidation($model);

		if(isset($_POST['Users'])){
			$model->attributes = $_POST['Users'];
			if($model->save(false)){
				Yii::app()->session['user_name'] = $_POST['Users']['username'];
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
			}else{
				Yii::app()->user->setFlash('failure_msg', "Error while executing your request. Try again later.");
			}
			$this->redirect(Yii::app()->createUrl('admin/update?id='.$this->data['user_id']));
		}
        $this->data['model'] = $model;
		$this->render('updateAdmin',$this->data);
	}
    //=== End: UPDATE ADMIN DETAIL ===============================//            

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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Admin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Admin']))
			$model->attributes=$_GET['Admin'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
}
