<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $breadcrumbs=array();
    public $data=array();
    public $facebook=null;
    
    public function init(){
        if(!empty(Yii::app()->session['dialog_id'])){
            $dialogCount = Dialogs::model()->count('id=:did', array(':did'=>Yii::app()->session['dialog_id']));
            if($dialogCount==0){
                unset(Yii::app()->session['dialog_id']);
                unset(Yii::app()->session['dialog_name']);
                unset(Yii::app()->session['dialog_created_by']);
            }
        }
            
        if(!isset(Yii::app()->session['user_id']) && !isset(Yii::app()->session['group_id'])){
            if($_COOKIE['cookieemail'] && $_COOKIE['cookiepass']){                
                $userloginmodel = Users::model()->find(array('condition'=>'email="'.$_COOKIE['cookieemail'].'" AND password="'.addslashes($_COOKIE['cookiepass']).'" AND status="Active"'));
                if(!empty($userloginmodel)){
                    Yii::app()->session['user_id'] = $userloginmodel->id;
                    Yii::app()->session['group_id'] = $userloginmodel->group_id;
          		    Yii::app()->session['user_name'] = $userloginmodel->username;
                    Yii::app()->session['email'] = $userloginmodel->email;   
                }
            }
        }
        
    	Yii::app()->clientScript->scriptMap=array('jquery.js'=>false,'jquery.yiiactiveform.js'=>false,'jquery.min.js'=>false);
    	
        
        // ========== FOR WITHOUT LOGIN ==============//
    	/*$this->data['default_permissions']=array(
            'SITE'=>array('GETCOMMENTS'=>1,'VIEWPEOPLE'=>1,'ERROR'=>1,'LOGOUT'=>1,'INDEX'=>1,'INSERTUSER'=>1,'PEOPLELIST'=>1,'DISPLAYPEOPLE'=>1,'FBLOGIN'=>1,'LOGINTWITTER'=>1,'GETPEOPLELISTDATA1'=>1,'COMFORMATIONLOGIN'=>1,'FORGOTPASSWORD'=>1,'LOGINUSER'=>1,'REGISTER'=>1),
			'ADMIN'=>array('ADMINLOGIN'=>1,'LOGOUT'=>1),
			'TOPICS'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWTOPIC'=>1,'TOPICSLIST'=>1,'GETTOPICS'=>1,'SHOWTOPICSTAGS'=>1,'SUBMITREPLY'=>1),
            'GENERAL'=>array('ABOUT'=>1,'TEAMDETAIL'=>1,'TEAMCOUNT'=>1,'RULECOUNT'=>1,'COUNT'=>1,'REPLYCOUNT'=>1,'CATETAG'=>1,'CATEGORY_DESCRIPTION'=>1,'TYPETAG'=>1,'TYPE_DESCRIPTION'=>1,'CATEGORYTAGDETAIL'=>1,'TYPETAGDETAIL'=>1,'TOPICDETAIL'=>1,'MOREMYTOPICS1'=>1,'MOREPOPULARTOPICS1'=>1,'GETPEOPLELISTDATA'=>1,'USERREPLY'=>1,'RULEDETAIL'=>1,'USERCOUNT'=>1,'AIIADESCRIPTOR'=>1),
            'TYPETAGS'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWRULE'=>1,'RULES'=>1,'PAGINATION'=>1,'LIKEDISLIKE'=>1),
            'TEAM'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWTEAM'=>1,'TEAMLIST'=>1,'PAGINATION'=>1),
        );*/
        // ========== FOR WITH LOGIN ==============//
        
       	$this->data['user_id'] = isset ( Yii::app()->session['user_id'] ) ? Yii::app()->session['user_id'] : 0 ;
    	$this->data['group_id'] = Yii::app()->session['group_id'];
    	$this->data['email'] = Yii::app()->session['email'];
    	$this->data['user_name'] = Yii::app()->session['user_name'];
        $this->data['access_token'] = Yii::app()->session['access_token'];
        
        
        $admin_model=Admin::model()->findByPk(1);
        $this->data['login_check']=$admin_model->login_check;
        if($admin_model->login_check=="1"){
      
                $this->data['default_permissions']=array(
                    'SITE'=>array('ERROR'=>1,'LOGOUT'=>1,'INDEX'=>1,'INSERTUSER'=>1,'PEOPLELIST'=>1,'DISPLAYPEOPLE'=>1,'FBLOGIN'=>1,'LOGINTWITTER'=>1,'GETPEOPLELISTDATA1'=>1,'COMFORMATIONLOGIN'=>1,'FORGOTPASSWORD'=>1,'LOGINUSER'=>1,'REGISTER'=>1,'NOTIFICATIONEMAIL'=>1, 'VIEWPEOPLEABOUT'=>1, 'TOPPOSTS'=>1, 'GETTOPCOMMENTS'=>1),
        			'ADMIN'=>array('ADMINLOGIN'=>1,'LOGOUT'=>1),
        			'TOPICS'=>array('SHOWTOPICSTAGS'=>1,'SUBMITREPLY'=>1,'TOPICANSWER'=>1,'UPDATEREPLY'=>1,'UPDATETOPIC'=>1),
                    'GENERAL'=>array('QUESTIONANSWER'=>1,'SELECTCATEGORYGROUP'=>1,'CATEGORYGROUPCREATE'=>1,'ABOUT'=>1,'TEAMDETAIL'=>1,'TEAMCOUNT'=>1,'RULECOUNT'=>1,'COUNT'=>1,'REPLYCOUNT'=>1,'CATETAG'=>1,'CATEGORY_DESCRIPTION'=>1,'TYPETAG'=>1,'TYPE_DESCRIPTION'=>1,'CATEGORYTAGDETAIL'=>1,'TYPETAGDETAIL'=>1,'TOPICDETAIL'=>1,'MOREMYTOPICS1'=>1,'MOREPOPULARTOPICS1'=>1,'GETPEOPLELISTDATA'=>1,'USERREPLY'=>1,'RULEDETAIL'=>1,'USERCOUNT'=>1,'AIIADESCRIPTOR'=>1),
                    'TYPETAGS'=>array('PAGINATION'=>1,'LIKEDISLIKE'=>1),
                    'TEAM'=>array('PAGINATION'=>1),
                    'DIALOGS'=>array('DIALOGLIST'=>1, 'CREATE'=>1,'UPDATE'=>1, 'MANAGE_TOPICS'=>1,'CREATENEWDIALOG'=>1, 'UPDATEDIALOG'=>1,'MAKEDEFAULTDIALOG'=>1,'CREATEABOUT'=>1,'EDITABOUT'=>1,'ABOUT'=>1,'ADMIN'=>1),
                    'ALLPOSTS'=>array('UPDATE'=>1,'INACTIVERECORD'=>1)
                );
        }else{
            $this->data['default_permissions']=array(
                'SITE'=>array('GETCOMMENTS'=>1,'VIEWPEOPLE'=>1,'ERROR'=>1,'LOGOUT'=>1,'INDEX'=>1,'INSERTUSER'=>1,'PEOPLELIST'=>1,'DISPLAYPEOPLE'=>1,'FBLOGIN'=>1,'LOGINTWITTER'=>1,'GETPEOPLELISTDATA1'=>1,'COMFORMATIONLOGIN'=>1,'FORGOTPASSWORD'=>1,'LOGINUSER'=>1,'REGISTER'=>1,'NOTIFICATIONEMAIL'=>1, 'VIEWPEOPLEABOUT'=>1, 'TOPPOSTS'=>1, 'GETTOPCOMMENTS'=>1),
    			'ADMIN'=>array('ADMINLOGIN'=>1,'LOGOUT'=>1),
    			'TOPICS'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWTOPIC'=>1,'TOPICSLIST'=>1,'GETTOPICS'=>1,'SHOWTOPICSTAGS'=>1,'SUBMITREPLY'=>1,'TOPICANSWER'=>1,'UPDATEREPLY'=>1,'UPDATETOPIC'=>1),
                'GENERAL'=>array('QUESTIONANSWER'=>1,'SELECTCATEGORYGROUP'=>1,'CATEGORYGROUPCREATE'=>1,'ABOUT'=>1,'TEAMDETAIL'=>1,'TEAMCOUNT'=>1,'RULECOUNT'=>1,'COUNT'=>1,'REPLYCOUNT'=>1,'CATETAG'=>1,'CATEGORY_DESCRIPTION'=>1,'TYPETAG'=>1,'TYPE_DESCRIPTION'=>1,'CATEGORYTAGDETAIL'=>1,'TYPETAGDETAIL'=>1,'TOPICDETAIL'=>1,'MOREMYTOPICS1'=>1,'MOREPOPULARTOPICS1'=>1,'GETPEOPLELISTDATA'=>1,'USERREPLY'=>1,'RULEDETAIL'=>1,'USERCOUNT'=>1,'AIIADESCRIPTOR'=>1),
                'TYPETAGS'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWRULE'=>1,'RULES'=>1,'PAGINATION'=>1,'LIKEDISLIKE'=>1),
                'TEAM'=>array('GETCOMMENTS'=>1,'VIEWTHREADCOMMENT'=>1,'VIEWTEAM'=>1,'TEAMLIST'=>1,'PAGINATION'=>1),
                'DIALOGS'=>array('DIALOGLIST'=>1, 'CREATE'=>1,'UPDATE'=>1, 'MANAGE_TOPICS'=>1,'CREATENEWDIALOG'=>1, 'UPDATEDIALOG'=>1,'MAKEDEFAULTDIALOG'=>1,'CREATEABOUT'=>1,'EDITABOUT'=>1,'ABOUT'=>1,'ADMIN'=>1),
                'ALLPOSTS'=>array('UPDATE'=>1,'INACTIVERECORD'=>1)
            );
        }
        
    	$this->getUserGroups();
    	
    	if(isset($this->data['group_id']) && $this->data['group_id'] > 0){
    		$this->getPermissionArray();
    	}
    	$this->checkUserPermissions();
        
    }
    
    /*
    protected function beforeAction($event)
    {
        if(empty(Yii::app()->session['user_id']) || Yii::app()->session['user_id']=="" || (Yii::app()->session['group_id'] != 1 && Yii::app()->session['group_id'] != 3)){
            if(strtolower(Yii::app()->controller->id)=='admin' || Yii::app()->controller->action->id=="admin") 
            {
                $this->redirect(Yii::app()->createUrl('dialogs/DialogList'));exit();
            }
           
        }
        return true;
    }*/
    
    public function getUserGroups()
    {
    	$groups=array();
    	$user_groups = Groups::model()->findAll();
    	if(isset($user_groups) && count($user_groups) > 0){
    		foreach($user_groups as $user_group){
    			$groups[strtoupper($user_group->slug)]=$user_group->id;
    		}
    	}
    	$this->data['groups']=$groups;
    
    	//print_r($this->data['groups']); die;
    }

    public function getPermissionArray(){
    	$groups_permissions = Yii::app()->db->createCommand()
    	->select('m.name,ma.action')
    	->from('groups_module_actions gma')
    	->join('module_actions ma','gma.module_action_id=ma.id')
    	->join('modules m','m.id=ma.module_id')
    	->where('group_id='.$this->data['group_id'])
    	->queryAll();
    	$this->data['groups_permissions']=$this->formatPermissionArray($groups_permissions);
    }
    
    private function formatPermissionArray($groups_permissions=array()){
    	$permission_arr = array();
    	if(count($groups_permissions) > 0){
    		foreach($groups_permissions as $permission){
    			$permission_arr[strtoupper($permission['name'])][strtoupper($permission['action'])]=true;
    		}
    	}
    	return $permission_arr;
    }
    
	private function checkUserPermissions(){
      $route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
        if(isset($route) && $route!=''){
            $path_arr = explode('/',$route);
            if(isset($path_arr[0]) && $path_arr[1]){
               $controller = strtoupper($path_arr[0]);
                $action = strtoupper($path_arr[1]);
            }elseif(isset($path_arr[0])){
                $controller = strtoupper($path_arr[0]);
                $action='INDEX';
            }
            //echo $controller."<br>".$action;
            //echo "<pre>";
           	//print_r($this->data['default_permissions'][$controller][$action]) ;
            //die;  
           if(isset($this->data['default_permissions'][$controller][$action]) || $action=='CAPTCHA'){
                if($this->data['login_check_stauts']){
                    //$this->redirect(Yii::app()->createUrl("Site/loginUser"));
                    //$this->redirect(array('Site/loginUser'));  
                }
                return true;
            }elseif(!isset($this->data['groups_permissions']) || !isset($this->data['groups_permissions'][$controller][$action])){
                if(isset($this->data['group_id']) && $this->data['group_id'] > 0){
                   
                   if(isset($this->data['default_permissions'][$controller][$action]) || $action=='CAPTCHA'){
                      return true;
                    }else{
            		  $this->redirect(array('/adminlogin'));  
            		}
            	}else{
            		$route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
            		$path_arr = explode('/',$route);
            		$name = $path_arr[0];
            		$actionname = $path_arr[1];
            		$modulemodel = Modules::model()->find(array('condition'=>'name = "'.$name.'"'));
            		if($modulemodel){
            			$actionmodel = ModuleActions::model()->find(array('condition'=>'module_id='.$modulemodel->id.' AND action="'.$actionname.'"'));
            			if($actionmodel){
            				$groupactionmodel = GroupsModuleActions::model()->find(array('condition'=>'module_action_id ='.$actionmodel->id,'order'=>'group_id DESC'));
            				if($groupactionmodel->group_id == $this->data['groups']['SUPERADMIN']){
            					
                                $this->redirect(array('/adminlogin'));
            				}else{
            					$this->redirect(Yii::app()->createUrl('site/LoginUser'));
            				}
            			}
            		}           		
            	}
            }
        }else{
            return true;
        }  
    }
    
    
/*	private function checkUserPermissions(){
		$route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
        if(isset($route) && $route!=''){
            $path_arr = explode('/',$route);
            if(isset($path_arr[0]) && $path_arr[1]){
            	$controller = strtoupper($path_arr[0]);
                $action = strtoupper($path_arr[1]);
            }elseif(isset($path_arr[0])){
                $controller = strtoupper($path_arr[0]);
                $action='INDEX';
            }
            
            if(isset($this->data['default_permissions'][$controller][$action]) || $action=='CAPTCHA'){
                return true;
            }else if(!empty($this->data['groups_permissions']) && !empty($this->data['groups_permissions'][$controller][$action])){
                return true;
            }else{
                
        		$route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
        		$path_arr = explode('/',$route);
        		$name = $path_arr[0];
        		$actionname = $path_arr[1];
        		$modulemodel = Modules::model()->find(array('condition'=>'name = "'.$name.'"'));
        		if($modulemodel){
        		  
        			$actionmodel = ModuleActions::model()->find(array('condition'=>'module_id='.$modulemodel->id.' AND action="'.$actionname.'"'));
        			if($actionmodel){
        			     
        				$groupactionmodel = GroupsModuleActions::model()->find(array('condition'=>'module_action_id ='.$actionmodel->id,'order'=>'group_id DESC'));
        				if($groupactionmodel->group_id == $this->data['groups']['SUPERADMIN']){
                            $this->redirect(Yii::app()->createUrl('adminlogin'));
        				}else if($groupactionmodel->group_id == $this->data['groups']['USER']){
                           //echo Yii::app()->createUrl('wedialog.net');exit;
                           $this->redirect(Yii::app()->createUrl('site/LoginUser'));
        				}else{
        					$this->redirect(Yii::app()->createUrl(''));
        				}
        			}else{
        			 
                        $this->redirect(Yii::app()->createUrl('')); 
        			}
                    
        		}else{
        		  
                    $this->redirect(Yii::app()->createUrl(''));
        		}                
            }
        }else{
        	return true;
    	}  
	}   */ 
    
    
    
	public function getFacebookDetails(){
			/*$result = array();
            $result["appid"] = '463702543834620';
            $result["secret"] = 'c4d3e8e2588adda245dc35440145374d';
            return $result;*/
           /* OLD key of some one
            $result = array();
            $result["appid"] = '1428097520739186';
            $result["secret"] = 'acc35a2fbd298d0771f27379c9da9f0d';
            return $result;
            */
	} 
       
    public function sendCustomEmail($templatename,$subject,$to,$from,$fromname=''){
    	/*
    	//$fromname= 'Sigma Topics';
		$fromname= 'Wedialog';
        $msg = $this->renderPartial('/emailTemplatespage/'.$templatename,$this->data,true);
        $headers = "MIME-Version: 1.0\r\n" . 
                   "Content-type: text/html; charset=iso-8859-1\r\n" . 
                   "From: $fromname <$from>" . "\r\n" . 
				   "Reply-To: {$from}";
        return mail($to,$subject,$msg,$headers);
		*/
		
		//$to = "atulmeetme@gmail.com";
		//$to1 = "ivanek.ivan@gmail.com";
		
		$fromname = 'Wedialog';
		$msg = $this->renderPartial('/emailTemplatespage/'.$templatename,$this->data,true);
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
		$mail->SMTPAuth = true;
		
		$smtp_host = "server99.siliconinfo.com";
		$smtp_email = "wedialog-info@wedialog.net";
		$email_pass = "Rovinj2005";
		$email_from = $from;
		
        $mail->Host = $smtp_host;
        $mail->Port = '465';
        $mail->Username = $smtp_email;
        $mail->Password = $email_pass;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl"; 
        
		$email_from = "$fromname";

        $mail->SetFrom($mail->Username, $email_from);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($msg);
        $mail->AddAddress($to);
        //$mail->AddAddress($to1);
        return $mail->Send();
    }
}