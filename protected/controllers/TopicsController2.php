<?php
class TopicsController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	public $record_to_fetch = 20;

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
		$model=new Topics('Create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Topics']))
		{
			//print_r($_POST['Topics']);exit;
			$model->attributes=$_POST['Topics'];
                        $model->topic_description = strip_tags($_POST['Topics']['topic_description'],'<br></br><br/>');
                        //$model->topic_description = nl2br($model->topic_description);
            if(empty($model->created_date)){
				$model->created_date = date("Y-m-d H:i:s");
			}
                        
			if($model->save()){
                Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                $this->redirect(Yii::app()->createUrl('topics/admin'));
            }else{
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
               $this->redirect(Yii::app()->createUrl('topics/admin'));
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
	public function actiontopicanswer(){
	    $this->layout = 'blank';
		//echo "<pre>";
        //$post_value = explode('&',$_POST['form']);
        //print_r($_POST);exit;
        $question1 = '';
        $answer1 = '';
        if(isset($_POST['question1']) && $_POST['question1']!=''){
            $question1 = $_POST['question1'];
            $answer1 =  $_POST['answer1'];
            $question1_model=CategoryGroups::model()->find(array("condition"=>"category='".$question1."' AND  groups='".$answer1."'"));   
        }
        
        $question2 = '';
        $answer2 = '';
        if(isset($_POST['question2']) && $_POST['question2']!=''){
            $question2 = $_POST['question2'];
            $answer2 =  $_POST['answer2'];
            $question2_model=CategoryGroups::model()->find(array("condition"=>"category='".$question2."' AND  groups='".$answer2."'"));
        }
		
		$question3 = '';
        $answer3 = '';
        if(isset($_POST['question3']) && $_POST['question3']!=''){
            $question3 = $_POST['question3'];
            $answer3 =  $_POST['answer3'];
            $question3_model=CategoryGroups::model()->find(array("condition"=>"category='".$question3."' AND  groups='".$answer3."'"));   
        }
		$topic_id = $_POST['topic_id'];
		$post_id = $_POST['post_id'];
		$user_id = Yii::app()->session['user_id'];
		$type = $_POST['type'];
 		$model=new TopicQuestionAnswer;
                $dialogID = '';
                if(!empty(Yii::app()->session['dialog_id'])) {
                    $dialogID = Yii::app()->session['dialog_id'];
                }
		$model->topic_id = $topic_id;
                $model->dialog_id = $dialogID;
		$model->user_id = $user_id;
        $model->ip_address = myhelpers::get_client_ip();
		$model->post_id = $post_id;
		$model->question1 = $question1;
		$model->question2 = $question2;
		$model->question3 = $question3;
		$model->answer1 = $answer1;
		$model->answer2 = $answer2;
		$model->answer3 = $answer3;
		$model->type = $type;
		//echo "<pre>";print_r($model->attributes);exit;
		 if($model->save()){
            $users_model=Users::model()->findByPk($user_id);
            //echo "<pre>";print_r($users_model->attributes);exit;
            if($users_model !=null){
                if($users_model->category_groups_id !=""){
                    $category_groups_id_arr=explode(",",$users_model->category_groups_id);   
                }
                //echo "<pre>";print_r($category_groups_id_arr);
                if(isset($question1_model) && $question1_model!=null){
                    if (!in_array($question1_model->id,$category_groups_id_arr)){
                      $category_groups_id_arr[]=$question1_model->id;
                    }
                }
                //echo "<pre>";print_r($category_groups_id_arr);
                if(isset($question2_model) && $question2_model!=null){
                    if (!in_array($question2_model->id,$category_groups_id_arr)){
                      $category_groups_id_arr[]=$question2_model->id;
                    }
                }
                //echo "<pre>";print_r($category_groups_id_arr);
                if(isset($question3_model) && $question3_model!=null){
                    if (!in_array($question3_model->id,$category_groups_id_arr)){
                      $category_groups_id_arr[]=$question3_model->id;
                    }
                }
                //echo "<pre>";print_r($category_groups_id_arr);
                $users_model->category_groups_id=implode(",",$category_groups_id_arr);
                //echo $users_model->category_groups_id;exit;
                $users_model->save(false);
            }
        }
      $this->redirect(array('Topics/TopicsList'));
	} 
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Topics']))
		{
			$model->attributes=$_POST['Topics'];
                        $model->topic_description = strip_tags($_POST['Topics']['topic_description'],'<br></br><br/>');
                        //$model->topic_description = nl2br($model->topic_description); 
			if($model->save()){
                Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
                $this->redirect(Yii::app()->createUrl('topics/admin'));
            }else{
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
               $this->redirect(Yii::app()->createUrl('topics/admin'));
            }
                
		}

		$this->render('update',array('model'=>$model,));
	}

	
//=== START: MANAGE STATUS AND DELETE => TOPICS ====================//

	function actionManage_topics(){
        if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => Topic ================//
            $deleted = Topics::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
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
			$updated = Topics::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
//=== END: MANAGE STATUS AND DELETE => TOPICS ======================//
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Topics');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Topics('search');
        
		$model->unsetAttributes();  // clear any default values
        
		if(isset($_GET['Topics']))
			$model->attributes=$_GET['Topics'];
        
        $this->data['model'] = $model;
		$this->render('admin',$this->data);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Topics the loaded model
	 * @throws CHttpException
	 */
     
    /*public function filters()
    {
        return array(
            array(
                'CHttpCacheFilter + index',
                'lastModified'=>Yii::app()->db->createCommand("SELECT MAX(`update_time`) FROM {{post}}")->queryScalar(),
            ),
        );
    }*/
	
	public function loadModel($id)
	{
		$model=Topics::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Topics $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='topics-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionCreatenewtopic(){
        if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
        	$this->layout = 'registration';
            $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
    		if(count($ip_status) > 0){
    			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['create_topic']);
                        if(!empty(Yii::app()->session['dialog_id'])) {
                            $dialogID = Yii::app()->session['dialog_id'];
                            $this->redirect(Yii::app()->createUrl('Topics/TopicsList', array('dialog_id'=>$dialogID)));
                        }
                        else {
                            $this->redirect(Yii::app()->createUrl('Topics/TopicsList'));
                        }
    		} 
            /*$TopicQuestionModel = new TopicQuestions;
            $this->data['TopicQuestionModel'] = $TopicQuestionModel;
            
            $categorygroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active"','group'=>'category'));
            $this->data['categorygroupmodel'] = $categorygroupmodel;
            
            //$catgroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active"','order'=>'id'));
            //$this->data['catgroupmodel'] = $catgroupmodel;
            //echo "<pre>";
            //print_r($this->data['catgroupmodel'][0]->attributes);exit;
            */
            $TopicModel = new Topics('Create');
            $tagmodel = Topics::model()->findAll();
            $this->data['tagmodel'] = $tagmodel;
            
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
            }
            
            $Tagcatmodel = CategoryTags::model()->findAll(array('condition'=>'dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
            $Tagtypemodel= TypeTags::model()->findAll();
            
            //print_r($tagmodel);exit;
            
            //echo '<pre>';
            //print_r($_POST);exit;
            
            $cate_tag_string=implode(",",$_POST['alltags']);
            //echo $cate_tag_string;exit;
            if(isset($_POST["Topics"])){
            	$category = implode(",",$_POST['Topics']['category_tags']);
            	$type = implode(",",$_POST['Topics']['type_tags']);
            	
            	$TopicModel->attributes = $_POST["Topics"];
                $TopicModel->user_id = Yii::app()->session['user_id'];
                $TopicModel->category_tags = $category;
                $TopicModel->type_tags = $type;
                //$TopicModel->created_date = date("Y-m-d H:i:s");
                if(!empty(Yii::app()->session['dialog_id'])) {
                    $TopicModel->dialog_id = Yii::app()->session['dialog_id'];
                }
                require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
                $config = HTMLPurifier_Config::createDefault();
                $config->set('AutoFormat', 'Linkify', true);
                $purifier = new HTMLPurifier($config);
                $TopicModel->topic_description = strip_tags($_POST['Topics']['topic_description'],'<br></br><br/>');
                $TopicModel->topic_description = $purifier->purify($TopicModel->topic_description);
                //$TopicModel->topic_description = nl2br($TopicModel->topic_description); 
                if($TopicModel->save()){
                    /*if(isset($_POST['TopicQuestions'])){
                        $TopicQuestionModel->attributes =  $_POST['TopicQuestions'];
                        if($TopicQuestionModel->question1=="0")$TopicQuestionModel->question1="";
                        if($TopicQuestionModel->question2=="0")$TopicQuestionModel->question2="";
                        if($TopicQuestionModel->question3=="0")$TopicQuestionModel->question3="";
                        //echo "<pre>";print_r($TopicQuestionModel->attributes);exit;
                        $TopicQuestionModel->topic_id = $TopicModel->id;
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
                    }*/
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['topic_saved']);
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }
                
                unset(Yii::app()->session['topic_title']);
                unset(Yii::app()->session['topic_discription1']);
                $this->redirect('Viewtopic?topic_id='.$TopicModel->id);
            }
            $this->data["TopicModel"] = $TopicModel;
            $this->data["Tagcatmodel"] = $Tagcatmodel;
            $this->data["Tagtypemodel"] = $Tagtypemodel;
            $this->render('topics_form',$this->data);
       }else{
            $this->redirect(Yii::app()->createUrl('Site/loginUser'));
       }
    }
    
    
    public function actionViewtopic(){
                $this->layout = 'registration';
		$id = $_GET['topic_id'];
		$selected_user_id = 0;
		$last_comment_id = 0;
		$page_no = 0;
		$record_per_page = 20;
                
                $dialogID = '';
                if(!empty(Yii::app()->session['dialog_id'])) {
                    $dialogID = Yii::app()->session['dialog_id'];
                }
                
                
    
		if(!empty($id) && is_numeric($id)){
            $rule_order_no_model=TypeTags::model()->findAll(array('condition'=>'order_no >0 AND dialog_id=:dID', 'order'=>'order_no', 'params'=>array(':dID'=>$dialogID)));
	        $TopicModel = Topics::model()->findByPk($id);
			if(count($TopicModel)>0){
                                $this->data['meta_description'] = $TopicModel->topic_description;
                                $this->data['meta_title'] = $TopicModel->topic_title;
				$user_comment_condition_clause = "main_id=".$id;
				if(!empty($_GET['user_id']) && is_numeric($_GET['user_id'])){
					$selected_user_id = $_GET['user_id'];

					$tmp_sql = "SELECT id FROM all_posts WHERE main_id=".$id." AND post_type =1 AND user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (user_id=".$selected_user_id." OR comment_id IN (".$tmp_sql."))";
				}

				$user_comment_order_clause = "created_date DESC LIMIT ".$page_no.",".$record_per_page;
                $user_comment_model = AllPosts::model()->findAll(array('condition'=>$user_comment_condition_clause, 'order'=>$user_comment_order_clause));
                
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $user_comment){
						$last_comment_id = $user_comment->id;
					}
				}
			}
		}

		$WHEREPOPULAR = " status = 'Active' ORDER BY Totalcommentscount DESC LIMIT 0,10";
        $TestpopularSql = "SELECT topics.*,(SELECT COUNT(*) FROM all_posts WHERE all_posts.main_id = topics.id AND post_type = 1) AS Totalcommentscount
                         	FROM topics WHERE ".$WHEREPOPULAR;
        $PopularTopicListModel = Topics::model()->findAllBySql($TestpopularSql);
        $this->data["PopularTopicListModel"] = $PopularTopicListModel;

        $user_comment_flag_model = new AllPostsFlags;
        $this->data["user_comment_flag_model"] = $user_comment_flag_model;
        
        $flag_reason_model = FlagReason::model()->findAll(array('condition'=>'status=1'));
        $this->data["flag_reason_model"] = $flag_reason_model;
        
        //$topic_question_model = TopicQuestions::model()->findAll(array('condition'=>'topic_id='.$_GET['topic_id'].' AND dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
        $topic_question_model = TopicQuestions::model()->findAll(array('condition'=>'dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
        $this->data["topic_question_model"] = $topic_question_model;
        
        //$topic_question_find_model = TopicQuestions::model()->find(array('condition'=>'topic_id='.$_GET['topic_id'].' AND dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
        $topic_question_find_model = TopicQuestions::model()->find(array('condition'=>'dialog_id=:dID AND user_id=:uid', 'params'=>array(':dID'=>$dialogID, ':uid'=>Yii::app()->session['user_id'])));
        if($topic_question_find_model == null){
            $topic_question_count="0";
        }else{
            //$topic_question_count = TopicQuestions::model()->count(array('condition'=>'topic_id='.$_GET['topic_id'].' AND dialog_id=:dID AND question1="" AND question2="" AND question3=""', 'params'=>array(':dID'=>$dialogID)));   
            $topic_question_count = TopicQuestions::model()->count(array('condition'=>'dialog_id=:dID AND user_id=:uid AND question1="" AND question2="" AND question3=""', 'params'=>array(':dID'=>$dialogID, ':uid'=>Yii::app()->session['user_id'])));   
        }
        $this->data["topic_question_count"] = $topic_question_count;
        
        if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){        
            $mytopics_user = MyTopics::model()->find(array('condition'=>'user_id='.Yii::app()->session['user_id']));
            if(count($mytopics_user)>0){
    			$myids_array=explode(',',$mytopics_user->my_topics_ids);
                $totat_ids=$mytopics_user->my_topics_ids;
                if (!in_array($id, $myids_array)){
                    if(count($myids_array)>9){
                        array_shift($myids_array);
        	        }
                }else{
                    if (($key = array_search($id, $myids_array)) !== false) {
                           unset($myids_array[$key]);
                    }
                }
                $myids_array[] = $id;
                $str_mytoipcs=implode(",",$myids_array) ;
                //print_r($myids_array);
                //echo $str_mytoipcs;exit;
                $MyTopicmodel= MyTopics::model()->findByPk($mytopics_user->id);
                $MyTopicmodel->user_id = Yii::app()->session['user_id'];
                $MyTopicmodel->my_topics_ids = $str_mytoipcs; 
                //$MyTopicmodel->save();
                $totat_ids=$MyTopicmodel->my_topics_ids;
    
                $TestSql = "SELECT topics.*
                         FROM topics WHERE id IN(".$totat_ids.") AND status='Active' ORDER BY FIELD(id,".$totat_ids.") DESC";;
                $MyTopicListModel = Topics::model()->findAllBySql($TestSql);
                $this->data["MyTopicList"] = $MyTopicListModel;
            }
        }

		$UserComment = new AllPosts;
		if(!empty($_POST)){
		      //echo "<pre>";print_r($_POST);exit;
			$post_comment_array = array();
			$post_comment_array['user_id'] = Yii::app()->session['user_id'];
            $post_comment_array['main_id'] = $_GET['topic_id'];
            $post_comment_array['post_type'] = 1;
			$post_comment_array['like'] = 0;
			$post_comment_array['dislike'] = 0;
			if(isset($_POST['comment_id']) && $_POST['comment_id']!=0){
				$tmp_comment_id = $_POST['comment_id'];
				$post_comment_array['comment_id'] = $tmp_comment_id;
                require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
                                $config = HTMLPurifier_Config::createDefault();
                                $config->set('AutoFormat', 'Linkify', true);
                                $purifier = new HTMLPurifier($config);
				$post_comment_array['comment'] = strip_tags($_POST['replycomment_'.$tmp_comment_id],'<br></br><br/>');
                                $post_comment_array['comment'] = $purifier->purify($post_comment_array['comment']);
			}else if(!empty($_POST['post_comment_area'])){
				$post_comment_array['comment_id'] = 0;
                       require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
                                $config = HTMLPurifier_Config::createDefault();
                                $config->set('AutoFormat', 'Linkify', true);
                                $purifier = new HTMLPurifier($config);
				$post_comment_array['comment'] = strip_tags($_POST['post_comment_area'], '<br></br><br/>');
                                $post_comment_array['comment'] = $purifier->purify($post_comment_array['comment']);
			}
            $UserComment->main_comment_id = $_POST['main_comment_id'];
       		$UserComment->attributes = $post_comment_array;
            //echo "<pre>";print_r($UserComment->attributes);exit;
			$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
			if(count($ip_status) > 0){
				Yii::app()->user->setFlash('failure_msg', 'You are not authorized person to posting..');
			}else{
				if($UserComment->validate()){
	            	$UserComment->save();
                    $topic_question_answer_model=TopicQuestionAnswer::model()->find(array("condition"=>"user_id=".Yii::app()->session['user_id']." AND topic_id=".$UserComment->main_id." AND type='post' AND post_id=0","order"=>'id DESC'));
	            	if($topic_question_answer_model !=null){
	            	  if(count($topic_question_answer_model)>0){
	            	      $topic_question_answer_model->post_id=$UserComment->id;
                          $topic_question_answer_model->save(false);
	            	  }  
	            	}
                    
                    $this->redirect('Viewtopic?topic_id='.$id);
	             }
			}	
        }
        
        /* start for filter information in ajax */
        Yii::app()->session['filter']="";
        Yii::app()->session['filter_submit']="";
        if(isset($_POST["filter_submit"])){
            if(isset($_POST["Filter"])){
                Yii::app()->session['filter']=$_POST['Filter'];
                Yii::app()->session['filter_submit']=$_POST['filter_submit'];   
            }
        }
        /*
        if(isset($_GET["filter"])){
            $this->data["filter"]="filter=".$_GET["filter"];
            $this->data["filter"].="&question_no=".$_GET["question_no"];
            $this->data["filter"].="&question=".$_GET["question"];
            $this->data["filter"].="&option=".$_GET["option"];
            $this->data["filter"].="&question_id=".$_GET["question_id"];
            $this->data["filter"].="&type=".$_GET["type"];
            
            // start for selected option
            $this->data["selected_option"]["question_no"]=$_GET["question_no"];
            $this->data["selected_option"]["question"]=$_GET["question"];
            $this->data["selected_option"]["option"]=$_GET["option"];
            $this->data["selected_option"]["question_id"]=$_GET["question_id"];
            $this->data["selected_option"]["type"]=$_GET["type"];
            // End for selected option
        }
        */
        /* End for filter information in ajax */
		$this->data["PostUserComment"] = $UserComment;
		$this->data["UserComment"] = $user_comment_model;
		$this->data["topic_id"] = $id;
		$this->data["selected_user_id"] = $selected_user_id;
		$this->data["last_comment_id"] = $last_comment_id;
        $this->data["TopicModel"] = $TopicModel;
        $this->data["rule_order_no_model"] = $rule_order_no_model;
        $this->render('/topics/topics_view', $this->data);
    }
	
	public function actionGetcomments(){
		$topic_id = $_GET['topic_id'];
		$selected_user_id = 0;
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];
        $pagination = $_POST['pagination'];
		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
        if($pagination == 0){
            $total_record_to_fetch = 0;    
        }
        
            $dialogID = '';
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;

        $block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND block_user= 1 AND flag_type="Red" AND post_type=1','group'=>'commented_by'));
        if(count($block_user_model) > 0){
            $block_user_ids = array();
            foreach($block_user_model as $block_user){
                $block_user_ids[] = $block_user->commented_by;
            }
            $block_user_ids = implode(',',$block_user_ids);
            //echo $block_user_ids;exit;
            $block_condition = ' AND user_id NOT IN ('.$block_user_ids.')';
        }else{
            $block_condition = '';
        }
        
        $inactive_user_model = Users::model()->findAll(array('condition'=>'status="Inactive"'));
        if(count($inactive_user_model) > 0){
            $inactive_user_ids = array();
            foreach($inactive_user_model as $inactive_user){
                $inactive_user_ids[] = $inactive_user->id;
            }
            $inactive_user_ids = implode(',',$inactive_user_ids);
            //echo $block_user_ids;exit;
            $inactive_condition = ' AND user_id NOT IN ('.$inactive_user_ids.')';
        }else{
            $inactive_condition = '';
        }        

		$data_str = "";
		if(!empty($topic_id) && is_numeric($topic_id) && !empty($currect_section)){
	        $TopicModel = Topics::model()->findByPk($topic_id);
			if(count($TopicModel)>0){
				$user_comment_condition_clause = "main_id=".$topic_id.' AND post_type=1 AND status = 1'.$block_condition.$inactive_condition;
                //echo $user_comment_condition_clause;exit;
				$user_comment_order_clause = "";
				if($currect_section == "all_topics"){
					$user_comment_order_clause = "ucm.id DESC LIMIT 0,".$new_total_record_to_fetch;
				}else if($currect_section == "my_topics"){
					$user_comment_order_clause = "ucm.id DESC LIMIT 0,".$new_total_record_to_fetch;
					$selected_user_id = Yii::app()->session['user_id'];
				}else if($currect_section == "date_topics"){
					$user_comment_order_clause = "ucm.id DESC LIMIT 0,".$new_total_record_to_fetch;    
				}else if($currect_section == "popular_topics"){
                                    if(TopicQuestions::model()->count('dialog_id=:did', array(':did'=>$dialogID))>=1){
                                        $user_comment_order_clause = "post_score DESC LIMIT 0,".$new_total_record_to_fetch;
                                    }
                                    else{
                                        $user_comment_order_clause = "like_difference DESC LIMIT 0,".$new_total_record_to_fetch;
                                    }
                                        
				}else if($currect_section == "disagree_topics"){
					$user_comment_order_clause = "like_difference  ASC LIMIT 0,".$new_total_record_to_fetch;
				}

				if(!empty($_GET['selected_user_id']) && is_numeric($_GET['selected_user_id']) && $_GET['selected_user_id']!=0){
					$selected_user_id = $_GET['selected_user_id'];
				}

				if(!empty($selected_user_id) && $selected_user_id!=0){
					$tmp_sql = "SELECT uc.id FROM all_posts uc WHERE uc.main_id=".$topic_id." AND post_type=1 AND uc.user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (ucm.user_id=".$selected_user_id." OR ucm.comment_id IN (".$tmp_sql."))";
				}
				//$user_comment_model = UserComment::model()->findAll(array('condition'=>$user_comment_condition_clause, 'order'=>$user_comment_order_clause));
                
                //Start : for filtered data //
                /*
                $all_posts_filter_model=AllPosts::model()->findAll(array("condition"=>"post_type=1 AND main_id=".$topic_id,"select"=>"user_id","group"=>"user_id"));
                $all_post_user_ids="";
                if($all_posts_filter_model !=null){
                    foreach($all_posts_filter_model as $all_posts_filter_model_arr){
                        if($all_post_user_ids=="")
                            $all_post_user_ids=$all_posts_filter_model_arr->user_id;
                        else
                            $all_post_user_ids.=",".$all_posts_filter_model_arr->user_id;        
                    }  
                } 
                //echo $all_post_user_ids;exit;
                */
                
                $filter_question_answer_condition="";
                $filter_where_condition="";
                $filter_category_groups_condition="";
                //$filter_vote_special_condition="";
                if(Yii::app()->session['filter_submit']!=""){
                    if(!empty(Yii::app()->session['filter'])){
                        if(isset(Yii::app()->session['filter']['post'])){
                            foreach(Yii::app()->session['filter']['post'] as $post_key1=>$post_value1){
                                foreach($post_value1 as $post_value2){
                                    foreach($post_value2 as $post_key3=>$post_value3){
                                        $answer_no="";
                                        if($post_key1=="question1"){
                                            $answer_no="answer1";
                                        }else if($post_key1=="question2"){
                                            $answer_no="answer2";
                                        }else if($post_key1=="question3"){
                                            $answer_no="answer3";
                                        }
                                        if($filter_where_condition==""){
                                            $filter_where_condition.=" AND (".$post_key1."='".$post_key3."' AND  ".$answer_no."='".$post_value3."' AND type='post')";
                                        }else{
                                            $filter_where_condition.=" OR (".$post_key1."='".$post_key3."' AND  ".$answer_no."='".$post_value3."' AND type='post')";   
                                        }
                                        
                                        if($filter_category_groups_condition==""){
                                            $filter_category_groups_condition.="(category='".$post_key3."' AND groups='".$post_value3."')";
                                        }else{
                                            $filter_category_groups_condition.=" OR (category='".$post_key3."' AND groups='".$post_value3."')";   
                                        }
                                        
                                    }
                                    
                                }
                            }
                        }
                        
                        if(isset(Yii::app()->session['filter']['vote'])){
                            //$filter_vote_special_condition="1";
                            foreach(Yii::app()->session['filter']['vote'] as $vote_key1=>$vote_value1){
                                foreach($vote_value1 as $vote_value2){
                                    foreach($vote_value2 as $vote_key3=>$vote_value3){
                                        $answer_no="";
                                        if($vote_key1=="question1"){
                                            $answer_no="answer1";
                                        }else if($vote_key1=="question2"){
                                            $answer_no="answer2";
                                        }else if($vote_key1=="question3"){
                                            $answer_no="answer3";
                                        }
                                        if($filter_where_condition==""){
                                            $filter_where_condition.=" AND (".$vote_key1."='".$vote_key3."' AND  ".$answer_no."='".$vote_value3."')";
                                        }else{
                                            $filter_where_condition.=" OR (".$vote_key1."='".$vote_key3."' AND  ".$answer_no."='".$vote_value3."')";
                                        }
                                        
                                        if($filter_category_groups_condition==""){
                                            $filter_category_groups_condition.="(category='".$vote_key3."' AND groups='".$vote_value3."')";
                                        }else{
                                            $filter_category_groups_condition.=" OR (category='".$vote_key3."' AND groups='".$vote_value3."')";   
                                        }
                                    }
                                    
                                }
                            }
                        }    
                        
                        $category_ids="";
                        if($filter_category_groups_condition !=""){
                            $filter_category_groups_model=CategoryGroups::model()->findAll(array("condition"=>$filter_category_groups_condition,"select"=>"id"));
                            if($filter_category_groups_model !=null){
                                foreach($filter_category_groups_model as $filter_category_groups_model_arr){
                                    if($category_ids=="")
                                        $category_ids="FIND_IN_SET(".$filter_category_groups_model_arr->id.",category_groups_id)";
                                    else
                                        $category_ids.=" OR FIND_IN_SET(".$filter_category_groups_model_arr->id.",category_groups_id)";
                                }    
                            } 
                        }
                        //echo $category_ids;exit;
                        if($category_ids !=""){
                            $filter_Users_model=Users::model()->findAll(array("condition"=>$category_ids,"select"=>"id"));
                        }
                        $filter_user_ids="";
                        if($filter_Users_model !=null){
                                foreach($filter_Users_model as $filter_Users_model_arr){
                                    if($filter_user_ids=="")
                                        $filter_user_ids=$filter_Users_model_arr->id;
                                    else
                                        $filter_user_ids.=",".$filter_Users_model_arr->id;
                                }    
                            } 
                        //echo $filter_user_ids;exit;
                    }
                    
                    /*$question_answer_filter_user_ids="0";
                    if($all_post_user_ids !=""){
                        $question_answer_filter_model=TopicQuestionAnswer::model()->findAll(array("condition"=>"topic_id=".$topic_id.$filter_where_condition." AND user_id IN (".$all_post_user_ids.")","select"=>"user_id"));
                    }else
                    {
                        $question_answer_filter_model=TopicQuestionAnswer::model()->findAll(array("condition"=>"topic_id=".$topic_id.$filter_where_condition,"select"=>"user_id"));   
                    }*/
                    /*if($question_answer_filter_model !=null){
                        foreach($question_answer_filter_model as $question_answer_filter_model_arr){
                            if($question_answer_filter_user_ids=="0")
                                $question_answer_filter_user_ids=$question_answer_filter_model_arr->user_id;
                            else
                                $question_answer_filter_user_ids.=",".$question_answer_filter_model_arr->user_id;
                        }
                        
                        //for vote filter selected add extra query.
                        if($filter_vote_special_condition=="1"){
                            $filter_vote_special_condition=" AND (like_ids IN(".$question_answer_filter_user_ids.") OR dislike_ids IN(".$question_answer_filter_user_ids."))";
                        }
                        
                    }*/
                    //$filter_question_answer_condition=" AND user_id IN(".$question_answer_filter_user_ids.")";                           
                    /*if($filter_vote_special_condition=="1"){
                        //$filter_vote_special_condition=" AND (like_ids IN(".$filter_user_ids.") OR dislike_ids IN(".$filter_user_ids."))";
                        $filter_question_answer_condition=" AND (like_ids IN(".$filter_user_ids.") OR dislike_ids IN(".$filter_user_ids."))";
                    }else{
                        $filter_question_answer_condition=" AND user_id IN(".$filter_user_ids.")";   
                    }*/
                    $filter_question_answer_condition=" AND user_id IN(".$filter_user_ids.")";
                    if($filter_user_ids==""){
                        $filter_question_answer_condition=" AND user_id IN(0)";
                    }
                    if(isset(Yii::app()->session['filter']['vote'])){
                        $filter_question_answer_condition=""; 
                    }
                    
                    //echo $filter_vote_special_condition;exit;
                }
                //End : for filtered data //
                
				//$main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition.$filter_vote_special_condition." ORDER BY ".$user_comment_order_clause;
                if(isset(Yii::app()->session['filter']['vote'])){
                    $main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition." ORDER BY ".$user_comment_order_clause;
                }
                else{
                    $main_sql = "SELECT ucm.*, ucm.post_score as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition." ORDER BY ".$user_comment_order_clause;
                }
                //echo $main_sql;exit;
                $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
				//echo count($user_comment_model);exit;
                if(isset(Yii::app()->session['filter']['vote'])){
                    $main_cnt_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition;
                }
                else{
                    $main_cnt_sql = "SELECT ucm.*, ucm.post_score as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition;
                }
                
                //$total_post_count = AllPosts::model()->count(array('condition'=>$user_comment_condition_clause));
                $total_post_count=count($user_comment_model);
                //$total_post_count = count($total_post_count);
                $cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $alltopic){
					   /*Start For filter to display only liked and disliked users post for Vote filter only */
                        if(isset(Yii::app()->session['filter']['vote'])){
                                    $temp_status=1;                                    
                                    $filter_user_ids_array=explode(",",$filter_user_ids);
                                    $temp_like_ids=explode(",",$alltopic->like_ids);
                                    $temp_dislike_ids=explode(",",$alltopic->dislike_ids);
                                    $result = array_merge($temp_like_ids, $temp_dislike_ids);
                                    $result = array_unique($result);
                                    foreach($filter_user_ids_array as $filter_user_ids_array_arr){
                                        foreach($result as $result_arr){
                                            if($filter_user_ids_array_arr==$result_arr){
                                                $temp_status=0;
                                                break;   
                                            }
                                        }
                                    }
                                    if($temp_status){
                                        continue;
                                    }
                        }
                       /*Start For filter to display only liked and disliked users post for Vote filter only */
                       
						$last_comment_id = $alltopic->id;
						$stringtime = strtotime($alltopic->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        /*if($alltopic->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($alltopic->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($alltopic->topic_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->topic_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->topic_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        }*/
                        $green_cnt = count($alltopic->topic_green_comment);
                        $red_cnt = count($alltopic->topic_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Green','1');
                        $red_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Red','1');
                        
						$data_str .= '<tr id="'.$alltopic->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                                                        if($red_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"red")).'" style="text-decoration:none;">
                                        <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                        $data_str .= '</td>
                                                    <td style="vertical-align: top;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                        <a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->user_comment->username).'</a>';
                                                                        if($alltopic->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->topic_other_comment->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->topic_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>
                                                                    </span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.$alltopic->comment.'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$alltopic->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>';
                                                                                    $green_vote_count=$alltopic->like;
                                                                                    $red_vote_count=$alltopic->dislike;
                                                                                    //start for filtered vote //
                                                                                    if(isset(Yii::app()->session['filter']['vote'])){
                                                                                        $green_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'like_ids');
                                                                                        $red_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'dislike_ids');
                                                                                    }/*
                                                                                    if(isset($_POST["filter"])){
                                                                                        if($_POST["type"]=="vote"){
                                                                                            $green_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'likedvote');
                                                                                            $red_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'dislikedvote');     
                                                                                        } 
                                                                   				    }*/
                                                                                    //end for filtered vote //
                                                                       $data_str .='
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alltopic->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$green_vote_count.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alltopic->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$red_vote_count.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alltopic->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:-1px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$alltopic->id.'\');" id="reply_'.$alltopic->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/topics/Viewtopic?topic_id='.$topic_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alltopic->id.'" name="user_comment_'.$alltopic->id.'" value="'.$alltopic->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alltopic->id.'" style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="showhide('.$alltopic->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alltopic->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alltopic->id.',\'Green\');" style="text-decoration: none;color:green;font-size: 13px; font-color:"green";">&#9607 Green ';
                                                                                             if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alltopic->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;font-color:"red";">&#9607 Red ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            if($alltopic->main_comment_id == 0){
                                                                                                $main_comment_id = $alltopic->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alltopic->main_comment_id;
                                                                                            }    
                                                                                                
                                                                                                
                                                                $data_str .=               '</a></div>
																						</div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                                  
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    </table>
                                                                 </td>    
             	                                            </tr>
                                                         </table>
                                                      </td>
                                                	</tr>
                                                    <tr style="width:30px;margin:5px 0 0 0;">
                                                      <td colspan="2" style="width:100%">
                                                        <table style="width: 100%; vertical-align: top;">
                										  <tr id="reply_form_id_'.$alltopic->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$alltopic->id.'" method="post" action="'.Yii::app()->createUrl("topics/Viewtopic?topic_id=".$topic_id).'" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$alltopic->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$alltopic->main_id.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$alltopic->id.'">
            																		<textarea id="replycomment_'.$alltopic->id.'" name="replycomment_'.$alltopic->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
            																	</td>
            																</tr>
            																<tr>
            																	<td>
                                                                                    <input value="Post" class="type" style="float: right;" type="submit"/>
            																	</td>
            																</tr>
            															</table>
            				                                       </form>
            													</td>
            												</tr>                                                        
                                                        </table>														
                                                    </td>
                                            	</tr>                                             
											</table>                                        	
										</td>
									</tr>';
					}
                    if($total_post_count > $new_total_record_to_fetch){                        
                        $data_str .='<tr style="background-color:#FFFFCC !important;cursor:pointer;" onclick="get_topic_comments(1);">
        									<td style="width:100%;text-align:center;vertical-align: middle;background-color:#3AC1F2;color:#FFFFFF;height:35px;font-size: 15px;">Show more posts</td>
        								</tr>';    
    				}/*else{
                        $data_str .='<tr style="background-color:#FFFFCC !important;">
        									<td style="width:100%;text-align:center;vertical-align: middle;background-color:#3AC1F2;color:#FFFFFF;height:35px;font-size: 15px;">No more posts....</td>
        								</tr>';    
    				    
    				}*/
                }else{
					$no_more_data = 1;
					$data_str = '<tr style="background-color:#FFFFCC !important;">
									<td style="width:100%">No more records available!!!</td>
								</tr>';
				}
			}
		}

		/*if($prev_last_comment_id == $last_comment_id){
			$no_more_data = 1;
			$data_str = '<tr style="background-color:#FFFFCC !important;">
							<td style="width:100%">No more records available!!!</td>
						</tr>';
		}*/

		$response_aray = array();
		$response_aray['topic_id'] = $topic_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;

		print_r(json_encode($response_aray));exit;
	}

    public function actionViewtags(){ 
        $this->layout = 'registration';
        $tagmodel = Topics::model()->findAll();
        $this->data['tagmodel'] = $tagmodel;
        if($_GET['tag']=='cat'){
            $this->render('/topics/cat_tag_list',$this->data);
        }elseif($_GET['tag']=='type'){
            $this->render('/topics/type_tag_list',$this->data);
        }
    }

    public function actionUpdatetopic(){
        	//echo "<pre>";print_r($_POST);exit;
			 
        if(Yii::app()->session['topic_title']){
            unset(Yii::app()->session['topic_title']);
        }
        $id= $_GET['topic_id'];
        $this->layout = 'registration';
        $TopicModel = Topics::model()->findByPk($id);
        $TopicModel->topic_description = strip_tags($TopicModel->topic_description,'<br></br><br/>');

        $TopicQuestionModel = TopicQuestions::model()->find(array('condition'=>'topic_id='.$id));
        if(count($TopicQuestionModel) == 0){
            $TopicQuestionModel = new TopicQuestions;
        }
        $this->data['TopicQuestionModel'] = $TopicQuestionModel;
        //echo "<pre>";print_r($TopicQuestionModel->attributes);exit;
        $categorygroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active"','group'=>'category'));
		//print_r($a);exit;
        $this->data['categorygroupmodel'] = $categorygroupmodel;
        
        $catgroupmodel = CategoryGroups::model()->findAll(array('condition'=>'status="Active"'));
        $this->data['catgroupmodel'] = $catgroupmodel;
        
        //echo "<pre>";
        //print_r($TopicQuestionsModel->attributes);exit;
        $dialogID = '';
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }
        $Tagcatmodel        = CategoryTags::model()->findAll(array('condition'=>'dialog_id=:did', 'params'=>array(':did'=>$dialogID)));
        $Tagtypemodel        = TypeTags::model()->findAll();
                
        
        if(isset($_POST["Topics"])){
            //echo "<pre>";print_r($_POST);exit;
            $TopicModel->user_id = Yii::app()->session['user_id'];
            //$TopicModel->created_date = date("Y-m-d H:i:s");    
            //$TopicModel->topic_description = $_POST['Topics']['topic_description'];
            $TopicModel->attributes = $_POST["Topics"];
            require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
            $config = HTMLPurifier_Config::createDefault();
            $config->set('AutoFormat', 'Linkify', true);
            $purifier = new HTMLPurifier($config);
            $TopicModel->topic_description = strip_tags($_POST['Topics']['topic_description'],'<br></br><br/>');
            $TopicModel->topic_description = $purifier->purify($TopicModel->topic_description);
            //$TopicModel->topic_description = nl2br($TopicModel->topic_description); 
            $category_tags = array_unique($_POST['Topics']['category_tags']);
            if($category_tags!=''){
            	$category_tags = implode(",",$category_tags);
            }
            $type_tags = array_unique($_POST['Topics']['type_tags']);
            if($type_tags!=''){
            	$type_tags = implode(",",$type_tags);
            }
            $TopicModel->category_tags = $category_tags;
            $TopicModel->type_tags = $type_tags;
            
            if($TopicModel->save()){
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
                    //echo ($TopicQuestionModel->option1);exit;
                    
                    $TopicQuestionModel->topic_id = $TopicModel->id;
                    $TopicQuestionModel->user_id = Yii::app()->session['user_id'];
                    //echo "<pre>";
                    //print_r($TopicQuestionModel->attributes);exit;
                    if($TopicQuestionModel->validate()){
                        $TopicQuestionModel->save();
                    }
                }                
            }
            $this->redirect('Viewtopic?topic_id='.$TopicModel->id);
        }
        
        $tagmodel = Topics::model()->findAll();
        $this->data['tagmodel'] = $tagmodel;
        
        $this->data["TopicModel"] = $TopicModel;
        $this->data["Tagcatmodel"] = $Tagcatmodel;
        $this->data["Tagtypemodel"] = $Tagtypemodel;
        
        $this->render('/topics/topics_form',$this->data);
        
        
        
    }

	public function actionTopicsList_old(){
		$this->layout = 'registration';

		$record_to_fetch = $this->record_to_fetch;
		$page = 0;
		
		$WHERE = "status='Active'";
		$alltopics_order = " ORDER BY id DESC LIMIT ".$page.",".$record_to_fetch;
        
		//=== START: FETCH ALL TOPICS ======================//
		$TestSql = "SELECT topics.*,
					(SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
					(SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					FROM topics WHERE ".$WHERE.$alltopics_order;
		$TopicListModel = Topics::model()->findAllBySql($TestSql);
		$this->data["TopicListModel"] = $TopicListModel;
		//=== END: FETCH ALL TOPICS ========================//


		//=== START: FETCH MY TOPICS =======================//
		$WHEREMYTOPICS = "status='Active' AND user_id=".Yii::app()->session['user_id'];
		$mytopics_order = " ORDER BY id DESC LIMIT ".$page.",".$record_to_fetch;
        $TestSqlMYTOPICS = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREMYTOPICS.$mytopics_order;
         $mytopicssviewmodel = MyTopics::model()->find(array('condition'=>'user_id='.Yii::app()->session['user_id']));
         if(count($mytopicssviewmodel) > 0){
         	
         	$test = explode(",",$mytopicssviewmodel->my_topics_ids);
         	$test = array_reverse($test);
         	$topic_ids = implode(",",$test);
         	
         	$TopicListBymytopicsModel = Topics::model()->findAll(array('condition'=>'id IN('.$topic_ids.')',"order"=>"FIELD(id,".$topic_ids.")"));
         	$this->data['TopicListBymytopicsModel'] = $TopicListBymytopicsModel;
         }
         
         //=== END: FETCH MY TOPICS =========================//


         //=== START: FETCH POPULAR TOPICS =======================//
        $WHEREPOPULAR = "status = 'Active'";
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag'];   
         $WHEREPOPULAR.=" AND FIND_IN_SET('".$value."', category_tags)";
         /*$tagdetailmodel = CategoryTags::model()->find(array('condition'=>'cat_tag="'.$_GET['tag'].'" '));
         if(count($tagdetailmodel)>0){
            $this->data["tagdetailmodel"] = $tagdetailmodel;
         }*/
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHEREPOPULAR.=" AND FIND_IN_SET('".$value."', type_tags)";
         /*$typetagdetailmodel = TypeTags::model()->find(array('condition'=>'type_tag="'.$_GET['tag'].'" '));
         if(count($typetagdetailmodel)>0){
            $this->data["typetagdetailmodel"] = $typetagdetailmodel;
         }*/
        }
        $popular_topics_order = " ORDER BY Totalcommentscount DESC LIMIT ".$page.",".$record_to_fetch;
		$TestSqlPOPULAR = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREPOPULAR.$popular_topics_order;
         $TopicListBypopularModel = Topics::model()->findAllBySql($TestSqlPOPULAR);
         $this->data['TopicListBypopularModel'] = $TopicListBypopularModel;
         //=== END: FETCH POPULAR TOPICS =========================//


         //=== START: FETCH DATE TOPICS ==========================//
         
         $WHEREDATE = "status='Active'";
         $date_topics_order = " ORDER BY created_date DESC LIMIT ".$page.",".$record_to_fetch;
         $TestSqlDATE = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREDATE.$date_topics_order;
         
         $TopicListBydateModel = Topics::model()->findAllBySql($TestSqlDATE);
         $this->data['TopicListBydateModel'] = $TopicListBydateModel;
         
         //=== DATE: FETCH DATE TOPICS ============================//


        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag'];   
         $WHERE.=" AND FIND_IN_SET('".$value."', category_tags)";
         $tagdetailmodel = CategoryTags::model()->find(array('condition'=>'cat_tag="'.$_GET['tag'].'" '));
         if(count($tagdetailmodel)>0){
            $this->data["tagdetailmodel"] = $tagdetailmodel;
         }
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHERE.=" AND FIND_IN_SET('".$value."', type_tags)";
         $typetagdetailmodel = TypeTags::model()->find(array('condition'=>'type_tag="'.$_GET['tag'].'" '));
         if(count($typetagdetailmodel)>0){
            $this->data["typetagdetailmodel"] = $typetagdetailmodel;
         }
        }
        
        $tagmodel = Topics::model()->findAll();
        $this->data['tagmodel'] = $tagmodel;

        $this->render('/topics/topics_list',$this->data);
    }
    
    
    

	public function actionTopicsList(){
		$this->layout = 'registration';

		$record_to_fetch = $this->record_to_fetch;
		$page = 0;
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
                else{
                    $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
                }
                
		$WHERE = "status='Active' AND dialog_id='".$dialogID."'";
                
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag']; 
         $WHERE.=" AND FIND_IN_SET('".$value."', category_tags)";
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHERE.=" AND FIND_IN_SET('".$value."', type_tags)";
        }        
		$alltopics_order = " ORDER BY Totalcommentscount DESC LIMIT ".$page.",".$record_to_fetch;
        
		//=== START: FETCH ALL TOPICS ======================//
		/*
        $TestSql = "SELECT topics.*,
					(SELECT COUNT(id)  FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
					(SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					FROM topics WHERE ".$WHERE.$alltopics_order;
        */
        /*$TestSql = "SELECT topics.*,
					(SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
					(SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					FROM topics WHERE ".$WHERE.$alltopics_order;*/
        $TestSql_Pin_To_Top = "SELECT topics.*,
					(SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
					(SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					FROM topics WHERE pin_to_top=1 AND ".$WHERE.$alltopics_order;
               
        $TopicListModel_Pin_To_Top = Topics::model()->findAllBySql($TestSql_Pin_To_Top);
        
        $TestSql_Not_Pin_To_Top = "SELECT topics.*,
					(SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
					(SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					FROM topics WHERE pin_to_top=0 AND ".$WHERE.$alltopics_order;
               
        $TopicListModel_Not_Pin_To_Top = Topics::model()->findAllBySql($TestSql_Not_Pin_To_Top);
        
        $TopicListModel = array_merge($TopicListModel_Pin_To_Top, $TopicListModel_Not_Pin_To_Top);
        $this->data["TopicListModel"] = $TopicListModel;
		//=== END: FETCH ALL TOPICS ========================//

		//=== START: FETCH MY TOPICS =======================//
		/*$WHEREMYTOPICS = "status='Active' AND user_id=".Yii::app()->session['user_id'];
		$mytopics_order = " ORDER BY id DESC LIMIT ".$page.",".$record_to_fetch;
        $TestSqlMYTOPICS = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREMYTOPICS.$mytopics_order;*/
         
         if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
             $mytopicssviewmodel = MyTopics::model()->find(array('condition'=>'user_id='.Yii::app()->session['user_id']));
             if(count($mytopicssviewmodel) > 0){
             	$test = explode(",",$mytopicssviewmodel->my_topics_ids);
             	$test = array_reverse($test);
             	$topic_ids = implode(",",$test);
                
        		$WHERE = "status='Active'";
                if($_GET['searchtopics']=='mytagscat'){
                 $value=$_GET['tag']; 
                 $WHERE.=" AND FIND_IN_SET('".$value."', category_tags)";
                }
                if($_GET['searchtopics']=='mytagstype'){
                 $value=$_GET['tag'];   
                 $WHERE.=" AND FIND_IN_SET('".$value."', type_tags)";
                }        
                
                
             	//$TopicListBymytopicsModel = Topics::model()->findAll(array('condition'=>$WHERE.' AND id IN('.$topic_ids.')',"order"=>"FIELD(id,".$topic_ids.")"));
             	$TopicListBymytopicsModel_Pin_To_Top = Topics::model()->findAll(array('condition'=>$WHERE.' AND id IN('.$topic_ids.') AND pin_to_top=1',"order"=>"FIELD(id,".$topic_ids.")"));
                $TopicListBymytopicsModel_Not_Pin_To_Top = Topics::model()->findAll(array('condition'=>$WHERE.' AND id IN('.$topic_ids.') AND pin_to_top=0',"order"=>"FIELD(id,".$topic_ids.")"));
                $TopicListBymytopicsModel = array_merge($TopicListBymytopicsModel_Pin_To_Top, $TopicListBymytopicsModel_Not_Pin_To_Top);
                //echo count($TopicListBymytopicsModel);exit;
                $this->data['TopicListBymytopicsModel'] = $TopicListBymytopicsModel;
             }
         }
         //=== END: FETCH MY TOPICS =========================//


         //=== START: FETCH POPULAR TOPICS =======================//
        $WHEREPOPULAR = "status = 'Active' AND dialog_id='".$dialogID."'";
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag']; 
         $WHEREPOPULAR.=" AND FIND_IN_SET('".$value."', category_tags)";
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHEREPOPULAR.=" AND FIND_IN_SET('".$value."', type_tags)";
        }
        /*$popular_topics_order = " ORDER BY Totalcommentscount DESC LIMIT ".$page.",".$record_to_fetch;
		$TestSqlPOPULAR = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREPOPULAR.$popular_topics_order;
          //echo $TestSqlPOPULAR;exit;               
        This condition is true but this replacing reason is that when any category is selcted and sort is ACTIVE at that time sord by post is not diaplay properly.*/
        /*$TestSqlPOPULAR = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE ".$WHEREPOPULAR.$alltopics_order;
         
         $TopicListBypopularModel = Topics::model()->findAllBySql($TestSqlPOPULAR);*/
         
         $TestSqlPOPULAR_Pin_To_Top = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE topics.pin_to_top=1 AND ".$WHEREPOPULAR.$alltopics_order;
         
         $TopicListBypopularModel_Pin_To_Top = Topics::model()->findAllBySql($TestSqlPOPULAR_Pin_To_Top);
         
         $TestSqlPOPULAR_Not_Pin_To_Top = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE topics.pin_to_top=0 AND ".$WHEREPOPULAR.$alltopics_order;
         
         $TopicListBypopularModel_Not_Pin_To_Top = Topics::model()->findAllBySql($TestSqlPOPULAR_Not_Pin_To_Top);
         $TopicListBypopularModel = array_merge($TopicListBypopularModel_Pin_To_Top, $TopicListBypopularModel_Not_Pin_To_Top);
         $this->data['TopicListBypopularModel'] = $TopicListBypopularModel;
         //=== END: FETCH POPULAR TOPICS =========================//
         
         
         //=== START: FETCH AGREE TOPICS =======================//
        $WHEREAGREE = "status = 'Active' AND dialog_id='".$dialogID."'";
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag']; 
         $WHEREAGREE.=" AND FIND_IN_SET('".$value."', category_tags)";
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHEREAGREE.=" AND FIND_IN_SET('".$value."', type_tags)";
        }
        /*$popular_topics_order = " ORDER BY Totalcommentscount DESC LIMIT ".$page.",".$record_to_fetch;
		$TestSqlPOPULAR = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHEREPOPULAR.$popular_topics_order;
          //echo $TestSqlPOPULAR;exit;               
        This condition is true but this replacing reason is that when any category is selcted and sort is ACTIVE at that time sord by post is not diaplay properly.*/
        $alltopics_order_agree = " ORDER BY topic_score DESC LIMIT ".$page.",".$record_to_fetch;
        /*$TestSqlAgree = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE ".$WHEREAGREE.$alltopics_order_agree;
         
         $TopicListByagreeModel = Topics::model()->findAllBySql($TestSqlAgree);*/
        $TestSqlAgree_Pin_To_Top = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE ".$WHEREAGREE." AND topics.pin_to_top=1".$alltopics_order_agree;
         
         $TopicListByagreeModel_Pin_To_Top = Topics::model()->findAllBySql($TestSqlAgree_Pin_To_Top);
         $TestSqlAgree_Not_Pin_To_Top = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
					      FROM topics WHERE ".$WHEREAGREE." AND topics.pin_to_top=0".$alltopics_order_agree;
         
         $TopicListByagreeModel_Not_Pin_To_Top = Topics::model()->findAllBySql($TestSqlAgree_Not_Pin_To_Top);
         $TopicListByagreeModel = array_merge($TopicListByagreeModel_Pin_To_Top, $TopicListByagreeModel_Not_Pin_To_Top);
         $this->data['TopicListByagreeModel'] = $TopicListByagreeModel;
         //=== END: FETCH AGREE TOPICS =========================//


         //=== START: FETCH DATE TOPICS ==========================//
         
         $WHEREDATE = "status='Active' AND dialog_id='".$dialogID."'";
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag']; 
         $WHEREDATE.=" AND FIND_IN_SET('".$value."', category_tags)";
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHEREDATE.=" AND FIND_IN_SET('".$value."', type_tags)";
        }          
         
         $date_topics_order = " ORDER BY created_date DESC LIMIT ".$page.",".$record_to_fetch;
         /*$TestSqlDATE = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE dialog_id='".$dialogID."' AND ".$WHEREDATE.$date_topics_order;
         
         $TopicListBydateModel = Topics::model()->findAllBySql($TestSqlDATE);*/
         
         $TestSqlDATE_Pin_To_Top = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE dialog_id='".$dialogID."' AND topics.pin_to_top=1 AND ".$WHEREDATE.$date_topics_order;
         
         $TopicListBydateModel_Pin_To_Top = Topics::model()->findAllBySql($TestSqlDATE_Pin_To_Top);
         
         $TestSqlDATE_NOT_Pin_To_Top = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE dialog_id='".$dialogID."' AND topics.pin_to_top=0 AND ".$WHEREDATE.$date_topics_order;
         
         $TopicListBydateModel_NOT_Pin_To_Top = Topics::model()->findAllBySql($TestSqlDATE_NOT_Pin_To_Top);
         
         $TopicListBydateModel = array_merge($TopicListBydateModel_Pin_To_Top, $TopicListBydateModel_NOT_Pin_To_Top);
         
         $this->data['TopicListBydateModel'] = $TopicListBydateModel;
         
         //=== DATE: FETCH DATE TOPICS ============================//
         
         
         //=== START: FETCH LAST POST TOPICS ==========================//
         
         $WHERELAST_POST = "status='Active' AND dialog_id='".$dialogID."'";
        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag']; 
         $WHERELAST_POST.=" AND FIND_IN_SET('".$value."', category_tags)";
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHERELAST_POST.=" AND FIND_IN_SET('".$value."', type_tags)";
        }          
         
         $last_post_topics_order = " ORDER BY LastPosttime DESC LIMIT ".$page.",".$record_to_fetch;
         /*$TestSqlLAST_POST = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime,
                         (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS LastPosttime
                         FROM topics WHERE dialog_id='".$dialogID."' AND ".$WHERELAST_POST.$last_post_topics_order;
         
         $TopicListByLAST_POSTModel = Topics::model()->findAllBySql($TestSqlLAST_POST);*/
         
         $TestSqlLAST_POST_Pin_To_Top = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime,
                         (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS LastPosttime
                         FROM topics WHERE dialog_id='".$dialogID."' AND topics.pin_to_top=1 AND ".$WHERELAST_POST.$last_post_topics_order;
         
         $TopicListByLAST_POSTModel_Pin_To_Top = Topics::model()->findAllBySql($TestSqlLAST_POST_Pin_To_Top);
         
         $TestSqlLAST_POST_Not_Pin_To_Top = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime,
                         (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS LastPosttime
                         FROM topics WHERE dialog_id='".$dialogID."' AND topics.pin_to_top=0 AND ".$WHERELAST_POST.$last_post_topics_order;
         
         $TopicListByLAST_POSTModel_Not_Pin_To_Top = Topics::model()->findAllBySql($TestSqlLAST_POST_Not_Pin_To_Top);
         $TopicListByLAST_POSTModel = array_merge($TopicListByLAST_POSTModel_Pin_To_Top, $TopicListByLAST_POSTModel_Not_Pin_To_Top);
         $this->data['TopicListBylastpostModel'] = $TopicListByLAST_POSTModel;
         
         //=== END: FETCH LAST POST TOPICS ============================//

        if($_GET['searchtopics']=='mytagscat'){
         $value=$_GET['tag'];   
         $WHERE.=" AND FIND_IN_SET('".$value."', category_tags)";
         $tagdetailmodel = CategoryTags::model()->find(array('condition'=>'cat_tag="'.$_GET['tag'].'" '));
         if(count($tagdetailmodel)>0){
            $this->data["tagdetailmodel"] = $tagdetailmodel;
         }
        }
        if($_GET['searchtopics']=='mytagstype'){
         $value=$_GET['tag'];   
         $WHERE.=" AND FIND_IN_SET('".$value."', type_tags)";
         $typetagdetailmodel = TypeTags::model()->find(array('condition'=>'type_tag="'.$_GET['tag'].'" '));
         if(count($typetagdetailmodel)>0){
            $this->data["typetagdetailmodel"] = $typetagdetailmodel;
         }
        }
        
        $tagmodel = Topics::model()->findAll(array('condition'=>'dialog_id=:did', 'params'=>array(':did'=>$dialogID)));
        $this->data['tagmodel'] = $tagmodel;

        $this->render('/topics/topics_list',$this->data);
    }


    
    
    
    public function actionGettopics(){
        //echo "<pre>";
        //print_r($_POST);exit;
    	$record_cnt = 0;
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
        
    	if(!empty($_POST)){
            $last_id = 0;

            //=== START: SET WHERE CLAUSE ======================//
            $WHERE = "";
            if(!empty($_POST['last_id'])){
            	$WHERE = " status='Active' AND dialog_id='".$dialogID."'";
                if($_GET['searchtopics']=='mytagscat'){
                    $value=$_GET['tag']; 
                    $WHERE.=" AND FIND_IN_SET('".$value."', category_tags)";
                }
                if($_GET['searchtopics']=='mytagstype'){
                    $value=$_GET['tag'];   
                    $WHERE.=" AND FIND_IN_SET('".$value."', type_tags)";
                }
                
                if($_POST['currect_section'] == "alltopics" || $_POST['currect_section'] == "popular"){
                    $WHERE .= " AND  topics.id NOT IN(".$_SESSION['default_topic_ids'].") ";
                }elseif($_POST['currect_section'] == "mytopics"){
                    $WHERE .= " AND  topics.id NOT IN(".$_SESSION['my_topic_ids'].") AND user_id=".Yii::app()->session['user_id'];
                    //$WHERE .= " AND user_id=".Yii::app()->session['user_id'];
                }/*elseif($_POST['currect_section'] == "date"){
                    $WHERE .= " AND id < ".$_POST['last_id'];
                }*/
                
            }
            //=== END: SET WHERE CLAUSE ========================//

            //=== START: SET ORDER CLAUSE ======================//
            $start_from = 0;
            $record_to_fetch = $this->record_to_fetch;
            //$order_by_term = "id";
            if($_POST['currect_section'] == "popular"){
            	$order_by_term = "Totalcommentscount";
            	$start_from = $_POST['next_page']*$record_to_fetch;
            }else if($_POST['currect_section'] == "date"){
                $start_from = 1+$_POST['next_page']*$record_to_fetch;
            	$order_by_term = "created_date";
            }else if($_POST['currect_section'] == "agree"){
            	$order_by_term = "topic_score";
                $start_from = $_POST['next_page']*$record_to_fetch;
            }else if($_POST['currect_section'] == "last_post"){
            	$order_by_term = "LastPosttime";
                $start_from = 1+$_POST['next_page']*$record_to_fetch;
            }else if($_POST['currect_section'] == "alltopics"){
            	$order_by_term = "Totalcommentscount";
            }else if($_POST['currect_section'] == "mytopics"){
            	$order_by_term = "Totalcommentscount";
            }
            
            if($_POST['currect_section'] == "date"){
                $order_by = " ORDER BY ".$order_by_term." DESC LIMIT ".$start_from.",".$record_to_fetch;
            }
            else{
                $order_by = " ORDER BY ".$order_by_term." DESC LIMIT ".$start_from.",".$record_to_fetch;
            }
            
            //=== END: SET ORDER CLAUSE ========================//
            

            $data_str = "";
    		if($WHERE != ""){
                    if($_POST['currect_section'] == "agree"){
                        $TestSql = "SELECT topics.*,
					      (SELECT COUNT(id)  FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
				          (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
			    			FROM topics WHERE ".$WHERE.$order_by;
                    }else if($_POST['currect_section'] == "last_post"){
                        $TestSql = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime,
                         (SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1 ORDER BY lasttime DESC LIMIT 0,1) AS LastPosttime
                         FROM topics WHERE ".$WHERE.$order_by;
                    }else if($_POST['currect_section'] == "date"){
                        $TestSql = "SELECT topics.*,
                         (SELECT COUNT(id) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount,
                         (SELECT user_comment.created_date as lasttime FROM user_comment WHERE user_comment.topic_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
                         FROM topics WHERE ".$WHERE.$order_by;
                    }
                    else{
    			$TestSql = "SELECT topics.*,
			    			(SELECT COUNT(all_posts.id) FROM all_posts WHERE all_posts.main_id = topics.id AND post_type=1) AS Totalcommentscount,
			    			(SELECT all_posts.created_date as lasttime FROM all_posts WHERE all_posts.main_id = topics.id ORDER BY lasttime DESC LIMIT 0,1) AS Lastdatetime
			    			FROM topics WHERE ".$WHERE.$order_by;
                    }
                //echo $TestSql; exit;            
              	$TopicListModel = Topics::model()->findAllBySql($TestSql);
				$record_cnt = count($TopicListModel);
                                if($record_cnt > 0){
					foreach($TopicListModel as $topic_record){
					   
                        //$last_id =  $_SESSION['str_ids'];
					    $last_id = $topic_record->id;
                       
                       if($_POST['currect_section'] == "alltopics" || $_POST['currect_section'] == "popular"){
                           if($_SESSION['default_topic_ids']==""){
                            $_SESSION['default_topic_ids'] = $last_id;
                           }else{
                            $_SESSION['default_topic_ids'] .= ",".$last_id;
                           }
                       }else if($_POST['currect_section'] == "mytopics"){
                           if($_SESSION['my_topic_ids']==""){
                            $_SESSION['my_topic_ids'] = $last_id;
                           }else{
                            $_SESSION['my_topic_ids'] .= ",".$last_id;
                           }
                       }
                       
                       
					   

                        if(!empty($topic_record->Lastdatetime) || $topic_record->Lastdatetime !=Null){
                            $stringtime= strtotime($topic_record->Lastdatetime);
                            $date1 = date('d/m/Y',$stringtime);
                            $stringtime= strtotime($topic_record->Lastdatetime);
                            $date2 = date('H:i',$stringtime);
                            $fulldate=$date1.'-'.$date2;
                         }
                        
                        $Topic_description=strip_tags(myhelpers::get_cropped_text($topic_record->topic_description, 180));//substr($topic_record->topic_description,0, 180);
                        if(strlen($topic_record->topic_description) > 180){
                            $Topic_description.= "...";
                        }
                        $fulldate = ($_POST['currect_section']=='last_post')?strtotime($topic_record->all_posts_relation[0]->created_date):'';
		    			$data_str .= '<div class="topic1" id='. $topic_record->id.'>
                                        <h2 style="font-family: Tahoma;">
                                            <img src='.Yii::app()->baseUrl.'/images/Square.png>
                                            <a href='.Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_record->id)).' style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
            					    			'.$topic_record->topic_title.'
                                            </a>                                        
                                        </h2>
                                        <p class="toptext">'.$Topic_description .'</p>
                                        <p class="topictext">
                                            <div style="color: rgb(153, 153, 153); padding-top: 2px; margin-left:20px;" class="datetime">
                                            <img src="'.Yii::app()->baseUrl.'/images/comment-icon.png" style="position:relative; top:6px;"/>
                                                <font size="-1">
                                                    '.count($topic_record->all_posts_relation).'&nbsp;&nbsp;'.$fulldate.'
                                                </font>          
                                            </div>           
                                        </p>
                                      </div>';


					}
				}
    		}
    	}
    	echo $record_cnt."======".$last_id."======".$data_str;
    }
    
    public function actionCreategreenflag(){
        //echo "<pre>";
        //print_r($_POST);exit;
        $AllPostsFlags = new AllPostsFlags;
        if(isset($_POST['AllPostsFlags'])){
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=1");
            if($model_check>0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=1");
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts.");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
                $AllPostsFlags->post_type =  1;
				$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
				if(count($ip_status) > 0){
				 Yii::app()->user->setFlash('failure_msg',Yii::app()->params['comment_green_flag']);
					$this->redirect(CHttpRequest::getUrlReferrer());
				}else{
					if($AllPostsFlags->validate()){
	                    //print_r($AllPostsFlags->attributes);exit;
	                    if($AllPostsFlags->save()){
	    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
	                    }else{
	                        Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
	                    }
	                    $this->redirect(CHttpRequest::getUrlReferrer());
	                }
			    }	
            }
        }
        
    }
    
    public function actionCreateredflag(){
        //echo "<pre>";
        //print_r($_POST);exit;
        $AllPostsFlags = new AllPostsFlags;
        if(isset($_POST['AllPostsFlags'])){
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=1");
            if($model_check > 0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=1");
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
                $AllPostsFlags->post_type =  1;
               $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
				if(count($ip_status) > 0){
				 Yii::app()->user->setFlash('failure_msg',Yii::app()->params['comment_red_flag']);
					$this->redirect(CHttpRequest::getUrlReferrer());
				}else{
	                if($AllPostsFlags->validate()){
	                    if($AllPostsFlags->save()){
	    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
	                    }else{
	                        Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
	                    }
	                    $this->redirect(CHttpRequest::getUrlReferrer());
	                }
				}
            }
        }        
    }
    
	public function actionViewthreadcomment(){
	   $this->layout = 'blank';
       
       //print_r($_POST);exit;
		$topic_id = $_POST['topic_id'];
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];
        $pagination = $_POST['pagination'];
		$record_to_fetch_per_page = 8;
		$total_record_to_fetch = $_POST['record_cnt'];
        if($pagination == 0){
            $total_record_to_fetch  = 0;  
        }
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;

		$data_str = "";
		if(!empty($topic_id) && is_numeric($topic_id) && !empty($currect_section)){
	        $TopicModel = Topics::model()->findByPk($topic_id);
			if(count($TopicModel)>0){
			 
                $block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND block_user= 1 AND flag_type="Red" AND post_type=1','group'=>'commented_by'));
                if(count($block_user_model) > 0){
                    $block_user_ids = array();
                    foreach($block_user_model as $block_user){
                        $block_user_ids[] = $block_user->commented_by;
                    }
                    $block_user_ids = implode(',',$block_user_ids);
                    //echo $block_user_ids;exit;
                    $block_condition = ' AND user_id NOT IN ('.$block_user_ids.')';
                }else{
                    $block_condition = '';
                }
                
                $inactive_user_model = Users::model()->findAll(array('condition'=>'status="Inactive"'));
                if(count($inactive_user_model) > 0){
                    $inactive_user_ids = array();
                    foreach($inactive_user_model as $inactive_user){
                        $inactive_user_ids[] = $inactive_user->id;
                    }
                    $inactive_user_ids = implode(',',$inactive_user_ids);
                    //echo $block_user_ids;exit;
                    $inactive_condition = ' AND user_id NOT IN ('.$inactive_user_ids.')';
                }else{
                    $inactive_condition = '';
                }        
             
             
             
             
				$user_comment_condition_clause = "main_id=".$topic_id.' AND post_type=1 AND status = 1 AND comment_id=0'.$block_condition.$inactive_condition;
				$user_comment_order_clause = "ucm.id DESC LIMIT 0,".$new_total_record_to_fetch;
				
                //Start : for filtered data //
                /*
                $all_posts_filter_model=AllPosts::model()->findAll(array("condition"=>"post_type=1 AND main_id=".$topic_id,"select"=>"user_id","group"=>"user_id"));
                $all_post_user_ids="";
                if($all_posts_filter_model !=null){
                    foreach($all_posts_filter_model as $all_posts_filter_model_arr){
                        if($all_post_user_ids=="")
                            $all_post_user_ids=$all_posts_filter_model_arr->user_id;
                        else
                            $all_post_user_ids.=",".$all_posts_filter_model_arr->user_id;        
                    }  
                } 
                //echo $all_post_user_ids;exit;
                */
                
                $filter_question_answer_condition="";
                $filter_where_condition="";
                $filter_category_groups_condition="";
                //$filter_vote_special_condition="";
                $sub_thered_post_ids="";
                if(Yii::app()->session['filter_submit']!=""){
                    if(!empty(Yii::app()->session['filter'])){
                        if(isset(Yii::app()->session['filter']['post'])){
                            foreach(Yii::app()->session['filter']['post'] as $post_key1=>$post_value1){
                                foreach($post_value1 as $post_value2){
                                    foreach($post_value2 as $post_key3=>$post_value3){
                                        $answer_no="";
                                        if($post_key1=="question1"){
                                            $answer_no="answer1";
                                        }else if($post_key1=="question2"){
                                            $answer_no="answer2";
                                        }else if($post_key1=="question3"){
                                            $answer_no="answer3";
                                        }
                                        if($filter_where_condition==""){
                                            $filter_where_condition.=" AND (".$post_key1."='".$post_key3."' AND  ".$answer_no."='".$post_value3."' AND type='post')";
                                        }else{
                                            $filter_where_condition.=" OR (".$post_key1."='".$post_key3."' AND  ".$answer_no."='".$post_value3."' AND type='post')";   
                                        }
                                        
                                        if($filter_category_groups_condition==""){
                                            $filter_category_groups_condition.="(category='".$post_key3."' AND groups='".$post_value3."')";
                                        }else{
                                            $filter_category_groups_condition.=" OR (category='".$post_key3."' AND groups='".$post_value3."')";   
                                        }
                                        
                                    }
                                    
                                }
                            }
                        }
                        
                        if(isset(Yii::app()->session['filter']['vote'])){
                            //$filter_vote_special_condition="1";
                            foreach(Yii::app()->session['filter']['vote'] as $vote_key1=>$vote_value1){
                                foreach($vote_value1 as $vote_value2){
                                    foreach($vote_value2 as $vote_key3=>$vote_value3){
                                        $answer_no="";
                                        if($vote_key1=="question1"){
                                            $answer_no="answer1";
                                        }else if($vote_key1=="question2"){
                                            $answer_no="answer2";
                                        }else if($vote_key1=="question3"){
                                            $answer_no="answer3";
                                        }
                                        if($filter_where_condition==""){
                                            $filter_where_condition.=" AND (".$vote_key1."='".$vote_key3."' AND  ".$answer_no."='".$vote_value3."')";
                                        }else{
                                            $filter_where_condition.=" OR (".$vote_key1."='".$vote_key3."' AND  ".$answer_no."='".$vote_value3."')";
                                        }
                                        
                                        if($filter_category_groups_condition==""){
                                            $filter_category_groups_condition.="(category='".$vote_key3."' AND groups='".$vote_value3."')";
                                        }else{
                                            $filter_category_groups_condition.=" OR (category='".$vote_key3."' AND groups='".$vote_value3."')";   
                                        }
                                    }
                                    
                                }
                            }
                        }    
                        
                        $category_ids="";
                        if($filter_category_groups_condition !=""){
                            $filter_category_groups_model=CategoryGroups::model()->findAll(array("condition"=>$filter_category_groups_condition,"select"=>"id"));
                            if($filter_category_groups_model !=null){
                                foreach($filter_category_groups_model as $filter_category_groups_model_arr){
                                    if($category_ids=="")
                                        $category_ids="FIND_IN_SET(".$filter_category_groups_model_arr->id.",category_groups_id)";
                                    else
                                        $category_ids.=" OR FIND_IN_SET(".$filter_category_groups_model_arr->id.",category_groups_id)";
                                }    
                            } 
                        }
                        //echo $category_ids;exit;
                        if($category_ids !=""){
                            $filter_Users_model=Users::model()->findAll(array("condition"=>$category_ids,"select"=>"id"));
                        }
                        $filter_user_ids="";
                        if($filter_Users_model !=null){
                                foreach($filter_Users_model as $filter_Users_model_arr){
                                    if($filter_user_ids=="")
                                        $filter_user_ids=$filter_Users_model_arr->id;
                                    else
                                        $filter_user_ids.=",".$filter_Users_model_arr->id;
                                }    
                            } 
                        //echo $filter_user_ids;exit;
                    }
                    
                    /*$question_answer_filter_user_ids="0";
                    if($all_post_user_ids !=""){
                        $question_answer_filter_model=TopicQuestionAnswer::model()->findAll(array("condition"=>"topic_id=".$topic_id.$filter_where_condition." AND user_id IN (".$all_post_user_ids.")","select"=>"user_id"));
                    }else
                    {
                        $question_answer_filter_model=TopicQuestionAnswer::model()->findAll(array("condition"=>"topic_id=".$topic_id.$filter_where_condition,"select"=>"user_id"));   
                    }*/
                    /*if($question_answer_filter_model !=null){
                        foreach($question_answer_filter_model as $question_answer_filter_model_arr){
                            if($question_answer_filter_user_ids=="0")
                                $question_answer_filter_user_ids=$question_answer_filter_model_arr->user_id;
                            else
                                $question_answer_filter_user_ids.=",".$question_answer_filter_model_arr->user_id;
                        }
                        
                        //for vote filter selected add extra query.
                        if($filter_vote_special_condition=="1"){
                            $filter_vote_special_condition=" AND (like_ids IN(".$question_answer_filter_user_ids.") OR dislike_ids IN(".$question_answer_filter_user_ids."))";
                        }
                        
                    }*/
                    //$filter_question_answer_condition=" AND user_id IN(".$question_answer_filter_user_ids.")";                           
                    /*if($filter_vote_special_condition=="1"){
                        //$filter_vote_special_condition=" AND (like_ids IN(".$filter_user_ids.") OR dislike_ids IN(".$filter_user_ids."))";
                        $filter_question_answer_condition=" AND (like_ids IN(".$filter_user_ids.") OR dislike_ids IN(".$filter_user_ids."))";
                    }else{
                        $filter_question_answer_condition=" AND user_id IN(".$filter_user_ids.")";   
                    }*/
                    $filter_question_answer_condition=" AND user_id IN(".$filter_user_ids.")";
                    if($filter_user_ids==""){
                        $filter_question_answer_condition=" AND user_id IN(0)";
                    }
                    if(isset(Yii::app()->session['filter']['vote'])){
                        $filter_question_answer_condition=""; 
                    }
                    $sub_thered_post_ids=$filter_user_ids;
                    //echo $filter_vote_special_condition;exit;
                }
                //End : for filtered data //
                //$main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition.$filter_vote_special_condition." ORDER BY ".$user_comment_order_clause;
                if(isset(Yii::app()->session['filter']['vote'])){
                    $main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition." ORDER BY ".$user_comment_order_clause;
                }
                else{
                    $main_sql = "SELECT ucm.*, ucm.post_score as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition." ORDER BY ".$user_comment_order_clause;
                }
				//echo $main_sql;exit;
                $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                if(isset(Yii::app()->session['filter']['vote'])){
                    $main_sql = "SELECT ucm.*,(ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition;
                }
                else{
                    $main_sql = "SELECT ucm.*, ucm.post_score as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause.$filter_question_answer_condition;
                }
				
                $total_comment_count = AllPosts::model()->count(array("condition"=>"main_id=".$topic_id.' AND post_type=1 AND status = 1 AND comment_id=0'.$block_condition.$inactive_condition));
                
				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $alltopic){
					    /*Start For filter to display only liked and disliked users post for Vote filter only */
                        if(isset(Yii::app()->session['filter']['vote'])){
                                    $temp_status=1;                                    
                                    $filter_user_ids_array=explode(",",$filter_user_ids);
                                    $temp_like_ids=explode(",",$alltopic->like_ids);
                                    $temp_dislike_ids=explode(",",$alltopic->dislike_ids);
                                    $result = array_merge($temp_like_ids, $temp_dislike_ids);
                                    $result = array_unique($result);
                                    foreach($filter_user_ids_array as $filter_user_ids_array_arr){
                                        foreach($result as $result_arr){
                                            if($filter_user_ids_array_arr==$result_arr){
                                                $temp_status=0;
                                                break;   
                                            }
                                        }
                                    }
                                    if($temp_status){
                                        continue;
                                    }
                        }
                       /*Start For filter to display only liked and disliked users post for Vote filter only */
                       
						$last_comment_id = $alltopic->id;
						$stringtime = strtotime($alltopic->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        /*if($alltopic->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($alltopic->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        $green_cnt = count($alltopic->topic_green_comment);
                        $red_cnt = count($alltopic->topic_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Green','1');
                        $red_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Red','1');
                        
                        
						$data_str .= '<tr id="'.$alltopic->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<input type="hidden" name="total_scroll_cnt_for_page" id="total_scroll_cnt_for_page" value="'.$new_total_record_to_fetch.'"/>
                                                        <a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                                                        if($red_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"red")).'" style="text-decoration:none;">
                                        <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                        $commentMore = '';
                        if(!empty($alltopic->comment)){
                            //echo $TopicList->topic_description;
                            $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                            $comText = nl2br(myhelpers::get_cropped_text($alltopic->comment, 700));
                            if(strlen($alltopic->comment) > 700){
                                $comText = strip_tags($comText,'<br></br><br/>');
                            }
                            //$comText = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $comText);
                            $commentMore.= "<span style='text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px; word-break: break-word;' id='comment-less-txt-".$alltopic->id."'>".$comText."</span>";
                                if(strlen($alltopic->comment) > 700){
                                    $comMoreText = nl2br(myhelpers::get_cropped_more_text($alltopic->comment, 700));
                                    //$comMoreText = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $comMoreText);
                                   $commentMore.= "<span class='comment_desc_more_dots_".$alltopic->id."' data-id='".$alltopic->id."'>...</span>";
                                   $commentMore.= "<span style='display:none; text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;' class='comment_desc_hidden_text_".$alltopic->id."'>".nl2br($alltopic->comment)."</span>";
                                   $commentMore.= "<a id='comment_desc_more_".$alltopic->id."' class='comment_desc_more' data-id='".$alltopic->id."'>More</a>";
                                   $commentMore.= "<a id='comment_desc_less_".$alltopic->id."' class='comment_desc_less' style='display:none' data-id='".$alltopic->id."'>Less</a>";
                                   $commentMore.= "<br/>";
                                }
                        } 
                        else{
                            $commentMore.= "<br/>";
                        }
                     
                        $data_str .= '</td>
                                                    <td style="vertical-align: top;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                        <a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->user_comment->username).'</a>';
                                                                        if($alltopic->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->topic_other_comment->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->topic_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                        $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>';
                                                                        
                                                                        if(Yii::app()->session['user_id']==$alltopic->user_id){
                                                                            $data_str .= '<span class="c-edit-post-button" data-id="'.$alltopic->id.'" style="float:right; cursor:pointer; font-size: 13px; color:#999999; margin-right:8px;">Edit</span>';
                                                                       
/*Ivan.a - below is what I did: I added Hide as hyperlink, and included javascript:inactive_records from Admin/Posts. 
It shows Hide command, but it does not Hide row when user clicks Hide. You can also look at above, similar "Edit", update Post
Same needs to also work for Hide Reply, below*/
                                                                            $data_str .= '<span a href="javascript:void(0)" onclick="javascript:inactive_records();" data-id="'.$alltopic->id.'"; style="float:right; cursor:pointer; font-size: 13px; color:#999999; margin-right:8px;">Hide</a></span>';  



                                                                      
                                                                                                                                               

                                                                        }
                                                                    $data_str .= '</span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr class="c-post-text" id="c-post-text-'.$alltopic->id.'" data-id="'.$alltopic->id.'">
                                                                <td>'.
                                                                    $commentMore
                                                                .'</td>
                                                            </tr>
                                                            <tr style="display:none;" data-show="none" class="c-post-text-edit-form" id="c-post-text-edit-form-'.$alltopic->id.'" data-id="'.$alltopic->id.'">
                                                                <td>
                                                                    <textarea id="c-post-text-edit-comment-area-'.$alltopic->id.'" name="c-post-text-edit-comment-area" style="width:100%; height:250px; resize: none; font-size:14px; font-family: Arial,Helvetica,Tahoma,sans-serif;">'.strip_tags($alltopic->comment,'<br></br><br/>').'</textarea>
                                                                    <br/>
                                                                    <input value="Post" class="type c-post-text-submit-post" data-id="'.$alltopic->id.'" style="float: right;" type="submit">
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$alltopic->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>';
                                                                                $green_vote_count=$alltopic->like;
                                                                                $red_vote_count=$alltopic->dislike;
                                                                                //start for filtered vote //
                                                                                if(isset(Yii::app()->session['filter']['vote'])){
                                                                                    $green_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'like_ids');
                                                                                    $red_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'dislike_ids');
                                                                                }
                                                                                /*if(isset($_POST["filter"])){
                                                                                    if($_POST["type"]=="vote"){
                                                                                        $green_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'likedvote');
                                                                                        $red_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'dislikedvote');       
                                                                                    }
                                                               				    }*/
                                                                                //end for filtered vote //
                                                                       $data_str .='
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alltopic->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$green_vote_count.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alltopic->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$red_vote_count.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alltopic->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:-1px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$alltopic->id.'\');" id="reply_'.$alltopic->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/topics/Viewtopic?topic_id='.$topic_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alltopic->id.'" name="user_comment_'.$alltopic->id.'" value="'.$alltopic->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alltopic->id.'" style="cursor: pointer;;float:right;color:#999999;font-size: 13px;" onclick="showhide('.$alltopic->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alltopic->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alltopic->id.',\'Green\');" style="text-decoration: none;color:green;font-size: 13px; font-color:"green";">&#9607 Green ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alltopic->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px; font-color:"red";">&#9607 Red ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            
                                                                                            if($alltopic->main_comment_id == 0){
                                                                                                $main_comment_id = $alltopic->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alltopic->main_comment_id;
                                                                                            }                                                                                            
                                                                                            
                                                                $data_str .=               '</a></div>
																						</div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                                  
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    </table>
                                                                 </td>    
             	                                            </tr>
                                                         </table>
                                                      </td>
                                                	</tr>
                                                    <tr style="width:30px;margin:5px 0 0 0;">
                                                      <td colspan="2" style="width:100%">
                                                        <table style="width: 100%; vertical-align: top;">
                										  <tr id="reply_form_id_'.$alltopic->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$alltopic->id.'" method="post" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$alltopic->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$alltopic->main_id.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$alltopic->id.'">
            																		<textarea id="replycomment_'.$alltopic->id.'" name="replycomment_'.$alltopic->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
            																	</td>
            																</tr>
            																<tr>
            																	<td>
                                                                                    <input value="Post" class="type" style="float: right;" type="button" onclick="saveReplay('.$alltopic->id.','.$main_comment_id.','.$topic_id.');"/>
            																	</td>
            																</tr>
            															</table>
            				                                       </form>
            													</td>
            												</tr>                                                        
                                                        </table>
                                                    </td>
                                            	</tr>                                               
											</table>                                        	
										</td>
									</tr>';
					
                     
                    if(isset($alltopic->topic_main_comment_list) && count($alltopic->topic_main_comment_list) > 0){





        //$cnt = 0;
		if(count($alltopic->topic_main_comment_list)>0){
			foreach($alltopic->topic_main_comment_list as $alltopic){
                //Start : for filtered chield thread condition(Not display which is totic id now available in topics question answer table))//
                if(Yii::app()->session['filter_submit']!=""){
                    if(!empty(Yii::app()->session['filter'])){
                         /*Start For filter to display only liked and disliked users post for Vote filter only */
                        if(isset(Yii::app()->session['filter']['vote'])){
                                    $temp_status=1;                                    
                                    $filter_user_ids_array=explode(",",$filter_user_ids);
                                    $temp_like_ids=explode(",",$alltopic->like_ids);
                                    $temp_dislike_ids=explode(",",$alltopic->dislike_ids);
                                    $result = array_merge($temp_like_ids, $temp_dislike_ids);
                                    $result = array_unique($result);
                                    foreach($filter_user_ids_array as $filter_user_ids_array_arr){
                                        foreach($result as $result_arr){
                                            if($filter_user_ids_array_arr==$result_arr){
                                                $temp_status=0;
                                                break;   
                                            }
                                        }
                                    }
                                    if($temp_status){
                                        continue;
                                    }
                        }
                       /*Start For filter to display only liked and disliked users post for Vote filter only */
                        //$sub_thered_post_ids=explode(",",$sub_thered_post_ids);
                        /*if(isset(Yii::app()->session['filter']['vote'])){
                            $temp_status=1;
                            $temp_like_dislike_ids=explode(",",$question_answer_filter_user_ids);
                            $temp_like_ids=explode(",",$alltopic->like_ids);
                            $temp_dislike_ids=explode(",",$alltopic->dislike_ids);
                            $result = array_merge($temp_like_ids, $temp_dislike_ids);
                            $result = array_unique($result);
                            foreach($sub_thered_post_ids as $sub_thered_post_ids_arr){
                                foreach($result as $result_arr){
                                    if($sub_thered_post_ids_arr==$result_arr){
                                        $temp_status=0;
                                        break;   
                                    }
                                }
                            }
                            if($temp_status){
                                continue;
                            }
                        }*/
                        else if(isset($sub_thered_post_ids) && $sub_thered_post_ids !=""){
                                    $temp_status=1;
                                    $filter_user_ids_array=explode(",",$sub_thered_post_ids);
                                    foreach($filter_user_ids_array as $filter_user_ids_array_temp){
                                        if($filter_user_ids_array_temp== $alltopic->user_id){
                                            $temp_status=0;
                                            break;        
                                        }
                                    }
                                    if($temp_status){
                                        continue;
                                    }
                                }
                    }
                }
                //Start : for filtered chield thread condition(Not display which is totic id now available in topics question answer table))//
                
				$last_comment_id = $alltopic->id;
				$stringtime = strtotime($alltopic->created_date);

				$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                /*if($alltopic->comment_id == 0){*/
                    $color = "color:#065A95";
                     if(!empty($alltopic->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image)){
                        $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;
                    }else{
                        $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                    }
               
                $green_cnt = count($alltopic->topic_green_comment);
                $red_cnt = count($alltopic->topic_red_comment);
                
                $green_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Green','1');
                $red_total_cooment = myhelpers::getGreentotalCount($alltopic->main_id,$alltopic->user_id,'Red','1');
                
				$data_str .= '<tr id="'.$alltopic->id.'" style="background-color:#FFFFFF !important;">
								<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                    <table style="width: 90%;margin-left: 10%;">
                                    	<tr style="width:30px; margin:6px 0 0 0;">
                                        	<td style="width:10%;vertical-align: top;">
												<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id)).'" style="text-decoration:none;">
													<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                </a>
                                                <div style="clear:both; height:3px;"></div>';
                                                if($green_total_cooment > 0){
                $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                    <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                </div>
                              </a>';
                                                }
                                                if($red_total_cooment > 0){
                
                
                $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_id,"type"=>"red")).'" style="text-decoration:none;">
                                <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                    <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                </div>
                              </a>';
                                                }
                $commentMore = '';
                if(!empty($alltopic->comment)){
                    //echo $TopicList->topic_description;
                    $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                    $comText = nl2br(myhelpers::get_cropped_text($alltopic->comment, 700));
                    if(strlen($alltopic->comment) > 700){
                        $comText = strip_tags($comText,'<br></br><br/>');
                    }
                    //$comText = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $comText);
                    $commentMore.= "<span style='text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px; word-break: break-word;' id='comment-less-txt-".$alltopic->id."'>".$comText."</span>";
                        if(strlen($alltopic->comment) > 700){
                            $comMoreText = nl2br(myhelpers::get_cropped_more_text($alltopic->comment, 700));
                            //$comMoreText = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $comMoreText);
                           $commentMore.= "<span class='comment_desc_more_dots_".$alltopic->id."' data-id='".$alltopic->id."'>...</span>";
                           $commentMore.= "<span style='display:none; text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;' class='comment_desc_hidden_text_".$alltopic->id."'>".nl2br($alltopic->comment)."</span>";
                           $commentMore.= "<a id='comment_desc_more_".$alltopic->id."' class='comment_desc_more' data-id='".$alltopic->id."'>More</a>";
                           $commentMore.= "<a id='comment_desc_less_".$alltopic->id."' class='comment_desc_less' style='display:none' data-id='".$alltopic->id."'>Less</a>";
                           $commentMore.= "<br/>";
                        }
                } 
                else{
                    $commentMore.= "<br/>";
                }
                
                $data_str .= '</td>
                                            <td style="vertical-align: top;">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                <a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->user_comment->username).'</a>';
                                                                if($alltopic->comment_id != 0){
                                                                    $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alltopic->topic_other_comment->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alltopic->topic_other_comment->user_comment->username).'</a>';
                                                                }
                                                                $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>';
                                                                if(Yii::app()->session['user_id']==$alltopic->user_id){
                                                                    $data_str .= '<span class="c-edit-post-button" data-id="'.$alltopic->id.'" style="float:right; cursor:pointer; font-size: 13px; color:#999999; margin-right:8px;">Edit</span>';
                                                                    $data_str .= '<span class="c-edit-post-button" data-id="'.$alltopic->id.'" style="float:right; cursor:pointer; font-size: 13px; color:#999999; margin-right:8px;">Hide</span>';
//<style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="setFlagMessage('.$alltopic->id.',\'Red\');">Report ';
                                                                }
                                                            $data_str .= '</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="c-post-text" id="c-post-text-'.$alltopic->id.'" data-id="'.$alltopic->id.'">
                                                        <td>'.
                                                            $commentMore
                                                        .'</td>
                                                    </tr>
                                                    <tr style="display:none" data-show="none" class="c-post-text-edit-form" id="c-post-text-edit-form-'.$alltopic->id.'" data-id="'.$alltopic->id.'">
                                                        <td>
                                                            <textarea id="c-post-text-edit-comment-area-'.$alltopic->id.'" name="c-post-text-edit-comment-area" style="width:100%; height:250px; resize: none; font-size:14px; font-family: Arial,Helvetica,Tahoma,sans-serif;">'.strip_tags($alltopic->comment,'<br></br><br/>').'</textarea>
                                                            <br/>
                                                            <input value="Post" class="type c-post-text-submit-post" data-id="'.$alltopic->id.'" style="float: right;" type="submit">
                                                        </td>
                                                    </tr>
                                                    <tr id="already_voted_message_'.$alltopic->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
    	                                            <tr style=" width:558px; padding-left:25px;">
    	                                            	
                                                        <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>';
                                                                                $green_vote_count=$alltopic->like;
                                                                                $red_vote_count=$alltopic->dislike;
                                                                                //start for filtered vote //
                                                                                if(isset(Yii::app()->session['filter']['vote'])){
                                                                                    $green_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'like_ids');
                                                                                    $red_vote_count = myhelpers::getUserVoteCount($alltopic->main_id,$alltopic->id,$filter_user_ids,'dislike_ids');
                                                                                }
                                                                                /*if(isset($_POST["filter"])){
                                                                                    if($_POST["type"]=="vote"){
                                                                                        $green_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'likedvote');
                                                                                        $red_vote_count = myhelpers::getQuestionAnswerLikedDisLikedVotetotalCount($alltopic->main_id,$alltopic->id,$_POST["question_no"],$_POST["question"],$_POST["option"],'dislikedvote');     
                                                                                    } 
                                                               				    }*/
                                                                                //end for filtered vote //
                                                                       $data_str .='
                                                                                <div style="float:left;width: 22%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alltopic->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$green_vote_count.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alltopic->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$red_vote_count.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alltopic->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:-1px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$alltopic->id.'\');" id="reply_'.$alltopic->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/topics/Viewtopic?topic_id='.$topic_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 38%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alltopic->id.'" name="user_comment_'.$alltopic->id.'" value="'.$alltopic->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alltopic->id.'" style="cursor: pointer;;float:right;color:#999999;font-size: 13px;" onclick="showhide('.$alltopic->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alltopic->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alltopic->id.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px; font-color:"green";">&#9607 Green ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alltopic->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px; font-color:"red";">&#9607 Red ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            
                                                                                            if($alltopic->main_comment_id == 0){
                                                                                                $main_comment_id = $alltopic->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alltopic->main_comment_id;
                                                                                            }                                                                                            
                                                                                            
                                                                $data_str .=               '</a></div>
																						</div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                                  
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    </table>
                                                         </td>    
     	                                            </tr>
                                                 </table>
                                              </td>
                                        	</tr>
                                            <tr style="width:30px;margin:5px 0 0 0;">
                                              <td colspan="2" style="width:100%">
                                                <table style="width: 100%; vertical-align: top;">
        										  <tr id="reply_form_id_'.$alltopic->id.'" style="display:none" class="hide_row">
    													<td>
    														<form id="user-comment-form_'.$alltopic->id.'" method="post">
    															<input type="hidden" name="comment_id" value="'.$alltopic->id.'" />
                                                                <input type="hidden" name="main_id" id="main_id" value="'.$alltopic->main_id.'" />
                                                                <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
    															<table style="width:100%; vertical-align: top;">
    																<tr>
    																	<td id="reply_comment_id_'.$alltopic->id.'">
    																		<textarea id="replycomment_'.$alltopic->id.'" name="replycomment_'.$alltopic->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
    																	</td>
    																</tr>
    																<tr>
    																	<td>
                                                                            <input value="Post" class="type" style="float: right;" type="button" onclick="saveReplay('.$alltopic->id.','.$main_comment_id.','.$topic_id.');"/>
    																	</td>
    																</tr>
    															</table>
    				                                       </form>
    													</td>
    												</tr>                                                        
                                                </table>
				                            </td>
                                    	</tr>
									</table>                                        	
								</td>
							</tr>';
			}
		}


                    }
                    
                    }
                    if($total_comment_count > $new_total_record_to_fetch){                        
                        $data_str .='<tr style="background-color:#FFFFCC !important;cursor:pointer;" onclick="threadcommentlisting(1);">
        									<td style="width:100%;text-align:center;vertical-align: middle;background-color:#3AC1F2;color:#FFFFFF;height:35px;font-size: 15px;">Show more posts</td>
        								</tr>';    
    				}/*else{
                        $data_str .='<tr style="background-color:#FFFFCC !important;">
        									<td style="width:100%;text-align:center;vertical-align: middle;background-color:#3AC1F2;color:#FFFFFF;height:35px;font-size: 15px;">No more posts....</td>
        								</tr>';    
    				    
    				}*/
                    
				}else{
					$no_more_data = 1;
					$data_str = '<tr style="background-color:#FFFFCC !important;">
									<td style="width:100%">No more records available!!!</td>
								</tr>';
				}
			}
		}

		/*if($prev_last_comment_id == $last_comment_id){
			$no_more_data = 1;
			$data_str = '<tr style="background-color:#FFFFCC !important;">
							<td style="width:100%">No more records available!!!</td>
						</tr>';
		}*/

		$response_aray = array();
		$response_aray['topic_id'] = $topic_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;
        //$response_aray['total_scroll_post_cnt'] = $total_comment_count;
		print_r(json_encode($response_aray));exit;
	}    
    
    public function actionUpdatereply(){
        $this->layout = 'blank';
        //echo "<pre>";
        //print_r($_POST);exit;
		$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0){
			echo "inactive";
		}else{ 
        
	        if(isset($_POST['Post'])){
                    $user_comment_model = AllPosts::model()->findByPk($_POST['Post']['id']); 
                    require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
                    $config = HTMLPurifier_Config::createDefault();
                    $config->set('AutoFormat', 'Linkify', true);
                    $purifier = new HTMLPurifier($config);
	            $user_comment_model->comment = strip_tags($_POST['Post']['comment'],'<br></br><br/>');
                    $user_comment_model->comment = $purifier->purify($user_comment_model->comment);
	            $user_comment_model->save(false);
	            echo '1';exit;
	        }
     	 }
    } 
    
    public function actionSubmitreply(){
        $this->layout = 'blank';
        //echo "<pre>";
        //print_r($_POST);exit;
		$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0){
			echo "inactive";
		}else{ 
        $user_comment_model = new AllPosts(); 
	        if(isset($_POST['AllPosts'])){
	            $user_comment_model->attributes = $_POST['AllPosts'];
                    require_once(dirname(Yii::app()->request->scriptFile).'/protected/extensions/htmlpurifier/library/HTMLPurifier.auto.php');
                    $config = HTMLPurifier_Config::createDefault();
                    $config->set('AutoFormat', 'Linkify', true);
                    $purifier = new HTMLPurifier($config);
                    $user_comment_model->comment = strip_tags($_POST['AllPosts']['comment'],'<br></br><br/>');
                    $user_comment_model->comment = $purifier->purify($user_comment_model->comment);
	            $user_comment_model->user_id = $this->data['user_id'];
	            $user_comment_model->post_type = 1;
	            $user_comment_model->save(false);
	            echo '1';exit;
	        }
     	 }
    } 
       
    public function actionCreateSSOUrl()
    {
        if(isset($_POST['uid']) && !empty($_POST['uid']) && isset($_POST['retUrl']) && !empty($_POST['retUrl'])) {
            $userId = $_POST['uid'];
            if($userId == Yii::app()->session['user_id']) {
                //An example of how to generate a secure token for Qualtrics SSO

                //your survey id - taken from the survey URL attribute SID

                //$surveyId = 'SV_xxxxxxx';
                $surveyId = 'SV_8uj2W5O1ikbKZff';

                //the data to be put in the token

                /* below for id, get current Wedialog userId

                For timestamp, get current time

                For expiration, set it = current time +1 */
                date_default_timezone_set('GMT');
                $timestamp = date('Y/m/d H:i:s');
                $expiration = date('Y/m/d H:i:s', strtotime('+5 mins'));
				
                $tokenData = array(
				
                'id' => $userId,

                'timestamp' => $timestamp,

                'expiration' => $expiration,

                );

                //generate the query parameters

                $token = '';

                $i = 0;

                foreach($tokenData as $key => $value)

                {

                if ($value != '')

                {

                if ($i != 0)

                $token .= '&';

                $token .= "$key=$value";

                $i++;

                }

                }

                //generate the secure token

                //$key = 'SOMESECRETSHARED';
                $key = 'oPVOfaUviO8HO2BB';

                $encMethod = 'rijndael-128';

                $macMethod = 'md5';

                //generate the hmac

                $hash = base64_encode( hash_hmac($macMethod, $token, $key, true) );

                $token .= '&mac='.$hash;

                //encrypt the token

                $ivSize = mcrypt_get_iv_size($encMethod, MCRYPT_MODE_ECB);

                $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

                $encData = base64_encode(mcrypt_encrypt($encMethod, $key, $token, MCRYPT_MODE_ECB, $iv));
                
                $query = '?SID='.$surveyId.'&ssotoken='.$encData;
                $returnUrl = "retUrl=".$_POST['retUrl'];
                
                //echo "SSO link and url:<br><br>"; 
                //echo "link: <a href='http://umassamherst.co1.qualtrics.com/CP/$query' target="_blank">token survey login</a><br><br>"; 
                //echo "url: http://umassamherst.co1.qualtrics.com/CP/$query<br>";
                echo "http://umassamherst.co1.qualtrics.com/SE/$query&Q_JFE=0&".$returnUrl;
                die;
            }
            else {
                throw new CHttpException(403, "Forbidden access.");
            }
        }
        else {
            throw new CHttpException(403, "Forbidden access.");
        }
    }
}