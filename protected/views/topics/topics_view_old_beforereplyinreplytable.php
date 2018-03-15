

<style type="text/css">
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}
</style>

<style>
		.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
		.content_2{height:100px;}
		.td-conten-bg{
			background: none repeat scroll 0 0 #FFFFCC;
   			border: 1px solid #0066FF;
    		padding: 5px;
		}
		.form_lable {
			color: #125D90;
			font-size: 12px;
			font-weight: bold;
			font-family:Arial, Helvetica, sans-serif;
			padding:3px 0px;
		}
		.form_lable_normal {
			color: #125D90;
			font-size: 12px;
			font-weight: normal;
			font-family:Arial, Helvetica, sans-serif;
			padding:3px 0px;
		}
	</style>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />  
  
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.js"></script>
<script>
$(document).ready(function(){
    
    $("#more,#topic_title,#more1").click(function() {
        $("#toggle_column").toggle();
        $("#show_tbl_detail").toggle();
        if($("#more").html()=="More"){
            $("#more").html("Less");
        }else{
            $("#more").html("More");
        }
    });
    
 
 	$(document).click(function(e) {
 		if(e.target.id !="postamessagetd"){
    	   $("#showmessage").hide();
           $("#postamessage").show();
        }else{
    	   $("#showmessage").show();
           $("#postamessage").hide();
       }
       var tmp_id = e.target.id; 
        $("table[id^=showreply]").hide();
        $("#showreply_"+tmp_id).show();
        
         
        $("table[id^=1showreply]").hide();
        $("#1showreply_"+tmp_id).show();
        
        
        
   });
    
 
    
    $("#postamessage").click(function() {
        $("#showmessage").show();
        $("#postamessage").hide();
    });
    
    
    
    
    $(".postareply").click(function() {
    	var tmp_comment_id=$(this).attr("id");
    	var tmp_comment_array = tmp_comment_id.split("_");
		$("#comment_id").val(tmp_comment_array[0]);
        $("#showreply_"+tmp_comment_id).show();
        
    });
    
   
    
    
    
});

 

function topicdetailmore2(topicid){
    
       
    var topic_id=topicid;
    $.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/topicdetail') ;?>',
		        data: "topic_id="+topic_id,
		        success: function(response){
                        var topic_array= response.split("||");
                        
                       $("#topic_titlehtml").html(topic_array[0]);
                       $("#topic_title").html(topic_array[7]);
                       $("#topic_descriptionhtml").html(topic_array[6]);
                       $("#topic_descriptionhtml2").html(topic_array[1]);
                       $("#category_tagshtml").html(topic_array[2]);
                       $("#category_tagshtml2").html(topic_array[2]);
                       $("#type_tagshtml").html(topic_array[3]);
                       $("#createdbyhtml").html(topic_array[4]);
                       $("#createdbyhtml2").html(topic_array[4]);
                       $("#date1_html").html(topic_array[5]);
                       $("#date1_html2").html(topic_array[5]);

               }
		    });	
        
        $("#toggle_column").show();
        $("#rightboxtoggle").show();
        $("#show_tbl_detail").hide();
        
    
}
function alldivshow(){
    
        $("#toggle_column").hide();
        $("#rightboxtoggle").hide();
        $("#show_tbl_detail").show();
        
    
}


</script>
<script type="text/javascript">
function likedislikecommentfun(comment_id,likedislike){
    //alert(likedislike);return false;
    if(comment_id=="")
    {
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

/*
function moremytopics(){
         $.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/moremytopics1') ;?>',
		        //data: "idstr="+idstr,
		        success: function(response){
		          $("#more_id").hide();
                  $("#mytopic_left").append(response);
		            
		       }
		    });	
}
function morepopulartopics(){
         $.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/morepopulartopics1') ;?>',
		        //data: "idstr="+idstr,
		        success: function(response){
		          $("#more_id1").hide();
                  $("#topic_popular_left").append(response);
		            
		       }
		    });	
}
*/
</script>
<script type="text/javascript">
$(document).ready(function(){
   
    $("#mymessage,#datemessage,#topmessage,#allmessage").click(function() {
        
        var ID = $(this).attr("id");
        
        $("#my_detail").hide();
        $("#date_detail").hide();
        $("#top_detail").hide(); 
        $("#show_tbl_detail1").hide();
       // $("#replylist_table").hide();
 
        if(ID=='mymessage'){
            $("#my_detail").show();    
        }else if(ID=='datemessage'){
            $("#date_detail").show();    
        }else if(ID=='topmessage'){
            $("#top_detail").show();    
        }else if(ID=='allmessage'){
            $("#show_tbl_detail1").show();
        }
        
         
       
        
    });
    
    $("#click_mytopics,#click_popular").click(function() {
        
        var ID = $(this).attr("id");
        
        $("#mytopic_left").hide();
        $("#topic_popular_left").hide();
        
        if(ID=='click_mytopics'){
            $("#mytopic_left").show();    
        }else if(ID=='click_popular'){
            $("#topic_popular_left").show();    
        }
        
         
       
        
    });
    
});
</script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo Yii::app()->request->baseUrl;?>/js//minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

	<script>
		(function($){
			$(window).load(function(){
				/* custom scrollbar fn call */
				$(".content_2").mCustomScrollbar({
					scrollInertia:150
				});			
				/* 
				demo fn 
				functions below are for demo and examples
				*/
			});
		})(jQuery);
	</script>
<tr>
	<td colspan="3">
    	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td class="logo" style="width:20%"><a href="#"><img src="<?php echo Yii::app()->createUrl()?>/images/logo.png" width="179" height="52" /></a></td>
                <!-- <td class="page_title" id="more1" style="cursor: pointer;" onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')"> -->
                <td class="page_title" id="" style="cursor: pointer;" onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')">
                    <?php echo ucwords($TopicModel->topic_title);?>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td class="left_column" style="padding-top: 8px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                    <td class="td-conten-bg">
                    	<div>
                			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="mytopic_left" style="display: none;" >
                                  <tr>
                                        <td height="20" style="text-align: left;padding-left: 25px !important;color: black;">
                                          <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="click_mytopics">My Topics </a>  
                                            <span>
                                              <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: silver;cursor: pointer; " id="click_popular">Popular </a>
                                            </span>
                                        </td>
                                  </tr>
                                  <!--
                                   <tr>
                                    <td class="form_lable" onclick="javascript: alldivshow()" style="cursor: pointer;">ALL</td>
                                  </tr>-->
                                  <?php 
                                     $i = 0;
                                     foreach($MyTopicList as $MyTopics){?>
                                            <tr>
                                                
                                                    <!-- <td class="form_lable_normal" style="cursor: pointer;" onclick="javascript: topicdetailmore2('< ?php echo $MyTopics->id; ?>')">-->
                                                    <td class="form_lable_normal" style="cursor: pointer;">
                                                    <?php echo $i+1; ?>.&nbsp;
                                                    
                                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$MyTopics->id))?>">
                                                    <?php echo ucwords($MyTopics->topic_title);?>
                                                    </a>
                                                    </td>
                                                
                                            </tr>
                                      <?php
                                        $i++;
                                      } 
                                   
                                  ?>
                                </table>
                                
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="topic_popular_left" style="display: block;">
                                  <tr>
                                        <td height="20" style="text-align: left;padding-left: 25px !important;color: black;">
                                          <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="click_mytopics">My Topics </a>  
                                            <span>
                                              <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: silver;cursor: pointer; " id="click_popular">Popular </a>
                                            </span>
                                        </td>
                                  </tr>
                                  <!--
                                  <tr>
                                    <td class="form_lable" onclick="javascript: alldivshow()" style="cursor: pointer;">ALL</td>
                                  </tr>
                                  -->
                                  <?php 
                                     $i = 0;
                                     foreach($PopularTopicListModel as $MyTopics2){ ?>
                                            <tr>
                                                <!-- <td  class="form_lable_normal" style="cursor: pointer;" onclick="javascript: topicdetailmore2('< ?php echo $MyTopics2->id; ?>')">-->
                                                <td  class="form_lable_normal" style="cursor: pointer;">
                                                <?php echo $i+1; ?>.&nbsp;
                                                <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$MyTopics2->id))?>">
                                                 <?php echo ucwords($MyTopics2->topic_title);?>
                                                </a>
                                                </td>
                                            </tr>
                                   <?php
                                        $i++;
                                   } ?>
                                  
                                </table>
                                
                                
                                
                		</div>
                    </td>
              </tr>
              
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
                            
                        <tr>
                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; " id="topic_titlehtml">
                            </td>
                        </tr>
                        
                        <tr>
                        	<td class="fontweight" id="topic_descriptionhtml">
                        	</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td style="vertical-align: top; ">
                        	    Categorys Tag
                        	</td>
                        </tr>
                        <tr>
                        	<td class="fontweight" id="category_tagshtml">
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
                        	<td class="fontweight" id="type_tagshtml">
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
                                         <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="createdbyhtml">
                                                   
                                        </td>
                                        
                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="date1_html">
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
                                <td style="text-align: left;!important;color: black;width: 50px;font-size: 12px;font-weight: bold;padding-left: 5px;;" >Type:</td>
                                <td>
                                    <?php $typetag=explode(",",$TopicModel->type_tags);
                                	   for($i=0;$i<count($typetag);$i++){?>
                                       
	                                	<span class="tags">
                                            <a href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$typetag[$i],'searchtopics'=>'mytagstype'))?>" >
                                                <?php echo $typetag[$i];?>
                                            </a>
		                                </span>
		                            <?php }	
                                ?>
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
				                                        <td id="postamessagetd" height="30" style="vertical-align: top; font: bolder !important;font-size: large;color: #125D90;"> Post A Messsage </td>
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
				                                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
				                                
                                    
                                                                <?php
				                                                   echo $form->textArea($UserComment,'comment',array("class"=>"input_box","style"=>"font-size:16px"));
				                                                ?>
                                                                <!--
				                                                < ?php
                                                                    $this->widget(
                                                                        'application.extensions.NHCKEditor.CKEditorWidget', 
                                                                        array(
                                                                            'model' => $UserComment,
                                                                            'attribute' => 'comment',
                                                                            'editorOptions' => array(
								                                                 'resize_maxWidth'=>'500px',
								                                                 'resize_maxHeight'=>'300px',
								                                                 
								                                                'toolbar'=>array(
								                    
								                                                   //array('Styles','Format','Font','FontSize'),
								                    
								                                                    //array('colors','TextColor','BGColor'),
								                    
								                                                    //array('paragraph', 'NumberedList','BulletedList','-','Outdent','Indent','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
								                    
								                                                    //array('insert','Table','HorizontalRule'),
								                    
								                                                   // array('tools','Maximize'),
								                    
								                                                   // array('links','Link','Unlink','Anchor'),
								                    
								                                                    //array('editing','Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'),
								                    
								                                                  //  array('clipboard','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
								                    
								                                                  //  array('basicstyles','Bold','Italic','Underline','Strike','-','RemoveFormat'),
								                    
								                                                )
								                    
								                                            ),
                                                                            'htmlOptions' => array(
                                                                                               "class"=>"",
                                                                                             ),
                                                                        )
                                                                    );
                                                                 ? >
                                                                 -->
                                                                  
				                                            </td>
				                                        </tr>
				                                        <tr>
				                                        	<td style="float: right;" >
				                                                <input id="imagetd" type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png" />
				                                            </td>
				                                            <!-- <td style="float: right;" id="closemessage">
				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
				                                            </td> -->
				                                        </tr>
				                                        <?php $this->endWidget(); ?>
				                               </table>
                                                
                                                </td>
                                            </tr>
                                        </table>
                                        
                                   </td>
                               </tr>
                        </table>
                    
                        <table style="width:98%;">
                            <tr style="width:30px; height:30px; margin:5px 0 0 0;">
                                <td style="float:right;" >
                                    <!--
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'mycomment'))?>">My |</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'datecomment'))?>">Date|</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id,'searchcomment'=>'difference'))?>">Top|</a>
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/viewtopic',array('topic_id'=>$TopicModel->id))?>">Thread</a>
                                    -->
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " id="mymessage"  >My |</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " id="datemessage"  >Date|</a> 
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " id="topmessage"  >Top|</a>
                                    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " id="allmessage"  >Thread</a>
                                    
                                </td>
                            </tr>
                        </table>
                       
                       <!--====================START:COMMON=======================-->
                        <table class="content_box form_lable" style="width:98%;" id="replylist_table">
                        </table>
                       	<table class="content_box form_lable" style="width:98%;" id="show_tbl_detail1">
                            <?php if(isset($alltopicmodel) && count($alltopicmodel) > 0){
                        	    $cnt = 0;
                                foreach($alltopicmodel as $alltopic){
                                    if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        $background_color="background-color:#FFFFCC !important;";
                                    }else{
                                        $background_color="background-color:#FFFFCC !important;";
                                    }
                                    
                                    ?>
                                <tr id="<?php echo $alltopic->id;?>" style="<?php echo $background_color ?>">
                                    <td style="width:100%">
                                        <table style="width: 100%;">
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"> <?php echo $alltopic->user_comment->username;?> </a> &nbsp;
                                                        <?php
                                                        $stringtime= strtotime($alltopic->created_date);
                                                        echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><?php echo $alltopic->comment;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                                    </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                                    
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'like')"/>&nbsp;&nbsp;
                                                        <span id="likecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 12px;font-weight: bold;"><?php echo $alltopic->like;?></span>
                                                        &nbsp;
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'dislike')">&nbsp;&nbsp;
                                                        <span id="dislikecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 12px;font-weight: bold;"><?php echo $alltopic->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt; ?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;" >Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $alltopic->id;?>" value="<?php echo $alltopic->user_comment->username;?>" />
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                            	<td>
                                            		        <?php 
                                                        $form = $this->beginWidget('CActiveForm', array(
                                                        											'id'=>'topic-reply-formss',
                                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                                        											'enableAjaxValidation'=>false,
                                                        										    'enableClientValidation'=>true,
                                                        										    'clientOptions'=>array(
                                                        												'validateOnSubmit'=>true,
                                                        											),
                                                        										)
                                                        						);
                                                        ?>
        
        				                                        <table  style="width:98%; vertical-align: top; display:none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box","style"=>"resize: none;width:565px;height:200px","id"=>"showreply_'".$alltopic->id."'_".$cnt));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
                                                                        
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                        	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                 <tr>
                                       <td><hr style="border: 1px solid red;" /></td>
                                 </tr>                                
                                    
                                  <!--/////////////START:COMMENT REPLY////////////////////////////////-->  
                                    
                                    
                                    <?php if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        foreach($alltopic->comment_reply as $reply){
                                            
                                            ?>
                                            
                                    <tr style="background-color:#9ABBE3 !important;">
                                     <td style="width:100%">
                                        <table style="width: 100%;">        
                                            <tr style="float:left; width:30px; height:30px; margin:5px 0 0 0;">
                                                <td id="user_reply_img" onclick="javascript: user_reply_img('<?php echo $reply->user_id; ?>','<?php echo $_GET['topic_id']; ?>')">
                                                        <?php if(!empty($alltopic->user_comment->profile_image)){ ?>
                                                            <img  src="<?php echo '../'.Yii::app()->params['profile_img'].$alltopic->user_comment->profile_image;?>" width="30" height="30" />&nbsp;
                                                        <?php }else{ ?>
                                                            <img src="<?=Yii::app()->baseUrl?>/images/img-1.png" width="30" height="30" >
                                                        <?php }?>
                                                </td>
                                            </tr>
                                            <tr style="float:left; padding-top:10px; font-size:14px;">
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$reply->reply_user->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $reply->reply_user->username;?> </a>:@ <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $alltopic->user_comment->username;?></a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($reply->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><?php echo $reply->reply;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                                    </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                            		
                                            		<img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'like')"/>&nbsp;&nbsp;
                                                    <span id="likecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><?php echo $reply->like;?></span>
                                                    &nbsp;
                                                    <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'dislike')">&nbsp;&nbsp;
                                                    <span id="dislikecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;"><?php echo $reply->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif; font-size: 14px;font-weight: bold;">Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $reply->reply_user->id;?>" value="<?php echo $reply->reply_user->username;?>" />                                                                                      
                                                </td>
                                            			
                                            </tr>
                                            
                                            <tr>
                                            	<td>
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
        
        				                                        <table  style="width:98%; vertical-align: top; display: none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box","id"=>"showreply_'".$alltopic->id."'_".$cnt));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                  <tr>
                                    <td><hr style="border: 1px solid red;" /></td>
                                  </tr>  
                                  <?php }}?>
                                  
                                  
                                <!--/////////////END:COMMENT REPLY////////////////////////////////-->
                                
                                  
                                <?php }}else{?>
                                <tr>
                                    <td>There are no comments!!!!</td>
                                </tr>
                            <?php }?>
                        </table>
                        
                        <!--====================END:COMMON=====================================================-->
                        <!--====================START:MY=====================================================-->
                        <table class="content_box form_lable" style="width:98%;display: none;" id="my_detail">
                            <?php if(isset($alltopicmymodel) && count($alltopicmymodel) > 0){
                        	   $cnt = 0;
                                foreach($alltopicmymodel as $alltopic){
                                    if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        $background_color="background-color:#FFFFCC !important;";
                                    }else{
                                        $background_color="background-color:#FFFFCC !important;";
                                    }
                                    ?>
                                <tr id="<?php echo $alltopic->id;?>" style="<?php echo $background_color ?>">
                                    <td style="width:100%">
                                        <table style="width: 100%;">
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"> <?php echo $alltopic->user_comment->username;?> </a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($alltopic->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->comment;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                                    </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                                    
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'like')"/>&nbsp;&nbsp;
                                                        <span id="likecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->like;?></span>
                                                        &nbsp;
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'dislike')">&nbsp;&nbsp;
                                                        <span id="dislikecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt; ?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;" >Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $alltopic->id;?>" value="<?php echo $alltopic->user_comment->username;?>" />
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                            	<td>
                                            		        <?php 
                                                        $form = $this->beginWidget('CActiveForm', array(
                                                        											'id'=>'topic-reply-formss',
                                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                                        											'enableAjaxValidation'=>false,
                                                        										    'enableClientValidation'=>true,
                                                        										    'clientOptions'=>array(
                                                        												'validateOnSubmit'=>true,
                                                        											),
                                                        										)
                                                        						);
                                                        ?>
        
        				                                        <table  style="width:98%; vertical-align: top; display:none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box","style"=>"resize: none;width:565px;height:200px"));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
                                                                        
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                 <tr>
                                       <td><hr style="border: 1px solid red;" /></td>
                                 </tr>                                
                                    
                                    
                                  <!--/////////////START:COMMENT REPLY////////////////////////////////-->  
                                    
                                    
                                    <?php if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        foreach($alltopic->comment_reply as $reply){
                                            
                                            ?>
                                            
                                   <tr style="background-color:#9ABBE3 !important;">
                                     <td style="width:100%">
                                        <table style="width: 100%;">        
                                            
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$reply->reply_user->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $reply->reply_user->username;?> </a>:@ <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $alltopic->user_comment->username;?></a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($reply->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->reply;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                                    </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                            		
                                            		<img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'like')"/>&nbsp;&nbsp;
                                                    <span id="likecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->like;?></span>
                                                    &nbsp;
                                                    <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'dislike')">&nbsp;&nbsp;
                                                    <span id="dislikecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;" >Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $reply->reply_user->id;?>" value="<?php echo $reply->reply_user->username;?>" />                                                                                      
                                                </td>
                                            			
                                            </tr>
                                    
                                            <tr>
                                            	<td>
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
        
        				                                        <table  style="width:98%; vertical-align: top; display: none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                  <tr>
                                    <td><hr style="border: 1px solid red;" /></td>
                                  </tr>  
                                    
                                  <?php }}?>
                                  
                                  
                                <!--/////////////END:COMMENT REPLY////////////////////////////////-->
                                
                                  
                                <?php }}else{?>
                                <tr>
                                    <td>There are no comments!!!!</td>
                                </tr>
                            <?php }?>
                        </table>
                        
                        
                        <!--====================END:MY=====================================================-->
                        <!--====================START:DATE=====================================================-->
                        
                        <table class="content_box form_lable" style="width:98%;display: none" id="date_detail">
                            <?php if(isset($alltopicdatemodel) && count($alltopicdatemodel) > 0){
                        	   $cnt = 0;
                                foreach($alltopicdatemodel as $alltopic){
                                    if(isset($alltopic->comment_reply_date) && count($alltopic->comment_reply_date) > 0){
                                        $background_color="background-color:#FFFFCC !important;";
                                    }else{
                                        $background_color="background-color:#FFFFCC !important;";
                                    }
                                    ?>
                                <tr id="<?php echo $alltopic->id;?>" style="<?php echo $background_color ?>">
                                    <td style="width:100%">
                                        <table style="width: 100%;">
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"> <?php echo $alltopic->user_comment->username;?> </a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($alltopic->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->comment;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                            </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                                    
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'like')"/>&nbsp;&nbsp;
                                                        <span id="likecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->like;?></span>
                                                        &nbsp;
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'dislike')">&nbsp;&nbsp;
                                                        <span id="dislikecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt; ?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;">Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $alltopic->id;?>" value="<?php echo $alltopic->user_comment->username;?>" />
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                            	<td>
                                            		        <?php 
                                                        $form = $this->beginWidget('CActiveForm', array(
                                                        											'id'=>'topic-reply-formss',
                                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                                        											'enableAjaxValidation'=>false,
                                                        										    'enableClientValidation'=>true,
                                                        										    'clientOptions'=>array(
                                                        												'validateOnSubmit'=>true,
                                                        											),
                                                        										)
                                                        						);
                                                        ?>
        
        				                                        <table  style="width:98%; vertical-align: top; display:none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box","style"=>"resize: none;width:565px;height:200px"));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
                                                                        
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                 <tr>
                                       <td><hr style="border: 1px solid red;" /></td>
                                 </tr>            
                                    
                                  <!--/////////////START:COMMENT REPLY////////////////////////////////-->  
                                    
                                    
                                    <?php if(isset($alltopic->comment_reply_date) && count($alltopic->comment_reply_date) > 0){
                                        
                                        foreach($alltopic->comment_reply_date as $reply){
                                            
                                            ?>
                                            
                                     <tr style="background-color:#9ABBE3 !important;">
                                        <td style="width:100%">
                                            <table style="width: 100%;">
                                            
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
                                                        <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$reply->reply_user->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $reply->reply_user->username;?> </a>:@ <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"><?php echo $alltopic->user_comment->username;?></a> &nbsp;
                                                                <?php
                                                                $stringtime= strtotime($reply->created_date);
                                                                echo date('m-d-Y',$stringtime);?>
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
                                                	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->reply;?>
                                                    </td>
                                                </tr>
                                        
                                                <tr>
                                                	<td height="5"></td>
                                                </tr>
                                                <tr style=" width:558px; padding-left:25px;">
                                                	<td height="20">
                                                		
                                                		<img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'like')"/>&nbsp;&nbsp;
                                                        <span id="likecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->like;?></span>
                                                        &nbsp;
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'dislike')">&nbsp;&nbsp;
                                                        <span id="dislikecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->dislike;?></span>
                                                            
                                                       
                                                       <div class="postareply" id="<?php echo $alltopic->id."_".$cnt;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;">Reply</div>
                                                       <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $reply->reply_user->id;?>" value="<?php echo $reply->reply_user->username;?>" />                                                                                      
                                                    </td>
                                                			
                                                </tr>
                                                
                                                <tr>
                                                	<td>
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
            
            				                                        <table  style="width:98%; vertical-align: top; display: none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
            				                                                <tr>
            				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
            				                                        
            				                                                        <?php
            				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
            				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
            				                                               			 ?>
            				                                                        
            				                                                    </td>
            				                                                </tr>
            				                                                <tr>
            				                                                	<td style="float: right;">
            				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
            				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
            				                                                    </td>
            				                                                    <!-- <td style="float: right;" id="closereply">
            				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
            				                                                    </td> -->
            				                                                </tr>
            				                                                
            				                                       </table>
            				                                       <?php $this->endWidget(); ?>
                                                	</td>
                                                </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                  <tr>
                                    <td><hr style="border: 1px solid red;" /></td>
                                  </tr>  
                                  <?php }}?>
                                  
                                  
                                <!--/////////////END:COMMENT REPLY////////////////////////////////-->
                                
                                  
                                <?php }}else{?>
                                <tr>
                                    <td>There are no comments!!!!</td>
                                </tr>
                            <?php }?>
                        </table>
                        
                        <!--====================END:DATE=====================================================-->
                        
                        <!--====================START:TOP=====================================================-->
                        
                        <table class="content_box form_lable" style="width:98%;display: none" id="top_detail">
                            <?php if(isset($alltopictopsmodel) && count($alltopictopsmodel) > 0){
                        	   $cnt = 0;
                                foreach($alltopictopsmodel as $alltopic){
                                    if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        $background_color="background-color:#FFFFCC !important;";
                                    }else{
                                        $background_color="background-color:#FFFFCC !important;";
                                    }
                                    ?>
                                <tr id="<?php echo $alltopic->id;?>" style="<?php echo $background_color ?>">
                                    <td style="width:100%">
                                        <table style="width: 100%;">
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"> <?php echo $alltopic->user_comment->username;?> </a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($alltopic->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->comment;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                            </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                                    
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'like')"/>&nbsp;&nbsp;
                                                        <span id="likecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->like;?></span>
                                                        &nbsp;
                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikecommentfun(<?php echo $alltopic->id;?>,'dislike')">&nbsp;&nbsp;
                                                        <span id="dislikecount_<?php echo $alltopic->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $alltopic->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt; ?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;">Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $alltopic->id;?>" value="<?php echo $alltopic->user_comment->username;?>" />
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                            	<td>
                                            		        <?php 
                                                        $form = $this->beginWidget('CActiveForm', array(
                                                        											'id'=>'topic-reply-formss',
                                                                                                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
                                                        											'enableAjaxValidation'=>false,
                                                        										    'enableClientValidation'=>true,
                                                        										    'clientOptions'=>array(
                                                        												'validateOnSubmit'=>true,
                                                        											),
                                                        										)
                                                        						);
                                                        ?>
        
        				                                        <table  style="width:98%; vertical-align: top; display:none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box","style"=>"resize: none;width:565px;height:200px"));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
                                                                        
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                 <tr>
                                       <td><hr style="border: 1px solid red;" /></td>
                                 </tr>            
                                    
                                  <!--/////////////START:COMMENT REPLY////////////////////////////////-->  
                                    
                                    
                                    <?php if(isset($alltopic->comment_reply) && count($alltopic->comment_reply) > 0){
                                        
                                        $replysqltops=" SELECT *,`like` - `dislike` AS totdiffreply
                                                FROM `comment_reply` WHERE comment_id='".$alltopic->id."'
                                                ORDER BY totdiffreply DESC
                                                ";
                                                
                                        $alltopicreplytopsmodel = CommentReply::model()->findAllBySql($replysqltops);
                                        
                                        foreach($alltopicreplytopsmodel as $reply){
                                            
                                            ?>
                                            
                                     <tr style="background-color:#9ABBE3 !important;">
                                        <td style="width:100%">
                                            <table style="width: 100%;">
                                            
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
                                                    <td style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;">
                                                        <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$reply->reply_user->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;">
                                                            <?php echo $reply->reply_user->username;?> </a>:@ <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$alltopic->user_comment->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;">
                                                            <?php echo $alltopic->user_comment->username;?></a> &nbsp;
                                                            <?php
                                                            $stringtime= strtotime($reply->created_date);
                                                            echo date('m-d-Y',$stringtime);?>
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
                                            	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->reply;?>
                                                </td>
                                            </tr>
                                    
                                            <tr>
                                            	<td height="5"></td>
                                                    </tr>
                                            <tr style=" width:558px; padding-left:25px;">
                                            	<td height="20">
                                            		
                                            		<img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon.png" alt="" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'like')"/>&nbsp;&nbsp;
                                                    <span id="likecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->like;?></span>
                                                    &nbsp;
                                                    <img src="<?php echo Yii::app()->createUrl()?>/images/bult-icon1.png" onclick="likedislikereplyfun(<?php echo $reply->id;?>,'dislike')">&nbsp;&nbsp;
                                                    <span id="dislikecount_<?php echo $reply->id;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;"><?php echo $reply->dislike;?></span>
                                                        
                                                   
                                                   <div class="postareply" id="<?php echo $alltopic->id."_".$cnt;?>" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 14px;font-weight: bold;">Reply</div>
                                                   <input type="hidden" id="usercomment_<?php echo $alltopic->id."_".$cnt;?>" name="user_comment_<?php echo $reply->reply_user->id;?>" value="<?php echo $reply->reply_user->username;?>" />                                                                                      
                                                </td>
                                            			
                                            </tr>
                                            
                                            <tr>
                                            	<td>
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
        
        				                                        <table  style="width:98%; vertical-align: top; display: none;" id="showreply_<?php echo $alltopic->id."_".$cnt;?>">
        				                                                <tr>
        				                                                	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large;" > 
        				                                        
        				                                                        <?php
        				                                                		    //echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                                        echo $form->textArea($CommentReply,'reply',array("class"=>"input_box"));
        				                                               			 ?>
        				                                                        
        				                                                    </td>
        				                                                </tr>
        				                                                <tr>
        				                                                	<td style="float: right;">
        				                                                        <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/post-btn.png"  />
        				                                                        <input type="hidden" id="comment_id" name="comment_id" value="<?php echo $alltopic->id?>"/>
        				                                                    </td>
        				                                                    <!-- <td style="float: right;" id="closereply">
        				                                                        <img src="<?php echo Yii::app()->createUrl()?>/images/cancel-btn.png" width="65" height="25" />
        				                                                    </td> -->
        				                                                </tr>
        				                                                
        				                                       </table>
        				                                       <?php $this->endWidget(); ?>
                                            	</td>
                                            </tr>
                                	<?php $cnt++;?>
                                            
                                       </table>
                                    </td>                    
                                 </tr>
                                  <tr>
                                    <td><hr style="border: 1px solid red;" /></td>
                                  </tr>  
                                    
                                  <?php }}?>
                                  
                                  
                                <!--/////////////END:COMMENT REPLY////////////////////////////////-->
                                
                                  
                                <?php }}else{?>
                                <tr>
                                    <td>There are no comments!!!!</td>
                                </tr>
                            <?php }?>
                        </table>
                        
                        <!--====================END:TOP=====================================================-->
                        
                        
                    </td>
                    
            </tr>
         </table>
         
                           
    </td>
    <td class="right_column" >
    	<table class="content_box form_lable" style="width:98%;display: block;" id="rightboxtoggle5" >
        	<tr>
            	<!--<td height="30" id="topic_title" style="vertical-align: top; font: bolder !important;font-size: small; " >-->
                <td height="30" style="vertical-align: top; font: bolder !important;font-size: small; " >
                <?php echo ucwords($TopicModel->topic_title);?>
                </td>
            </tr>
            <tr>
            	<!-- <td height="20" style="word-wrap: normal" class="fontweight" id="topic_descriptionhtml2">-->
                <td height="20" style="word-wrap: normal" class="fontweight" >
                 <?php
            	    echo substr($TopicModel->topic_description,0, 100);
            	    if(strlen($TopicModel->topic_description) > 100){
            	        echo "...";
            	    }
                    ?>
                    <div style="height: 10;" ></div>
                    <div onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')" >More</div>
                    
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
                <!-- <td id="category_tagshtml2">-->
                <td>
                    <?php $typecattag=explode(",",$TopicModel->category_tags);
                	   for($i=0;$i<count($typecattag);$i++){?>
                       
                    	<span>
                            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$typecattag[$i],'searchtopics'=>'mytagscat'))?>" >
                                <?php echo $typecattag[$i];
                                  if($i==(count($typecattag)-1)){
                                    echo "";
                                  }else{
                                    echo ",";
                                  }
                                ?>
                                
                            </a>
                        </span>
                    <?php }	
                    ?>
                </td>
                
            </tr>
            <!-- <tr>
                 <td>
                    <a href="< ?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$TopicModel->category_tags,'searchtopics'=>'mytagscat'))?>" >
                                                
                         < ?php echo ucwords($TopicModel->category_tags);?>
                    </a>
            	</td>
            </tr>
            -->
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
                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->topics_username->id)) ?>">
                             <?php echo $TopicModel->topics_username->username ?> </a>/
        
                            </td>
                            <!-- <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="date1_html2">-->
                            <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" >
                             <?php
                                $stringtime= strtotime($TopicModel->created_date);
                                echo $date1=date('d-m-Y',$stringtime); 
                             ?>
              
                            </td>
                        </tr>
                    </table>
            	</td>
            </tr>
        </table>
    </td>
</tr>
<script>
function user_reply_img(user_id,topic_id){  
    var user_id=user_id;
    var topic_id=topic_id;
    $.ajax ({
		        type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/userreply') ;?>',
		        data: "user_id="+user_id+"&topic_id="+topic_id,
		        success: function(response){
		        	alert(response);
		               $("#replylist_table").append(response);
		                
               }
		    });	
        
        $("#replylist_table").show();
        $("#show_tbl_detail1").hide();
        
}    
 function showtextarea(id){
    	var tmp_comment_id=id;
    	var tmp_comment_array = tmp_comment_id.split("_");
   
		$("#comment_id").val(tmp_comment_array[0]);
		$("#replylist_table").show();
        $("#1showreply_"+tmp_comment_id).show();
    }   
    
</script>

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea',
                      plugins: "autolink",
                      menubar:false,
                      statusbar: false,
                      toolbar: false,
                      content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
                      
                      
});


</script>
