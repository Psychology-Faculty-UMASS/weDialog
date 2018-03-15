<?php

class GeneralController extends Controller{
    public function actionUsercount(){
    	//main_id="+mainid+"&post_type="+posttype,
        $likedislike  = $_POST["likedislike"];
        $this->layout = 'blank';
        $id           = $_POST['comment_id'];
        $main_id      = $_POST["[main_id"];
        $post_type    = $_POST["post_type"];
        $model        = AllPosts::model()->findByPk($id);
        
        $Output = "";
        $like_user_ids = $model->like_ids;
        $like_ids = explode(",", $like_user_ids);
        $dislike_user_ids = $model->dislike_ids;
        $dislike_ids = explode(",", $dislike_user_ids);
        $exist_ids = array_merge($like_ids,$dislike_ids);
        $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0){
		    $Output = "inactive";
		}else{
        if(in_array(Yii::app()->session['user_id'], $exist_ids)){
           $Output = "exist";     
        }else{
            if($likedislike == "like"){
                $model->like = $model->like+1; 
                if($like_user_ids == ''){
                    $model->like_ids = Yii::app()->session['user_id'];
                }else{
                    $model->like_ids = $like_user_ids.','.Yii::app()->session['user_id'];
                }
                   
            }else if($likedislike == "dislike"){
                $model->dislike = $model->dislike+1;
                if($dislike_user_ids == ''){
                   $model->dislike_ids = Yii::app()->session['user_id']; 
                }else{
                    $model->dislike_ids = $dislike_user_ids.','.Yii::app()->session['user_id'];
                }
                
            }
            $model->main_id=$_POST[main_id];
            $model->post_type=$post_type;
            if($model->save()){
              if($likedislike == "like"){
                $Output = $model->like;  
              }else if($likedislike == "dislike"){
                $Output = $model->dislike;
              }
            }else{
                $Output = "fail";
            }                                
        }
     }	
        echo $Output;        
  }
    public function actionCount(){
        $dialogID = '';
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }

        if(isset($_POST['dialog_id'])){
            $dialogID = $_POST['dialog_id'];
        }

        $userID = Yii::app()->session['user_id'];
        
        $likedislike  = $_POST["likedislike"];
        $this->layout = 'blank';
        $id           = $_POST['comment_id'];
        $model        = AllPosts::model()->findByPk($id);
        
        $categoryName = $_POST['category_group_name'];
        $groupA = $_POST['groupA'];
        $groupB = $_POST['groupB'];
        $groupC = $_POST['groupC'];
        
        $categoryGroupModel = CategoryGroups::model()->find("category=:cat AND groups=:group", array(":cat"=>$categoryName, ":group"=>$groupA));
        if($categoryGroupModel){
           $groupA_Id = $categoryGroupModel->id; 
        }
        else {
            $groupA_Id = 0;
        }
        
        $categoryGroupModel = CategoryGroups::model()->find("category=:cat AND groups=:group", array(":cat"=>$categoryName, ":group"=>$groupB));
        if($categoryGroupModel){
           $groupB_Id = $categoryGroupModel->id; 
        }
        else {
            $groupB_Id = 0;
        }
        
        $categoryGroupModel = CategoryGroups::model()->find("category=:cat AND groups=:group", array(":cat"=>$categoryName, ":group"=>$groupC));
        if($categoryGroupModel){
           $groupC_Id = $categoryGroupModel->id; 
        }
        else {
            $groupC_Id = 0;
        }
        
        $Output = "";
        $like_user_ids = $model->like_ids;
        $like_ids = explode(",", $like_user_ids);
        $dislike_user_ids = $model->dislike_ids;
        $dislike_ids = explode(",", $dislike_user_ids);
        $exist_ids = array_merge($like_ids,$dislike_ids);
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
		$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.$ip.'" AND status="Inactive"'));
		if(count($ip_status) > 0){
		    $Output = "inactive";
		}else{	
            if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
                $ipaddress_status=0;
                if($model->ip_address !=""){
                    $ip_address = explode(",",$model->ip_address);
                    foreach($ip_address as $ip_address_temp){
                        if($ip_address_temp==myhelpers::get_client_ip()){
                            $ipaddress_status=1;
                            break;            
                        }
                    }
                }
                if($ipaddress_status==1){
                    $Output = "exist";
                }else if(in_array(Yii::app()->session['user_id'], $exist_ids)){
                   $Output = "exist";     
                }else{
                	if($likedislike == "like"){
                    	$model->like = $model->like+1; 
                        if($like_user_ids == ''){
                            $model->like_ids = Yii::app()->session['user_id'];
                        }else{
                            $model->like_ids = $like_user_ids.','.Yii::app()->session['user_id'];
                        }
                           
                    }else if($likedislike == "dislike"){
                        $model->dislike = $model->dislike+1;
                        if($dislike_user_ids == ''){
                           $model->dislike_ids = Yii::app()->session['user_id']; 
                        }else{
                            $model->dislike_ids = $dislike_user_ids.','.Yii::app()->session['user_id'];
                        }
                        
                    }
                    
                    if($model->ip_address == ''){
                       $model->ip_address =myhelpers::get_client_ip(); 
                    }else{
                        $model->ip_address = $model->ip_address.','.myhelpers::get_client_ip();
                    }
                    
                    
                    $model->post_type=1;
                    $model->main_id=$_POST['main_id'];
                    if($model->save()){
                        $postScore = $model->post_score;
                        $likeIDs_Arr = explode(",",$model->like_ids);
                        if(count($likeIDs_Arr)>0){
                            $groupA_UP_Total = $model->like;
                            $groupB_UP_Total = $model->like;
                            $userModels = Users::model()->findAll(array('condition'=>'id IN (:ids)', 'params'=>array(':ids'=>$model->like_ids)));
                            if(count($userModels)>0){
                                foreach($userModels as $userModel){
                                    $userModelCategory_IDs_Array = explode(",", $userModel->category_groups_id);
                                    if(!in_array($groupA_Id,$userModelCategory_IDs_Array)){
                                        $groupA_UP_Total = $groupA_UP_Total-1;
                                    }
                                    
                                    if(!in_array($groupB_Id,$userModelCategory_IDs_Array)){
                                        $groupB_UP_Total = $groupA_UP_Total-1;
                                    }
                                }
                            }
                            
                            $groupA_DOWN_Total = $model->dislike;
                            $groupB_DOWN_Total = $model->dislike;
                            $userModels = Users::model()->findAll(array('condition'=>'id IN (:ids)', 'params'=>array(':ids'=>$model->dislike_ids)));
                            if(count($userModels)>0){
                                foreach($userModels as $userModel){
                                    $userModelCategory_IDs_Array = explode(",", $userModel->category_groups_id);
                                    if(!in_array($groupB_Id,$userModelCategory_IDs_Array)){
                                        $groupA_DOWN_Total = $groupB_DOWN_Total-1;
                                    }
                                }
                            }
                            
                            $groupA_Total = $groupA_UP_Total+$groupA_DOWN_Total;
                            $groupB_Total = $groupB_UP_Total+$groupB_DOWN_Total;
                            
                            $postScore =  number_format($groupA_UP_Total/$groupA_Total * $groupB_UP_Total/$groupB_Total * log10($groupA_UP_Total + $groupB_UP_Total*$groupA_Total/$groupB_Total + 1),2);
                            
                        }
                        else{
                            $postScore = 0.00;
                        }
                        $model->post_score = $postScore;
                        if($model->save()){
                            $query = Yii::app()->db->createCommand('SELECT SUM(post_score) AS total_post_score, COUNT(*) AS total_count FROM all_posts WHERE main_id=:main_id');
                            $query->params = array(":main_id"=>$model->main_id);
                            $topicScoreData = $query->queryRow();
                            $topicScore = number_format($topicScoreData->total_post_score/$topicScoreData->total_count * log10($topicScoreData->total_count+1),2);
                            Topics::model()->updateByPk($model->main_id, array('topic_score'=>$topicScore));
                            
                            $peopleScoreDataSQl = "SELECT SUM(post_score) AS p_score, COUNT(post_score) AS p_count FROM all_posts AS t INNER JOIN topics AS top ON t.main_id=top.id WHERE t.user_id=".$userID." AND top.dialog_id=".$dialogID;
                            $connection = Yii::app()->db;
                            $command=$connection->createCommand($peopleScoreDataSQl);
                            $dataReader = $command->query();
                            $peopleScoreData = $dataReader->readAll();
                            $postsCountByUser = $peopleScoreData[0]['p_count'];
                            $postsScoreSumByUser = $peopleScoreData[0]['p_score'];
                            $peolpleScore = number_format(log10($postsCountByUser+1)*$postsScoreSumByUser/$postsCountByUser,2);
                            $peolpleScoreModel = PeopleScore::model()->find('user_id=:uid AND dialog_id=:did', array(':uid'=>$userID, ':did'=>$dialogID));
                            if($peolpleScoreModel){
                                $peolpleScoreModel->score = $peolpleScore;
                            }
                            else {
                                $peolpleScoreModel = new PeopleScore();
                                $peolpleScoreModel->user_id = $userID;
                                $peolpleScoreModel->dialog_id = $dialogID;
                                $peolpleScoreModel->score = $peolpleScore;
                            }
                            $peolpleScoreModel->save();
                        }
                      if($likedislike == "like"){
                        $Output = $model->like;  
                      }else if($likedislike == "dislike"){
                        $Output = $model->dislike;
                      }
                    }else{
                        $Output = "fail";
                    }                                
                }        
            
            }else{
                $Output = "login"; 
            }
        }
        
        echo $Output;
    }
    
    
    public function actionCategorygroupcreate(){
        	$this->layout = 'blank';
            $groupname  = $_POST["groupname"];
            $categoryname  = $_POST["categoryname"];
            $question_number = $_POST['question_number'];
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
            }
            $groupexistmodel  = CategoryGroups::model()->findAll(array('condition'=>'category = "'.$categoryname.'" AND groups ="'.$groupname.'"'));
        	if(count($groupexistmodel) >0){
        	   $Output="exist";
            }else{
                $CategoryGroupsModel = new CategoryGroups;
            	$CategoryGroupsModel->groups = $groupname;
            	$CategoryGroupsModel->category = $categoryname;
                $CategoryGroupsModel->dialog_id = $dialogID;
            	$CategoryGroupsModel->created_by = $this->data['user_name'];
            	$CategoryGroupsModel->date = date("Y-m-d H:i:s");  
            	if($CategoryGroupsModel->save()){
            		
            		/*$catgroupmodel  = CategoryGroups::model()->findAll(array('condition'=>'category="'.$categoryname.'" AND status="Active"'));
            		$this->data['catgroupmodel'] = $catgroupmodel;
            		foreach($catgroupmodel as $total_cat){
            			$tag_html.='<option value='.$total_cat->groups.'>'.$total_cat->groups.'</option>';
            		}
                    $Output = $tag_html;*/
                    $Output='<option value='.$groupname.'>'.$groupname.'</option>';
            	};
            }
        
            echo $Output;        
        
        
    }
    
    public function actionSelectcategorygroup(){
        	$this->layout = 'blank';
            $category  = $_POST["category"];
            $question_number = $_POST['question_number'];
            $dialogID = '';
            if(!empty(Yii::app()->session['dialog_id'])) {
                $dialogID = Yii::app()->session['dialog_id'];
            }
    		$catgroupmodel  = CategoryGroups::model()->findAll(array('condition'=>'category="'.$category.'" AND status="Active" AND dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
    		$this->data['catgroupmodel'] = $catgroupmodel;
    		foreach($catgroupmodel as $total_cat){
    			$tag_html.='<option value='.$total_cat->groups.'>'.$total_cat->groups.'</option>';
    		}
            $Output = $tag_html;
        	echo $Output; 
            
         
            /*$tmp_group_array = array();
            foreach($catgroupmodel as $catgroup){
                 $tmp_group_array[] = trim($catgroup->groups);  
            }
            if(($TopicQuestionModel->id  > 0) && !empty($TopicQuestionModel->option1)){
            $test = explode(",",$TopicQuestionModel->option1);
            $temp_array = array();
            foreach($test as $acb => $value){
                $temp_array[] = $value; 
                ?>
            <option selected="" value="<?php echo $value;?>"><?php echo $value;?></option>
            
            <?php }}                    
            
            $uniq_array=array_unique($tmp_group_array);
            for($i=0;$i<count($uniq_array);$i++){
                  if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>
                  <option value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>
            		<?php                           	
                    $tagS_Array[]='"'.$uniq_array[$i].'"';
                  } 
            }
            $new_string=implode(",",$tagS_Array);
            */             
            
            
            
                   
    }
    
    
    
    
        

    public function actionQuestionanswer(){
        $this->layout = 'blank';
        $topic_id = $_POST['topic_id'];
        $dialogID = '';
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }
        //$comment_id = $_POST['comment_id'];
        //$type = $_POST['type'];
        //echo "type=".$type."Comment=".$comment_id."user_id=".$this->data['user_id'];exit;
        //$all_post_model = TopicQuestionAnswer::model()->find(array('condition'=>'(user_id='.$this->data['user_id'].' OR ip_address="'.myhelpers::get_client_ip().'") AND topic_id ='.$topic_id));
//        $all_post_model = TopicQuestionAnswer::model()->find(array('condition'=>'(user_id='.$this->data['user_id'].' OR ip_address="'.myhelpers::get_client_ip().'") AND dialog_id =:did', 'params'=>array(':did'=>$dialogID)));
        $all_post_model = TopicQuestionAnswer::model()->find(array('condition'=>'(user_id='.$this->data['user_id'].') AND dialog_id =:did', 'params'=>array(':did'=>$dialogID)));
        //$all_post_model = TopicQuestionAnswer::model()->find(array('condition'=>'user_id='.$this->data['user_id'].' AND post_id='.$comment_id.' AND type="'.$type.'"'));        
//        print_R($all_post_model);die;
        //print_r(count($all_post_model));exit;
        if(isset($all_post_model) && count($all_post_model) > 0){
            $output = '1';
        }else{
            $output = '0';
        }
        echo $output;exit;
    }    
    
    
    public function actionRulecount(){
    	$likedislike  = $_POST["likedislike"];
        $this->layout = 'blank';
        $id           = $_POST['comment_id'];
        $model        = AllPosts::model()->findByPk($id);
        
        $Output = "";
        $like_user_ids = $model->like_ids;
        $like_ids = explode(",", $like_user_ids);
        $dislike_user_ids = $model->dislike_ids;
        $dislike_ids = explode(",", $dislike_user_ids);
        $exist_ids = array_merge($like_ids,$dislike_ids);
        $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0 ){
			$Output = "inactive";
		}else{
        if(in_array(Yii::app()->session['user_id'], $exist_ids)){
           $Output = "exist";     
        }else{
            if($likedislike == "like"){
                $model->like = $model->like+1; 
                if($like_user_ids == ''){
                    $model->like_ids = Yii::app()->session['user_id'];
                }else{
                    $model->like_ids = $like_user_ids.','.Yii::app()->session['user_id'];
                }
                   
            }else if($likedislike == "dislike"){
                $model->dislike = $model->dislike+1;
                if($dislike_user_ids == ''){
                   $model->dislike_ids = Yii::app()->session['user_id']; 
                }else{
                    $model->dislike_ids = $dislike_user_ids.','.Yii::app()->session['user_id'];
                }
                
            }
            $model->post_type=2;
            $model->main_id=$_POST['main_id'];
            if($model->save()){
              if($likedislike == "like"){
                $Output = $model->like;  
              }else if($likedislike == "dislike"){
                $Output = $model->dislike;
              }
            }else{
                $Output = "fail";
            }                                
        }
   
     }	
        echo $Output;        
    }    
    
    
    public function actionTeamcount(){
        $likedislike  = $_POST["likedislike"];
        $this->layout = 'blank';
        $id           = $_POST['comment_id'];
        $model        = AllPosts::model()->findByPk($id);
        
        $Output = "";
        $like_user_ids = $model->like_ids;
        $like_ids = explode(",", $like_user_ids);
        $dislike_user_ids = $model->dislike_ids;
        $dislike_ids = explode(",", $dislike_user_ids);
        $exist_ids = array_merge($like_ids,$dislike_ids);
        $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0 ){
			$Output = "inactive";
		}else{
        if(in_array(Yii::app()->session['user_id'], $exist_ids)){
           $Output = "exist";     
        }else{
	            if($likedislike == "like"){
	                $model->like = $model->like+1; 
	                if($like_user_ids == ''){
	                    $model->like_ids = Yii::app()->session['user_id'];
	                }else{
	                    $model->like_ids = $like_user_ids.','.Yii::app()->session['user_id'];
	                }
	                   
	            }else if($likedislike == "dislike"){
	                $model->dislike = $model->dislike+1;
	                if($dislike_user_ids == ''){
	                   $model->dislike_ids = Yii::app()->session['user_id']; 
	                }else{
	                    $model->dislike_ids = $dislike_user_ids.','.Yii::app()->session['user_id'];
	                }
	                
	            }
	            $model->post_type=3;
	            $model->main_id=$_POST['main_id'];
	            if($model->save()){
	              if($likedislike == "like"){
	                $Output = $model->like;  
	              }else if($likedislike == "dislike"){
	                $Output = $model->dislike;
	              }
	            }else{
	                $Output = "fail";
	            }                                
	        }
        }
        echo $Output;        
    }
    
    
    
    public function actionReplycount(){
    	$likedislike  = $_POST["likedislike"];
    	$this->layout = 'blank';
    	$id           = $_POST['reply_id'];
    	$model        = CommentReply::model()->findByPk($id);
    
    	$Output = "";
    	if(empty($model->likedislikeids)  && $model->likedislikeids == ''){
    		$model->likedislikeids = Yii::app()->session['user_id'];
    		if($likedislike == "like"){
    			$model->like = $model->like+1;
    		}else if($likedislike == "dislike"){
    			$model->dislike = $model->dislike+1;
    		}
    		if($model->save()){
    			if($likedislike == "like"){
    				$Output = $model->like;
    			}else if($likedislike == "dislike"){
    				$Output = $model->dislike;
    			}
    		}else{
    			$Output = "fail";
    		}
    	}else{
    		$user_ids = $model->likedislikeids;
    		$ExpUserID = explode(",", $user_ids);
    		if(in_array(Yii::app()->session['user_id'], $ExpUserID)){
    			$Output = "exist";
    		}else{
    			$user_ids = $user_ids.",".Yii::app()->session['user_id'];
    			$model->likedislikeids = $user_ids;
    			if($likedislike == "like"){
    				$model->like = $model->like+1;
    			}else if($likedislike == "dislike"){
    				$model->dislike = $model->dislike+1;
    			}
    			if($model->save()){
    				if($likedislike == "like"){
    					$Output = $model->like;
    				}else if($likedislike == "dislike"){
    					$Output = $model->dislike;
    				}
    			}else{
    				$Output = "fail";
    			}
    		}
    	}
    	echo $Output;
    }
    
    public function actionCatetag(){
    	$category_tags  = $_POST["category_tags"];
    	$this->layout = 'blank';
    	$Tagmodel        = CategoryTags::model()->findAll(array('condition'=>'cat_tag LIKE "%'.$category_tags.'%"'));
    	$Output = "";
    	$Output = '<table style="width: 100%; border:1px solid;">';
    	
    	foreach($Tagmodel AS $cattaglist){
    		$Output.= '<tr>
		                	<td style="width:100%; vertical-align: top;" onclick="cat_tag(\''.$cattaglist->cat_tag.'\')" >'.$cattaglist->cat_tag.'</td>
		               	  </tr>                                                                                                
		            ';
    	}
    	
    	$Output.= '</table>';
    	
    	echo $Output;
    	
    }
    
    public function actionCategory_description(){
        $dialogID = '';
        if(!empty(Yii::app()->session['dialog_id'])) {
            $dialogID = Yii::app()->session['dialog_id'];
        }
        
    	$category_description  = $_POST["category_description"];
    	$tag_value  = $_POST["tag_value"];
    	$this->layout = 'blank';
        
        if($_POST["tag_id"]){
            $CategoryModel = CategoryTags::model()->find(array('condition'=>'id ='.$_POST["tag_id"]));
            
            $CategoryModel->cat_tag_description = $category_description;
            $CategoryModel->user_id = Yii::app()->session['user_id'];
            $CategoryModel->dialog_id = $dialogID;
            if($CategoryModel->validate()){
                $CategoryModel->save();
                $Output = $CategoryModel->cat_tag;
            }
        }else{
            $Tagexistmodel  = CategoryTags::model()->findAll(array('condition'=>'cat_tag ="'.$tag_value.'"'));
        	if(count($Tagexistmodel) >0){
        	   $Output="exist";
            }else{
                Yii::app()->session['topic_title']=$_POST["topic_title"];
                Yii::app()->session['topic_discription1']=$_POST["topic_discription1"];
                
                $TagModel = new CategoryTags;
            	$TagModel->cat_tag_description = $category_description;
            	$TagModel->cat_tag = $tag_value;
            	$TagModel->user_id = Yii::app()->session['user_id'];
            	$TagModel->created_date = date("Y-m-d H:i:s"); 
                $TagModel->dialog_id = $dialogID;
            	if($TagModel->save()){
            		
            		$Totaltagtmodel  = CategoryTags::model()->findAll(array('condition'=>'dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
            		$this->data['Totaltagtmodel'] = $Totaltagtmodel;
            		foreach($Totaltagtmodel as $total_cat){
            			$tag_html.='<option value='.$total_cat->cat_tag.'>'.$total_cat->cat_tag.'</option>';
            		}
            		/*$Tagcatmodel        = CategoryTags::model()->findAll();
    				$tmp_cat_tags_array = array();
                        foreach($Tagcatmodel as $tag_cat){
                             $tmp_cat_tags_array[] = trim($tag_cat->cat_tag);  
            			}
            			$uniq_array=array_unique($tmp_cat_tags_array);
                        for($i=0;$i<count($uniq_array);$i++){
                              if(!empty($uniq_array[$i])){
                                $tagS_Array[]='"'.trim($uniq_array[$i]).'"';
    							//$tagS_Array[]="'".trim($uniq_array[$i])."'";
                              } 
                        }            
                        $new_string=implode(",",$tagS_Array);*/
    					
            	    //$Output = $_POST["topic_title"].'===='.$_POST["topic_discription1"];
                    $Output = $tag_html;
            	};
            }
        }
        	echo $Output;
        	 
    }
    
    public function actionTypetag(){
    	$type_tags  = $_POST["type_tags"];
    	$this->layout = 'blank';
    	$Tagmodel        = TypeTags::model()->findAll(array('condition'=>'type_tag LIKE "%'.$type_tags.'%"'));
    	$Output = "";
    	$Output = '<table style="width: 100%; border:1px solid;">';
    	 
    	foreach($Tagmodel AS $typetaglist){
    		$Output.= '<tr>
    		<td style="width:100%; vertical-align: top;" onclick="type_tag(\''.$typetaglist->type_tag.'\')" >'.$typetaglist->type_tag.'</td>
    		</tr>
    		';
    	}
    	 
    	$Output.= '</table>';
    	 
    	echo $Output;
    	 
    }
    
    public function actionType_description(){
    	$type_description  = $_POST["type_description"];
    	$tag_value  = $_POST["tag_value"];
    	$this->layout = 'blank';
        if($_POST["tag_id"]){
            $TypeModel = TypeTags::model()->find(array('condition'=>'id ="'.$_POST["tag_id"].'"'));
            $TypeModel->type_tag_description = $type_description;
        	$TypeModel->user_id = Yii::app()->session['user_id'];
            if($TypeModel->save()){
                $Output = $TypeModel->type_tag;
            }
        }else{
            $Tagexistmodel        = TypeTags::model()->findAll(array('condition'=>'type_tag ="'.$tag_value.'"'));
        	if(count($Tagexistmodel) >0){
        	   $Output="exist";
            }else{
                Yii::app()->session['topic_title']=$_POST["topic_title"];
                Yii::app()->session['topic_discription1']=$_POST["topic_discription1"];
                
                
            	$TagModel = new TypeTags;
            	$TagModel->type_tag_description = $type_description;
            	$TagModel->type_tag = $tag_value;
            	$TagModel->user_id = Yii::app()->session['user_id'];
            	$TagModel->created_date = date("Y-m-d H:i:s");
                if($TagModel->save()){
            	    //$Output = $TagModel->type_tag;
            	    
                	$Totaltypetagtmodel  = TypeTags::model()->findAll();
                	$this->data['Totaltypetagtmodel'] = $Totaltypetagtmodel;
                	foreach($Totaltypetagtmodel as $total_type_cat){
                		$type_tag_html.='<option value='.$total_type_cat->type_tag.'>'.$total_type_cat->type_tag.'</option>';
                	}
                	
                	$Output = $type_tag_html;
                	
            	};
            	
            }
        }
    	echo $Output;
    
    }
    
    public function actionCategorytagdetail(){
    	
        $tag_value  = $_POST["tag_value"];
    	$this->layout = 'blank';
        if($_POST["tag_value"]){
            $CategoryModel = CategoryTags::model()->find(array('condition'=>'cat_tag ="'.$_POST["tag_value"].'"'));
        
        }
        $tagtital=$CategoryModel->cat_tag;
        
        /*if($CategoryModel->user_id == Yii::app()->session['user_id']){
            $tagtital.='<a href="#signup" name="signup" rel="leanModal" id="go" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Tag</a>';
        }*/
        $username=$CategoryModel->categoryTags_username->username."/";
        $stringtime= strtotime($CategoryModel->created_date);
        $datetoshow=date('d-m-Y',$stringtime);
    	$Output= $tagtital.'||'.$CategoryModel->cat_tag_description.'||'.$datetoshow.'||'.$username;
    	 
    	 
    	echo $Output;
    	
    
    }
    
    public function actionTypetagdetail(){
    	
        $tag_value  = $_POST["tag_value"];
    	$this->layout = 'blank';
        if($_POST["tag_value"]){
            $TypeModel = TypeTags::model()->find(array('condition'=>'type_tag ="'.$_POST["tag_value"].'"'));
        
        }
        $username=$TypeModel->typeTags_username->username."/";
        $stringtime= strtotime($TypeModel->created_date);
        $datetoshow=date('m/d/Y',$stringtime);
    	$Output= $TypeModel->type_tag.'||'.$TypeModel->type_tag_description.'||'.$datetoshow.'||'.$username;
    	 
    	 
    	echo $Output;
    	
    
    }
    
    public function actionTopicdetail(){
    	
        $topic_id  = $_POST["topic_id"];
    	$this->layout = 'blank';
        if($_POST["topic_id"]){
            
            $TopicModel = Topics::model()->findByPk($topic_id);
            
        }
        $topic_title1=$TopicModel->topic_title;
        $topic_title=$TopicModel->topic_title;
        
        if($TopicModel->user_id == Yii::app()->session['user_id']){
            
           $topic_title.='<a href='.Yii::app()->createUrl('topics/updatetopic',array('topic_id'=>$TopicModel->id)).' style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Topic</a>';
        }
                                
        $topic_description1 = nl2br($TopicModel->topic_description);
        $topic_description=nl2br(myhelpers::get_cropped_text($TopicModel->topic_description, 100));
        if(strlen($TopicModel->topic_description) > 100){
            $topic_description.= "...";
        
            $topic_description.='<div style="height: 10;" ></div>
                    <div id="less123" >Less</div>';
         }           
        $category_tags=$TopicModel->category_tags;
        $type_tags=$TopicModel->type_tags;
        $createdby='<a  style="text-decoration: none;font-weight: bold;" href='. Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->topics_username->id)).'>'.ucfirst($TopicModel->topics_username->username).', </a>';
        $stringtime= strtotime($TopicModel->created_date);
        $date1='&nbsp; '.date('m/d/Y',$stringtime); 
        
        $Output= $topic_title.'||'.$topic_description.'||'.$category_tags.'||'.$type_tags.'||'.$createdby.'||'.$date1.'||'.$topic_description1.'||'.$topic_title1;
    	 
    	 
    	echo $Output;
    
    }
    
    
    public function actionRuledetail(){
    	
        $tag_id  = $_POST["tag_id"];
    	$this->layout = 'blank';
        if($_POST["tag_id"]){
            
            $TopicModel = TypeTags::model()->findByPk($tag_id);
            
        }
        $topic_title1=$TopicModel->type_tag;
        $topic_title=$TopicModel->type_tag;
        
        if($TopicModel->user_id == Yii::app()->session['user_id']){
            
           $topic_title.='<a href='.Yii::app()->createUrl('TypeTags/updatetypetags',array('tag_id'=>$TopicModel->id)).' style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Type Tags</a>';
        }
                                
        $topic_description1=$TopicModel->type_tag_description;
        $topic_description=substr($TopicModel->type_tag_description,0, 100);
        if(strlen($TopicModel->type_tag_description) > 100){
            $topic_description.= "...";
        
            $topic_description.='<div style="height: 10;" ></div>
                    <div id="less123" >Less</div>';
         }           
        $category_tags=' ';
        $type_tags=' ';
        $createdby='<a  style="text-decoration: none;font-weight: bold;" href='. Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->typeTags_username->id)).'>'.ucfirst($TopicModel->typeTags_username->username).', </a>';
        $stringtime= strtotime($TopicModel->created_date);
        $date1='&nbsp; '.date('m/d/Y',$stringtime); 
        
        $Output= $topic_title.'||'.$topic_description.'||'.$category_tags.'||'.$type_tags.'||'.$createdby.'||'.$date1.'||'.$topic_description1.'||'.$topic_title1;
    	 
    	 
    	echo $Output;
    
    }    
    
    public function actionTeamdetail(){
    	
        $team_id  = $_POST["team_id"];
    	$this->layout = 'blank';
        if($_POST["team_id"]){
            
            $TopicModel = Team::model()->findByPk($team_id);
            
        }
        $topic_title1=$TopicModel->name;
        $topic_title=$TopicModel->name;
        
        if($TopicModel->user_id == Yii::app()->session['user_id']){
            
           $topic_title.='<a href='.Yii::app()->createUrl('Team/updateteam',array('$team_id'=>$TopicModel->id)).' style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Team</a>';
        }
                                
        $topic_description1=$TopicModel->description;
        $topic_description=substr($TopicModel->description,0, 100);
        if(strlen($TopicModel->description) > 100){
            $topic_description.= "...";
        
            $topic_description.='<div style="height: 10;" ></div>
                    <div id="less123" >Less</div>';
         }           
        $category_tags=' ';
        $type_tags=' ';
        $createdby='<a  style="text-decoration: none;font-weight: bold;" href='. Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->team_to_user_relation->id)).'>'.ucfirst($TopicModel->team_to_user_relation->username).', </a>';
        $stringtime= strtotime($TopicModel->created_date);
        $date1='&nbsp; '.date('m/d/Y',$stringtime); 
        
        $Output= $topic_title.'||'.$topic_description.'||'.$category_tags.'||'.$type_tags.'||'.$createdby.'||'.$date1.'||'.$topic_description1.'||'.$topic_title1;
    	 
    	 
    	echo $Output;
    
    }
    
   /* 
    public function actionMoremytopics1(){
    	//$ExoIds = explode(',',$_POST['idstr']);
        
        $this->layout = 'blank';
        //$TotalMytopics = Topics::model()->findAll(array('condition'=>'status="Active" AND user_id="'.Yii::app()->session['user_id'].'" AND id NOT IN ('.$_POST['idstr'].')'));
        $TotalMytopics = Topics::model()->findAll(array('condition'=>'status="Active" AND user_id="'.Yii::app()->session['user_id'].'" '));
        $i=2;
        foreach($TotalMytopics as $MyTopics){
        $title=ucwords($MyTopics->topic_title);
        $increment=$i+1;
        $data_str.='<tr><td height="20" style="text-align: left;padding-left: 25px !important;cursor: pointer;" onclick="javascript: topicdetailmore2('.$MyTopics->id.')">
                    ('.$increment.')&nbsp;&nbsp;'.$title.'</td>
                </tr>';
        $i++;
                
        } 
    	 
    	echo $data_str;
    	
    
    }
    
    public function actionMorepopulartopics1(){
    	//$ExoIds = explode(',',$_POST['idstr']);
        //$beforeids=$_POST['idstr'];
        $this->layout = 'blank';
        //$WHEREPOPULAR.=" status = 'Active' AND id NOT IN ($beforeids) AND user_id='".Yii::app()->session['user_id']."' ORDER BY Totalcommentscount DESC";
        $WHEREPOPULAR.=" status = 'Active' AND user_id='".Yii::app()->session['user_id']."' ORDER BY Totalcommentscount DESC";
        $TestpopularSql = "SELECT topics.*,(SELECT COUNT(*) FROM user_comment WHERE user_comment.topic_id = topics.id) AS Totalcommentscount
                         FROM topics WHERE ".$WHEREPOPULAR;
        $PopularTopicListModel = Topics::model()->findAllBySql($TestpopularSql);
        $i=2;
        foreach($PopularTopicListModel as $MyTopics){
            $title=ucwords($MyTopics->topic_title);
            $increment=$i+1;
            $data_str.='<tr><td height="20" style="text-align: left;padding-left: 25px !important;cursor: pointer;" onclick="javascript: topicdetailmore2('.$MyTopics->id.')">
                        ('.$increment.')&nbsp;&nbsp;'.$title.'</td>
                    </tr>';
            $i++;
                
        } 
    	 
    	echo $data_str;
    	
    
    }
    */
    public function actionGetpeoplelistdata(){
    	$this->layout = 'blank';
        if(isset($_POST["lastid"]) && $_POST["lastid"] != "0"){
            $lastid = $_POST["lastid"];
            $WHERE="users.id != ".Yii::app()->session['user_id']." AND users.id > ".$lastid." ORDER BY users.id ASC LIMIT 10 "; 
            
            $TestSql = "SELECT users.*, (SELECT COUNT(*) FROM topics WHERE topics.user_id = users.id) AS Totalcount,(SELECT COUNT(*) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount FROM users WHERE ".$WHERE;
            $PeopleListModel = Users::model()->findAllBySql($TestSql);
            
            foreach($PeopleListModel AS $PeopleList){
                $topic_title1=$TopicModel->topic_title;
                $topic_title=$TopicModel->topic_title;
                $Src = '../'.Yii::app()->params['profile_img'].$PeopleList->profile_image;
                if($PeopleList->profile_image == ""){
                    $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
                }
                
                if($PeopleList->facebook_id != 0 &&  $PeopleList->facebook_id!=""){
                        if($PeopleList->profile_image==""){
                             $Src= 'http://graph.facebook.com/'.$PeopleList->facebook_id.'/picture?type=large' ;
                        }
                }
                
                if(!empty($PeopleList->user_description)){
                     $user_description= substr($PeopleList->user_description,0, 100);
            	     if(strlen($PeopleList->user_description) > 100){
            	        $user_description.= "...";
            	     }
                }
                $count=$PeopleList->Totalcount;            
                $data_str.='<tr id='.$PeopleList->id.' class="tr_people_data">
                                <td style="width:100%">
                                    <table style="width: 100%;">
                                        <tr>                    
                                            <td style="width:85px; vertical-align: top;">
                                               <a href='.Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$PeopleList->id)).'>
                                                    <img  src='.$Src.' width="25" height="25" style="background-color:#bde3e7;"/>
                                               </a>
                                            </td>
                                            <td style="width:12px;">&nbsp;</td>
                                            <td style="width:100%; vertical-align: top;">
                                                <table width="100%" style="vertical-align: top;padding: 0px;" cellspacing="0" cellpadding="0" border="0">
                                                    <tr style="vertical-align: top;">
                                                        <td style=" float:left;font-size:18px;">'.ucfirst($PeopleList->username).'</td>    
                                                    </tr>
                                                    <tr>
                                                        <td height="20" style="word-wrap: normal;color: #125D90;font-size: 12px;">'.$user_description.'</td>
                                                    </tr>
                                                </table>                    
                                            </td>
                                       </tr> 
    						
    						
    						            <tr>
                            				<td height="5"></td>
                           				 </tr>
                           				 <tr>
                            				<td height="20">Topics &nbsp;('.$count.')</td>
                           				 </tr>
                           				 <tr>
                            				<td height="5"></td>
                            			</tr>
                           				 <tr>
                            	
                           				 </tr>
    			                        <tr>
    			                        	<td height="20">Posts&nbsp;('.$PeopleList->Totalcommentscount.')</td>
    			                            </td>
    			                        </tr>
    			                        
    			                        <tr>
    			                        	<td><hr style="border: 1px solid red;" /></td>
    			                        </tr>
    			                        
                                                                                                                           
                        </table>
                    </td>                    
                </tr> ';
                    
            } 
    		echo $data_str;
           } 
    }
    
    public function actionAiiadescriptor(){
      if(isset($_POST)){
    	$descriptorname  = $_POST["descriptorname"];
    	$this->layout = 'blank';
        
        $Aiiaexistmodel  = Aiia::model()->findAll(array('condition'=>'discriptor ="'.$descriptorname.'"'));
    	if(count($Aiiaexistmodel) >0){
    	   $Output="exist";
        }else{
            
            //Yii::app()->session['topic_title']=$_POST["topic_title"];
            //Yii::app()->session['topic_discription1']=$_POST["topic_discription1"];
            
            $AiiaModel = new Aiia;
        	$AiiaModel->discriptor = $descriptorname;
        	$AiiaModel->created_by = Yii::app()->session['user_id'];
        	//$AiiaModel->date = date("Y-m-d H:i:s");  
        	if($AiiaModel->save()){
        		$Totalaiiamodel  = Aiia::model()->findAll(array('condition'=>'status="Active"'));
        		$this->data['Totalaiiamodel'] = $Totalaiiamodel;
        		foreach($Totalaiiamodel as $total_descriptor){
        			$tag_html.='<option value='.$total_descriptor->id.'>'.$total_descriptor->discriptor.'</option>';
        		}
                $Output = $tag_html;
        	};
        }
        
    	echo $Output;
      }  	 
    }
    
    public function actionAbout(){
        $this->layout = 'registration';
        $cms_about_model = Cms::model()->findByPk(1);
        $this->data['cms_about_model'] = $cms_about_model;
        $this->render('about_us',$this->data);
    }
    
    
 public function actionUserreply(){
       	$this->layout = 'blank';
        if(isset($_POST["user_id"]) && $_POST["user_id"] != "0"){
            $user_id = $_POST["user_id"];
            $topic_id = $_POST["topic_id"];
            $comment_user_id = $_POST["comment_user_id"];
            $ReplyListModel = CommentReply::model()->findAll(array('condition'=>'user_id="'.$user_id.'" AND topic_id='.$topic_id));
		
            $cnt = 0;
            foreach($ReplyListModel AS $ReplyList){
            	
                $userid       = UserComment::model()->findByPk($ReplyList->comment_id);
                $userdetail= Users::model()->findByPk($userid->user_id);
                
                $Src = '../'.Yii::app()->params['profile_img'].$userdetail->profile_image;
                if($ReplyList->reply_user->profile_image == ""){
                    $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
                }
                
                $Src1 = Yii::app()->createUrl().'/images/bult-icon.png'; 
                $Src2 = Yii::app()->createUrl().'/images/bult-icon1.png'; 
                
                
                $stringtime= strtotime($ReplyList->created_date);
                $date1 = date('m-d-Y',$stringtime);
                $stringtime= strtotime($ReplyList->created_date);
                $date2= date('H:i',$stringtime);
                                        
               
                
                                            
                                            
//                                                  
                $data_str.="<tr>
                               <td style='width:100%'>
                                    <table style='width: 100%;'>";
                                    
                $data_str.="<tr style='float:left; width:30px; height:30px; margin:5px 0 0 0;'>
                                <td>
                                    <img  src=$Src width='25' height='25' style='background-color:#bde3e7;'/>
                                </td>
                            </tr>";    
                
                $data_str.="<tr style='float:left; padding-top:10px; font-size:14px;'>
                                <td style='color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;'>";
 				$href =  Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$ReplyList->reply_user->id));                                
				$reply_username = $ReplyList->reply_user->username;
				$userdetail_username = $userdetail->username;
                $comment_id = $ReplyList->comment_id;
                $user_id = $ReplyList->user_id;
                $id = $ReplyList->id;   
                                   
                $data_str.="<a href=$href style='color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;'>$reply_username</a>:@ 
                                    <a href=$href style='color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;'>$userdetail_username
                                    </a>$date1 at $date2
                                </td>
                            </tr>
                            <tr>
                                <td height='5'></td>
                            </tr>
                            <tr style='float:left; margin:0 0 0 25px;'>
                                <td height='20' style='color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;'>$ReplyList->reply
                                </td>
                            </tr>
                            <tr>
                                <td height='5'></td>
                            </tr>
                            <tr style='width:558px; padding-left:25px;'>
                                <td height='20'>
                                    <img src=$Src1 onclick=likedislikecommentfun($id,'like')>
                                    <span id='likecount_".$id."' style='color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 12px;font-weight: bold;'>$ReplyList->like
                                    </span>
                                    &nbsp;
                                    <img src=$Src2 onclick=likedislikecommentfun($id,'dislike')>&nbsp;&nbsp;
                                    <span id='dislikecount_".$id."' style='color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 12px;font-weight: bold;'>
                                                            $ReplyList->dislike
                                    </span>
                                                        
                                    <div class='postareply' id='".$comment_id."_".$cnt."' style='color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;' onclick=showtextarea(this.id) >Reply1</div>
                                    <input type='hidden' id='usercomment_".$comment_id."_".$cnt."' name='user_comment_".$user_id."' value='$reply_username' />
                                </td>
                            </tr>";
                            
                  $data_str.="<tr>
                                <td><form method='post' action='/ivan_topics/topics/Viewtopic?topic_id=14' id='topic-reply-form'> ";
                                     
                $data_str.="<table  style='width:98%; vertical-align: top; display: none;' id='1showreply_".$ReplyList->comment_id."_".$cnt."'>
        				        <tr>
        				            <td height='30' style='vertical-align: top; font: bolder !important;font-size: large;'>";
        		$data_str.= " <textarea name='CommentReply[reply]' id='showreply_".$ReplyList->comment_id."_".$cnt."' class='input_box' aria-hidden='true'></textarea>"; 
        				            
        				                
                $data_str.="</td>
        				        </tr>
        				        <tr>
        				            <td style='float: right;'>
        				                <input type='image' src='".Yii::app()->createUrl()."/images/post-btn.png'  />
                                        <input type='hidden' id='comment_id' name='comment_id' value=".$ReplyList->comment_id."/>
        				            </td>
        				         </tr>
        				    </table></form>";
                            
                           
                $data_str.="</td>
                            </tr>"; 
							
                $data_str.="</table>
                            </td>
                            </tr>
                            <tr>
                                       <td><hr style='border: 1px solid red;' /></td>
                            </tr> ";
                                            
               $cnt++;     
            } 
    		echo $data_str;
           } 
    }
}
?>