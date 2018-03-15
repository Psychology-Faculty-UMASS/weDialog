<style type="text/css">
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.js"></script>
<script>
$(document).ready(function(){
    $("#more,#topic_title").click(function() {
        $("#toggle_column").toggle();
        $("#show_tbl_detail").toggle();
        if($("#more").html()=="More"){
            $("#more").html("Less");
        }else{
            $("#more").html("More");
        }
    });
    
    $("#postamessage").click(function() {
        $("#showmessage").show();
        $("#postamessage").hide();
    });
    
    $("#closemessage").click(function() {
        $("#showmessage").hide();
        $("#postamessage").show();
       
    });
    
    $(".postareply").click(function() {
    	
    	var tmp_comment_id=$(this).attr("id");
    	var tmp_comment_array = tmp_comment_id.split("_");

       	$("#comment_id").val(tmp_comment_array[0]);
        $("#showreply").show();
        $("#postareply").hide();
        
        //alert(comment_id);
        var username= '@'+$("#usercomment_"+tmp_comment_id).val()+'-';

        $("#topic-reply-form textarea[id=Topics_topic_title]").html(username);
                
        $("#showreply").show();
        $("#postareply").hide();
    });
    $("#closereply").click(function() {
        $("#showreply").hide();
        $("#postareply").show();
       
    });
});
</script>
<script type="text/javascript">
function likedislikecommentfun(comment_id,likedislike){
    //alert(comment_id);
    //alert(likedislike);return false;
    if(comment_id=="")
    {alert("hi");return false;
         document.getElementById('Event_location_id').innerHTML="<option value=''>Please Select Location</option>";
         $('#Event_location_id').attr("disabled",true);
    }else{
        //$.blockUI({ css: { backgroundColor: '#00A4B3', color: '#fff'} });
        $.ajax ( {
            type: "POST",
            url: '<?php echo Yii::app()->createUrl('general/count') ;?>',
            data: "comment_id="+comment_id+"&likedislike="+likedislike,
            success: function(response){
                //alert(response)
                if(response == "fail"){
                    alert("Error");
                }else if(response == "exist"){
                   // alert("Popat");
                }else{
                    if(likedislike == "like"){
                        $("#likecount_"+comment_id).html(response);
                    }else if(likedislike == "dislike"){
                        $("#dislikecount_"+comment_id).html(response);    
                    }
                }
           }
        });
    }       
}

function likedislikereplyfun(reply_id,likedislike){
    //alert(reply_id);
    //alert(likedislike);return false;
    if(reply_id=="")
    {alert("hi");return false;
    }else{
        //$.blockUI({ css: { backgroundColor: '#00A4B3', color: '#fff'} });
        $.ajax ( {
            type: "POST",
            url: '<?php echo Yii::app()->createUrl('general/replycount') ;?>',
            data: "reply_id="+reply_id+"&likedislike="+likedislike,
            success: function(response){
                //alert(response)
                if(response == "fail"){
                    alert("Error");
                }else if(response == "exist"){
                   // alert("Popat");
                }else{
                    if(likedislike == "like"){
                        $("#likecount_"+reply_id).html(response);
                    }else if(likedislike == "dislike"){
                        $("#dislikecount_"+reply_id).html(response);    
                    }
                }
           }
        });
    }       
}
</script>

<tr>
	<td colspan="3">
    	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td class="logo" style="width:20%"><a href="#"><img src="<?php echo Yii::app()->createUrl()?>/images/logo.png" width="179" height="52" /></a></td>
                <td class="page_title">Topic</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td class="left_column">
        <table class="content_box form_lable" style="width:98%;">
            <tr>
                <td height="20" style="text-align: left;padding-left: 25px !important;color: black;">
                  <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id))?>">My Topics </a>  
                <span>
                  <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: silver; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchtopics'=>'popular'))?>">Popular </a>
                </span>
                </td>
            </tr>
            <?php $i=0;
             foreach($MyTopicList as $MyTopics){
             if($i==10){?>
                <tr>
                    <td height="20" style="text-align: left;padding-left: 25px !important;">
                    <?php echo "More"; ?>
                    </td>
                </tr>
             <? }else{ ?>
                <tr>
                    <td height="20" style="text-align: left;padding-left: 25px !important;">
                    (<?php echo $i+1; ?>)&nbsp;
                    <?php echo ucwords($MyTopics->topic_title);?>
                    </td>
                </tr>
           <?php $i++; }} ?>
        </table>
    </td>
     <td class="middle_column" >
        <table class="content_box form_lable" style="width:98%; vertical-align: top;display: none;" >
            	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; "><?php echo ucwords($TopicModel->topic_title);?>
                
                    <?php
                    if($TopicModel->user_id == Yii::app()->session['user_id']){
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('topics/updatetopic',array('topic_id'=>$TopicModel->id))?>" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Topic</a>
                    <?php
                    }
                    ?>
                </td>
        </table>
        <table style="width:98%; vertical-align: top;display: none;" id="toggle_column" >
            <tr>
                <td>
                    <table class="content_box form_lable" style="width:98%; vertical-align: top;">
                       <!--
                        <tr>
                            <td>
                             
                                <table style="width:98%; vertical-align: top;" id="postamessage">
                                    <tr>
                                        <td height="30" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;"> Post A Messsage </td>
                                    </tr>
                                </table>
                                <table  style="width:98%; vertical-align: top; display: none;" id="showmessage">
                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                        											'id'=>'topic-comment-form',
                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                        											'enableAjaxValidation'=>false,
                                        										    'enableClientValidation'=>true,
                                        										    'clientOptions'=>array(
                                        																'validateOnSubmit'=>true,
                                        													        ),
                                        										)
                                        						);
                                        ?>
                                        <tr>
                                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;" > Post A Messsage
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
                                
                                                <?php
                                                    echo $form->textArea($TopicModel,'topic_title',array("class"=>"input_box"));
                                                ?>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td style="float: right;">
                                                <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/create-1.png" width="65" height="25" />
                                            </td>
                                            <td style="float: right;" id="closemessage">
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
                                            </td>
                                        </tr>
                                        <?php $this->endWidget(); ?>
                               </table>
                               
                           </td>
                       </tr>-->
                    </table>
                    <table class="content_box form_lable" style="width:98%; vertical-align: top;">
                            
                        <tr>
                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; "><?php echo ucwords($TopicModel->topic_title);?>
                            
                                <?php
                                if($TopicModel->user_id == Yii::app()->session['user_id']){
                                ?>
                                <a href="<?php echo Yii::app()->createUrl('topics/updatetopic',array('topic_id'=>$TopicModel->id))?>" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Topic</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td class="fontweight">
                        	    <?php echo $TopicModel->topic_description;?>
                        	</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td style="vertical-align: top; ">
                        	    Category Tag
                        	</td>
                        </tr>
                        <tr>
                        	<td class="fontweight">
                        	    <?php echo $TopicModel->category_tags;?>
                        	</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td style="vertical-align: top; ">
                        	    Type Tag
                        	</td>
                        </tr>
                        <tr>
                        	<td class="fontweight">
                        	    <?php echo $TopicModel->type_tags;?>
                        	</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; ">CreatedBy/Date</td>
                        </tr>
                        <tr>
                        	<td class="fontweight">
                                <table>
                                    <tr>
                                         <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                           <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->topics_username->id))?>"> <?php echo $TopicModel->topics_username->username;?></a>/        
                                        </td>
                                        
                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                            <?php
                                            $stringtime= strtotime($TopicModel->created_date);
                                            echo date('d-m-Y',$stringtime);?>     
                                        </td>
                                    </tr>
                                </table>
                        	</td>
                        </tr>
                        <tr>
                        	<td height="5"></td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            
            
            
         </table>
         
                           
         <table style="width:98%; vertical-align: top" id="show_tbl_detail">
        	<tr>
            	<td class="middle_column">
                          <table  style="width:98%; vertical-align: top;">
                            <tr>
                                <td  style="text-align: left;!important;color: black;width: 25px;font-size: 12px;font-weight: bold;padding-left: 5px;;" >Type:</td>
                                <td style="color: #125D90;font-size: 12px;font-weight: bold;">
                                 <?php echo $TopicModel->type_tags;?>
                                </td>
                            </tr>
                          </table>
                          <table class="content_box form_lable" style="width:98%; vertical-align: top;">
                                <tr>
                                    <td>
                                        <table style="width:98%; vertical-align: top;">
                                            <tr>
                                                <td height="20" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;"> 
                                                <table style="width:98%; vertical-align: top;" id="postamessage">
				                                    <tr>
				                                        <td height="30" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;"> Post A Messsage </td>
				                                    </tr>
				                                </table>
				                                <table  style="width:98%; vertical-align: top; display: none;" id="showmessage">
				                                        <?php
				                                        $form = $this->beginWidget('CActiveForm', array(
				                                        											'id'=>'topic-comment-form',
				                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
				                                        											'enableAjaxValidation'=>false,
				                                        										    'enableClientValidation'=>true,
				                                        										    'clientOptions'=>array(
				                                        																'validateOnSubmit'=>true,
				                                        													        ),
				                                        										)
				                                        						);
				                                        ?>
				                                        <tr>
				                                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;" > Post A Messsage
				                                            </td>
				                                        </tr>
				                                        <tr>
				                                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
				                                
				                                                <?php
				                                                    echo $form->textArea($TopicModel,'topic_title',array("class"=>"input_box"));
				                                                ?>
				                                                
				                                            </td>
				                                        </tr>
				                                        <tr>
				                                        	<td style="float: right;">
				                                                <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/create-1.png" width="65" height="25" />
				                                            </td>
				                                            <td style="float: right;" id="closemessage">
				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
				                                            </td>
				                                        </tr>
				                                        <?php $this->endWidget(); ?>
				                               </table>
                                                
                                                </td>
                                            </tr>
                                        </table>
                                                                                        <?php
                                                $form = $this->beginWidget('CActiveForm', array(
                                                											'id'=>'topic-reply-form',
                                                                                            //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                                											'enableAjaxValidation'=>false,
                                                										    'enableClientValidation'=>true,
                                                										    'clientOptions'=>array(
                                                																'validateOnSubmit'=>true,
                                                													        ),
                                                										)
                                                						);
                                                ?>

                                        <table  style="width:98%; vertical-align: top; display: none;" id="showreply">
                                                <tr>
                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
                                        
                                                        <?php
                                                            echo $form->textArea($TopicModel,'topic_title',array("class"=>"input_box"));
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                	<td style="float: right;">
                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/create-1.png" width="65" height="25" />
                                                        <input type="hidden" id="comment_id" name="comment_id"/>
                                                    </td>
                                                    <td style="float: right;" id="closereply">
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
                                                    </td>
                                                </tr>
                                                
                                       </table>
                                       <?php $this->endWidget(); ?>
                                   </td>
                               </tr>
                        </table>
                    
                        <table style="width:98%;">
                            <tr style="width:30px; height:30px; margin:5px 0 0 0;">
                                <td style="float:right;" >
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'mycomment'))?>">My |</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'datecomment'))?>">Date|</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'difference'))?>">Tops|</a>
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id))?>">All Messages</a>
                                </td>
                            </tr>
                        </table>
                    	<table class="content_box form_lable" style="width:98%;">
                            <?php if(isset($alltopicmodel) && count($alltopicmodel) > 0){
                        	   $cnt = 0;
                                foreach($alltopicmodel as $alltopic){
                                    
                                    ?>
                                    <tr style="float:left; width:30px; height:30px; margin:5px 0 0 0;">
                                    <td> <a href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'user_id'=>$alltopic->user_id,'searchcomment'=>'usercomment'))?>">
                                        <?php if(!empty($alltopic->user_comment->profile_image)){ ?>
                                            <img  src="<?php echo '../'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;?>" width="30" height="30"/>&nbsp;
                                        <?php }else{ ?>
                                            <img src="<?=Yii::app()->baseUrl?>/images/img-1.png" width="30" height="30">
                                        <?php }?>
                                         </a>
                                    </td>
                                    </tr>
                                    <tr style="float:left; padding-top:10px; font-size:14px;">
                                    <td><?php echo $alltopic->user_comment->username;?> &nbsp;
                                            <?php
                                            $stringtime= strtotime($alltopic->created_date);
                                            echo date('d-m-Y',$stringtime);?>
                                            at 
                                            <?php
                                            $stringtime= strtotime($alltopic->created_date);
                                            echo date('H:i',$stringtime);?>
                                            </td>
                                    </tr>
                                    <tr>
                                    	<td height="5"></td>
                                    </tr>
                            
                                    <tr style="float:left; margin:0 0 0 25px;">
                                    	<td height="20"><?php echo $alltopic->comment;?>
                                        </td>
                                    </tr>
                            
                                    <tr>
                                    	<td height="5"></td>
                                            </tr>
                                    <tr style=" width:558px; padding-left:25px;">
                                    	<td height="20">
                                            
                                                <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'like')"/>&nbsp;&nbsp;
                                                <span id="likecount_<?php echo $alltopic->id;?>"><?php echo $alltopic->like;?></span>
                                                &nbsp;
                                                <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'dislike')">&nbsp;&nbsp;
                                                <span id="dislikecount_<?php echo $alltopic->id;?>"><?php echo $alltopic->dislike;?></span>
                                                
                                           
                                           <div class="postareply" id="<?php echo $alltopic->id."_".$cnt; ?>" >Reply</div>
                                           <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $alltopic->id;?>" value="<?php echo $alltopic->user_comment->username;?>" />
                                        </td>
                                    
                                    </tr>
                                    <?php $cnt++;?>
                                    <tr>
                                    	<td><hr style="border: 1px solid red;" /></td>
                                    </tr>
                                    
                                  <!--/////////////START:COMMENT REPLY////////////////////////////////-->  
                                    
                                    
                                    <?php if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        foreach($alltopic->comment_reply as $reply){
                                            
                                            ?>
                                            
                                            
                                            
                                            <tr style="float:left; width:30px; height:30px; margin:5px 0 0 0;">
                                    <td>
                                        <?php if(!empty($alltopic->user_comment->profile_image)){ ?>
                                            <img  src="<?php echo '../'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;?>" width="30" height="30"/>&nbsp;
                                        <?php }else{ ?>
                                            <img src="<?=Yii::app()->baseUrl?>/images/img-1.png" width="30" height="30">
                                        <?php }?>
                                    </td>
                                    </tr>
                                    <tr style="float:left; padding-top:10px; font-size:14px;">
                                    <td><?php echo $reply->reply_user->username;?>:@ <?php echo $alltopic->user_comment->username;?> &nbsp;
                                            <?php
                                            $stringtime= strtotime($reply->created_date);
                                            echo date('d-m-Y',$stringtime);?>
                                            at 
                                            <?php
                                            $stringtime= strtotime($reply->created_date);
                                            echo date('H:i',$stringtime);?>
                                            </td>
                                    </tr>
                                    <tr>
                                    	<td height="5"></td>
                                    </tr>
                            
                                    <tr style="float:left; margin:0 0 0 25px;">
                                    	<td height="20"><?php echo $reply->reply;?>
                                        </td>
                                    </tr>
                            
                                    <tr>
                                    	<td height="5"></td>
                                            </tr>
                                    <tr style=" width:558px; padding-left:25px;">
                                    	<td height="20">
                                    		
                                    		<img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'like')"/>&nbsp;&nbsp;
                                            <span id="likecount_<?php echo $reply->id;?>"><?php echo $reply->like;?></span>
                                            &nbsp;
                                            <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'dislike')">&nbsp;&nbsp;
                                            <span id="dislikecount_<?php echo $reply->id;?>"><?php echo $reply->dislike;?></span>
                                                
                                           
                                           <div class="postareply" id="<?php echo $alltopic->id."_".$cnt;?>" >Reply</div>
                                           <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $reply->reply_user->id;?>" value="<?php echo $reply->reply_user->username;?>" />                                                                                      
                                        </td>
                                    			
                                    </tr>
                                    <?php $cnt++;?>
                                    <tr>
                                    	<td><hr style="border: 1px solid red;" /></td>
                                    </tr>
                                    
                                    
                                    
                                    
                                   <!-- 
                                    <tr>
                                        <td class="left_column">
                                        	<table class="content_box form_lable" style="width:98%; background:#CCC;">
                                            	<tr>
                                                	<td height="20"><?php echo $reply->reply_user->username;?>:@ <?php echo $alltopic->user_comment->username;?></td>
                                                </tr>
                                                <tr>
                                                	<td height="20"><?php echo $reply->reply;?></td>
                                                </tr>
                                                <tr>
                                                	<td height="20"> 
                                                    <?php
                                                        $stringtime= strtotime($reply->created_date);
                                                        echo date('d-m-Y',$stringtime);
                                                    ?>
                                                    at 
                                                    <?php
                                                        $stringtime= strtotime($reply->created_date);
                                                        echo date('H:i',$stringtime);
                                                    ?>
                                                                  
                                                    </td>
                                                </tr>
                                            </table>
                                      </td>
                                  </tr>
                                  -->
                                  <?php }}?>
                                  
                                  
                                <!--/////////////END:COMMENT REPLY////////////////////////////////-->
                                
                                
                                  
                                <?php }}else{?>
                                <tr>
                                    <td>There are no comments!!!!</td>
                                </tr>
                            <?php }?>
                        </table>
                    </td>
                    
            </tr>
         </table>
         
                           
    </td>
    <td class="right_column">
    	<table class="content_box form_lable" style="width:98%">
        	<tr>
            	<td height="30" id="topic_title" style="vertical-align: top; font: bolder !important;font-size: small; "><?php echo ucwords($TopicModel->topic_title);?>
                </td>
            </tr>
            <tr>
            	<td height="20" style="word-wrap: normal" class="fontweight">
            	    <?php
            	    echo substr($TopicModel->topic_description,0, 100);
            	    if(strlen($TopicModel->topic_description) > 100){
            	        echo "...";
            	    }
                    ?>
                    <div style="height: 10;" ></div>
                    <div id="more" >More</div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td height="20" style="text-align: left;!important;color: black;">
                Category:
                </td>
            </tr>
            <tr>
                <td>
            	    <?php echo $TopicModel->category_tags;?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;!important;color: black;">CreatedBy/Date:</td>
            </tr>
            <tr>
            	<td class="fontweight">
                    <table>
                        <tr>
                            <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->topics_username->id))?>"><?php echo $TopicModel->topics_username->username;?> </a>/        
                            </td>
                            <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                <?php 
                                $stringtime= strtotime($TopicModel->created_date);
                                echo date('d-m-Y',$stringtime);?>     
                            </td>
                        </tr>
                    </table>
            	</td>
            </tr>
        </table>
    </td>
</tr>