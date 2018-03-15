<?php
include("TwitterOAuth/class.TwitterOAuth.php");
include("facebook-php-sdk-master/src/facebook.php");
class SiteController extends Controller{
    public $layout = 'registration';
    public $record_to_fetch = 10;
	
	public function actionIndex(){
	 
	   //==============START:FOR DIFFERENT METATITLE========================//
       //$this->getMetaData();
	   //==============END:FOR DIFFERENT METATITLE========================//
		if(isset($_GET['oauth_provider']) && !empty($_GET['oauth_provider'])){
			/*
            if($_GET['oauth_provider'] == 'facebook'){
				include("Fb/facebook.php");
				$FbDetails = $this->getFacebookDetails();
				//print_r($FbDetails);
				$fbconfig['appid' ]     = $FbDetails['appid'];
				$fbconfig['secret']     = $FbDetails['secret'];
				//echo Yii::app()->createAbsoluteUrl('fbresponse.php');exit;
				$fbconfig['baseurl']    = Yii::app()->createAbsoluteUrl('fbresponse.php');
                
				$user =   null;
				$facebook = new Facebook(array(
				  'appId'  => $fbconfig['appid'],
				  'secret' => $fbconfig['secret'],
				  'cookie' => true,
				));

				$loginUrl   = $facebook->getLoginUrl(
					array(
						'scope'         => 'user_about_me',
						//'redirect_uri' => $_SERVER['SCRIPT_URI'],
						'redirect_uri'  => $fbconfig['baseurl'],
					)
				);
				//echo "<pre>"; print_r($loginUrl);exit;
				header("Location: ".$loginUrl);exit;
				//$this->redirect($loginUrl);
			}else */ if($_GET['oauth_provider'] == 'twitter'){
			    
				$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
                //echo "<pre>";
                //print_r($twitteroauth);exit;
				$request_token = $twitteroauth->getRequestToken(YOUR_REDIRECTING_URL);
                //print_r($request_token);exit;
				$_SESSION['oauth_token'] = $request_token['oauth_token'];
				$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
				//echo $twitteroauth->http_code;exit;
                if ($twitteroauth->http_code == '200'){
					$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
					//echo $url;exit;
					$this->redirect($url);
				} else {
				    
				    Yii::app()->user->setFlash('failure_msg', "There was some problem with requesting the Twitter Site.Please Try Again");
					$this->redirect(array('/'));
				}
			}
		}
    
		if(!empty($this->data['user_id']) && !empty($this->data['group_id'])){
			$this->redirect(Yii::app()->createUrl('topics/TopicsList'));
		}else{
		  $this->redirect(Yii::app()->createUrl('site/register'));
		}
	} 
    //jaydeep
    public function actionNotificationemail(){
		$email_notification = EmailTemplates::model()->findByPk(3);
        if($email_notification->notification_flag == 1){
            $current_date = date("Y-m-d 00:00:00");
    		$all_post=AllPosts::model()->findAll(array('condition'=>'created_date > "'.$current_date.'"','group'=>'main_id'));
            $html = '<table style="width: 98%;" border="1">
                        <tr>
                            <td style="width: 15%;">TitleID</td>
                            <td style="width: 65%;">Title URL</td>
                            <td style="width: 20%;">New Post Total</td>
                        </tr>';
                    
    		foreach ($all_post as $allpost){
    				if($allpost->post_type == 1){
    					$topic = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));
                       $html .= '<tr>
                                <td style="width: 15%;">TopicID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('topics/Viewtopic',array('topic_id'=>$allpost->main_id)).'">'.$allpost->topic_table_relation->topic_title.'</a></td>
                                <td style="width: 20%;" align="center">'.count($topic).'</td>
                            </tr>';
    				
                    }elseif($allpost->post_type == 2){
    					$rulls = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));
                       $html .= '<tr>
                                <td style="width: 15%;">RuleID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('TypeTags/viewrule',array('tag_id'=>$allpost->main_id)).'">'.$allpost->rule_table_relation->type_tag.'</a></td>
                                <td style="width: 20%;" align="center">'.count($rulls).'</td>
                            </tr>';
    				
                    }elseif($allpost->post_type == 3){
    					$team = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));		
                       $html .= '<tr>
                                <td style="width: 15%;">TeamID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('team/viewteam',array('id'=>$allpost->main_id)).'">'.$allpost->team_table_relation->name.'</a></td>
                                <td style="width: 20%;" align="center">'.count($team).'</td>
                            </tr>';
                    }
            }
            $html .= '</table>';
            
            $user_model = Users::model()->findAll(array('condition'=>'status="Active"'));
            if(isset($user_model) && count($user_model) > 0){
                foreach($user_model as $user){
                    $to = $user->email;
        			$from = $this->data['settings']['DEFAULT']['EMAIL'];
        			$subject = $email_notification->subject;
                    $templatename = 'dynemic_template';
                    $content = str_replace("#NAME#",$user->username,$email_notification->description);
                    $content = str_replace("#POSTDETAILS#",$html,$content);
                    $this->data['content'] = $content;
                    $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
	                if ($email_flag) {
						Yii::app()->user->setFlash('success_msg','The instructions to reset your Password have been emailed to '.$to.'. This may take a minute.');  	
					} 
					else {
						Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
					}
                }
            }
        }					
		
    }
    /*
    public function actionNotificationemail(){
		$email_notification = EmailTemplates::model()->findByPk(3);
        if($email_notification->notification_flag == 1){
            $current_date = date("Y-m-d 00:00:00");
    		$all_post=AllPosts::model()->findAll(array('condition'=>'created_date > "'.$current_date.'"','group'=>'main_id'));
            $html = '<table style="width: 98%;" border="1">
                        <tr>
                            <td style="width: 15%;">TitleID</td>
                            <td style="width: 65%;">Title URL</td>
                            <td style="width: 20%;">New Post Total</td>
                        </tr>';
                    $dialogsArray = array();
                    $dialogsArray['dialogTopic'] = array();
    		foreach ($all_post as $allpost){
    				if($allpost->post_type == 1){
    					$topic = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));
                                        if(!array_key_exists($allpost->topic_table_relation->dialog_id, $dialogsArray['dialogTopic']))
                                        {
                                            $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id] = array();
                                            $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count'] = count($topic);
                                            $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['name'] = $allpost->topic_table_relation->dialog_id->dialog_title;
                                        }
                                        else
                                        {
                                            $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count'] = (int)$dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count']+count($topic);
                                        }
                       /*$html .= '<tr>
                                <td style="width: 15%;">TopicID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('topics/Viewtopic',array('topic_id'=>$allpost->main_id)).'">'.$allpost->topic_table_relation->topic_title.'</a></td>
                                <td style="width: 20%;" align="center">'.count($topic).'</td>
                            </tr>';
    				
                    }elseif($allpost->post_type == 2){
    					$rulls = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));
                       $html .= '<tr>
                                <td style="width: 15%;">RuleID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('TypeTags/viewrule',array('tag_id'=>$allpost->main_id)).'">'.$allpost->rule_table_relation->type_tag.'</a></td>
                                <td style="width: 20%;" align="center">'.count($rulls).'</td>
                            </tr>';
    				
                    }elseif($allpost->post_type == 3){
    					$team = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date > "'.$current_date.'"'));		
                       $html .= '<tr>
                                <td style="width: 15%;">TeamID='.$allpost->main_id.'</td>
                                <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('team/viewteam',array('id'=>$allpost->main_id)).'">'.$allpost->team_table_relation->name.'</a></td>
                                <td style="width: 20%;" align="center">'.count($team).'</td>
                            </tr>';
                    }
            }
            usort($dialogsArray['dialogTopic'], function($a, $b) {
                if ($a['count']==$b['count']) return 0;
                    return ($a['count']>$b['count'])?-1:1;
            });
            foreach($dialogsArray['dialogTopic'] as $key=>$val)
            {
                if($val['count']==0)
                    continue;
                $html .= '<tr>
                    <td style="width: 15%;">DialogID='.$key.'</td>
                    <td style="width: 65%;"><a style="color:#000000;" href="'.Yii::app()->createAbsoluteUrl('dialogs/DialogList').'">'.$val['name'].'</a></td>
                    <td style="width: 20%;" align="center">'.$val['count'].'</td>
                </tr>';
            }
            $html .= '</table>';
            
            $user_model = Users::model()->findAll(array('condition'=>'status="Active"'));
            if(isset($user_model) && count($user_model) > 0){
                foreach($user_model as $user){
                    $to = $user->email;
        			$from = $this->data['settings']['DEFAULT']['EMAIL'];
        			$subject = $email_notification->subject;
                    $templatename = 'dynemic_template';
                    $content = str_replace("#NAME#",$user->username,$email_notification->description);
                    $content = str_replace("#POSTDETAILS#",$html,$content);
                    $this->data['content'] = $content;
                    $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
	                if ($email_flag) {
						Yii::app()->user->setFlash('success_msg','The instructions to reset your Password have been emailed to '.$to.'. This may take a minute.');  	
					} 
					else {
						Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
					}
                }
            }
        }					
		
    }*/
    //jaydeep
    public function actionRegister(){
		$model = new Users;
                if(isset($_GET['userid']) && !empty($_GET['userid']))
                {
                    $model->special_id = $_GET['userid'];
                }
                
		if(isset($_POST["Users"])){
            $model->attributes = $_POST["Users"];
            $model->created_date = date("Y-m-d H:i:s");
            $model->token = uniqid();
 			$ip = $_SERVER['REMOTE_ADDR'];
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
			$ip_address_data = IpAddress::model()->findAll(array('condition'=>'ip_address="'.$ip.'"'));
			$ip_address_inactive = IpAddress::model()->findAll(array('condition'=>'ip_address="'.$ip.'" AND status="Inactive"'));
			
			//according to client request commented this code 2015-12-22 12-03 PM
                        $admin = Admin::model()->find();
                        if($admin && $admin->ip_address_check == 1){
                            if(count($ip_address_data) > 0){
                                    if(count($ip_address_inactive) > 0){
                                            Yii::app()->user->setFlash('failure_msg','Sorry ! your ip is blocked please contact to admin...');
                                            $this->redirect(Yii::app()->createUrl('Site/register'));
                                    }
                                    Yii::app()->user->setFlash('failure_msg','Sorry ! your ip Address allready registerd...');
                                    $this->redirect(Yii::app()->createUrl('Site/register')); 
                            }
                        }
			
			$model->ip_address = $ip;		
		    if($model->validate() && $model->IsUniqueUsername()){
				$model->save();                    	
				$ipaddress=new Ipaddress;
				$ipaddress->ip_address = $ip;
				$ipaddress->save();
	            /*Yii::app()->session['user_id'] = $model->id;
                Yii::app()->session['group_id'] = $model->group_id;
		        Yii::app()->session['user_name'] = $model->username;
                Yii::app()->session['email'] = $model->email;*/
                
                //==============START:SEND MAIL============================//
                $this->data['model'] = $model;
                
                $synemic_email = EmailTemplates::model()->findByPk(1);
                                    
                $to = $model->email;
    			$from = Yii::app()->params['adminEmail'];//$this->data['settings']['DEFAULT']['EMAIL'];
    			$subject = $synemic_email->subject;//$emailTemplateModel->subject;
                $templatename = 'dynemic_template';
                $link = Yii::app()->createAbsoluteUrl('site/Comformationlogin/',array('token'=>$model->token));
                
                $content = str_replace("#Name#",$model->username,$synemic_email->description);
                $content = str_replace("#Link#",$link,$content);
                $content = str_replace("#Email#",$model->email,$content);
                $content = str_replace("#Username#",$model->username,$content);
                $content = str_replace("#Password#",$model->password,$content);
                $this->data['content'] = $content;                            
                
                
                $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
				if ($email_flag) {
					Yii::app()->user->setFlash('success_msg','Thank you for registering! Please Verify email to login');  	
				} 
				else {
					Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
				}
                //==============END:SEND MAIL============================//
                
                
                //Yii::app()->user->setFlash('success_msg','Thank you for registering! Please Verify email to login');
                $this->redirect(Yii::app()->createUrl('Site/register'));        
			}
		}
        $this->data['UserModel'] = $model;            
		$this->render('view', $this->data);        
	}
    
    
    //==============START:FOR DIFFERENT METATITLE========================//
    private function getMetaData(){

        $this->data['meta_title'] = "Wedialog Register";
        $this->data['meta_description'] = "Wedialog Register";
        $this->data['meta_keyword'] = "Wedialog Register";
    }
    //==============END:FOR DIFFERENT METATITLE========================//
    
    public function actionLoginUser(){
        $admin = Admin::model()->find();
        if($admin) {
            if($admin->login_check == 0 && Yii::app()->getRequest()->getUrlReferrer()==null) {
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
            }
        }
        
        if(!empty($this->data['user_id']) && $this->data['user_id'] > 0){
            $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
        }else{    
        $userLoginFormModel = new UserLoginForm;
        if(isset($_POST["UserLoginForm"])){
            $userLoginFormModel -> attributes = $_POST['UserLoginForm'];
            if($userLoginFormModel->validate()){
                //print_r($_POST);exit;
                $email=$_POST['UserLoginForm']['email'];
                $password=$_POST['UserLoginForm']['password'];
                $remember = $_POST['UserLoginForm']['remember_me'];
                //echo $remember;exit; 
                $user_get_ip = Users::model()->findall(array('condition'=>'email="'.$email.'"'));
				foreach ($user_get_ip as $user_ip){
					$ip_address = $user_ip->ip_address;
				}
				$ip_add = IpAddress::model()->findall(array('condition'=>'ip_address="'.$ip_address.'" AND status="Inactive"'));
				if(count($ip_add) > 0){
					Yii::app()->user->setFlash('failure_msg', Yii::app()->params['ip_inactive']);
					$this->redirect(Yii::app()->createUrl('site/LoginUser'));
				}	
				$userloginmodel = Admin::model()->find(array('condition'=>'email="'.$email.'" AND login_password="'.addslashes($password).'"'));
                if(count($userloginmodel)>0){
                
                	Yii::app()->session['user_id'] = $userloginmodel->id;
					Yii::app()->session['user_name'] = $userloginmodel->login_username;
                    Yii::app()->session['group_id'] = $userloginmodel->group_id;
                    Yii::app()->session['email'] = $userloginmodel->email;
                    $this->redirect(Yii::app()->createUrl('admin/update?id='.Yii::app()->session['user_id']));
                
                }else{
                    $userloginmodel = Users::model()->find(array('condition'=>'email="'.$email.'" AND password="'.addslashes($password).'"'));
					
                    if(count($userloginmodel)>0){
                        $userloginmodel_status = Users::model()->find(array('condition'=>'email="'.$email.'" AND password="'.addslashes($password).'" AND status="Active"'));
                    //print_r($userloginmodel);exit;
                        if(count($userloginmodel_status)>0){
							$ip = $_SERVER['REMOTE_ADDR'];
							    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
							        $ip = $_SERVER['HTTP_CLIENT_IP'];
							    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
							    }
							$userloginmodel_status->ip_address = $ip;
							$userloginmodel_status->save();
							$ip_address_data = IpAddress::model()->findAll(array('condition'=>'ip_address="'.$ip.'"'));
							$ip_address_inactive = IpAddress::model()->findAll(array('condition'=>'ip_address="'.$ip.'" AND status="Inactive"'));
							if(count($ip_address_data) > 0){
								Yii::app()->session['ip_address'] = $ip;
								if(count($ip_address_inactive) > 0){
									Yii::app()->session['ip_address'] = $ip;
								}
							}else{
								$ipaddress=new Ipaddress;
								$ipaddress->ip_address = $ip;
								$ipaddress->save();
							}
									                        
                           //print_r($userloginmodel);exit;
                           Yii::app()->session['user_id'] = $userloginmodel->id;
                           Yii::app()->session['group_id'] = $userloginmodel->group_id;
                	       Yii::app()->session['user_name'] = $userloginmodel->username;
                           Yii::app()->session['email'] = $userloginmodel->email;
                           Yii::app()->session['password'] = $userloginmodel->password;
                           
                           /*===============START: SAVE USERID AND PASSWORD========================*/
                            if(isset($remember) && $remember==1){
                                $expire = time()+60*60*24*100;
                                setcookie("cookieemail",Yii::app()->session['email'],$expire);
                                setcookie("cookiepass",Yii::app()->session['password'],$expire);
                             }elseif($remember==0){
                                $expire = time()-60*60*24*100;
                                setcookie("cookieemail","",$expire);
                                setcookie("cookiepass","",$expire);
                             }
                            //print_r($_COOKIE['cookieemail']); exit;
                          /*===============END: SAVE USERID AND PASSWORD========================*/
                       
                          $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
                            
                        }else{
                            Yii::app()->user->setFlash('failure_msg', "Your Account Is Inactive.");
                            $this->redirect(Yii::app()->createUrl('site/LoginUser'));
                        }
                       }else{
                       Yii::app()->user->setFlash('failure_msg', "Incorrect login detail OR not verify email");
                       $this->redirect(Yii::app()->createUrl('site/LoginUser'));
                    }
                }
            }
        }
       $this->data['UserLoginModel'] = $userLoginFormModel;
       $this->render('login', $this->data);
       }
    } 
    
    public function actionInsertUser(){
        $model = new Users;
        if(isset($_POST["Users"])){
            
            
            
            $model->attributes = $_POST["Users"];
            $model->created_date = date("Y-m-d H:i:s");
            $model->token = uniqid();
 
            //echo "<pre>";
            //print_r($model->attributes);exit;
 
            
                if($model->validationOK()){
                    $model->save();
                    
                    Yii::app()->session['user_id'] = $model->id;
                    Yii::app()->session['group_id'] = $model->group_id;
      		    Yii::app()->session['user_name'] = $model->username;
                    Yii::app()->session['email'] = $model->email;
                    
                    //==============START:SEND MAIL============================//
                    //$sendMailModel = Users::model()->findByAttributes(array('email'=>$model->email)); 
                    $this->data['model'] = $model;
                    /*                    
                    $to = $model->email;
        			$from = "admin@siliconinfo.com";//$this->data['settings']['DEFAULT']['EMAIL'];
        			$subject = "Sigma Topic Verify Mail";//$emailTemplateModel->subject;
                    $templatename = 'registratio_form';
                    */
                    //$image = Yii::app()->createAbsoluteUrl('images/verify.png');
                    //$link = Yii::app()->createAbsoluteUrl('site/Comformationlogin/'.$model->token);
                    $link = Yii::app()->createAbsoluteUrl('site/Comformationlogin/',array('token'=>$model->token));
                    //$link = Yii::app()->createAbsoluteUrl('/resetpassword/'.$sendMailModel->token);
                   // echo $link;exit; 
                    $this->data['confirm_link'] = $link;
                    
                    $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
					if ($email_flag) {
						Yii::app()->user->setFlash('success_msg','Thank you for registering! Please login');  	
					} 
					else {
						Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
					}
                    //==============END:SEND MAIL============================//
                    
                    
                    $this->redirect(Yii::app()->createUrl('site/EditUser'));        
                 
               }
            
        }
    }
	
    public function actionEditUser(){
        //echo "<pre>";print_r($_POST);exit;
        $id = Yii::app()->session['user_id'];
        $model= Users::model()->findByPk($id);
        $category_groups_old_id=$model->category_groups_id;
        $logo = $model->profile_image;
        
        //Start for select tag options//
        $Aiia_model = Aiia::model()->findAll(array("condition"=>"status='Active'"));
        $TypeTags_model = TypeTags::model()->findAll(array("condition"=>"status='Active' AND order_no>0"));
        $CategoryGroups_model = CategoryGroups::model()->findAll(array("condition"=>"status='Active'","order"=>"category"));
        $groupcategories = CategoryGroups::model()->findAll(array("select"=>"category","condition"=>"status='Active'","group"=>"category","order"=>"category"));
        //End for select tag options//
        
        if(isset($_POST["Users"])){
        //echo "<pre>";
        //print_r($_POST);exit;
            
           $aiia_discriptor = implode(",",$_POST['Users']['aiia_discriptor']);
           $favorite_rule   = implode(",",$_POST['Users']['favorite_rule']);
           if(isset($_POST['favorite_value']) && $_POST['favorite_value'] !=''){
            $favorite_rule   = $_POST['favorite_value']; 
           }
           if(isset($_POST['aiia_discriptor_value']) && $_POST['aiia_discriptor_value'] !=''){
            $aiia_discriptor   = $_POST['aiia_discriptor_value']; 
           }
           
           
           //for ger groups id comes from rendamaly//
            $temp_array=array();
            foreach($_POST['Users']["category"] as $category_groups){
                foreach($category_groups as $category_groups_1){
                    $temp_array_groups_id[]=$category_groups_1;
                }
            }
            $temp_array_groups_id = implode(",",$temp_array_groups_id);
            
            $str_cat_hide_ids = "";
            if(isset($_POST['category_hide'])){
                foreach($_POST['category_hide'] as $key=>$hidecategoryarray){
                    $cat_arr = $_POST['Users']["category"][$key];
                    foreach($cat_arr as $cat){
                        if($str_cat_hide_ids == ""){
                            $str_cat_hide_ids .= $cat;
                        }else{
                            $str_cat_hide_ids .= ','.$cat;
                        }
                    }
                }    
            }
            //for ger groups id comes from rendamaly//
           $model->aiia_discriptor=$aiia_discriptor;
           $model->favorite_rule=$favorite_rule;
           $model->category_groups_id=$temp_array_groups_id;
           $model->category_groups_id_hide=$str_cat_hide_ids;
           
           $model->attributes = $_POST["Users"];
           
           if($model->profile_image == ""){
                $model->profile_image = $logo;
           }
           $this->getEventImage($model);           
           $model->user_description = $_POST["Users"]["user_description"];
           if($model->save());
           Yii::app()->session['group_id'] = $model->group_id;
    	   Yii::app()->session['user_name'] = $model->username;
           Yii::app()->session['email'] = $model->email;
           
           //Start for add total in the Group table of selected groups//
           $category_groups_old_id = explode(",",$category_groups_old_id);
           $temp_array_groups_id   = explode(",",$temp_array_groups_id);
           $result = array_diff($category_groups_old_id, $temp_array_groups_id);//not in resent record means deleted groups 
           
           if(!empty($result) && $result[0]!=""){
                $result_str_ids = implode(",",$result);
                $group_model_for_decrease_total=CategoryGroups::model()->findAll(array('condition'=>"id IN(".$result_str_ids.")"));
                foreach($group_model_for_decrease_total as $group_model_for_decrease_total){
                    $update_total_model=CategoryGroups::model()->findByPk($group_model_for_decrease_total->id);
                    $update_total_model->total=($update_total_model->total)-1;
                    $update_total_model->save(false);
                }
           }
           $result = array_diff($temp_array_groups_id,$category_groups_old_id);//new records means new selected groups
           if(!empty($result) && $result[0]!=""){
                $result_str_ids = implode(",",$result);
                $group_model_for_increase_total=CategoryGroups::model()->findAll(array('condition'=>"id IN(".$result_str_ids.")"));
                foreach($group_model_for_increase_total as $group_model_for_increase_total){
                    $update_total_model=CategoryGroups::model()->findByPk($group_model_for_increase_total->id);
                    $update_total_model->total=($update_total_model->total)+1;
                    $update_total_model->save(false);
                }
           }
           //$count_group_model=User::model()->count(array('condition'=>"id IN(".$temp_array_groups_id.")"));
           //End for add total in the Group table of selected groups// 
           
           //$this->redirect(Yii::app()->createUrl('site/UserProfile'));  
           $this->redirect(Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$model->id)));
        }
        $this->data['UserEditModel'] = $model;
        $this->data['Aiia_model'] = $Aiia_model;
        $this->data['TypeTags_model'] = $TypeTags_model;
        $this->data['CategoryGroups_model'] = $CategoryGroups_model;
        $this->data['groupcategories'] = $groupcategories;
        $this->render('/site/editprofile', $this->data);
        
    }
    
    private function getEventImage(&$model){
        $file_logo = CUploadedFile::getInstance($model,'profile_image');
        if(is_object($file_logo) && get_class($file_logo)==='CUploadedFile'){ 
			$random = time();
            if(file_exists(Yii::app()->params['profile_img'].$model->profile_image)){
           	    if(Yii::app()->baseUrl."/".Yii::app()->params['profile_img'].$model->profile_image){
           	        unlink(Yii::app()->params['profile_img'].$model->profile_image);   
            	}
        	}
             
        	$model->profile_image = $random."_".$file_logo->name;
            
            $profile_img = Yii::app()->params['profile_img'].$model->profile_image;
            $file_logo->saveAs($profile_img);
            /*
        	$thumb = resize_to_canvas($profile_image, "250", "200");
        	imagejpeg($thumb,$this->data['event_thumb_img'].$model->profile_image,100);
            */
        }
    }        
    
    public function actionUserProfile()
    {
        $ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
		if(count($ip_status) > 0 ){
			Yii::app()->user->setFlash('failure_msg', Yii::app()->params['ip_inactive']);
			$this->redirect(Yii::app()->createUrl('Topics/TopicsList'));
		}   
        $id = Yii::app()->session['user_id'];
        $UserProfileModel= Users::model()->findByPk($id);
        
        $this->data['UserProfileModel'] = $UserProfileModel;
        
        $counttopicmodel = Topics::model()->count(array('condition'=>'user_id='.Yii::app()->session['user_id']));
        $this->data['counttopic'] = $counttopicmodel;
        $countcommentmodel = UserComment::model()->count(array('condition'=>'user_id='.Yii::app()->session['user_id']));
        $this->data['countcomments'] = $countcommentmodel;
        
        // Start : for as an individual i am and  favorite rules and groups and tesms// 
        if($UserProfileModel->aiia_discriptor!=""){
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN('.$UserProfileModel->aiia_discriptor.')'));
        }else{
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN(0)'));//here 0 means user aiia_discriptor fiel is blank.
        }
        //order by field("fieldname","1","1","1","1","1","1");''
        if($UserProfileModel->favorite_rule!=""){
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN ('.$UserProfileModel->favorite_rule.')','order'=>'FIELD (id, '.$UserProfileModel->favorite_rule.')'));
        }else{
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN (0)'));//here 0 means user favorite_rule fiel is blank.
        }
        if($UserProfileModel->category_groups_id_hide!=""){
                $hide_category=$UserProfileModel->category_groups_id_hide;
        }else{
                $hide_category="0";
        }
        
        if($UserProfileModel->category_groups_id!=""){
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN('.$UserProfileModel->category_groups_id.') AND id NOT IN ('.$hide_category.')'));
        }else{
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN(0) AND id NOT IN ('.$hide_category.')'));
        }
        //$TopicQuestionAnswer_model=TopicQuestionAnswer::model()->findAll(array('condition'=>'user_id ='.$id));
        //$team_model=Team::model()->findAll(array("condition"=>"user_id=".$id));
        $team_model=Team::model()->findAll(array("condition"=>"id IN(select team_id from team_member where user_id=".$id.")"));
        
        $this->data["aiia_model"] = $aiia_model;
        $this->data["TypeTags_favorite_rule_model"] = $TypeTags_favorite_rule_model;
        $this->data["CategoryGroups_model"] = $CategoryGroups_model;
        $this->data["team_model"] = $team_model;
        //$this->data["TopicQuestionAnswer_model"] = $TopicQuestionAnswer_model;
        // End : for as an individual i am and  favorite rules and groups and tesms//
        $this->render('/site/profile', $this->data);        
	}
    
    
    
    public function actionViewPeopleAbout($people_id)
    {
        $id = $people_id;
        $UserProfileModel= Users::model()->findByPk($id);
        //print_r($UserProfileModel);exit;
        $this->data['UserProfileModel'] = $UserProfileModel;
        $this->render('/site/profile', $this->data);
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
            $error = Yii::app()->errorHandler->error;
	    if($error)
	    {
	    	if(Yii::app()->request->isAjaxRequest){
	    		echo $error['message'];
                }
	    	else {
                    $this->render('error', array('error'=>$error));
                }
	    }
	}
  
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        if (isset($_COOKIE['cookieemail'])) {
            unset($_COOKIE['cookieemail']);
            unset($_COOKIE['cookiepass']);
            setcookie('cookieemail', null, -1, '/');
            setcookie('cookiepass', null, -1, '/');
        }
        /*if($_COOKIE['cookieemail'] && $_COOKIE['cookiepass']){        
            $expire = time()-60*60*24*100;
            setcookie("cookieemail","",$expire);
            setcookie("cookiepass","",$expire);
        }*/
        $this->redirect(Yii::app()->createUrl('site/LoginUser'));        
	}
    
	public function actionFblogin(){
        $response_arr = array(); 
        $facebook = new Facebook(array(
                        'appId'  =>  Yii::app()->params['facebookApiKey'],                    //app id
                        'secret' => Yii::app()->params['facebookAppSecret'],    // app secret
                    ));
        $user_fb_id = $facebook->getUser();
        if(isset($user_fb_id) && $user_fb_id > 0){
            $user_fb_token = $facebook->getAccessToken();
            $logoutUrl = $facebook->getLogoutUrl();
            try {
                //$user_profile = $facebook->api('/me', array('fields' => 'id,name,email,link'));
                $user_profile = $facebook->api('/'.$user_fb_id, array('fields' => 'id,name,email,link'));
                //$FacebookId=$user_profile['id'];
                //$username= $user_profile['name'];  
               //print_r($user_profile);  exit;
                if(!empty($user_profile["id"]) && $user_profile["id"] != 0){
                    $FacebookId = $user_profile["id"];
                    $model = Users::model()->find(array('condition'=>'facebook_id='.$FacebookId));
                    if($model){
                            Yii::app()->session['user_id'] = $model->id;
                            Yii::app()->session['group_id'] = $model->group_id;
                            Yii::app()->session['user_name'] = $model->username;
                            Yii::app()->session['email'] = $model->email;
                    }else{
                        $isertmodel = new Users;
                        $isertmodel->facebook_id = $user_profile["id"];
                        //$isertmodel->username = $user_profile["first_name"].' '.$user_profile["last_name"];
                        $isertmodel->username = $user_profile["name"];
                        $isertmodel->group_id = 2;
                        $isertmodel->email = $user_profile["email"];
                        $isertmodel->facebook_link = $user_profile["link"];
                        $isertmodel->status = 'Active';
                        $isertmodel->password = uniqid();
                        $isertmodel->save(false);
                            Yii::app()->session['user_id'] = $isertmodel->id;
                            Yii::app()->session['group_id'] = $isertmodel->group_id;
                            Yii::app()->session['user_name'] = $isertmodel->username;
                            Yii::app()->session['email'] = $isertmodel->email;
                    }
                    
                    $this->redirect(Yii::app()->createUrl('topics/TopicsList'));
                    
                }else{
                    $this->redirect(Yii::app()->createUrl('site/index?oauth_provider=facebook'));
                }                                                                                                                                                                         

            }catch(Exception $e){
               Yii::app()->user->setFlash('failure_msg', ucfirst(Yii::t('translation', "Oops!!! There was some problem while executing your request. Try again later")));
                $this->redirect(Yii::app()->createUrl('site/index')); 
            }
        }else{
            Yii::app()->user->setFlash('failure_msg', ucfirst(Yii::t('translation', "Oops!!! There was some problem while executing your request. Try again later")));
            $this->redirect(Yii::app()->createUrl('site/index')); 
        }
    }
        /*
		//print_r($_POST);exit;
		$user_profile["id"] = $_POST['id'];
		$user_profile["first_name"] = $_POST['first_name'];
		$user_profile["last_name"] = $_POST['last_name'];
		$user_profile["link"] = $_POST['link'];
		$user_profile["email"] = $_POST['email'];
        
		if(!empty($user_profile["id"]) && $user_profile["id"] != 0){
			$FacebookId = $user_profile["id"];
			    $model = Users::model()->find(array('condition'=>'facebook_id='.$FacebookId));
                if($model){
                        Yii::app()->session['user_id'] = $model->id;
                        Yii::app()->session['group_id'] = $model->group_id;
                        Yii::app()->session['user_name'] = $model->username;
                        Yii::app()->session['email'] = $model->email;
				}else{
                    $isertmodel = new Users;
                    $isertmodel->facebook_id = $user_profile["id"];
                    $isertmodel->username = $user_profile["first_name"].' '.$user_profile["last_name"];
                    $isertmodel->group_id = 2;
                    $isertmodel->email = $user_profile["email"];
                    $isertmodel->facebook_link = $user_profile["link"];
                    $isertmodel->status = 'Active';
                    $isertmodel->password = uniqid();
                    $isertmodel->save();
                        Yii::app()->session['user_id'] = $isertmodel->id;
                        Yii::app()->session['group_id'] = $isertmodel->group_id;
                        Yii::app()->session['user_name'] = $isertmodel->username;
                        Yii::app()->session['email'] = $isertmodel->email;
				}
				
                $this->redirect(Yii::app()->createUrl('topics/TopicsList'));
				
		}else{
			$this->redirect(Yii::app()->createUrl('site/index?oauth_provider=facebook'));
		}
        */

    
    
    public function actionLogintwitter(){
		$oauth_verifier = $_GET["oauth_verifier"];
		$oauth_token = $_GET["oauth_token"];
		$oauth_secret = $_SESSION['oauth_token_secret'];
        
		if(!empty($oauth_verifier) && !empty($oauth_token) && !empty($oauth_secret)){
		  	$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $oauth_token, $oauth_secret);
			$access_token = $twitteroauth->getAccessToken($oauth_verifier);
			$user_info = $twitteroauth->get('account/verify_credentials');
            
            if(isset($user_info->error)){
				$this->redirect(Yii::app()->createUrl('site/index?oauth_provider=twitter'));
			}else{
				$TwitterId = $user_info->id;
                    $model = Users::model()->find(array('condition'=>'twitter_id='.$TwitterId));
					if($model){
					    Yii::app()->session['user_id'] = $model->id;
                        Yii::app()->session['group_id'] = $model->group_id;
                        Yii::app()->session['user_name'] = $model->username;
                        Yii::app()->session['email'] = $model->email;
                        Yii::app()->session['twitter_image'] = $user_info->profile_image_url;
					}else{
					   
						$isertmodel = new Users;
                        $isertmodel->twitter_id = $TwitterId;
                        $isertmodel->username = $user_info->name;
                        $isertmodel->group_id = 2;
                        $isertmodel->email = time().'@twitter.com';
                        $isertmodel->status = 'Active';
                        $isertmodel->password = uniqid();
                        $isertmodel->save();
                        
                        Yii::app()->session['user_id'] = $isertmodel->id;
                        Yii::app()->session['group_id'] = $isertmodel->group_id;
                        Yii::app()->session['user_name'] = $isertmodel->username;
                        Yii::app()->session['email'] = $isertmodel->email;
                        Yii::app()->session['twitter_image'] = $user_info->profile_image_url;
                        
					}
					$this->redirect(Yii::app()->createUrl('topics/TopicsList'));
					
			}
		}else{
			$this->redirect(Yii::app()->createUrl('site/index?oauth_provider=twitter'));
		}
        
    }
    
    public function actionSendRegisterMail()
	{	
	    
        // Get an instance of the ForgotPasswordForm. 
		$model = new Users;
		// Get user's Email Address.
		if ( isset($_POST['ForgotPasswordForm']) )
		{	
			$model->attributes = $_POST['ForgotPasswordForm'];
	        // Check whether email is correct or not.
			if ( $model->validate())
			{	
				// Check if a user having this email exists or not.
				if ( $model->isEmailExists())
				{
					$userLoginModel = Users::model()->findByAttributes(array('email'=>$model->email)); 
                    $this->data['userLoginModel'] = $userLoginModel;
                                        
                    $emailTemplateModel = EmailTemplates::model()->findByAttributes(array('slug'=>"forgot-password"));    			
                              
                    $to = $userLoginModel->email;
        			$from = $this->data['settings']['DEFAULT']['EMAIL'];
        			$subject = $emailTemplateModel->subject;
                    $templatename = 'registration form';
                    $image = Yii::app()->createAbsoluteUrl('images/verify.png');
                    $link = Yii::app()->createAbsoluteUrl('/resetpassword/'.$userLoginModel->token);
                    
                    $content = str_replace("##Email Verify Link##",$link,$emailTemplateModel->description);
                    $content = str_replace("##Image##",$image,$content);
                    $content = str_replace("##Email Verify##",$link,$content);
                    $this->data['content'] = $content;
                    
                    $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
					
	                if ($email_flag) {
						Yii::app()->user->setFlash('success_msg','The instructions to reset your Password have been emailed to '.$to.'. This may take a minute.');  	
					} 
					else {
						Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
					}
 				}
				else
				{
					Yii::app()->user->setFlash('failure_msg',"Sorry ! No user was found for ".$model->email.".");  
				}
				
				$this->refresh();
			}
		}	
		
	
        $this->createCustomBreadcumbs('User Login',Yii::app()->createUrl('customerlogin'),array(),'http');
	    $this->createCustomBreadcumbs('Forget Password','',array(),'http');
		// Display Forgot password form ( It is having only one input field, which gets Email Address. ).
        $this->data['model'] = $model;
		$this->render('forgot_password',$this->data);
	}
    
	public function actionPeopleList(){
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
            
            $dialogHasQuestions = false;
            if(!empty($dialogID)){
                $topicQuestionCount = TopicQuestions::model()->count(array('condition'=>'dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
                if($topicQuestionCount>0){
                    $dialogHasQuestions =true;
                }
            }
		
        $this->layout = "registration";
	    /*if(empty($this->data['user_id'])){
	       $this->redirect(Yii::app()->createUrl(''));
	    }else{*/
	       
    		$record_to_fetch = $this->record_to_fetch;
    		$page = 0;
    	
    		//=== START: FETCH ALL PEOPLE ======================//
    		//$WHERE = "status='Active' AND users.id!=".Yii::app()->session['user_id'];
                $WHERE = "status='Active' ";
    		$allpeople_order = " ORDER BY users.id DESC LIMIT ".$page.",".$record_to_fetch;
    		$TestSql = "SELECT users.*,
    					(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                        (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
    					(SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
    					FROM users WHERE ".$WHERE.$allpeople_order;
                $UserModel = Users::model()->findAllBySql($TestSql);
    		$this->data['PeopleListModel']  = $UserModel;
    		//=== END: FETCH ALL PEOPLE ======================//
                
                //=== START: FETCH AGREE PEOPLE ======================//
    		//$WHEREOLDESTPEOPLE = "status = 'Active' AND users.id !=".Yii::app()->session['user_id'];
                if($dialogHasQuestions){
                    $WHEREAGREEPEOPLE = "status = 'Active'";
                    $agreepeople_order = " ORDER BY Peoplescore DESC LIMIT ".$page.",".$record_to_fetch;
                    $TestSqlAGREEPEOPLE = "SELECT users.*,
                                                                    (SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                                                    (SELECT score FROM people_score WHERE dialog_id = ".$dialogID." AND people_score.user_id=users.id) AS Peoplescore,
                                                                    (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
                                                                    (SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
                                                                    FROM users WHERE ".$WHEREAGREEPEOPLE.$agreepeople_order;
                    $TopicListByagreepeopleModel = Users::model()->findAllBySql($TestSqlAGREEPEOPLE);
                    $this->data['TopicListByagreepeople'] = $TopicListByagreepeopleModel;
                }
                else{
                    $this->data['TopicListByagreepeople'] = array();
                }
                
                $this->data['dialogHasQuestions'] = $dialogHasQuestions;
    		//=== END: FETCH AGREE PEOPLE ======================//
    
    		//=== START: FETCH TOP PEOPLE ======================//
    		//$WHERETOPPEOPLE = "status='Active' AND users.id!=".Yii::app()->session['user_id'];
            $WHERETOPPEOPLE = "status='Active'";
    		$toppeople_order = " ORDER BY Totalpostscount DESC LIMIT ".$page.",".$record_to_fetch;
    		/*$TestSqlTOPPEOPLE = "SELECT users.*,
    							(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                                        (SELECT COUNT(all_posts.id) FROM all_posts WHERE all_posts.user_id = users.id AND all_posts.status=1) AS TotalPostsCount,
                                                        (SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
    							FROM users WHERE ".$WHERETOPPEOPLE.$toppeople_order;*/
                $TestSqlTOPPEOPLE = "SELECT users.*,
    							(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                                        (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
                                                        (SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
    							FROM users WHERE ".$WHERETOPPEOPLE.$toppeople_order;
    		$TopicListBytoppeopleModel = Users::model()->findAllBySql($TestSqlTOPPEOPLE);
                $this->data['TopicListBytoppeople'] = $TopicListBytoppeopleModel;
                
            //=== END: FETCH TOP PEOPLE ======================//
    	
    		//=== START: FETCH OLD PEOPLE ======================//
    		//$WHEREOLDESTPEOPLE = "status = 'Active' AND users.id !=".Yii::app()->session['user_id'];
            $WHEREOLDESTPEOPLE = "status = 'Active'";
    		$oldpeople_order = " ORDER BY id ASC LIMIT ".$page.",".$record_to_fetch;
    		$TestSqlOLDESTPEOPLE = "SELECT users.*,
    								(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                                                (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
    								(SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
    								FROM users WHERE ".$WHEREOLDESTPEOPLE.$oldpeople_order;
    		$TopicListByoldestpeopleModel = Users::model()->findAllBySql($TestSqlOLDESTPEOPLE);
    		$this->data['TopicListByoldestpeople'] = $TopicListByoldestpeopleModel;
    		//=== END: FETCH OLD PEOPLE ======================//
    	
    		//=== START: FETCH NEW PEOPLE ======================//
    		//$WHERENEWESTPEOPLE = "status = 'Active' AND users.id !=".Yii::app()->session['user_id'];
            $WHERENEWESTPEOPLE = "status = 'Active' ";
    		$newpeople_order = " ORDER BY id DESC LIMIT ".$page.",".$record_to_fetch;
    		$TestSqlNEWESTPEOPLE = "SELECT users.*,
    								(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                                                (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
    								(SELECT COUNT(user_comment.id) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount
    								FROM users WHERE ".$WHERENEWESTPEOPLE.$newpeople_order;
    		$TopicListBynewestpeopleModel = Users::model()->findAllBySql($TestSqlNEWESTPEOPLE);
    		$this->data['TopicListBynewestpeople'] = $TopicListBynewestpeopleModel;
    		//=== END: FETCH NEW PEOPLE ======================//
    		//=== START: FETCH GREEN Flag ======================//
			$WHEREGREENFLAGPEOPLE = "status = 'Active' ";
			$greenflagpeople_order = " ORDER BY Totalcount DESC LIMIT ".$page.",".$record_to_fetch;
			$TestSqlGREENFLAGPEOPLE="select *,(select count(flag_type) from all_posts_flags where flag_type='Green' AND user_id=users.id) as Totalcount, (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount from users where ".$WHEREGREENFLAGPEOPLE.$greenflagpeople_order;
			$TopicListBygreenflagpeople=Users::model()->findAllBySql($TestSqlGREENFLAGPEOPLE);
			//echo "<pre>";print_r($TopicListBygreenflagpeople);exit;
    		$this->data['TopicListBygreenflagpeople'] = $TopicListBygreenflagpeople;
			//=== END: FETCH GREEN Flag ======================//
			//=== START: FETCH RED Flag ======================//
			$WHEREREDFLAGPEOPLE = "status = 'Active' ";
			$redflagpeople_order = " ORDER BY Totalcount DESC LIMIT ".$page.",".$record_to_fetch;
			$TestSqlREDFLAGPEOPLE="select *,(select count(flag_type) from all_posts_flags where flag_type='Red' AND user_id=users.id) as Totalcount, (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount from users where ".$WHEREREDFLAGPEOPLE.$redflagpeople_order;
			$TopicListByredflagpeople=Users::model()->findAllBySql($TestSqlREDFLAGPEOPLE);
    		$this->data['TopicListByredflagpeople'] = $TopicListByredflagpeople;
			//=== END: FETCH RED Flag ======================//
			
    		$this->render('/site/people_list',$this->data);
        //}
	}
    
    public function actionGetpeoplelistdata1(){
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
        
        $record_cnt = 0;
        
    	if(!empty($_POST)){
            $last_id = 0;
            //=== START: SET WHERE CLAUSE ======================//
            $WHERE = "";
            $WHEREgreenredflag="";
            if(!empty($_POST['last_id']) && is_numeric($_POST['last_id'])){
            	$WHERE = " status = 'Active' AND users.id !=".Yii::app()->session['user_id'];
            	if($_POST['currect_section'] == "allpeople" || $_POST['currect_section'] == "newestpeople"){
            		$WHERE.= " AND id < ".$_POST['last_id'];
                }else if($_POST['currect_section'] == "oledestpeople"){
            		$WHERE.= " AND id > ".$_POST['last_id'];
            	}else if($_POST['currect_section'] == "agreepeople"){
            		$WHERE = "status = 'Active'";
            	}else if($_POST['currect_section'] == "greenflagpeople"){
            		$WHEREgreenredflag.= " AND Totalcount > ".$_POST['last_count'];
                }else if($_POST['currect_section'] == "redflagpeople"){
                    $WHEREgreenredflag.= " AND Totalcount > ".$_POST['last_count'];
                }
            }
            //=== END: SET WHERE CLAUSE ========================//

            //=== START: SET ORDER CLAUSE ======================//
            $start_from = 0;
            $record_to_fetch = $this->record_to_fetch;
            $order_by_term = "id DESC";
            if($_POST['currect_section'] == "toppeople"){
            	$order_by_term = "Totalpostscount DESC";
            	$start_from = $_POST['next_page']*$record_to_fetch;
            }else if($_POST['currect_section'] == "agreepeople"){
            	$order_by_term = "Peoplescore DESC";
                $start_from = $_POST['next_page']*$record_to_fetch;
            }else if($_POST['currect_section'] == "oledestpeople"){
            	$order_by_term = "id ASC";
                $start_from = $_POST['next_page']*$record_to_fetch;
            }
            $order_by = " ORDER BY ".$order_by_term." LIMIT ".$start_from.",".$record_to_fetch;
            //=== END: SET ORDER CLAUSE ========================//

            $data_str = "";
            if($WHERE != ""){
                $TestSql = "SELECT users.*, 
                			(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                        (SELECT score FROM people_score WHERE dialog_id = ".$dialogID." AND people_score.user_id=users.id) AS Peoplescore,
                                        (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
                			(SELECT COUNT(*) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount 
                			FROM users WHERE ".$WHERE.$order_by;
				
                                if($_POST['currect_section'] == "agreepeople"){
					"SELECT users.*, 
                			(SELECT COUNT(topics.id) FROM topics WHERE topics.user_id = users.id) AS Totalcount,
                                        (SELECT score FROM people_score WHERE dialog_id = ".$dialogID." AND people_score.user_id=users.id) AS Peoplescore,
                                        (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount,
                			(SELECT COUNT(*) FROM user_comment WHERE user_comment.user_id = users.id) AS Totalcommentscount 
                			FROM users WHERE ".$WHERE.$order_by;
				}
                                
				if($_POST['currect_section'] == "greenflagpeople"){
					$WHEREGREENFLAGPEOPLE = "status = 'Active' ".$WHEREgreenredflag." ";
					$greenflagpeople_order = " ORDER BY Totalcount DESC LIMIT ".$start_from.",".$record_to_fetch;
					$TestSql="select *,(select count(flag_type) from all_posts_flags where flag_type='Green' AND user_id=users.id) as Totalcount, (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount from users where ".$WHEREGREENFLAGPEOPLE.$greenflagpeople_order;
				}
				
				if($_POST['currect_section'] == "redflagpeople"){
					$WHEREREDFLAGPEOPLE = "status = 'Active' ".$WHEREgreenredflag." ";
					$redflagpeople_order = " ORDER BY Totalcount DESC LIMIT ".$start_from.",".$record_to_fetch;
					$TestSql="select *,(select count(flag_type) from all_posts_flags where flag_type='Red' AND user_id=users.id), (SELECT COUNT(all_posts.id) FROM all_posts INNER JOIN topics ON all_posts.main_id=topics.id WHERE all_posts.user_id = users.id AND all_posts.status=1 AND topics.dialog_id='".$dialogID."') AS Totalpostscount as Totalcount from users where ".$WHEREREDFLAGPEOPLE.$redflagpeople_order;
				}
				
                $PeopleListModel = Users::model()->findAllBySql($TestSql);
                $record_cnt = count($PeopleListModel);

				if($record_cnt > 0){
					foreach($PeopleListModel as $PeopleList){
					    $last_id = $PeopleList->id;

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
                        else{
                            $user_description = $PeopleList->user_description;
                        }
                        $count=$PeopleList->Totalcount;
                        
                        $data_str.='<tr id='.$PeopleList->id.' class="tr_people_data">
                                        <td style="width:100%">
                                            <table style="width: 100%;">
                                                <tr>                    
                                                    <td style="width:85px; vertical-align: top;">
                                                       <a href='.Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id)).'>
                                                            <img  src='.$Src.' width="50" height="50" style="background-color:#bde3e7;"/>
                                                       </a>
                                                    </td>
                                                    <td style="width:12px;">&nbsp;</td>
                                                    <td style="width:100%; vertical-align: top;">
                                                        <table width="100%" style="vertical-align: top;padding: 0px;" cellspacing="0" cellpadding="0" border="0">
                                                            <tr style="vertical-align: top;">
                                                                <td style=" float:left;font-size:18px;font-weight: bold;"><a href='.Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id)).' style="text-decoration: none;color: #065A95 !important;font-size: 17.5px; font-weight:normal">'.$PeopleList->username.'</a></td>    
                                                            </tr>
                                                            <tr>
                                                                <td height="20" style="word-wrap: normal;color: #666666;font-size: 14px;text-align: justify;">'.$user_description.'</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <table width="25%" >
                                                                        <tr>
                                                                            <td style="font-size: 13px;color: #999999;">Posts('.$PeopleList->Totalpostscount.')</td>
                                                                            <!//--<td style="font-size: 13px;color: #999999;">Topics('.$count.')</td>-->
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                                            
                                                        </table>                    
                                                    </td>
                                               </tr> 
            						            <tr>
                                    				<td height="5" colspan="3">&nbsp;</td>
                                   				 </tr>
                                        </table>
                                    </td>                    
                                </tr> ';
                                
                                
       
					}
				}
    		}
    	}
    	echo $record_cnt."======".$last_id."======".$data_str;
    }  
    
     public function actionComformationlogin(){
        $token = $_GET['token'];
        $user_tokenlogin = Users::model()->find(array('condition'=>'token="'.$token.'" '));
        if(count($user_tokenlogin)>0){
            $user_tokenlogin->status = 'Active';
            $new_token=uniqid();
            $user_tokenlogin->token = $new_token;
            if($user_tokenlogin->save()){
                Yii::app()->session['user_id'] = $user_tokenlogin->id;
                Yii::app()->session['group_id'] = $user_tokenlogin->group_id;
				Yii::app()->session['user_name'] = $user_tokenlogin->username;
                Yii::app()->session['email'] = $user_tokenlogin->email;
                $this->redirect(Yii::app()->createUrl('topics/TopicsList')); 
                
            }        
            
        }else{
            Yii::app()->user->setFlash('failure_msg','Sorry ! Already use this link.');  
			$this->redirect(Yii::app()->createUrl('dialogs/DialogList'));
        }
        
        
     }
     
     public function actionForgotpassword(){
        $useremail_exist = new Users;
        if(isset($_POST["Users"])){
            $useremail_exist = Users::model()->find(array('condition'=>'email="'.$_POST["Users"]['email'].'"'));
            if(count($useremail_exist)>0){
                //==============START:SEND MAIL============================//
                $this->data['useremail_exist'] = $useremail_exist;
    			$dynemic_email = EmailTemplates::model()->findByPk(2);

    			$templatename = 'dynemic_template';
				$from = Yii::app()->params['adminEmail'];//$this->data['settings']['DEFAULT']['EMAIL'];
    			$subject = $dynemic_email->subject;//$emailTemplateModel->subject;
    			$to = $useremail_exist->email;
                $content = str_replace("#Name#",$useremail_exist->username,$dynemic_email->description);
                $content = str_replace("#Email#",$useremail_exist->email,$content);
                $content = str_replace("#Username#",$useremail_exist->username,$content);
                $content = str_replace("#Password#",$useremail_exist->password,$content);
                $this->data['content'] = $content;                            
                $email_flag = $this->sendCustomEmail($templatename,$subject,$to,$from);
				//echo $email_flag;exit;
				if ($email_flag) {
					Yii::app()->user->setFlash('success_msg',' Your login detais mail has been send your email acount, please check email');  	
				} 
				else {
					Yii::app()->user->setFlash('failure_msg','Sorry ! Failed to send you a mail. Please submit again.');  
				}
                //==============END:SEND MAIL============================//
                $this->redirect(Yii::app()->createUrl('site/loginUser')); 
                 
            }else{
                Yii::app()->user->setFlash('failure_msg', "This email not registered. Then please register");
                $this->redirect(Yii::app()->createUrl('site/loginUser'));
                
            }
        } 
        $this->data['UserForgotPasswordModel'] = $useremail_exist;
        $this->render('/site/forgotpassword', $this->data);
    }
    
    public function actionEditcms($id=''){
        $this->layout = 'registration';
        $model=Cms::model()->findByPk($id);
        
        if(isset($_POST['Cms'])){
            $model->attributes = $_POST['Cms'];
            $model->updated = date('Y-m-d H:i:s');
			if($model->save()){
				Yii::app()->user->setFlash('success_msg', 'CMS Updated successfully...');
			}else{
				Yii::app()->user->setFlash('failure_msg', Yii::app()->params['execution_error']);
			}
            if($id == 5){
                $this->redirect(Yii::app()->createUrl('TypeTags/rules'));
            }else if($id == 6){
                $this->redirect(Yii::app()->createUrl('team/teamlist'));
            }else{
                $this->redirect(CHttpRequest::getUrlReferrer());
            }            
            
        }
        
        $this->data['model']=$model;
        $this->render('/typeTags/updatecmsrule',$this->data);
    }      
    
    public function actionViewpeople($people_id="",$type=''){
		$this->layout = 'registration';
		$id = $_GET['people_id'];
		$selected_user_id = 0;
		$last_comment_id = 0;
		$page_no = 0;
		$record_per_page = 20;
        $this->data['type'] = $type;
		if(!empty($id) && is_numeric($id)){
            $rule_order_no_model=TypeTags::model()->findAll(array('condition'=>'order_no >0','order'=>'order_no'));
	        $rule_model = TypeTags::model()->findByPk($id);
			if(count($rule_model)>0){
				$user_comment_condition_clause = "user_id=".$id;
				if(!empty($_GET['user_id']) && is_numeric($_GET['user_id'])){
					$selected_user_id = $_GET['user_id'];

					$tmp_sql = "SELECT id FROM all_posts WHERE user_id=".$id." AND user_id=".$selected_user_id;
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

    /*
		$WHEREPOPULAR = " status = 'Active' ORDER BY Totalcommentscount DESC LIMIT 0,10";
        $TestpopularSql = "SELECT type_tags.*,(SELECT COUNT(*) FROM all_posts WHERE all_posts.main_id = type_tags.id AND post_type = 2) AS Totalcommentscount
                         	FROM type_tags WHERE ".$WHEREPOPULAR;
        $PopularRuleListModel = TypeTags::model()->findAllBySql($TestpopularSql);
        $this->data["PopularRuleListModel"] = $PopularRuleListModel;
    */
        $user_flag_model = new AllPostsFlags;
        $this->data["user_flag_model"] = $user_flag_model;
        
        $flag_reason_model = FlagReason::model()->findAll(array('condition'=>'status=1'));
        $this->data["flag_reason_model"] = $flag_reason_model;
      /*  
        $MyRuleListModel = TypeTags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'],'order'=>'id DESC','limit'=>10));
        $this->data["MyRuleListModel"] = $MyRuleListModel;
      */

		$UserComment = new AllPosts;
		if(!empty($_POST)){
            
			$post_comment_array = array();
			$post_comment_array['user_id'] = Yii::app()->session['user_id'];
            //echo "<pre>";print_r($_POST);exit;
            $post_comment_array['main_id'] =$_POST['main_id'];
            $post_comment_array['post_type'] =$_POST['post_type'];
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
		if(count($ip_status) > 0){
		    Yii::app()->user->setFlash('failure_msg', Yii::app()->params['post_on_comment']);
			$this->redirect(Yii::app()->createUrl('Site/Viewpeople',array('people_id'=>$people_id)));
		}else{
	            if($UserComment->validate()){
	            	$UserComment->save();
	                $this->redirect(Yii::app()->createUrl('Site/Viewpeople',array('people_id'=>$people_id)));
	            }
		    }	
        }
        $user_model=Users::model()->findByPk($people_id);
        // Start : for as an individual i am and  favorite rules and groups and tesms// 
        if($user_model->aiia_discriptor!=""){
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN('.$user_model->aiia_discriptor.')','order'=>'FIELD(id,'.$user_model->aiia_discriptor.')'));
        }else{
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN(0)'));//here 0 means user aiia_discriptor fiel is blank.
        }
        if($user_model->favorite_rule!=""){
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN('.$user_model->favorite_rule.')','order'=>'FIELD(id,'.$user_model->favorite_rule.')'));
        }else{
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN(0)'));//here 0 means user favorite_rule fiel is blank.
        }
        if($user_model->category_groups_id_hide!=""){
                $hide_category=$user_model->category_groups_id_hide;
        }else{
                $hide_category="0";
        }
        if($user_model->category_groups_id!=""){
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN('.$user_model->category_groups_id.') AND id NOT IN ('.$hide_category.')'));
        }else{
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN(0) AND id NOT IN ('.$hide_category.')'));
        }
        /*if($user_model->category_groups_id!=""){
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN('.$user_model->category_groups_id.') AND id NOT IN ('.$hide_category.')'));
        }else{
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN(0) AND id NOT IN ('.$hide_category.')'));
        }*/
        
        //$team_model=Team::model()->findAll(array("condition"=>"user_id=".$people_id));
        $team_model=Team::model()->findAll(array("condition"=>"id IN(select team_id from team_member where user_id=".$id.")"));
        // End : for as an individual i am and  favorite rules and groups and tesms//
        
    	//$this->data["PostUserComment"] = $UserComment;
        $this->data["user_model"] = $user_model;
        $this->data["aiia_model"] = $aiia_model;
        $this->data["TypeTags_favorite_rule_model"] = $TypeTags_favorite_rule_model;
        $this->data["CategoryGroups_model"] = $CategoryGroups_model;
        $this->data["team_model"] = $team_model;
		$this->data["UserComment"] = $user_comment_model;
		$this->data["people_id"] = $id;
		$this->data["selected_user_id"] = $selected_user_id;
		$this->data["last_comment_id"] = $last_comment_id;
        //$this->data["rule_model"] = $rule_model;
        $this->data["rule_order_no_model"] = $rule_order_no_model;
        $this->render('people_view',$this->data);
    }
    
    public function actionTopposts($dialog_id="",$type=''){
		$this->layout = 'registration';
		$id = $_GET['dialog_id'];
		$selected_user_id = 0;
		$last_comment_id = 0;
		$page_no = 0;
		$record_per_page = 20;
        $this->data['type'] = $type;
		
        $user_flag_model = new AllPostsFlags;
        $this->data["user_flag_model"] = $user_flag_model;
        
        $flag_reason_model = FlagReason::model()->findAll(array('condition'=>'status=1'));
        $this->data["flag_reason_model"] = $flag_reason_model;
      	
        $this->data["selected_user_id"] = $selected_user_id;
        $this->data["last_comment_id"] = $last_comment_id;
        //$this->data["rule_model"] = $rule_model;
        $this->render('top_posts',$this->data);
    }
    
    
   	public function actionGetcomments(){
   	    //echo "<pre>";
        //print_r($_REQUEST);exit;
		$user_id = $_GET['user_id'];
		$selected_user_id = 0;
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];

		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;

        /*$block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND flag_type="Red"','group'=>'commented_by'));
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
        */
        
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
		if(!empty($user_id) && is_numeric($user_id) && !empty($currect_section)){
	        
            $user_model = Users::model()->findByPk($user_id);
			if(count($user_model)>0){
			 
				//$user_comment_condition_clause = "user_id=".$user_id.' AND status = 1'.$block_condition.$inactive_condition;
                $user_comment_condition_clause = "user_id=".$user_id.' AND status = 1'.$inactive_condition;
                //echo $user_comment_condition_clause;exit;
				$user_comment_order_clause = "";
				if($currect_section == "date_topics"){
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
					$tmp_sql = "SELECT uc.id FROM all_posts uc WHERE uc.user_id=".$user_id." AND uc.user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (ucm.user_id=".$selected_user_id." OR ucm.comment_id IN (".$tmp_sql."))";
				}
                
                if($currect_section == "green_flag"){
    				$main_sql = "SELECT all_posts.*,
                                (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Green') as total
                                FROM all_posts
                                INNER JOIN all_posts_flags ON all_posts_flags.all_posts_id = all_posts.id
                                WHERE all_posts.user_id=".$user_id." AND all_posts.status = 1 AND all_posts_flags.flag_type='Green' ORDER BY total DESC LIMIT 0,".$new_total_record_to_fetch;
                    //echo $main_sql;exit;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
/*Ivan
                }else if($currect_section == "hidden"){
                    $main_sql = "SELECT all_posts.*,
                                (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Red') as total
                                FROM all_posts
                                INNER JOIN all_posts_flags ON all_posts_flags.all_posts_id = all_posts.id
                                WHERE all_posts.user_id=".$user_id." AND all_posts.status = 0 AND all_posts_flags.flag_type='Red' ORDER BY total DESC LIMIT 0,".$new_total_record_to_fetch;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql); */
                    
                }else{
    				$main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause." ORDER BY ".$user_comment_order_clause;
    				$user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }    
				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $alluser){
						$last_comment_id = $alluser->id;
						$stringtime = strtotime($alluser->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        $id='';
                        /*if($alluser->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($alluser->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_comment->id;
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($alluser->user_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_other_comment->user_comment->id;
                        }*/
                        
                        $green_cnt = count($alluser->user_green_comment);
                        $red_cnt = count($alluser->user_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Green');
                        $red_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Red');
                        
						$data_str .= '<tr id="'.$alluser->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0 && $currect_section != 'red_flag'){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'green')).'" style="text-decoration:none;">
                                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                                        </div></a>';
                                                        }
                                                        if($red_total_cooment > 0 && $currect_section != 'green_flag'){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'red')).'" style="text-decoration:none;">
                                                        <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                                        </div></a>';
                                                        }
                        $data_str .= '</td>
                                                    <td style="vertical-align: top;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                        <a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alluser->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_comment->username).'</a>';
                                                                        if($alluser->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>&nbsp;&nbsp;';
                                                                        if($alluser->post_type==1){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Topics/Viewtopic',array('topic_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==2){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==3){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Team/viewteam',array('id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }
                                                                    $data_str .= '</span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.strip_tags(nl2br($alluser->comment)).'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$alluser->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alluser->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$alluser->id.'\');" id="reply_'.$alluser->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Site/Viewpeople?people_id='.$user_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alluser->id.'" name="user_comment_'.$alluser->id.'" value="'.$alluser->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alluser->id.'" style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="showhide('.$alluser->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alluser->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            if($alluser->main_comment_id == 0){
                                                                                                $main_comment_id = $alluser->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alluser->main_comment_id;
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
                										  <tr id="reply_form_id_'.$alluser->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$alluser->id.'" method="post" action="'.Yii::app()->createUrl("Site/Viewpeople?people_id=".$user_id).'" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$alluser->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$alluser->main_id.'" />
                                                                        <input type="hidden" name="post_type" id="post_type" value="'.$alluser->post_type.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$alluser->id.'">
            																		<textarea id="replycomment_'.$alluser->id.'" name="replycomment_'.$alluser->id.'" style="width:100%; height:250px;"></textarea>
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
									<td style="width:100%">No posts available!!!</td>
								</tr>';
				}
			}
		}
                
                if($new_total_record_to_fetch>count($user_comment_model))
                    $no_more_data = 1;
                
		$response_aray = array();
		$response_aray['user_id'] = $user_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;

		print_r(json_encode($response_aray));exit;
	}
        
        public function actionGettopcomments(){
            $topSecCount = 0;
   	    //echo "<pre>";
        //print_r($_REQUEST);exit;
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
            
		$user_id = 0;
		$selected_user_id = 0;
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];

		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;

        /*$block_user_model = AllPostsFlags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'].' AND flag_type="Red"','group'=>'commented_by'));
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
        */
        
        $inactive_user_model = Users::model()->findAll(array('condition'=>'status="Inactive"'));
        if(count($inactive_user_model) > 0){
            $inactive_user_ids = array();
            foreach($inactive_user_model as $inactive_user){
                $inactive_user_ids[] = $inactive_user->id;
            }
            $inactive_user_ids = implode(',',$inactive_user_ids);
            //echo $block_user_ids;exit;
            $inactive_condition = ' AND ucm.user_id NOT IN ('.$inactive_user_ids.')';
        }else{
            $inactive_condition = '';
        }        
        
		$data_str = "";
		if(!empty($currect_section)){
				//$user_comment_condition_clause = "user_id=".$user_id.' AND status = 1'.$block_condition.$inactive_condition;
                $user_comment_condition_clause = 'ucm.status = 1'.$inactive_condition;
                //echo $user_comment_condition_clause;exit;
				$user_comment_order_clause = "";
				if($currect_section == "date_topics"){
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
					$tmp_sql = "SELECT uc.id FROM all_posts uc WHERE uc.user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (ucm.user_id=".$selected_user_id." OR ucm.comment_id IN (".$tmp_sql."))";
				}
                
                if($currect_section == "green_flag"){
    				$main_sql = "SELECT all_posts.*,
                                (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Green') as total
                                FROM all_posts
                                INNER JOIN all_posts_flags ON all_posts_flags.all_posts_id = all_posts.id
                                WHERE all_posts.status = 1 AND all_posts_flags.flag_type='Green' ORDER BY total DESC LIMIT 0,".$new_total_record_to_fetch;
                    //echo $main_sql;exit;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }else if($currect_section == "red_flag"){
                    $topSecCountSQL = "SELECT COUNT(sumTotal.totalRedFlag) FROM
                                (SELECT all_posts.*,
                                (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Red') as totalRedFlag
                                FROM all_posts
                                INNER JOIN topics as tops ON all_posts.main_id=tops.id
                                WHERE all_posts.status = 1 AND tops.dialog_id='".$dialogID."') AS sumTotal WHERE sumTotal.totalRedFlag>0";
                    $command = Yii::app()->db->createCommand($topSecCountSQL);
                    $topSecCount = $command->queryScalar();
                    
                    $main_sql = "SELECT DISTINCT all_posts.id, all_posts.*,
                                (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Red') as totalRedFlag
                                FROM all_posts
                                INNER JOIN all_posts_flags ON all_posts_flags.all_posts_id = all_posts.id INNER JOIN topics as tops ON all_posts.main_id=tops.id
                                WHERE all_posts.status = 1 AND all_posts_flags.flag_type='Red' AND tops.dialog_id='".$dialogID."' ORDER BY totalRedFlag DESC LIMIT 0,".$new_total_record_to_fetch;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }else{
                    
    				$main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm INNER JOIN topics as tops ON ucm.main_id=tops.id WHERE tops.dialog_id='".$dialogID."' AND ".$user_comment_condition_clause." ORDER BY ".$user_comment_order_clause;
    				
                                $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }    
                if((int)$topSecCount>0 && $currect_section == "red_flag")
                {
                    //$data_str.= "<p>Red Flag(".$topSecCount.")</p><br/>";
                }
				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $alluser){
						$last_comment_id = $alluser->id;
						$stringtime = strtotime($alluser->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        $id='';
                        /*if($alluser->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($alluser->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_comment->id;
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($alluser->user_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_other_comment->user_comment->id;
                        }*/
                        
                        $green_cnt = count($alluser->user_green_comment);
                        $red_cnt = count($alluser->user_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Green');
                        $red_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Red');
                        
						$data_str .= '<tr id="'.$alluser->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0 && $currect_section != 'red_flag'){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'green')).'" style="text-decoration:none;">
                                                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                                        </div></a>';
                                                        }
                                                        if($red_total_cooment > 0 && $currect_section != 'green_flag'){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'red')).'" style="text-decoration:none;">
                                                        <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                                        </div></a>';
                                                        }
                        $data_str .= '</td>
                                                    <td style="vertical-align: top;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                        <a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alluser->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_comment->username).'</a>';
                                                                        if($alluser->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alluser->user_id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>&nbsp;&nbsp;';
                                                                        if($alluser->post_type==1){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Topics/Viewtopic',array('topic_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==2){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==3){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Team/viewteam',array('id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }
                                                                        if($currect_section == 'red_flag'){
                                                                            $data_str .= '<a href="javascript:void(0)" onclick="javascript:inactive_record('.$alluser->id.');" data-id="'.$alluser->id.'" style="float:right; cursor:pointer; font-size: 13px; color:#999999; margin-right:8px;">Hide</a>';
                                                                        }
                                                                    $data_str .= '</span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.strip_tags(nl2br($alluser->comment)).'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$alluser->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alluser->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " id="reply_'.$alluser->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Site/Viewpeople?people_id='.$alluser->user_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alluser->id.'" name="user_comment_'.$alluser->id.'" value="'.$alluser->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alluser->id.'" style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="showhide('.$alluser->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alluser->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            if($alluser->main_comment_id == 0){
                                                                                                $main_comment_id = $alluser->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alluser->main_comment_id;
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
                										  <tr id="reply_form_id_'.$alluser->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$alluser->id.'" method="post" action="#" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$alluser->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$alluser->main_id.'" />
                                                                        <input type="hidden" name="post_type" id="post_type" value="'.$alluser->post_type.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$alluser->id.'">
            																		<textarea id="replycomment_'.$alluser->id.'" name="replycomment_'.$alluser->id.'" style="width:100%; height:250px;"></textarea>
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
									<td style="width:100%">No posts available!!!</td>
								</tr>';
				}
			
		}
                
                if($new_total_record_to_fetch>count($user_comment_model))
                    $no_more_data = 1;
                
		$response_aray = array();
		$response_aray['user_id'] = $user_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;
                $response_aray['topSecCount'] = $topSecCount;

		print_r(json_encode($response_aray));exit;
	}
       
    public function actionCreategreenflag(){
        
        $AllPostsFlags = new AllPostsFlags;
        if(isset($_POST['AllPostsFlags'])){
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=".$_POST['AllPostsFlags']['post_type']);
            if($model_check>0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=".$_POST['AllPostsFlags']['post_type']);
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
				$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
				if(count($ip_status) > 0){
				  Yii::app()->user->setFlash('failure_msg', Yii::app()->params['comment_green_flag']);
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
            $model_check=AllPostsFlags::model()->count("all_posts_id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=".$_POST['AllPostsFlags']['post_type']);
            if($model_check > 0)
            {
                 Yii::app()->user->setFlash('failure_msg',"You Have Alreay Flaged");
                 $this->redirect(CHttpRequest::getUrlReferrer());
            }else{
                $usermodel_check=AllPosts::model()->count("id=".$_POST['AllPostsFlags']['all_posts_id']." AND user_id=".$_POST['AllPostsFlags']['user_id']." AND post_type=".$_POST['AllPostsFlags']['post_type']);
                if($usermodel_check > 0){
                     Yii::app()->user->setFlash('failure_msg',"You cannot flag your own posts");
                     $this->redirect(CHttpRequest::getUrlReferrer());
                }
                
                $AllPostsFlags->attributes = $_POST['AllPostsFlags'];
                $comment_model = AllPosts::model()->findByPk($AllPostsFlags->all_posts_id);
                $AllPostsFlags->commented_by =  $comment_model->user_id;
				$ip_status = IpAddress::model()->findall(array('condition'=>'ip_address="'.Yii::app()->session['ip_address'].'" AND status="Inactive"'));
				if(count($ip_status) > 0){
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
/*    
    public function actionSubmitreply(){
        $this->layout = 'blank';
        $user_comment_model = new AllPosts(); 
        if(isset($_POST['AllPosts'])){
            $user_comment_model->attributes = $_POST['AllPosts'];
            $user_comment_model->user_id = $this->data['user_id'];
            $user_comment_model->post_type = 2;
            $user_comment_model->save(false);
            echo '1';exit;
        }
    }
    */
	
	//this action used for Home menu
    public function actionViewuser($people_id="",$type=''){
		$this->layout = 'registration';
		//$id = $_GET['people_id'];
		$people_id=$this->data['user_id'];
		$id =$this->data['user_id'];
		$selected_user_id = 0;
		$last_comment_id = 0;
		$page_no = 0;
		$record_per_page = 20;
        $this->data['type'] = $type;
		if(!empty($id) && is_numeric($id)){
            $rule_order_no_model=TypeTags::model()->findAll(array('condition'=>'order_no >0','order'=>'order_no'));
	        $rule_model = TypeTags::model()->findByPk($id);
			if(count($rule_model)>0){
				$user_comment_condition_clause = "user_id=".$id;
				if(!empty($_GET['user_id']) && is_numeric($_GET['user_id'])){
					$selected_user_id = $_GET['user_id'];

					$tmp_sql = "SELECT id FROM all_posts WHERE user_id=".$id." AND user_id=".$selected_user_id;
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

    /*
		$WHEREPOPULAR = " status = 'Active' ORDER BY Totalcommentscount DESC LIMIT 0,10";
        $TestpopularSql = "SELECT type_tags.*,(SELECT COUNT(*) FROM all_posts WHERE all_posts.main_id = type_tags.id AND post_type = 2) AS Totalcommentscount
                         	FROM type_tags WHERE ".$WHEREPOPULAR;
        $PopularRuleListModel = TypeTags::model()->findAllBySql($TestpopularSql);
        $this->data["PopularRuleListModel"] = $PopularRuleListModel;
    */
        $user_flag_model = new AllPostsFlags;
        $this->data["user_flag_model"] = $user_flag_model;
        
        $flag_reason_model = FlagReason::model()->findAll(array('condition'=>'status=1'));
        $this->data["flag_reason_model"] = $flag_reason_model;
      /*  
        $MyRuleListModel = TypeTags::model()->findAll(array('condition'=>'user_id='.$this->data['user_id'],'order'=>'id DESC','limit'=>10));
        $this->data["MyRuleListModel"] = $MyRuleListModel;
      */

		$UserComment = new AllPosts;
		if(!empty($_POST)){
            
			$post_comment_array = array();
			$post_comment_array['user_id'] = Yii::app()->session['user_id'];
            //echo "<pre>";print_r($_POST);exit;
            $post_comment_array['main_id'] =$_POST['main_id'];
            $post_comment_array['post_type'] =$_POST['post_type'];
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
            if($UserComment->validate()){
            	$UserComment->save();
                $this->redirect(Yii::app()->createUrl('Site/Viewuser',array('people_id'=>$people_id)));
            }
        }
        $user_model=Users::model()->findByPk($people_id);
        // Start : for as an individual i am and  favorite rules and groups and tesms// 
        if($user_model->aiia_discriptor!=""){
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN('.$user_model->aiia_discriptor.')','order'=>'FIELD(id,'.$user_model->aiia_discriptor.')'));
        }else{
            $aiia_model=Aiia::model()->findAll(array('condition'=>'id IN(0)'));//here 0 means user aiia_discriptor fiel is blank.
        }
        if($user_model->favorite_rule!=""){
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN('.$user_model->favorite_rule.')','order'=>'FIELD(id,'.$user_model->favorite_rule.')'));
        }else{
            $TypeTags_favorite_rule_model=TypeTags::model()->findAll(array('condition'=>'id IN(0)'));//here 0 means user favorite_rule fiel is blank.
        }
        if($user_model->category_groups_id_hide!=""){
                $hide_category=$user_model->category_groups_id_hide;
        }else{
                $hide_category="0";
        }
        if($user_model->category_groups_id!=""){
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN('.$user_model->category_groups_id.') AND id NOT IN ('.$hide_category.')'));
        }else{
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN(0) AND id NOT IN ('.$hide_category.')'));
        }
        /*if($user_model->category_groups_id!=""){
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN('.$user_model->category_groups_id.') AND id NOT IN ('.$hide_category.')'));
        }else{
            $CategoryGroups_model=CategoryGroups::model()->findAll(array('condition'=>'id IN(0) AND id NOT IN ('.$hide_category.')'));
        }*/
        
        //$team_model=Team::model()->findAll(array("condition"=>"user_id=".$people_id));
        $team_model=Team::model()->findAll(array("condition"=>"id IN(select team_id from team_member where user_id=".$people_id.")"));
        // End : for as an individual i am and  favorite rules and groups and tesms//
    	//$this->data["PostUserComment"] = $UserComment;
        $this->data["user_model"] = $user_model;
        $this->data["aiia_model"] = $aiia_model;
        $this->data["TypeTags_favorite_rule_model"] = $TypeTags_favorite_rule_model;
        $this->data["CategoryGroups_model"] = $CategoryGroups_model;
        $this->data["team_model"] = $team_model;
		$this->data["UserComment"] = $user_comment_model;
		$this->data["people_id"] = $id;
		$this->data["selected_user_id"] = $selected_user_id;
		$this->data["last_comment_id"] = $last_comment_id;
        //$this->data["rule_model"] = $rule_model;
        $this->data["rule_order_no_model"] = $rule_order_no_model;
        $this->render('user_view',$this->data);
    }
	
	//this action used for Home menu
	public function actionGetusercomments(){
   	    //echo "<pre>";
        //print_r($_REQUEST);exit;
		$user_id = $_GET['user_id'];
		//$user_id =$this->data['user_id'];
		$selected_user_id = 0;
		$currect_section = $_POST['currect_section'];
		$prev_last_comment_id = $_POST['last_comment_id'];

		$record_to_fetch_per_page = 20;
		$total_record_to_fetch = $_POST['record_cnt'];
		$new_total_record_to_fetch = $total_record_to_fetch + $record_to_fetch_per_page;
  
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
		if(!empty($user_id) && is_numeric($user_id) && !empty($currect_section)){
	        
            $user_model = Users::model()->findByPk($user_id);
			if(count($user_model)>0){
			 
				//$user_comment_condition_clause = "user_id=".$user_id.' AND status = 1'.$block_condition.$inactive_condition;
                $user_comment_condition_clause = 'status = 1'.$inactive_condition;
                //echo $user_comment_condition_clause;exit;
				$user_comment_order_clause = "";
				if($currect_section == "date_topics"){
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
					$tmp_sql = "SELECT uc.id FROM all_posts uc WHERE uc.user_id=".$user_id." AND uc.user_id=".$selected_user_id;
					$user_comment_condition_clause .= " AND (ucm.user_id=".$selected_user_id." OR ucm.comment_id IN (".$tmp_sql."))";
				}
                
                $user_comment_ids = array();
                $user_comment_model = AllPosts::model()->findAll(array('condition'=>'user_id='.$user_id.' AND status=1'));
                foreach($user_comment_model as $user_comment){
                    $user_comment_ids[] = $user_comment->id;
                }
                $user_comment_ids = implode(',',$user_comment_ids);
				$user_comment_condition_clause .= " AND (ucm.comment_id IN (".$user_comment_ids.") OR user_id=".$user_id.")";
                
                if($currect_section == "green_flag"){
    				$main_sql = "SELECT all_posts.*, (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Green') as total FROM all_posts WHERE (comment_id IN (".$user_comment_ids.") OR user_id=".$user_id.") AND status = 1 ORDER BY total DESC LIMIT 0,".$new_total_record_to_fetch;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                }else if($currect_section == "red_flag"){
                    $main_sql = "SELECT all_posts.*, (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Red') as total FROM all_posts WHERE (comment_id IN (".$user_comment_ids.") OR user_id=".$user_id.") AND status = 1 ORDER BY total DESC LIMIT 0,".$new_total_record_to_fetch;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }else{
                    $main_sql = "SELECT ucm.*, (ucm.like - ucm.dislike) as like_difference FROM all_posts ucm WHERE ".$user_comment_condition_clause." ORDER BY ".$user_comment_order_clause;
                    $user_comment_model = AllPosts::model()->findAllBySql($main_sql);
                    
                }    
				$cnt = 0;
				$no_more_data = 0;
				$UserComment = new AllPosts;
				if(count($user_comment_model)>0){
					foreach($user_comment_model as $alluser){
						$last_comment_id = $alluser->id;
						$stringtime = strtotime($alluser->created_date);

						$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                        $id='';
                        /*if($alluser->comment_id == 0){*/
                            $color = "color:#065A95";
                             if(!empty($alluser->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_comment->profile_image)){
                                $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_comment->id;
                        /*}else{
                            $color = "color:#999999";
                            if(!empty($alluser->user_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image)){
                                     $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alluser->user_other_comment->user_comment->profile_image;
                            }else{
                                $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                            }
                            $id=$alluser->user_other_comment->user_comment->id;
                        }*/
                        
                        $green_cnt = count($alluser->user_green_comment);
                        $red_cnt = count($alluser->user_red_comment);
                        
                        $green_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Green');
                        $red_total_cooment = myhelpers::getGreentotalCountPeople($alluser->user_id,'Red');
                        
						$data_str .= '<tr id="'.$alluser->id.'" style="background-color:#FFFFFF !important;">
										<td style="width:100%;padding-bottom:7px;border-bottom:1px solid #e2f5fa; ">
                                            <table style="width: 100%;">
                                            	<tr style="width:30px; margin:6px 0 0 0;">
                                                	<td style="width:10%;vertical-align: top;">
														<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id)).'" style="text-decoration:none;">
															<img  src="'.$user_image.'" width="45" height="45" align="left" style="padding:6px 1px 0px 0px;"/>
                                                        </a>
                                                        <div style="clear:both; height:3px;"></div>';
                                                        if($green_total_cooment > 0){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'green')).'" style="text-decoration:none;"><div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="'.$green_total_cooment.' Green Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$green_total_cooment.'</div>
                                                            </div></a>';
                                                        }
                                                        if($red_total_cooment > 0){
                        $data_str .= '<a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id,'type'=>'red')).'" style="text-decoration:none;"><div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="'.$red_total_cooment.' Red  Flags">
                                                            <div style="margin-top:-3px; font-size:11px;">'.$red_total_cooment.'</div>
                                                            </div></a>';
                                                        }
                        $data_str .= '</td>
                                                    <td style="vertical-align: top;">
                                                        <table style="width:100%">
                                                            <tr>
                                                                <td>
                                                                    <span style="color:#065A95;font-family: Arial,Helvetica,sans-serif; font-size: 14px;" >
                                                                        <a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$alluser->user_comment->id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_comment->username).'</a>';
                                                                        if($alluser->comment_id != 0){
                                                                            $data_str .= '<span style="color:#065A95;"> > @ </span><a href="'.Yii::app()->createUrl("Site/viewpeople", array("people_id"=>$id)).'" style="text-decoration:none;color:#075A99;">'.ucfirst($alluser->user_other_comment->user_comment->username).'</a>';
                                                                        }
                                                                            $data_str .= '<span style="font-size: 14px;'.$color.'"> - '.date('m/d/Y',$stringtime).'-'.date('H:i',$stringtime).'</span>&nbsp;&nbsp;';
                                                                        if($alluser->post_type==1){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Topics/Viewtopic',array('topic_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==2){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }else if($alluser->post_type==3){
                                                                            $data_str .= '<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#075A99;" href="'.Yii::app()->createUrl('Team/viewteam',array('id'=>$alluser->main_id)).'" >View Dialog</a>';
                                                                        }
                                                                    $data_str .= '</span>                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif; font-size: 14px;">'.$alluser->comment.'</span>
                                                                </td>
                                                            </tr>
            											   <tr id="already_voted_message_'.$alluser->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #666666;width:128px"><td style="color:#666666;font-size: 14px;text-align: center;" colspan="2">You already voted!</td></tr>
            	                                            <tr style=" width:558px; padding-left:25px;">
            	                                            	
                                                                <td>
                                                                    <table style="width:100%;">
                                                                    <tr style="float:right;width:100%;">
                                                                        <td style="width:100%">
                                                                            <div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" alt="" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'like\')" style="cursor:pointer;"/>
                                                                                    <span id="likecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                                    <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" onclick="javascript:likedislikecommentfun('.$alluser->post_type.','.$alluser->main_id.','.$alluser->id.', \'dislike\')" style="cursor:pointer;" />
                                                                                    <span id="dislikecount_'.$alluser->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 12px;">'.$alluser->dislike.'</span>
                                                                               	</div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <div class="postareply" id="showtbldetail1_'.$alluser->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; font-size: 13px;float:left;margin-top:3px;" >
                                                                                    	<span style="cursor:pointer; " id="reply_'.$alluser->id.'">Reply</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div style="float:left;width: 20%;">
                                                                                    <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
																					<style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> 
                                                                                    <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog/Site/Viewpeople?people_id='.$user_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;"></a> 
																					<a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                </div>
                                                                               <div style="float:left;width: 40%;">
                                                                                    
                                                                                    <input type="hidden" id="usercomment_'.$alluser->id.'" name="user_comment_'.$alluser->id.'" value="'.$alluser->user_comment->username.'" />
																						<div style="float:right;">
																							<div class="flagclass"  id="flag_'.$alluser->id.'" style="cursor: pointer;;float:right;color: #999999;;font-size: 13px;" onclick="showhide('.$alluser->id.');">Flag ';
                                                                                            if($green_cnt >0 OR $red_cnt > 0){
                                                                $data_str .=                       '('.($green_cnt+$red_cnt).')';    
                                                                                            }
                                                                $data_str .=               '</div>
                                                                                            <div style="clear:both"></div>
																							<div class="flagclass_sub" id="flagsub_'.$alluser->id.'" style="display:none;border:1px solid #999999;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Green\');" style="text-decoration: none;color:#999999;font-size: 13px;">Green Flag ';
                                                                                            if($green_cnt >0){
                                                                $data_str .=                       '('.($green_cnt).') ';    
                                                                                            }
                                                                $data_str .=               '</a><br/>
                                                                                            <a href="javascript:void(0);" onclick="setFlagMessage('.$alluser->id.','.$alluser->main_id.','.$alluser->post_type.',\'Red\');" style="text-decoration: none;color:#999999;font-size: 13px;">Red Flag ';
                                                                                            if($red_cnt >0){
                                                                $data_str .=                       '('.($red_cnt).') ';    
                                                                                            }
                                                                                            if($alluser->main_comment_id == 0){
                                                                                                $main_comment_id = $alluser->id;
                                                                                            }else{
                                                                                                $main_comment_id = $alluser->main_comment_id;
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
                										  <tr id="reply_form_id_'.$alluser->id.'" style="display:none" class="hide_row">
            													<td>
            														<form id="user-comment-form_'.$alluser->id.'" method="post" action="'.Yii::app()->createUrl("Site/Viewpeople?people_id=".$user_id).'" enctype="multipart/form-data">
            															<input type="hidden" name="comment_id" value="'.$alluser->id.'" />
                                                                        <input type="hidden" name="main_id" id="main_id" value="'.$alluser->main_id.'" />
                                                                        <input type="hidden" name="post_type" id="post_type" value="'.$alluser->post_type.'" />
                                                                        <input type="hidden" name="main_comment_id" value="'.$main_comment_id.'" />
            															<table style="width:100%; vertical-align: top;">
            																<tr>
            																	<td id="reply_comment_id_'.$alluser->id.'">
            																		<textarea id="replycomment_'.$alluser->id.'" name="replycomment_'.$alluser->id.'" style="width:100%; height:250px;"></textarea>
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
		$response_aray['user_id'] = $user_id;
		$response_aray['selected_user_id'] = $selected_user_id;
		$response_aray['total_record_to_fetch'] = $new_total_record_to_fetch;
		$response_aray['currect_section'] = $currect_section;
		$response_aray['last_comment_id'] = $last_comment_id;
		$response_aray['response_data_str'] = $data_str;
		$response_aray['no_more_data'] = $no_more_data;

		print_r(json_encode($response_aray));exit;
	} 
    
}
