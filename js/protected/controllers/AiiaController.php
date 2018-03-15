<?php

class AiiaController extends Controller
{
	public $layout='//layouts/column2';
	
    public function actionAdmin(){
        $admin_model=Admin::model()->find(array('select'=>"login_username"));
		$model=new Aiia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Aiia']))
			$model->attributes=$_GET['Aiia'];

		$this->render('admin',array(
			'model'=>$model,'admin_model'=>$admin_model,
		));
	}
    
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Aiia;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Aiia']))
		{
			$model->attributes=$_POST['Aiia'];
            $model->created_by="0";
            if($model->validate()){
                if($model->save()){
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                    $this->redirect(Yii::app()->createUrl('Aiia/admin'));
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }  
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Aiia']))
		{
			$model->attributes=$_POST['Aiia'];
            $model->created_by="0";
            if($model->validate()){
    			if($model->save()){
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                    $this->redirect(Yii::app()->createUrl('Aiia/admin'));
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }
            }
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

    //=== START: MANAGE STATUS AND DELETE => AIIAS ====================//

	function actionManage(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => Aiia ================//
            $deleted = Aiia::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
           }else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => Aiia ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => Aiia =========//
            
            $new_status = 'Inactive';
			$old_status = 'Active';
			if($_POST['action_type'] == "active"){
				$new_status = 'Active';
				$old_status = 'Inactive';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = Aiia::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
            }else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => Aiia ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
	//=== END: MANAGE STATUS AND DELETE => AIIAS ======================//

	public function loadModel($id)
	{
		$model=Aiia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='aiia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
