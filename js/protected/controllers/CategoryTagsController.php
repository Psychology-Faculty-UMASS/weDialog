<?php

class CategoryTagsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	


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
		$model=new CategoryTags;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CategoryTags']))
		{
			$model->attributes=$_POST['CategoryTags'];
            $model->user_id=$this->data['user_id'];
			if($model->validationOk()){
				$model->save();
				$this->redirect(array('view','id'=>$model->id));
			}
			
				
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
		$category_tag = $model->cat_tag;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CategoryTags']))
		{
			$model->attributes=$_POST['CategoryTags'];
			if($model->validate()){
				$model->save();
				$sql="SELECT * FROM topics WHERE FIND_IN_SET('".$category_tag."' ,category_tags)";
				$tagtopicmodel = Topics::model()->findAllBySql($sql);
				if(count($tagtopicmodel) > 0){
					foreach($tagtopicmodel as $cattag){
						$topicmodel = Topics::model()->findByPk($cattag->id);
						if(count($topicmodel) > 0){
							$cat_tags = str_replace($category_tag,$model->cat_tag,$topicmodel->category_tags);
							$topicmodel->category_tags = $cat_tags;
							$topicmodel->save(false);
						}
							
					}
				
				}
				$this->redirect(Yii::app()->createUrl('categoryTags/admin'));
			}	
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	//=== START: MANAGE DELETE => TAGS ====================//
	
	function actionManage_cattags(){
		if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
		   
            $deleteids=explode(",",$_POST['selected_ids']);
            for($i=0;$i<count($deleteids);$i++){
                $cattagnamemodel = CategoryTags::model()->findByPk($deleteids[$i]);
                
                $sql="SELECT * FROM topics WHERE FIND_IN_SET('".$cattagnamemodel->cat_tag."' ,category_tags)";
                $tagtopicmodel = Topics::model()->findAllBySql($sql);
                foreach($tagtopicmodel as $tagtopic){
                    
                    $topictagarray=explode(",",$tagtopic->category_tags);
                    
                    if(($key = array_search($cattagnamemodel->cat_tag, $topictagarray)) !== false) {
                           unset($topictagarray[$key]);
                    }
                    $cattag_string = implode(",", $topictagarray);
                    $TopicModel = Topics::model()->findByPk($tagtopic->id);
                    $TopicModel->category_tags = $cattag_string;
                    $TopicModel->save();
                }
                
            }
		  	//=== START: DELETE => USERS ================//
			$deleted = CategoryTags::model()->deleteAll('id IN ('.$_POST['selected_ids'].')');
			if($deleted){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
			//=== END: DELETE => USERS ==================//
		}else if(!empty($_POST['action_type']) && !empty($_POST['selected_ids']) && ($_POST['action_type']=="active" || $_POST['action_type']=="inactive")){
			//=== START: CHANGE STATUS => Rules =========//
            $new_status = 'Inactive';
			$old_status = 'Active';
			if($_POST['action_type'] == "active"){
				$new_status = 'Active';
				$old_status = 'Inactive';
			}
			//echo $_POST['selected_ids']." ".$new_status." ".$old_status;exit;
			$updated = CategoryTags::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => Rules ===========//
		}
        else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
	//=== END: MANAGE DELETE => TAGS ======================//

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CategoryTags');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CategoryTags('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CategoryTags']))
			$model->attributes=$_GET['CategoryTags'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CategoryTags the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CategoryTags::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CategoryTags $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-tags-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
