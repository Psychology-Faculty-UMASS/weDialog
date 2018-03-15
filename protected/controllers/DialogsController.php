<?php
class DialogsController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	public $record_to_fetch = 20;
        
        public function actionAdmin()
	{
            $model=new Dialogs('search');

            $model->unsetAttributes();  // clear any default values

            if(isset($_GET['Dialogs']))
                    $model->attributes=$_GET['Dialogs'];

            $this->data['model'] = $model;
            $this->render('admin',$this->data);
	}
        
        //=== START: MANAGE STATUS AND DELETE => TOPICS ====================//

	public function actionManage_topics(){
            if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
                            //=== START: DELETE => Dialogs ================//
                $deleted = Dialogs::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
                            if($deleted){
                                $selectedIDsArr = explode(",", $_POST['selected_ids']);
                                foreach($selectedIDsArr as $selID) {
                                    if(!empty(Yii::app()->session['dialog_id']) && Yii::app()->session['dialog_id']==$selID){
                                        unset(Yii::app()->session['dialog_id']);
                                        unset(Yii::app()->session['dialog_name']);
                                        unset(Yii::app()->session['dialog_created_by']);
                                    }
                                    CategoryGroups::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    CategoryTags::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    Team::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    Topics::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    TopicQuestionAnswer::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    TopicQuestions::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    TypeTags::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                    PeopleScore::model()->updateAll(array('dialog_id'=>''), 'dialog_id=:did', array(':did'=>$selID));
                                }
                                /*
                                //=== START: DELETE => Topic Chiled record( topic comment and topic commented flag)) ================//
                                $flag_id_get_model=UserComment::model()->findAll('topic_id IN (' . $_POST['selected_ids'] . ')');
                                $ids=array();
                                if(count($flag_id_get_model)>0){
                                   foreach($flag_id_get_model as $flag_id_get_model_temp){
                                       $ids[]=$flag_id_get_model_temp->id;
                                   }
                                   $ids=implode(',',$ids);
                                   $deleted = UserCommentFlag::model()->deleteAll('user_comment_id  IN (' . $ids . ')');
                                }
                                $deleted = UserComment::model()->deleteAll('topic_id IN (' . $_POST['selected_ids'] . ')');
                                //=== End: DELETE => Topic Chiled record( topic comment and topic commented flag)) ================//
                                 * */
                                Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_deleted']);
                            }else{
                                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                            }
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
                            $updated = Dialogs::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
                            if($updated){
                                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
                            }else{
                                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
                            }
                            //=== END: CHANGE STATUS => USERS ===========//
                    }else{
                            Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
                    }
                    $this->redirect(array('dialogs/admin'));
            }
        //=== END: MANAGE STATUS AND DELETE => TOPICS ======================//
            
        public function actionUpdate($id)
	{
            $model=$this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Dialogs']))
            {
                $model->attributes=$_POST['Dialogs'];
                if($model->save()){
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                    $this->redirect(Yii::app()->createUrl('dialogs/admin'));
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                   $this->redirect(Yii::app()->createUrl('dialogs/admin'));
                }
            }
            $this->render('update',array('model'=>$model,));
	}
        
        public function actionCreate()
	{
		$model=new Dialogs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dialogs']))
		{
                    $model->attributes=$_POST['Dialogs'];
                    if(empty($model->created_date)){
                            $model->created_date = date("Y-m-d H:i:s");
                    }
                    if($model->save()){
                        Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                        $this->redirect(Yii::app()->createUrl('dialogs/admin'));
                    }else{
                        Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                        $this->redirect(Yii::app()->createUrl('dialogs/admin'));
                    }
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionDialogList()
        {
            $this->layout = 'registration';
            $models = Dialogs::model()->findAll(array('order'=>'created_date ASC'));
            
            $this->render('dialogs_list', array(
                'models' => $models
            ));
        }
        
        public function actionCreatenewdialog(){
            if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
        	$this->layout = 'registration';
                $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
    		if(count($ip_status) > 0){
    			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['create_dialog']);
    				$this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
    		} 
                $dialogID = '';
                if(!empty(Yii::app()->session['dialog_id'])) {
                    $dialogID = Yii::app()->session['dialog_id'];
                }
                $TopicQuestionModel = new TopicQuestions;
                $this->data['TopicQuestionModel'] = $TopicQuestionModel;
            
                $categorygroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active" AND dialog_id=:dID','group'=>'category', 'params'=>array(':dID'=>$dialogID)));
                $this->data['categorygroupmodel'] = $categorygroupmodel;
            
                $DialogModel = new Dialogs;
                $tagmodel = Dialogs::model()->findAll();
                $this->data['tagmodel'] = $tagmodel;
            
            
     		//$Tagcatmodel = CategoryTags::model()->findAll();
                //$Tagtypemodel= TypeTags::model()->findAll();
            
            
            
                //$cate_tag_string=implode(",",$_POST['alltags']);
            
                if(isset($_POST["Dialogs"])){
                    //$category = implode(",",$_POST['Topics']['category_tags']);
                    //$type = implode(",",$_POST['Topics']['type_tags']);
                    $DialogModel->attributes = $_POST["Dialogs"];
                    $DialogModel->user_id = Yii::app()->session['user_id'];
                    //$DialogModel->category_tags = $category;
                    //$TopicModel->type_tags = $type;
                    $DialogModel->created_date = date("Y-m-d H:i:s"); 
                    $DialogModel->status = "Active";
                    $DialogModel->dialog_description = $_POST['Dialogs']['dialog_description'];
                
                    if($DialogModel->save()){
                        if(isset($_POST['TopicQuestions'])){
                            if($TopicQuestionModel->question1!="0"){
                                $catGroupCount = CategoryGroups::model()->count('category=:cat', array(':cat'=>$TopicQuestionModel->question1));
                                if($catGroupCount == 0){
                                    foreach($TopicQuestionModel->option1 as $option) {
                                        $categoryGroupModel = new CategoryGroups;
                                        $categoryGroupModel->dialog_id = $dialogID;
                                        $categoryGroupModel->category = $TopicQuestionModel->question1;
                                        $categoryGroupModel->groups = $option;
                                        $categoryGroupModel->created_by = Yii::app()->session['username'];
                                        $categoryGroupModel->save();
                                    }
                                    
                                }
                            }
                            
                            if($TopicQuestionModel->question2!="0"){
                                $catGroupCount = CategoryGroups::model()->count('category=:cat', array(':cat'=>$TopicQuestionModel->question2));
                                if($catGroupCount == 0){
                                    foreach($TopicQuestionModel->option2 as $option) {
                                        $categoryGroupModel = new CategoryGroups;
                                        $categoryGroupModel->dialog_id = $dialogID;
                                        $categoryGroupModel->category = $TopicQuestionModel->question2;
                                        $categoryGroupModel->groups = $option;
                                        $categoryGroupModel->created_by = Yii::app()->session['username'];
                                        $categoryGroupModel->save();
                                    }
                                    
                                }
                            }
                            
                            if($TopicQuestionModel->question3!="0"){
                                $catGroupCount = CategoryGroups::model()->count('category=:cat', array(':cat'=>$TopicQuestionModel->question3));
                                if($catGroupCount == 0){
                                    foreach($TopicQuestionModel->option3 as $option) {
                                        $categoryGroupModel = new CategoryGroups;
                                        $categoryGroupModel->dialog_id = $dialogID;
                                        $categoryGroupModel->category = $TopicQuestionModel->question3;
                                        $categoryGroupModel->groups = $option;
                                        $categoryGroupModel->created_by = Yii::app()->session['username'];
                                        $categoryGroupModel->save();
                                    }
                                    
                                }
                            }
                            
                            $TopicQuestionModel->attributes =  $_POST['TopicQuestions'];
                            if($TopicQuestionModel->question1=="0")$TopicQuestionModel->question1="";
                            if($TopicQuestionModel->question2=="0")$TopicQuestionModel->question2="";
                            if($TopicQuestionModel->question3=="0")$TopicQuestionModel->question3="";
                            //echo "<pre>";print_r($TopicQuestionModel->attributes);exit;
                            $TopicQuestionModel->dialog_id = $DialogModel->id;
                            //$TopicQuestionModel->option1 = implode(',',$_POST['TopicQuestions']['option1']);
                            //$TopicQuestionModel->option2 = implode(',',$_POST['TopicQuestions']['option2']);
                            //$TopicQuestionModel->option3 = implode(',',$_POST['TopicQuestions']['option3']);
                            $TopicQuestionModel->option1 = $_POST["QuestionOption1_value"];
                            $TopicQuestionModel->option2 = $_POST["QuestionOption2_value"];
                            $TopicQuestionModel->option3 = $_POST["QuestionOption3_value"];
                        
                            $TopicQuestionModel->user_id = Yii::app()->session['user_id'];
                            if($TopicQuestionModel->validate()){
                                $TopicQuestionModel->save();
                            }
                        }
                        Yii::app()->user->setFlash('success_msg', Yii::app()->params['dialog_saved']);
                    }else{
                        Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                    }

                    unset(Yii::app()->session['dialog_title']);
                    unset(Yii::app()->session['dialog_description1']);
                    $this->redirect('DialogList');
                }
                $this->data["DialogModel"] = $DialogModel;
                //$this->data["Tagcatmodel"] = $Tagcatmodel;
                //$this->data["Tagtypemodel"] = $Tagtypemodel;
                $this->render('dialogs_form',$this->data);
           }else{
                $this->redirect(Yii::app()->createUrl('site/loginUser'));
           }
        }
        
        public function actionUpdatedialog(){
        		 
            if(Yii::app()->session['dialog_title']){
                unset(Yii::app()->session['dialog_title']);
            }
            $id= $_GET['dialog_id'];
            $this->layout = 'registration';
            $DialogModel = Dialogs::model()->findByPk($id);

            $TopicQuestionModel = TopicQuestions::model()->find(array('condition'=>'dialog_id='.$id));
            if(count($TopicQuestionModel) == 0){
                $TopicQuestionModel = new TopicQuestions;
            }
            $this->data['TopicQuestionModel'] = $TopicQuestionModel;
            $categorygroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active" AND dialog_id=:did','group'=>'category', 'params'=>array(':did'=>$id)));
            $this->data['categorygroupmodel'] = $categorygroupmodel;

            $catgroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active" AND dialog_id=:did', 'params'=>array(':did'=>$id)));
            $this->data['catgroupmodel'] = $catgroupmodel;

            
            if(isset($_POST["Dialogs"])){
                $DialogModel->user_id = Yii::app()->session['user_id'];
                $DialogModel->created_date = date("Y-m-d H:i:s");    
                $DialogModel->dialog_description = $_POST['Dialogs']['dialog_description'];
                $DialogModel->attributes = $_POST["Dialogs"];
                $category_tags = array_unique($_POST['Dialogs']['category_tags']);
                if($category_tags!=''){
                    $category_tags = implode(",",$category_tags);
                }
                
                if($type_tags!=''){
                    $type_tags = implode(",",$type_tags);
                }
                

                if($DialogModel->save()){
                    if(isset($_POST['TopicQuestions'])){
                        //echo "<pre>";print_r($_POST['TopicQuestions']);exit;
                        $TopicQuestionModel->attributes =  $_POST['TopicQuestions'];
                        if($TopicQuestionModel->question1=="0")$TopicQuestionModel->question1="";
                        if($TopicQuestionModel->question2=="0")$TopicQuestionModel->question2="";
                        if($TopicQuestionModel->question3=="0")$TopicQuestionModel->question3="";
                        //echo "<pre>";print_r($TopicQuestionModel->attributes);exit;
                        //$TopicQuestionModel->option1 = implode(',',$_POST['TopicQuestions']['option1']);
                        //$TopicQuestionModel->option2 = implode(',',$_POST['TopicQuestions']['option2']);
                        //$TopicQuestionModel->option3 = implode(',',$_POST['TopicQuestions']['option3']);
                        $TopicQuestionModel->option1 = $_POST["QuestionOption1_value"];
                        $TopicQuestionModel->option2 = $_POST["QuestionOption2_value"];
                        $TopicQuestionModel->option3 = $_POST["QuestionOption3_value"];
                        
                        $TopicQuestionModel->dialog_id = $DialogModel->id;
                        $TopicQuestionModel->user_id = Yii::app()->session['user_id'];
                        if($TopicQuestionModel->validate()){
                            $TopicQuestionModel->save();
                        }
                    }                
                }
                $this->redirect('DialogList');
            }

            $tagmodel = Dialogs::model()->findAll();
            $this->data['tagmodel'] = $tagmodel;

            $this->data["DialogModel"] = $DialogModel;

            $this->render('/dialogs/dialogs_form',$this->data);



        }
        
        public function actionMakeDefaultDialog()
        {
            if(isset($_POST['id']) && isset($_POST['name'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $createdBy = $_POST['createdBy'];
                Yii::app()->session['dialog_name'] = $name;
                Yii::app()->session['dialog_id'] = $id;
                Yii::app()->session['dialog_created_by'] = $createdBy;
                echo "ok";
                die;
            }
        }
        
        public function actionCreateAbout()
        {
            $this->layout = 'registration';
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
            }

            if(isset($_GET['dialog_id'])){
                $dialogID = $_GET['dialog_id'];
                $dialogModel = Dialogs::model()->findByPk($dialogID);
                if(!$dialogModel){
                    throw new CHttpException(404, 'Not Found.');
                }
            }
            if(!empty($dialogID)) {
                $model = Dialogs::model()->findByPk($dialogID);
            }
            else{
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            if(!isset($model) || !$model){
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            if(isset($_POST['Dialogs'])){
                $model->dialog_about_description = $_POST['Dialogs']['dialog_about_description'];
                $model->dialog_about_title = $_POST['Dialogs']['dialog_about_title'];
                $model->dialog_about_updated = date("Y-m-d H:i:s"); 
                $model->dialog_about_exists = 1;
                if($model->save()){
                    $this->redirect(Yii::app()->createUrl('dialogs/about', array('dialog_id'=>$dialogID)));
                }
            }
            
            $this->render('dialog_about', array('model'=>$model, 'action'=>'create'));
        }
        
        public function actionEditAbout()
        {
            $this->layout = 'registration';
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
            }

            if(isset($_GET['dialog_id'])){
                $dialogID = $_GET['dialog_id'];
                $dialogModel = Dialogs::model()->findByPk($dialogID);
                if(!$dialogModel){
                    throw new CHttpException(404, 'Not Found.');
                }
            }
            
            if(!empty($dialogID)) {
                $model = Dialogs::model()->findByPk($dialogID);
            }
            else{
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            if(!isset($model) || !$model){
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            if(isset($_POST['Dialogs'])){
                $model->dialog_about_description = $_POST['Dialogs']['dialog_about_description'];
                $model->dialog_about_title = $_POST['Dialogs']['dialog_about_title'];
                $model->dialog_about_updated = date("Y-m-d H:i:s"); 
                $model->dialog_about_exists = 1;
                if($model->save()){
                    $this->redirect(Yii::app()->createUrl('dialogs/about', array('dialog_id'=>$dialogID)));
                }
            }
            
            $this->render('dialog_about', array('model'=>$model, 'action'=>'Edit'));
        }
        
        public function actionAbout()
        {
            $this->layout = 'registration';
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
                $model = Dialogs::model()->findByPk($dialogID);
            }
            else{
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            if(!isset($model) || !$model){
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
            
            $this->render('about', array('model'=>$model));
        }
        
        public function loadModel($id)
	{
		$model=Dialogs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
