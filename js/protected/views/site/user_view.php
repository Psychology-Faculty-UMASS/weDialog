<style type="text/css">
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}

.button {
    background-color: #097DD5;
    color:#fff;
}
input.button2 {
    background-color: #097DD5;
     color:#fff;
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
	/*font-weight: bold;*/
	font-family:Arial, Helvetica, sans-serif;
	padding:0px 0px;
}
.form_lable_normal {
	color: #125D90;
	font-size: 12px;
	font-weight: normal;
	font-family:Arial, Helvetica, sans-serif;
	padding:3px 0px;
}


.success_msg {
   background-color: #5BA0C9;
   color: white;
   font-size: 14px;
   font-weight: bold;
   margin-bottom: 10px;
   padding: 5px;
}
.failure_msg {
    background-color: #e85449;
    color: white;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
    padding: 5px;
}
</style>

<link href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />  
<!--<script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl;?>/js/jquery.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script>
function reply_form_section(reply_topc_id){
	if(document.getElementById("reply_form_id_"+reply_topc_id).style.display == ""){
		document.getElementById("reply_form_id_"+reply_topc_id).style.display = "none";
	}else{
		document.getElementById("reply_form_id_"+reply_topc_id).style.display = "";
		//change_textarea_to_editor('replycomment_'+reply_topc_id);
	}
}
function change_textarea_to_editor(texteditor_id){
	/*CKEDITOR.replace(texteditor_id, {
		toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
				'/',																					// Line break - next group will be placed in new line.
				{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
			]
	});*/
}

$(document).ready(function() {
      //threadcomment('onload');
      change_current_section('onload')
	  $('.popup').click(function(event) {
	    // and so on...
	  });
	});
  $('.popup').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
                 ',width='  + width  +
                 ',height=' + height +
                 ',top='    + top    +
                 ',left='   + left;
    
    window.open(url, 'twitter', opts);
 
    return false;
  });
</script>
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

		   //change_textarea_to_editor('post_comment_area');
       }

       var tmp_id = e.target.id;
		if(tmp_id!=""){
			var tmp_array = tmp_id.split("_"); 
		   	if(tmp_array[0] != "textarea"){
		    	$("table[id^=showreply_show_tbl_detail1]").hide();
		       	$("table[id^=showreply_my_detail]").hide();
		       	$("table[id^=showreply_date_detail]").hide();
		       	$("table[id^=showreply_top_detail]").hide();
	           	$("table[id^=showreply_disagree_detail]").hide();
		       	if(tmp_array[0]=="showtbldetail1"){
					$("#showreply_show_tbl_detail1_"+tmp_array[1]+"_"+tmp_array[2]).show();	
		      	}else if(tmp_array[0]=="mydetail"){
		        	$("#showreply_my_detail_"+tmp_array[1]+"_"+tmp_array[2]).show();
		      	}else if(tmp_array[0]=="datedetail"){
		        	$("#showreply_date_detail_"+tmp_array[1]+"_"+tmp_array[2]).show();
		      	}else if(tmp_array[0]=="topdetail"){
		        	$("#showreply_top_detail_"+tmp_array[1]+"_"+tmp_array[2]).show();
		      	}else if(tmp_array[0]=="disagreedetail"){
		        	$("#showreply_disagree_detail_"+tmp_array[1]+"_"+tmp_array[2]).show();
		     	}
			}
		}else{
			$("table[id^=showreply_show_tbl_detail1]").hide();
	       	$("table[id^=showreply_my_detail]").hide();
	       	$("table[id^=showreply_date_detail]").hide();
	       	$("table[id^=showreply_top_detail]").hide();
           	$("table[id^=showreply_disagree_detail]").hide();

			$(".hide_row").css("display", "none");
			
		}
   });

    $("#postamessage").click(function() {
        $("#showmessage").show();
        $("#postamessage").hide();
    });

    $(".postareply").click(function() {
                
    	var tmp_comment_id=$(this).attr("id");
        
    	var tmp_comment_array = tmp_comment_id.split("_");
		//$("#comment_id").val(tmp_comment_array[0]);
		var table_id = $(this).parent("td").parent("tr").parent("tbody").parent("table").parent("td").parent("tr").parent("tbody").parent("table").attr("id");
        
        $("#showreply_"+table_id+"_"+tmp_comment_id).show();
    });
});

function capitalize(str)
{
    return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function topicdetailmore2(tagid){
    var tag_id=tagid;
    /*$.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/ruledetail') ;?>',
		        data: "tag_id="+tag_id,
		        success: function(response){
		          
                       var topic_array= response.split("||");
                       //capitalize(topic_array[7]);
                       var cat_tags= topic_array[2].split(",");
                       var total_tag="";
                       for (var i=0;i<cat_tags.length;i++)
                        {
                            if(i+1==cat_tags.length){
                                 total_tag=total_tag + cat_tags[i];
                            }else{
                                 total_tag=total_tag + cat_tags[i] + ", ";
                            }
                        }
                       var type_tags= topic_array[3].split(",");
                       var total_type_tag="";
                       for (var i=0;i<type_tags.length;i++)
                        {
                            if(i+1==type_tags.length){
                                 total_type_tag=total_type_tag + type_tags[i];
                            }else{
                                 total_type_tag=total_type_tag + type_tags[i] + ", ";
                            }
                        }
                       
                       $("#topic_titlehtml").html(topic_array[0]);
                       $("#topic_title").html(capitalize(topic_array[7]));
                       $("#topic_descriptionhtml").html(topic_array[6]);
                       $("#topic_descriptionhtml2").html(topic_array[1]);
                       $("#category_tagshtml").html(total_tag);
                       $("#category_tagshtml2").html(topic_array[2]);
                       $("#type_tagshtml").html(total_type_tag);
                       $("#createdbyhtml").html(topic_array[4]);
                       $("#createdbyhtml2").html(topic_array[4]);
                       $("#date1_html").html(topic_array[5]);
                       $("#date1_html2").html(topic_array[5]);
               }
		    });	*/
        $("#toggle_column").show();
        $("#rightboxtoggle").show();
        $("#show_tbl_detail").hide();

		$("#show_tbl_detail_menue").hide();
		
}
</script>
<script type="text/javascript">
function likedislikecommentfun(posttype,mainid,comment_id, likedislike){
    if(comment_id==""){
         document.getElementById('Event_location_id').innerHTML="<option value=''>Please Select Location</option>";
         $('#Event_location_id').attr("disabled",true);
    }else{
        $.ajax ( {
            type: "POST",
            url: '<?php echo Yii::app()->createUrl('general/usercount') ;?>',
            data: "comment_id="+comment_id+"&likedislike="+likedislike+"&main_id="+mainid+"&post_type="+posttype,
            success: function(response){
                if(response == "fail"){
                    alert("Error");
                }else if(response == "exist"){
                    //alert("You already voted!");
                    document.getElementById('already_voted_message_'+comment_id).style.display = "block";
                    return false;
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
    if(reply_id==""){
		alert("hi");return false;
    }else{
        $.ajax ( {
            type: "POST",
            url: '<?php echo Yii::app()->createUrl('general/replycount') ;?>',
            data: "reply_id="+reply_id+"&likedislike="+likedislike,
            success: function(response){
                if(response == "fail"){
                    alert("Error");
                }else if(response == "exist"){
                   // alert("exists");
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
<script type="text/javascript">
$(document).ready(function(){
    <?php if(isset($type) && $type == 'green'){?>
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#000000';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
    
    <?php }else if(isset($type) && $type == 'red'){?>
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#000000';
    
    <?php }else{?>
            document.getElementById('datemessage').style.color = '#000000';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
    
    <?php }?>
    $("#datemessage,#topmessage,#disagreemessage,#greenflagmessage,#redflagmessage").click(function() {
        var ID = $(this).attr("id");
        //alert('1')
        //$("#my_detail").hide();
        $("#date_detail").hide();
        $("#top_detail").hide(); 
        $("#show_tbl_detail1").hide();
        $("#disagree_detail").hide();
        $("#greenflag_detail").hide();
        $("#redflag_detail").hide();
        /*if(ID=='mymessage'){
            $("#my_detail").show();
            //document.getElementById('mymessage').style.color = '#000000';
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
            
                
        }else */if(ID=='datemessage'){
            $("#date_detail").show();
            //document.getElementById('mymessage').style.color = '#c3c3c3';
            document.getElementById('datemessage').style.color = '#000000';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
                
        }else if(ID=='topmessage'){
            $("#top_detail").show();  
            //document.getElementById('mymessage').style.color = '#c3c3c3';
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#000000';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
              
        }else if(ID=='disagreemessage'){
            $("#disagree_detail").show(); 
            //document.getElementById('mymessage').style.color = '#c3c3c3';
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#000000';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
               
        }else if(ID=='greenflagmessage'){
            $("#greenflag_detail").show();
            //document.getElementById('mymessage').style.color = '#c3c3c3';
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#000000';
            document.getElementById('redflagmessage').style.color = '#c3c3c3';
            
        }else if(ID == 'redflagmessage'){
            $("#redflag_detail").show();
            //document.getElementById('mymessage').style.color = '#c3c3c3';
            document.getElementById('datemessage').style.color = '#c3c3c3';
            document.getElementById('topmessage').style.color = '#c3c3c3';
            document.getElementById('disagreemessage').style.color = '#c3c3c3';
            document.getElementById('greenflagmessage').style.color = '#c3c3c3';
            document.getElementById('redflagmessage').style.color = '#000000';
        }
      
    });

    $("#click_mytopics,#click_popular").click(function() {
        var ID = $(this).attr("id");
        $("#mytopic_left").hide();
        $("#topic_popular_left").hide();

        if(ID=='click_mytopics'){                                   
            $("#mytopic_left").show();
            document.getElementById('selected').style.background= 'none repeat scroll 0 0 #097DD5';
            document.getElementById('selected_popular').style.background= 'none repeat scroll 0 0 #065A95';
        }else if(ID=='click_popular'){
            $("#topic_popular_left").show();
            document.getElementById('selected_popular').style.background= 'none repeat scroll 0 0 #097DD5';
            document.getElementById('selected').style.background= 'none repeat scroll 0 0 #065A95';
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

<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
    <div class="main_left">
    	<?php
    	$this->renderPartial('/topics/_topics_list_left_panel',$this->data);
        /*
        ?>
        <div class="rules" style="background-color: #E2F5FA;">
        	<!-- //============================START:  LEFT PANEL   =======================  -->
            <?php //$this->renderPartial('/typeTags/_left_panel',$this->data);?>
            <!-- //============================END:  LEFT PANEL    =======================  -->
        </div>
        <?php
        */
        ?>
    </div>
    <div class="main_mid">
        <div class="topics"  id="show_tbl_detail_menue">
            <div class="topic_head">People</div>
             <!--   <a href="<?php echo Yii::app()->createUrl('topics/Createnewtopic')?>" class="newtopic"><img src="<?php echo Yii::app()->baseUrl;?>/images/new_topic.jpg"/></a>-->
       </div>
        <!-- //============================START:  ABOUT TOPICS   =======================  -->
          <?php $this->renderPartial('/site/_about_people',$this->data);?>
        <!-- //============================END:  ABOUT TOPICS   =======================  -->
        <div class="topic1" id="show_tbl_detail" style="padding-top: 10px;">
            <p style="padding-bottom: 12px;">
                <tbody>
                <tr>                    
                    <td style="width:85px; vertical-align: top;">
                        <a href="">
                            <?php if($user_model->profile_image==""){?>
                                <img  src="<?php echo Yii::app()->baseUrl."/images/img-1.png";?>" width="50" height="50" align="left" style="padding:6px 5px 0px 0px;"/>
                            <?php }else{?>
                                <?php $prifile_image =  Yii::app()->baseUrl.'/'.Yii::app()->params['profile_img'].$user_model->profile_image; ?>  

                                <img  src="<?php echo $prifile_image;?>" width="50" height="50" align="left" style="padding:6px 5px 0px 0px;"/>
                           <?php }?>
                           </a>
                           <a href="" style="text-decoration: none;color: #065A95 !important;font-size: 14px;">
                                <?php echo ucfirst($user_model->username);?>
                            </a>
                    </td>
                    <td style="width:12px;">&nbsp;</td>
                    <td style="width:100%; vertical-align: top;">
                        <table style="vertical-align: top;padding: 0px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                        
                        </table>                    
                    </td>
                </tr> 
            </tbody>
            </p>
            <!--
            <div>
                <div style="color:#065A95;font-family: Tahoma;font-size: 16px;padding-bottom: 16px;cursor: pointer;" onclick="javascript: topicdetailmore2('<?php echo $rule_model->id; ?>')"><?php echo ucwords($rule_model->type_tag);?></div>
            </div>
            -->
            <div>
                <!-- //============================START:  POST MESSAGE TOP   =======================  -->
                <?php //$this->renderPartial('/typeTags/_post_message_form',$this->data);?>
                <!-- //============================END:  POST MESSAGE TOP   =======================  -->
            </div>
            <div style="padding-bottom: 10px;">
                <table style="width:98%;">
                    <tr style="font-family:Verdana;width:30px; margin:0px 0 0 0; ">
                        <td style="float:left;font-family:Verdana" >
                            <!--<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#000000;" href="javascript:void(0);" id="allmessage" onclick="threadcomment('');">THREAD &nbsp;|&nbsp;</a>-->                            
                            <a class="active" style="font-family:Verdana; font-size: small;cursor: pointer;text-decoration: none;color:#000000;" id="datemessage" onclick="javascript:change_current_section('date_topics');">NEW &nbsp;|&nbsp;</a> 
                            <a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="topmessage" onclick="javascript:change_current_section('popular_topics');">AGREE &nbsp;|&nbsp;</a> 
                            <a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="disagreemessage" onclick="javascript:change_current_section('disagree_topics');">DISAGREE &nbsp;|&nbsp;</a>
                            <a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="greenflagmessage" onclick="javascript:change_current_section('green_flag');">GREEN FLAG &nbsp;|&nbsp;</a>
                            <a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="redflagmessage" onclick="javascript:change_current_section('red_flag');">RED FLAG</a>
                            <!--<a style="font-family:Verdana;font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="mymessage" onclick="javascript:change_current_section('my_topics');">MY</a>-->
                        </td>
                        <td style="float:right;vertical-align: top;">
                           <!-- <a style="font-family:Verdana; font-size: small;cursor: pointer;text-decoration: none;color:#c3c3c3;" id="flatmessage" onclick="javascript:change_current_section('date_topics');">FLAT &nbsp;</a>-->
                        
                            <!--<script>function fbs_click() {u=location.href;t=document.title;window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(<?php echo Yii::app()->baseUrl;?>/images/facebook_share_icon.gif) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:url(<?php echo Yii::app()->baseUrl;?>/images/facebook_share_icon.gif) no-repeat top right; text-decoration:none; } </style> <a rel="nofollow" href="https://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;padding:1px 10px 0px 5px;margin:3px 0px 0px 10px;"></a> 
                   			<a class="twitter popup" href="http://twitter.com/share"><img src="<?php echo Yii::app()->baseurl;?>/images/twitter_icon.png"/></a>
                            <a href="mailto:?Subject=Ivan Topics&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/email-icon.jpg"  alt="Email" width="16" height="16" /></a>-->
                        </td>
                        
                    </tr>
                </table>
            </div>
            <div>
                <!-- //============================START:  AJAX LOADING TABLE   =======================  -->
                    <table class="content_box form_lable" style="width:100%;" id="topic_comment_data"></table>
                <!-- //============================END:  AJAX LOADING TABLE   =======================  -->
            </div>            
        </div> 
    </div>
    <div class="main_right">
        <!-- //============================START:  RIGHT PANEL   =======================  -->
          <?php $this->renderPartial('/site/_right_panel',$this->data);?>
        <!-- //============================END:  RIGHT PANEL    =======================  -->
    </div>
</div>
<script>
/*function user_reply_img(user_id,tag_id){  
    var user_id=user_id;
    var tag_id=tag_id;
    $.ajax ({
		        type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/userreply') ;?>',
		        data: "user_id="+user_id+"&tag_id="+tag_id,
		        success: function(response){
		        	//alert(response);
		               $("#replylist_table").append(response);
		                
               }
		    });	
        
        $("#replylist_table").show();
        $("#show_tbl_detail1").hide();
        
}*/    
 function showtextarea(id){
    	var tmp_comment_id=id;
    	var tmp_comment_array = tmp_comment_id.split("_");
   
		$("#comment_id").val(tmp_comment_array[0]);
		$("#replylist_table").show();
        $("#1showreply_"+tmp_comment_id).show();
    }   
    
</script>

<script>
var tag_id = <?php echo $people_id;?>;
var selected_user_id = <?php echo $this->data['selected_user_id'];?>;

var currect_section = "date_topics";

var all_record_cnt = 0;
var my_record_cnt = 0;
var popular_record_cnt = 0;
var disagree_record_cnt = 0;
var date_record_cnt = 0;

var all_record_no_more_data = 0;
var my_record_no_more_data = 0;
var popular_record_no_more_data = 0;
var disagree_record_no_more_data = 0;
var date_record_no_more_data = 0;

var all_last_comment_id = 0;
var my_last_comment_id = 0;
var popular_last_comment_id = 0;
var disagree_last_comment_id = 0;
var date_last_comment_id = 0;

var ajax_call_complated = 0;
var is_fist_call = 1;

function change_current_section(new_method_name){
	$(window).bind("scroll");
    if(new_method_name == 'onload'){
        <?php if(isset($type) && $type == 'green'){?>
        currect_section = 'green_flag';
        <?php }else if(isset($type) && $type == 'red'){?>
        currect_section = 'red_flag';
        <?php }else{?>
        currect_section = 'date_topics';
        <?php }?>
		temp_var='onload';
    }else{
		//temp_var='';
		//$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
        currect_section = new_method_name;
    }
	temp_var='';
	$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
	//get_topic_comments(); 
	setTimeout(function(){
        get_topic_comments(temp_var);
    }, 1000);
    //setTimeout(get_topic_comments, 1000);   
    
}
/*
function threadcomment(temp_var){
    if(temp_var == ''){
        $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});

    }
    setTimeout(function(){
        threadcommentlisting(temp_var);
    }, 1000);
}    
function threadcommentlisting(temp_var){
    //alert('lll')
    
    
    //setTimeout(function(){}, 100);
    
	$(window).bind("scroll");
	new_page_no = 0;
	need_ajax_call = 1;
	if(all_record_no_more_data == 1){
		need_ajax_call = 0;
	}
	new_record_cnt = all_record_cnt;
	last_comment_id = all_last_comment_id;
    //var currect_section = "date_topics";
	if(need_ajax_call==1){
		data_str += "&record_cnt="+new_record_cnt+"&last_comment_id="+last_comment_id+"&tag_id=<?php echo $rule_model->id;?>";
		if(ajax_call_complated==1 || is_fist_call == 1){
			is_fist_call = 0;
			$.ajax({
    			type: 'POST', 
    			url: "<?php echo Yii::app()->createUrl('TypeTags/viewthreadcomment');?>",
    			data: data_str,
                dataType: "json",
    			async:false,
    			success: function(topic_comment_response){
    			         
    				    //alert(topic_comment_response['response_data_str']);
                        //if(currect_section == "date_topics"){
        					all_record_cnt = topic_comment_response['total_record_to_fetch'];
        					all_last_comment_id = topic_comment_response['last_comment_id'];
        					
        					if(topic_comment_response['no_more_data'] == "1"){
        						all_record_no_more_data = 1;
        					}
                        //}
    				
    
    				if(topic_comment_response['no_more_data'] != "1"){
    					$("#topic_comment_data").html(topic_comment_response['response_data_str']);
    				}
    				ajax_call_complated = 1;
    			}
		  });
		}
	}
        if(temp_var == ''){
            $.unblockUI();
        }       
 }
*/

function get_topic_comments(temp_var){
	data_str = "currect_section="+currect_section;
    
	new_page_no = 0;
	need_ajax_call = 1;
	if(currect_section == "green_flag"){
		if(all_record_no_more_data == 1){
			need_ajax_call = 0;
		}
		new_record_cnt = all_record_cnt;
		last_comment_id = all_last_comment_id;
	}else if(currect_section == "red_flag"){
		if(my_record_no_more_data == 1){
			need_ajax_call = 0;
		}
		new_record_cnt = my_record_cnt;
		last_comment_id = my_last_comment_id;
	}else if(currect_section == "popular_topics"){
		if(popular_record_no_more_data == 1){
			need_ajax_call = 0;
		}
		new_record_cnt = popular_record_cnt;
		last_comment_id = popular_last_comment_id;
	}else if(currect_section == "disagree_topics"){
		if(disagree_record_no_more_data == 1){
			need_ajax_call = 0;
		}
		new_record_cnt = disagree_record_cnt;
		last_comment_id = disagree_last_comment_id;
	}else if(currect_section == "date_topics"){
		if(date_record_no_more_data == 1){
			need_ajax_call = 0;
		}
		new_record_cnt = date_record_cnt;
		last_comment_id = date_last_comment_id;
	}
	if(need_ajax_call==1){
		data_str += "&record_cnt="+new_record_cnt+"&last_comment_id="+last_comment_id;
		if(ajax_call_complated==1 || is_fist_call == 1){
			is_fist_call = 0;
			$.ajax({
			url: "Getusercomments?user_id="+'<?php echo $people_id;?>'+"&selected_user_id="+selected_user_id,
			data: data_str,
			type: 'POST',
			dataType: "json",
			async:false,
			success: function(topic_comment_response){
				//alert(topic_comment_response);
				if(currect_section == "green_flag"){
				    //alert('1')
					all_record_cnt = topic_comment_response['total_record_to_fetch'];
					all_last_comment_id = topic_comment_response['last_comment_id'];
					
					if(topic_comment_response['no_more_data'] == "1"){
						all_record_no_more_data = 1;
					}
				}else if(currect_section == "red_flag"){
					my_record_cnt = topic_comment_response['total_record_to_fetch'];
					my_last_comment_id = topic_comment_response['last_comment_id'];
					
					if(topic_comment_response['no_more_data'] == "1"){
						my_record_no_more_data = 1;
					}
				}else if(currect_section == "popular_topics"){
					popular_record_cnt = topic_comment_response['total_record_to_fetch'];
					popular_last_comment_id = topic_comment_response['last_comment_id'];
					
					if(topic_comment_response['no_more_data'] == "1"){
						popular_record_no_more_data = 1;
					}
				}else if(currect_section == "disagree_topics"){
					disagree_record_cnt = topic_comment_response['total_record_to_fetch'];
					disagree_last_comment_id = topic_comment_response['last_comment_id'];
					
					if(topic_comment_response['no_more_data'] == "1"){
						disagree_record_no_more_data = 1;
					}
				}else if(currect_section == "date_topics"){
					date_record_cnt = topic_comment_response['total_record_to_fetch'];
					date_last_comment_id = topic_comment_response['last_comment_id'];
					
					if(topic_comment_response['no_more_data'] == "1"){
						date_record_no_more_data = 1;
					}
				}

				if(topic_comment_response['no_more_data'] != "1"){
					$("#topic_comment_data").html(topic_comment_response['response_data_str']);
				}
				
				ajax_call_complated = 1;
                 
			}
		});
        
		}
	}
	
	tinymce.init({
        selector:'textarea',
        plugins: "autolink",
        paste_auto_cleanup_on_paste :true,
        forced_root_block : false,  
        menubar:false,
        statusbar: false,
        toolbar: false,
        content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
	});
    //if(temp_var==''){
	    $.unblockUI();
	//}
 }

$(window).load(function() {
	get_topic_comments();
});

$(function(){
    var scrollFunction = function(){
    	$("#loading_div").show();
		var scroll_top = $(window).scrollTop();
		var window_height = $(document).height();
		if (scroll_top >= window_height*0.80 && scroll_top <= window_height*0.82){
            if(ajax_call_complated==1 || is_fist_call == 1){
				setTimeout(get_topic_comments, 1000);
            }
		}
		 $("#loading_div").hide();
    };
	$(window).scroll(scrollFunction);
});
</script>
<div style="height: 51px; width: 100%; float: left;display: none; position: fixed; margin-top: 600px;" id="loading_div">
<img style="float: right; margin-right: 300px;" src="../images/ajax-loader.gif"/>
</div>

<script src="<?php echo Yii::app()->createUrl("js/tinymce/tinymce.min.js");?>"></script>
<!-- <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> -->
<script>
/*tinymce.init({
	selector:'textarea',
	plugins: "autolink",
	menubar:false,
	statusbar: false,
	toolbar: false,
	content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
});*/
</script>
<script>
    function showhide(id){
        $('#flagsub_'+id).toggle();
         $('.flagclass_sub').not('#flagsub_'+id).hide();
    }

    function setFlagMessage(comment_id,main_id,post_type,flag_type){
        //alert(comment_id+"===="+flag_type);
        if(flag_type == 'Green'){
            document.getElementById('AllPostsFlags_all_posts_id').value = comment_id;
            document.getElementById('AllPostsFlags_main_id').value = main_id;
            document.getElementById('AllPostsFlags_post_type').value = post_type;                        
            var temp = $('#green_open_form').html();
            $('#green_open_form').html('');
            $('body').css('background-color','#A6A6A6');
            $('body *').not('#green_open_form').css({opacity:'0.8'});
            $('#green_open_form').html(temp);
            $('#green_open_form').show();
        }else{
            document.getElementById('AllPostsFlags_red_all_posts_id').value = comment_id;
            document.getElementById('AllPostsFlags_red_main_id').value = main_id;
            document.getElementById('AllPostsFlags_red_post_type').value = post_type;   
            var temp = $('#red_open_form').html();
            $('#red_open_form').html('');
            $('body').css('background-color','#A6A6A6');
            $('body *').not('#red_open_form').css({opacity:'0.8'});
            $('#red_open_form').html(temp);
            $('#red_open_form').show();
        }
    }
    

    function closemodel_div(div_id){
        $('body').css('background-color','');
        $('body *').css({opacity:'1'});
        $('#'+div_id).hide();
    }
    
    
    //$('#green_open_form').leanModal({ top : 200, closeButton: ".modal_close" });
    //$('#red_open_form').leanModal({ top : 200, closeButton: ".modal_close" });
    
</script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>

<style>
#lean_overlay {
  background: none repeat scroll 0 0 #000000;
  display: none;
  height: 100%;
  left: 0;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100;
}

#green_open_form{
    background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.7);
    display: none;
    padding-bottom: 2px;
    width: 404px;
}
#red_open_form{
    background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 5px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.7);
    display: none;
    padding-bottom: 2px;
    width: 404px;
}
</style>
<div id="green_open_form" style="display: none; width: 35%; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -249px; top: 200px;">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            		'id'=>'topic-form',
                    'action'=>Yii::app()->createUrl('Site/creategreenflag'),
            		'enableAjaxValidation'=>false,
            	    'enableClientValidation'=>true,
            	    'clientOptions'=>array(
            			'validateOnSubmit'=>true,
                    ),
            	)
            );
        ?>
        <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0"s> 
            <tr style="width: 100%;">
                <td class="tagtitle-new" align="left">Green Flag User<a class="modal_close" onclick="javascript:closemodel_div('green_open_form');" style="right: 3px;top: 3px;"></a></td>
            </tr>
        </table>
        <table class="topic_detail" width="95%" border="0" class="tag" style="padding-left:5%;" cellpadding="0" cellspacing="0">
             <tr><td>&nbsp;</td></tr>
            <tr>
                <td style="padding-left: 1%;"><h4>Reason for green flagging user</h4></td>
            </tr>
            
                <?php 
                    if(isset($flag_reason_model) && count($flag_reason_model) > 0){
                        $cnt = 1;
                        $checked = '0';
                        $greenreason = array();
                        foreach($flag_reason_model as $flag_reason){
                            

                            if($flag_reason->flag_type == 'Green'){
                                $greenreason[$flag_reason->id] = $flag_reason->reason;
                                if($cnt == 1){
                                    $checked = $flag_reason->id;
                                }
                                $cnt++;
                            }
                        
                        }
                ?>
                    <tr>
                     <?php
    
                        /*$accountStatus = array('Male'=>'Male', 'Female'=>'Female');
                        echo $form->radioButtonList($model,'jnsKelamin',$accountStatus,
                        array('separator'=>' ',
                        'labelOptions'=>array('style'=>'display:inline'), // add this code
                        ));*/
                    ?>       
                        
                        
                        <td><?php 
                            $user_flag_model->flag_reason_id = $checked;   
                            echo $form->radioButtonList($user_flag_model,'flag_reason_id',$greenreason,array('style'=>'width:5%;','labelOptions'=>array('style'=>'display:inline')));?>
                        </td>
                    </tr>
                    <?php //echo $form->error($user_flag_model,'flag_reason_id');?>
                    <?php echo $form->hiddenField($user_flag_model,'all_posts_id',array("value"=>''));?>
                    <?php echo $form->hiddenField($user_flag_model,'flag_type',array("value"=>'Green'));?>
                    <?php echo $form->hiddenField($user_flag_model,'user_id',array("value"=>$this->data['user_id']));?>
                    <?php echo $form->hiddenField($user_flag_model,'main_id',array("value"=>'','id'=>'AllPostsFlags_main_id'));?>
                    <?php echo $form->hiddenField($user_flag_model,'post_type',array("value"=>'','id'=>'AllPostsFlags_post_type'));?>
                <?php }?>
                 <tr><td>&nbsp;</td></tr>
                <tr style="width: 100%;">
                <td>
                    <input type="submit" name="save" value="OK" id="save" style="width: 30%;text-align: center;float:left;"/>
                    <input type="button" class="closemodel" name="Cancel" value="Cancel" id="closemodel" onclick="javascript:closemodel_div('green_open_form');" style="display: block;width: 30%;background:#d8d8d8!important;float: left;"/>
                
                </td>
                </tr>
            
        </table>
	<?php $this->endWidget(); ?>
</div>
<div id="red_open_form" style="display: none; width: 35%; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -249px; top: 200px;">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            		'id'=>'topic-form',
                    'action'=>Yii::app()->createUrl('Site/createredflag'),
            		'enableAjaxValidation'=>false,
            	    'enableClientValidation'=>true,
            	    'clientOptions'=>array(
            			'validateOnSubmit'=>true,
                    ),
            	)
            );
        ?>
         <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0">
          <tr style="width: 100%;">
                <td class="tagtitle-new" align="left">Red Flag User<a class="modal_close" onclick="javascript:closemodel_div('red_open_form');" style="right: 3px;top: 3px;"></a></td>
            </tr>
         </table>
        <table class="topic_detail" width="95%" border="0" class="tag" cellpadding="0" cellspacing="0" style="padding-left:5%;">
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td ><h4>Reason for Red flagging user</h4></td>
            </tr>
                <?php 
                    if(isset($flag_reason_model) && count($flag_reason_model) > 0){
                        $cnt = 1;
                        $checked = '0';
                        $greenreason = array();
                        foreach($flag_reason_model as $flag_reason){
                            

                            if($flag_reason->flag_type == 'Red'){
                                $greenreason[$flag_reason->id] = $flag_reason->reason;
                                if($cnt == 1){
                                    $checked = $flag_reason->id;
                                }
                                $cnt++;
                            }
                        
                        }
                ?>
                    <tr style="width: 100%;">
                    
                        <td><?php 
                        $user_flag_model->flag_reason_id = $checked;
                        echo $form->radioButtonList($user_flag_model,'flag_reason_id',$greenreason,array('style'=>'width:5%','labelOptions'=>array('style'=>'display:inline')));?></td>
                    </tr>
                     <tr><td>&nbsp;</td></tr>
                    <tr style="width: 100%;">
                        <td><?php echo $form->checkBox($user_flag_model,'block_user',array('style'=>'width:5%'));?> Block User</td>
                    </tr>
                    <tr style="width: 100%;">
                        <td><?php echo $form->checkBox($user_flag_model,'hide_post',array('style'=>'width:5%'));?> Hide Post</td>
                    </tr>                    
                    <?php echo $form->hiddenField($user_flag_model,'all_posts_id',array("value"=>'','id'=>'AllPostsFlags_red_all_posts_id'));?>
                    <?php echo $form->hiddenField($user_flag_model,'flag_type',array("value"=>'Red'));?>
                    <?php echo $form->hiddenField($user_flag_model,'user_id',array("value"=>$this->data['user_id']));?>
                    <?php echo $form->hiddenField($user_flag_model,'main_id',array("value"=>'','id'=>'AllPostsFlags_red_main_id'));?>
                    <?php echo $form->hiddenField($user_flag_model,'post_type',array("value"=>'','id'=>'AllPostsFlags_red_post_type'));?>
                <?php }?>
                 <tr><td>&nbsp;</td></tr>
                <tr style="width: 100%;">
                <td>              
                     <input type="submit" name="save" value="OK" id="save" style="width: 25%;float: left;"/>
                    <input type="button" class="closemodel" name="Cancel" value="Cancel" id="Cancel" onclick="javascript:closemodel_div('red_open_form');" style="display: block;width: 20%;background:#d8d8d8!important;float: left;"/>
                </td>
                </tr>
        </table>
	<?php $this->endWidget(); ?>
</div>
<script>
$(document).click(function (e){
    var container = $(".flagclass , .flagclass_sub , .closemodel , .modal_close ");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        //container.hide();
        $('.flagclass_sub').hide();
    }
});	
/*
function saveReplay(comment_id,main_comment_id,main_id){
    var comment = $('#replycomment_'+comment_id).val();
    if(comment!=''){
        $.ajax({
            type: 'POST', 
            url: "<?php echo Yii::app()->createUrl('Site/submitreply');?>",
            data: "AllPosts[comment_id]="+comment_id+"&AllPosts[main_comment_id]="+main_comment_id+"&AllPosts[main_id]="+main_id+"&AllPosts[comment]="+comment,
            async:false,
            success: function(response){
                threadcomment('');
                //alert(response);return false;
            }
        });
    }   
    
    
}
*/
</script>