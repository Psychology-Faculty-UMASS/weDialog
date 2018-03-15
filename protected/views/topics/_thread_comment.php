<?php
		if(count($alltopic_comment)>0){
			foreach($alltopic_comment as $alltopic){
				$last_comment_id = $alltopic->id;
				$stringtime = strtotime($alltopic->created_date);

				$user_image = Yii::app()->baseUrl.'/images/img-1.png';
                if($alltopic->comment_id == 0){
                    $color = "color:#3C1B85";
                     if(!empty($alltopic->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image)){
                        $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;
                    }else{
                        $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                    }
                }else{
                    $color = "color:#999999";
                    if(!empty($alltopic->user_other_comment->user_comment->profile_image) && file_exists(Yii::app()->params['profile_img'].$alltopic->user_other_comment->user_comment->profile_image)){
                             $user_image = Yii::app()->request->baseUrl.'/'.Yii::app()->params['profile_img'].$alltopic->user_other_comment->user_comment->profile_image;
                    }else{
                        $user_image = Yii::app()->baseUrl.'/images/img-1.png';
                    }
                }
                
                $green_cnt = count($alltopic->user_green_comment);
                $red_cnt = count($alltopic->user_red_comment);
				$data_str .= '<tr id="'.$alltopic->id.'" style="background-color:#FFFFFF !important;">
								<td style="width:100%;padding-bottom:7px; ">
                                    <table style="width: 100%;margin-left: 10%;">
                                    	<tr style="width:30px; margin:6px 0 0 0;">
                                        	<td style="width:10%;vertical-align: top;">
												<a href="'.Yii::app()->createUrl("topics/viewtopic", array("topic_id"=>$TopicModel->id, "user_id"=>$alltopic->user_id, "searchcomment"=>"usercomment")).'" style="text-decoration:none;">
													<img  src="'.$user_image.'" width="50" height="50" align="left" style="padding:6px 5px 0px 0px;"/>
                                                </a>
                                                <div style="clear:both; height:3px;"></div>';
                                                if($green_cnt > 0){
                $data_str .= '<div style="background-color:green; color:white; font-size:12px; width:42%; float:left; text-align:center; margin-right:10%" title="'.$green_cnt.' Green Flags">'.$green_cnt.'</div>';
                                                }
                                                if($red_cnt > 0){
                $data_str .= '<div style="background-color:red; color:white; font-size:12px; width:42%; float:left; text-align:center;" title="'.$red_cnt.' Red  Flags">'.$red_cnt.'</div>';
                                                }
                $data_str .= '</td>
                                            <td style="vertical-align: top;">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>
                                                            <span style="color:#3C1B85;font-family: Arial,Helvetica,sans-serif;" >
                                                                <a href="'.Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id)).'" style="color: #3C1B85; font-weight: bold; text-decoration: none;">'.ucfirst($alltopic->user_comment->username).'</a>';
                                                                if($alltopic->comment_id != 0){
                                                                    $data_str .= '<span style="color:#3C1B85;"> > @ </span><a href="'.Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_other_comment->user_comment->id)).'" style="color: #3C1B85; text-decoration: none;">'.ucfirst($alltopic->user_other_comment->user_comment->username).'</a>';
                                                                }
                                                                    $data_str .= '<span style="'.$color.'"> - '.date('m-d-y',$stringtime).' at '.date('H:i',$stringtime).'</span>
                                                            </span>                                                    
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span style="text-align: justify;color: #666666;font-family: Arial,Helvetica,sans-serif;">'.$alltopic->comment.'</span>
                                                        </td>
                                                    </tr>
    											   <tr id="already_voted_message_'.$alltopic->id.'" style="background-color: #FFFA9D;display:none;border:1px solid #000000;width:128px"><td style="color:#666666;text-align: center;" colspan="2">You already voted!</td></tr>
    	                                            <tr style=" width:558px; padding-left:25px;">
    	                                            	
                                                        <td>
                                                            <table style="width:100%;">
                                                            <tr class="footer" style="float:right;width:100%;">
                                                                <td style="width:100%">
                                                                    <div>
                                                                        <div style="float:">
                                                                            <img src="'.Yii::app()->baseUrl.'/images/newgreen.jpg" id="greenup" alt="" onclick="javascript:likedislikecommentfun('.$alltopic->id.', \'like\')" style="cursor:pointer;"/>
                                                                            <span id="likecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif;">'.$alltopic->like.'</span>&nbsp&nbsp&nbsp&nbsp;
                                                                            <img src="'.Yii::app()->baseUrl.'/images/newred.jpg" id="reddown" alt="" onclick="javascript:likedislikecommentfun('.$alltopic->id.',\'dislike\')" style="cursor:pointer;" />
                                                                            <span id="dislikecount_'.$alltopic->id.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; ">'.$alltopic->dislike.'</span>
                                                                       	</div>
                                                                       <div style="float:left;width: 60%;">
                                                                            <div class="postareply" id="showtbldetail1_'.$alltopic->id.'_'.$cnt.'" style="color: #999999;font-family: Arial,Helvetica,sans-serif; float:left;margin-left:30px;width: 20%;" >
                                                                            	<span style="cursor:pointer; " onclick="javascript:reply_form_section(\''.$alltopic->id.'\');" id="reply_'.$alltopic->id.'">Reply</span>
                                                                            </div>
                                                                            <input type="hidden" id="usercomment_'.$alltopic->id.'" name="user_comment_'.$alltopic->id.'" value="'.$alltopic->user_comment->username.'" />
                                                                            <div style="float:right;width: 60%;">
                                                                                <script>function fbs_click() {u=location.href;t=document.title;window.open("https://www.facebook.com/sharer.php?u=+encodeURIComponent(u)+&t=+encodeURIComponent(t)",sharer,toolbar=0,status=0,width=626,height=436);return false;}</script>
                                                                                <style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url('.Yii::app()->baseUrl.'/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> <a rel="nofollow" href="https://www.facebook.com/sharer.php?u=http://'.$_SERVER["SERVER_NAME"].'/wedialog//topics/Viewtopic?topic_id='.$topic_id.'" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:0px 10px 0px 5px;margin:2px 0px 0px 10px;"></a> 
                                                                                <a class="twitter popup" href="http://twitter.com/share"><img src="'.Yii::app()->baseurl.'/images/twitter_icon.png"/></a>
                                                                                <div id="flag_'.$alltopic->id.'" style="cursor: pointer;;float:right;color:#075A99;width: 50%;" onclick="showhide('.$alltopic->id.');">Report</div>
                                                                                <div id="flagsub_'.$alltopic->id.'" style="display:none;border:1px solid #075A99;width: 75%;text-align: right;padding: 3%;border-radius: 5px;"><a href="javascript:void(0);" onclick="javascript:setFlagMessage('.$alltopic->id.',\'Green\');" style="text-decoration: none;color:#075A99;font-size: 15px;">Green Flag</a><br/><a href="javascript:void(0);" onclick="setFlagMessage('.$alltopic->id.',\'Red\');" style="text-decoration: none;color:#075A99;font-size: 15px;">Red Flag</a></div>
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
                                                <table style="width: 98%; vertical-align: top;">
        										  <tr id="reply_form_id_'.$alltopic->id.'" style="display:none" class="hide_row">
    													<td>
    														<form id="user-comment-form_'.$alltopic->id.'" method="post" action="'.Yii::app()->createUrl("topics/Viewtopic?topic_id=".$topic_id).'" enctype="multipart/form-data">
    															<input type="hidden" name="comment_id" value="'.$alltopic->id.'" />
    															<table style="width:98%; vertical-align: top;">
    																<tr>
    																	<td id="reply_comment_id_'.$alltopic->id.'">
    																		<textarea id="replycomment_'.$alltopic->id.'" name="replycomment_'.$alltopic->id.'" style="width:600px; height:250px;"></textarea>
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
		}
        
?>