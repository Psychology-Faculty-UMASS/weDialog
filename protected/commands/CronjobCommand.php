<?php
class CronjobCommand extends CConsoleCommand {

    public function run($args) {
        // your code will come here...
	//echo "here";
	/*
	if(isset($_SERVER['HTTPS']))
		$protocol="https://";
	else
		$protocol="http://";

	$actual_link = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	echo $actual_link;exit;*/

	//echo dirname(__FILE__);exit;
        $email_notification = EmailTemplates::model()->findByPk(3);
        if($email_notification->notification_flag == 1){
            //$current_date = date("Y-m-d 00:00:00");
    		$all_post=AllPosts::model()->findAll(array('condition'=>'created_date >= date_sub( now( ) , INTERVAL 24 HOUR )','group'=>'main_id'));
            if(count($all_post)>0){
            $html = '<ul style="list-style-type:disc;color:#0000FF;padding-top:0px;">';
                    $dialogsArray = array();
                    $dialogsArray['dialogTopic'] = array();
        		foreach ($all_post as $allpost){
        				if($allpost->post_type == 1){
                                            if(!is_null($allpost->topic_table_relation->dialog_id))
                                            {
                                                $dialog = Dialogs::model()->findByPk($allpost->topic_table_relation->dialog_id);
        					$topic = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date >= date_sub( now( ) , INTERVAL 24 HOUR )'));
                                                if(!array_key_exists($allpost->topic_table_relation->dialog_id, $dialogsArray['dialogTopic']))
                                                {
                                                    $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id] = array();
                                                    $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count'] = count($topic);
                                                    $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['name'] = $dialog->dialog_title;
                                                }
                                                else
                                                {
                                                    $dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count'] = (int)$dialogsArray['dialogTopic'][$allpost->topic_table_relation->dialog_id]['count']+count($topic);
                                                }
                                            }
                           /*$html .= ' <li>
                                        <a style="color:#498BF4;" href="'.Yii::app()->params['full_path_topics'].'?topic_id='.$allpost->main_id.'">'.$allpost->topic_table_relation->topic_title.'</a>
                                        ('.count($topic).')
                                      </li>';*/
        				
                        }/*elseif($allpost->post_type == 2){
        					$rulls = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date >= date_sub( now( ) , INTERVAL 24 HOUR )'));
                           $html .= '<li>
                                        <a style="color:#498BF4;" href="'.Yii::app()->params['full_path_rules'].'?tag_id='.$allpost->main_id.'">'.$allpost->rule_table_relation->type_tag.'</a>
                                        ('.count($rulls).')
                                    </li>';
        				
                        }elseif($allpost->post_type == 3){
        					$team = AllPosts::model()->findAll(array('condition'=>'main_id='.$allpost->main_id.' AND created_date >= date_sub( now( ) , INTERVAL 24 HOUR )'));		
                           $html .= '<li>
                                        <a style="color:#498BF4;" href="'.Yii::app()->params['full_path_teams'].'?id='.$allpost->main_id.'">'.$allpost->team_table_relation->name.'</a>
                                        ('.count($team).')
                                    </li>';
                        }*/
                }
                uasort($dialogsArray['dialogTopic'], function($a, $b) {
                if ($a['count']==$b['count']) return 0;
                    return ($a['count']>$b['count'])?-1:1;
                });
                foreach($dialogsArray['dialogTopic'] as $key=>$val)
                {
                    if($val['count']==0)
                        continue;
                    $html .= ' <li>
                        <a style="color:#498BF4;" href="'.Yii::app()->params['full_path_dialogs'].'?dialog_id='.$key.'">'.$val['name'].'</a>
                        ('.$val['count'].')
                      </li>';
                }
                $html .= '</ul>';
                $user_model = Users::model()->findAll(array('condition'=>'status="Active"'));
                if(isset($user_model) && count($user_model) > 0){
    		$from = Yii::app()->params['adminEmail'];
    		//$replayTo = Yii::app()->params['adminReplayEmail'];
                    foreach($user_model as $user){
                        $to = $user->email;
            	    //$from = $this->data['settings']['DEFAULT']['EMAIL'];
            	    $subject = $email_notification->subject;
                        $templatename = 'dynemic_template';
                        $content = str_replace("#NAME#",$user->username,$email_notification->description);
                        $content = str_replace("#POSTDETAILS#",$html,$content);
                        //$this->data['content'] = $content;
    	
    		    $fromname= 'Wedialog';
                
                //$msg = $this->renderPartial('/emailTemplatespage/'.$templatename,$content,true);
                //echo $content;exit;
                $headers = 'MIME-Version: 1.0' . "\r\n" . 
                           'Content-type: text/html; charset=iso-8859-1' . "\r\n" . 
                           "From: $fromname <$from>" . "\r\n" . 
    					   "Reply-To: {$from}";
                //mail($to,$subject,$content,$headers);
                //mail("ivanek.ivan@gmail.com",$subject,$content,$headers);
                //mail("hunanyan.areg21@gmail.com",$subject,$content,$headers);
                    }
                }
            
            }
        }
    }

}

/*
to tun this code from cron

a. php cron.php cronjob
b. php protected/yiic cronjob


following is used for run this code from controller's action genetally it is not used but for information.
Yii::import('application.commands.*');
    $command = new CronjobCommand("test", "test");
    $command->run(null);
*/
