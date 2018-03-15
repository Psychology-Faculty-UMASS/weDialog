<?php

class TeamController extends Controller
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
    function actionManage_team(){
		if(!empty($_POST['action_type']) && $_POST['action_type']=="delete" && !empty($_POST['selected_ids'])){
			//=== START: DELETE => Team ================//
            
            $deleteids=explode(",",$_POST['selected_ids']);
            
			$deleted = Team::model()->deleteAll('id IN (' . $_POST['selected_ids'] . ')');
			if($deleted){
			     //=== START: DELETE => Team Chiled record( Team comment and  commented flag)) ================//
			     $flag_id_get_model=TeamComment::model()->findAll('team_id IN (' . $_POST['selected_ids'] . ')');
                 $ids=array();
                 if(count($flag_id_get_model)>0){
                    foreach($flag_id_get_model as $flag_id_get_model_temp){
                        $ids[]=$flag_id_get_model_temp->id;
                    }
                    $ids=implode(',',$ids);
                   $deleted =  TeamCommentFlag::model()->deleteAll('team_comment_id IN (' . $ids . ')'); 
                 }
			      $deleted = TeamComment::model()->deleteAll('team_id IN (' . $_POST['selected_ids'] . ')');
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
			$updated = Team::model()->updateAll(array('status'=>$new_status), 'id IN ('.$_POST['selected_ids'].') AND status="'.$old_status.'"');
			if($updated){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['status_changed']);
			}
			//=== END: CHANGE STATUS => USERS ===========//
		}
        else{
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['provide_data']);
		}
		$this->redirect(array('admin'));
	}
     
	public function actionCreate(){
		$model=new Team;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Team'])){
			$model->attributes=$_POST['Team'];
			if($model->save()){
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
			}else{
				Yii::app()->user->setFlash('success_msg', Yii::app()->params['execution_error']);
			}
				$this->redirect(array('admin'));
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
		if(isset($_POST['Team']))
		{
			$model->attributes=$_POST['Team'];
            if($model->validate()){
    			if($model->save()){
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['record_saved']);
    			}else{
    				Yii::app()->user->setFlash('success_msg', Yii::app()->params['execution_error']);
    			}
    				$this->redirect(array('admin'));
   		  }
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
		$dataProvider=new CActiveDataProvider('Team');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{  
		$model=new Team('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Team']))
			$model->attributes=$_GET['Team'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Team the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Team::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Team $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='team-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionTeamlist(){
        $this->layout = 'registration';
        
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }
        else {
            $dialogID = '';
        }
        
        if(isset($_GET['dialog_id'])){
            $dialogID = $_GET['dialog_id'];
            $dialogModel = Dialogs::model()->findByPk($dialogID);
            if(!$dialogModel){
                throw new CHttpException(404, 'Not Found.');
            }
        }
        
       $tagmodel = Topics::model()->findAll();
       $this->data['tagmodel'] = $tagmodel;
       $teammodel =Team::model()->findAll(array('condition'=>'dialog_id=:did','order'=>'members DESC','limit' =>20, 'params'=>array(':did'=>$dialogID)));
       $this->data['teammodel'] = $teammodel;
       
       $model_cms=Cms::model()->findByPk(6);
       $this->data['model_cms']=$model_cms;
       
       $_SESSION['limit']=20;
       $this->render('team_list',$this->data);
	}
    
    public function actionPagination(){
        $this->layout = 'blank';
        $limit=20;
        if(isset($_POST['limit'])){
            $limit=$_POST['limit'];
        }
       $teammodel =Team::model()->findAll(array('order'=>$_POST['list_by'].' DESC','limit' =>$limit));
       
       $this->data['teammodel'] = $teammodel;
       
       $_SESSION['limit']=$limit;       
       $this->renderPartial('_team_list',$this->data);
	}    
    
    public function actionCreateteam(){
        if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
            $this->layout = 'registration';
    		$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
    	   if(count($ip_status) > 0 ){
    	   	Yii::app()->user->setFlash('failure_msg', Yii::app()->params['create_team']);
                    if(!empty(Yii::app()->session['dialog_id'])) {
                        $dialogID = Yii::app()->session['dialog_id'];
                        $this->redirect(Yii::app()->createUrl('team/teamlist', array('dialog_id'=>$dialogID)));
                    }
                    else {
                        $this->redirect(Yii::app()->createUrl('team/teamlist'));
                    }
    	   } 
            $team_model = new Team;
            $this->data['team_model'] = $team_model;
            
            if(isset($_POST['Team'])){
                $team_model->attributes = $_POST['Team'];
                $team_model->user_id = $this->data['user_id'];
                if(!empty(Yii::app()->session['dialog_id'])) {
                    $team_model->dialog_id = Yii::app()->session['dialog_id'];
                }
                if($team_model->validate()){
                    $team_model->save();
                    if(!empty(Yii::app()->session['dialog_id'])) {
                        $dialogID = Yii::app()->session['dialog_id'];
                        $this->redirect(Yii::app()->createUrl('team/teamlist', array('dialog_id'=>$dialogID)));
                    }
                    else {
                        $this->redirect(Yii::app()->createUrl('team/teamlist'));
                    }
                }
            }
            
            $team_post_model = Team::model()->findAll(array('order'=>'posts DESC','limit'=>12)); 
            $this->data['team_post_model']=$team_post_model;
            $this->render('team_form',$this->data); 
        }else{
            $this->redirect(Yii::app()->createUrl('Site/loginUser'));
       }
    }    
    
    public function actionUpdateteam($id=''){
        $this->layout = 'registration';
        $team_model = Team::model()->find(array('condition'=>'id='.$id.' AND user_id='.$this->data['user_id']));
        if(count($team_model) > 0){
           if(isset($_POST['Team'])){
               $team_model->attributes=$_POST['Team'];
               $team_model->user_id=$this->data['user_id'];
                if($team_model->save()){
                    Yii::app()->user->setFlash('success_msg', Yii::app()->params['rule_saved']);
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }
                $this->redirect(Yii::app()->createUrl('Team/viewteam',array('id'=>$id)));
            }
           $team_post_model = Team::model()->findAll(array('order'=>'posts DESC','limit'=>12)); 
           $this->data['team_post_model']=$team_post_model;
           
           $this->data['team_model'] = $team_model;
           $this->render('team_form',$this->data); 
        
        }else{
            Yii::app()->user->setFlash('failure_msg', 'There are no Team available....');
           $this->redirect(Yii::app()->createUrl('team/teamlist')); 
        }
    }
    
    
    public function actionViewteam($id=''){
    	$this->layout = 'registration';
		$id = $_GET['id'];
		$selected_user_id = 0;
		$last_comment_id = 0;
		$page_no = 0;
		$record_per_page = 20;

		if(!empty($id) && is_numeric($id)){
            $rule_order_no_model=TypeTags::model()->findAll(array('condition'=>'order_no >0','order'=>'order_no'));
	        $team_model = Team::model()->findByPk($id);
			if(count($team_model)>0){
				$user_comment_condition_clause = "main_id=".$id;
				if(!empty($_GET['user_id']) && is_numeric($_GET['user_id'])){
					$selected_user_id = $_GET['user_id'];

					$tmp_sql = "SELECT id FROM all_posts WHERE main_id=".$id." AND post_type =3 AND user_id=".$selected_user_id;
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
        $TestpopularSql = "SELECT team.*,(SELECT COUNT(*) FROM  all_posts WHERE  all_posts.main_id = team.id  AND post_type = 3) AS Totalcommentscount
                         	FROM team WHERE ".$WHEREPOPULAR;
        $PopularTeamListModel = Team::model()->findAllBySql($TestpopularSql);
        $this->data["PopularTeamListModel"] = $PopularTeamListModel;

        $user_comment_team_model = new AllPostsFlags;
        $this->data["user_comment_team_model"] = $user_comment_team_model;
        
        $flag_reason_model = FlagReason::model()->findAll(array('condition'=>'status=1'));
        $this->data["flag_reason_model"] = $flag_reason_model;
        
        $MyTeamListModel = Team::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'],'order'=>'id DESC','limit'=>10));
        $this->data["MyTeamListModel"] = $MyTeamListModel;


		$UserComment = new AllPosts;
		if(!empty($_POST)){
			$post_comment_array = array();
			$post_comment_array['user_id'] = Yii::app()->session['user_id'];
            $post_comment_array['main_id'] = $_GET['id'];
            $post_comment_array['post_type'] = 3;
			$post_comment_array['like'] = 0;
			$post_comment_array['dislike'] = 0;
			$post_comment_array['likedislikeids'] = '';
			if(isset($_POST['comment_id']) && $_POST['comment_id']!=0){
				$tmp_comment_id = $_POST['comment_id'];
				$post_comment_array['comment_id'] = $tmp_comment_id;
				$post_comment_array['comment'] = $_POST['replycomment_'.$tmp_comment_id];
			}else if(!empty($_POST['post_comment_area'])){
				$post_comment_array['comment_id'] = 0;
				$post_comment_array['comment'] = $_POST['post_comment_area'];
			}
            $UserComment->main_comment_id = $_POST['main_comment_id'];
       		$UserComment->attributes = $post_comment_array;
			$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
			if(count($ip_status) > 0 ){
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['message']);
				$this->redirect(CHttpRequest::getUrlReferrer());
			}else{
	            if($UserComment->validate()){
	            	$UserComment->save();
	                $model_find_team=Team::model()->findByPk($_GET['id']);
	                if(count($model_find_team)>0){
	                    $model_find_team->posts=$model_find_team->posts+1;
	                    $model_find_team->save();
	                    //$status_update=Team::model()->updateAll(array('posts='.($model_find_team->posts+1),'user_id='.Yii::app()->session['user_id'].' AND name='.$model_find_team->name));
	                }
	                
	                $this->redirect(Yii::app()->createUrl('Team/viewteam',array('id'=>$id)));
	            }
            }
        }

		$this->data["PostUserComment"] = $UserComment;
		$this->data["UserComment"] = $user_comment_model;
		$this->data["team_id"] = $id;
		$this->data["selected_user_id"] = $selected_user_id;
		$this->data["last_comment_id"] = $last_comment_id;
        $this->data["team_model"] = $team_model;
        $this->data["rule_order_no_model"] = $rule_order_no_model;
        $this->render('view_team',$this->data);
        
    }
    
    
    public function actionGetcomments(){
		$team_id = $_GET['team_id'];
		$selected_user_id = 0;
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];

		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;
        $block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND block_user= 1 AND flag_type="Red"  AND post_type=3','group'=>'commented_by'));
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
		if(!empty($team_id) && is_numeric($team_id) && !empty($currect_section)){
	        $team_model = Team::model()->findByPk($team_id);
			if(count($team_model)>0){
				$user_comment_condition_clause = "main_id=".$team_id.'  AND post_type=3 AND status = 1'.$block_condition.$inactive_condition;
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
					$user_comment_order_clause = "like_difference DESC LIMIT 0,".$new_total_record_to_fetch;
				}else if($currect_section == "disagree_topics"){
					$user_comment_order_clause = "like_difference  ASC LIMIT 0,".$new_total_record_to_fetch;
				}
				if(!empty($_GET['selected_user_id']) && is_numeric($_GET['selected_user_id']) && $_GET['selected_user_id']!=0){
					$selected_user_id = $_GET['selected_user_id'];
				}

				if(!empty($selected_user_id) && $selected_user_id!=0){
					$tmp_sql = "SELECT uc.id FROM all_posts uc WHERE uc.main_id=".$team_id." AND post_type=3 AND uc.user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (ucm.user_id=".$selected_user_id." OR ucm.comment_id IN (".$tmp_sql."))";
				}

                $main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause." ORDER BY ".$user_comment_order_clause;
                //echo $main_sql;exit;
                $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $allteam){
						$last_comment_id = $allteam->id;
						$stringtime = strtotime($allteam->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        /*if($allteam->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($allteam->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($allteam->team_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        }*/
                        
                        $green_cnt = count($allteam->team_green_comment);
                        $red_cnt = count($allteam->team_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Green','3');
                        $red_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Red','3');
                        
						$data_str .= '<tr id="'.$allteam->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
                                                        <a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                                                        if($red_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"red")).'" style="text-decoration:none;">
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
                                                                        <a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->user_comment->id)).'" style="color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;">'.ucfirst($allteam->user_comment->username).'</a>';
                                                                        if($allteam->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->team_other_comment->user_comment->id)).'" style="color: #065A95;font-size: 14px; text-decoration: none;">'.ucfirst($allteam->team_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>
                                                                    </span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.$allteam->comment.'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$allteam->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$allteam->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$allteam->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$allteam->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$allteam->id.'\');" id="reply_'.$allteam->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Team/viewteam?id='.$team_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$allteam->id.'" name="user_comment_'.$allteam->id.'" value="'.$allteam->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$allteam->id.'" style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="showhide('.$allteam->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$allteam->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$allteam->id.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$allteam->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            if($allteam->main_comment_id == 0){
                                                                                                $main_comment_id = $allteam->id;
                                                                                            }else{
                                                                                                $main_comment_id = $allteam->main_comment_id;
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
                										  <tr id="reply_form_id_'.$allteam->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$allteam->id.'" method="post" action="'.Yii::app()->createUrl("Team/viewteam?id=".$team_id).'" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$allteam->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$allteam->main_id.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$allteam->id.'">
            																		<textarea id="replycomment_'.$allteam->id.'" name="replycomment_'.$allteam->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
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
				}else{
					$no_more_data = 1;
					$data_str = '<tr style="background-color:#FFFFCC !important;">
									<td style="width:100%">No more records available!!!</td>
								</tr>';
				}
			}
		}

		$response_aray = array();
		$response_aray['team_id'] = $team_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;

		print_r(json_encode($response_aray));exit;
	}
     
     
    public function actionCreategreenflag(){    
        //echo "<pre>";
        //print_r($_POST);exit;
        $AllPostsFlags = new AllPostsFlags;
        if(isset($_POST['AllPostsFlags'])){
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=3");
            if($model_check>0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=3");
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
                $AllPostsFlags->post_type = 3;
                $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
				if(count($ip_status) > 0 ){
					Yii::app()->user->setFlash('failure_msg', Yii::app()->params['comment_green_flag']);
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
    
    public function actionCreateredflag(){
        //echo "<pre>";
        //print_r($_POST);exit;
        $AllPostsFlags = new AllPostsFlags;
        if(isset($_POST['AllPostsFlags'])){
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=3");
            if($model_check > 0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=3");
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
                $AllPostsFlags->post_type =  3;
                $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
                if(count($ip_status) > 0 ){
					Yii::app()->user->setFlash('failure_msg', Yii::app()->params['comment_red_flag']);
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
    
    public function actionSubmitreply(){
        $this->layout = 'blank';
		$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0 ){
			echo "inactive";
		}else{
        $user_comment_model = new AllPosts(); 
        if(isset($_POST['AllPosts'])){
            $user_comment_model->attributes = $_POST['AllPosts'];
            $user_comment_model->user_id = $this->data['user_id'];
            $user_comment_model->post_type = 3;
            $user_comment_model->save(false);
            
            $model_find_team=Team::model()->findByPk($_POST['AllPosts']['main_id']);
                if(count($model_find_team)>0){
                    $model_find_team->posts=$model_find_team->posts+1;
                    $model_find_team->save();
                    //$status_update=Team::model()->updateAll(array('posts='.($model_find_team->posts+1),'user_id='.Yii::app()->session['user_id'].' AND name='.$model_find_team->name));
                }
            echo '1';exit;
        }
		} 
    }
    
    public function actionViewthreadcomment(){
	   $this->layout = 'blank';
       
       //print_r($_POST);exit;
       
		$team_id = $_POST['team_id'];
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];

		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;

		$data_str = "";
		if(!empty($team_id) && is_numeric($team_id) && !empty($currect_section)){
	        $team_model = Team::model()->findByPk($team_id);
			if(count($team_model)>0){
			 
                $block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND block_user= 1 AND flag_type="Red" AND post_type=3','group'=>'commented_by'));
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
             
             
             
             
				$user_comment_condition_clause = "main_id=".$team_id.' AND post_type=3 AND status = 1 AND comment_id=0'.$block_condition.$inactive_condition;
				$user_comment_order_clause = "ucm.id DESC LIMIT 0,".$new_total_record_to_fetch;
				$main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause." ORDER BY ".$user_comment_order_clause;
				$user_comment_model = AllPosts::model()->findAllBySql($main_sql);

				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $allteam){
						$last_comment_id = $allteam->id;
						$stringtime = strtotime($allteam->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        /*if($allteam->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($allteam->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($allteam->team_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                        }*/
                        
                        $green_cnt = count($allteam->team_green_comment);
                        $red_cnt = count($allteam->team_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Green','3');
                        $red_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Red','3');
                       
						$data_str .= '<tr id="'.$allteam->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                        </div>
                                      </a>';
                                                        }
                                                        if($red_total_cooment > 0){
                        $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"red")).'" style="text-decoration:none;">
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
                                                                        <a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->user_comment->id)).'" style="color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;">'.ucfirst($allteam->user_comment->username).'</a>';
                                                                        if($allteam->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->team_other_comment->user_comment->id)).'" style="color: #065A95;font-size: 14px; text-decoration: none;">'.ucfirst($allteam->team_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>
                                                                    </span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.$allteam->comment.'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$allteam->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$allteam->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$allteam->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$allteam->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$allteam->id.'\');" id="reply_'.$allteam->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Team/viewteam?id='.$team_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="https://twitter.com/intent/tweet?url=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Team/viewteam?id='.$team_id.'"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$allteam->id.'" name="user_comment_'.$allteam->id.'" value="'.$allteam->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$allteam->id.'" style="cursor: pointer;;float:right;color:#999999;font-size: 13px;" onclick="showhide('.$allteam->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$allteam->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$allteam->id.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$allteam->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            
                                                                                            if($allteam->main_comment_id == 0){
                                                                                                $main_comment_id = $allteam->id;
                                                                                            }else{
                                                                                                $main_comment_id = $allteam->main_comment_id;
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
                										  <tr id="reply_form_id_'.$allteam->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$allteam->id.'" method="post" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$allteam->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$allteam->main_id.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$allteam->id.'">
            																		<textarea id="replycomment_'.$allteam->id.'" name="replycomment_'.$allteam->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
            																	</td>
            																</tr>
            																<tr>
            																	<td>
                                                                                    <input value="Post" class="type" style="float: right;" type="button" onclick="saveReplay('.$allteam->id.','.$main_comment_id.','.$team_id.');"/>
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
					
                     
                    if(isset($allteam->team_main_comment_list) && count($allteam->team_main_comment_list) > 0){





        //$cnt = 0;
		if(count($allteam->team_main_comment_list)>0){
			foreach($allteam->team_main_comment_list as $allteam){
				$last_comment_id = $allteam->id;
				$stringtime = strtotime($allteam->created_date);

				$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                /*if($allteam->comment_id == 0){*/
                    $color = "color:#065A95";
                     if(!empty($allteam->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->user_comment->profile_image)){
                        $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->user_comment->profile_image;
                    }else{
                        $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                    }
                /*}else{
                    $color = "color:#999999";
                    if(!empty($allteam->team_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image)){
                             $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$allteam->team_other_comment->user_comment->profile_image;
                    }else{
                        $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                    }
                }*/
                
                $green_cnt = count($allteam->team_green_comment);
                $red_cnt = count($allteam->team_red_comment);
      
                $green_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Green','3');
                $red_total_cooment = myhelpers::getGreentotalCount($allteam->main_id,$allteam->user_id,'Red','3');
                
				$data_str .= '<tr id="'.$allteam->id.'" style="background-color:#FFFFFF !important;">
								<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                    <table style="width: 90%;margin-left: 10%;">
                                    	<tr style="width:30px; margin:6px 0 0 0;">
                                        	<td style="width:10%;vertical-align: top;">
												<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id)).'" style="text-decoration:none;">
													<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                </a>
                                                <div style="clear:both; height:3px;"></div>';
                                                if($green_total_cooment > 0){
                $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"green")).'" style="text-decoration:none;">
                                <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                    <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                </div>
                              </a>';
                                                }
                                                if($red_total_cooment > 0){
                $data_str .= '<a target="_blank" href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$team_model->user_id,"type"=>"red")).'" style="text-decoration:none;">
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
                                                                <a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->user_comment->id)).'" style="color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;">'.ucfirst($allteam->user_comment->username).'</a>';
                                                                if($allteam->comment_id != 0){
                                                                    $data_str .= '<span style="color:#065A95;"> > @ </span><a target="_blank" href="'.Yii::app()->createUrl('site/viewpeople',array('people_id'=>$allteam->team_other_comment->user_comment->id)).'" style="color: #065A95;font-size: 14px; text-decoration: none;">'.ucfirst($allteam->team_other_comment->user_comment->username).'</a>';
                                                                }
                                                                    $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>
                                                            </span>                                                    
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.$allteam->comment.'</span>
                                                        </td>
                                                    </tr>
    											   <tr id="already_voted_message_'.$allteam->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
    	                                            <tr style=" width:558px; padding-left:25px;">
    	                                            	
                                                        <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$allteam->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$allteam->id.',\'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$allteam->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$allteam->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$allteam->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$allteam->id.'\');" id="reply_'.$allteam->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Team/viewteam?id=1'.$team_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="https://twitter.com/intent/tweet?url=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Team/viewteam?id='.$team_id.'"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 28%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$allteam->id.'" name="user_comment_'.$allteam->id.'" value="'.$allteam->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$allteam->id.'" style="cursor: pointer;;float:right;color:#999999;font-size: 13px;" onclick="showhide('.$allteam->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$allteam->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$allteam->id.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$allteam->id.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            
                                                                                            if($allteam->main_comment_id == 0){
                                                                                                $main_comment_id = $allteam->id;
                                                                                            }else{
                                                                                                $main_comment_id = $allteam->main_comment_id;
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
        										  <tr id="reply_form_id_'.$allteam->id.'" style="display:none" class="hide_row">
    													<td>
    														<form id="user-comment-form_'.$allteam->id.'" method="post">
    															<input type="hidden" name="comment_id" value="'.$allteam->id.'" />
                                                                <input type="hidden" name="main_id" id="main_id" value="'.$allteam->main_id.'" />
                                                                <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
    															<table style="width:100%; vertical-align: top;">
    																<tr>
    																	<td id="reply_comment_id_'.$allteam->id.'">
    																		<textarea id="replycomment_'.$allteam->id.'" name="replycomment_'.$allteam->id.'" style="width:100%; height:250px;font-family:Arial,Helvetica,Tahoma,sans-serif;font-size:14px;padding: 1%;"></textarea>
    																	</td>
    																</tr>
    																<tr>
    																	<td>
                                                                            <input value="Post" class="type" style="float: right;" type="button" onclick="saveReplay('.$allteam->id.','.$main_comment_id.','.$team_id.');"/>
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
				}else{
					$no_more_data = 1;
					$data_str = '<tr style="background-color:#FFFFCC !important;">
									<td style="width:100%">No more records available!!!</td>
								</tr>';
				}
			}
		}
        
		$response_aray = array();
		$response_aray['team_id'] = $team_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;

		print_r(json_encode($response_aray));exit;
	} 
    
    public function actionMember($team_id=''){
        if(isset($_GET['team_id'])){
           $model_find_member=TeamMember::model()->findAll(array('condition'=>'team_id='.$_GET['team_id']." AND user_id=".$this->data['user_id']));
           if(count($model_find_member)>0){
                Yii::app()->user->setFlash('failure_msg', Yii::app()->params['team_member_duplicate']);
           }else{  
                $model=new TeamMember;
                $model->team_id=$_GET['team_id'];
                $model->user_id=$this->data['user_id'];
                if($model->save()){
                    $model_find_team=Team::model()->findByPk($_GET['team_id']);
                    if(count($model_find_team)>0){
                        $model_find_team->members=$model_find_team->members+1;
                        $model_find_team->save();
                    }
                Yii::app()->user->setFlash('success_msg', Yii::app()->params['team_member_saved']);
                }else{
                    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
                }
            }
            $this->redirect(Yii::app()->createUrl('Team/viewteam',array('id'=>$_GET['team_id'])));
        }
        $this->redirect(Yii::app()->createUrl('Team//teamlist'));
    } 
    
}
