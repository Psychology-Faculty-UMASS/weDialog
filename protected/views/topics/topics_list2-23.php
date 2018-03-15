<!-- <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> -->
<script src="<?php echo Yii::app()->createUrl("js/jquery.blockUI.js");?>"></script>
<script src="<?php echo Yii::app()->createUrl("js/tinymce/tinymce.min.js");?>"></script>
<script>
    /*tinymce.init({selector:'textarea',
        plugins: "autolink",
        plugins : "paste",
        paste_text_sticky : true,
        setup : function(ed) {
          ed.onInit.add(function(ed) {
            ed.pasteAsPlainText = true;
              });
        }
        paste_auto_cleanup_on_paste : true,
        paste_remove_spans : true,
        paste_remove_styles : true,
        paste_convert_middot_lists : false,
        paste_use_dialog : false,
        paste_convert_headers_to_strong : false,
        paste_strip_class_attributes : "all",
        paste_retain_style_properties : "",
        paste_remove_styles_if_webkit : true,
        paste_unindented_list_class : "unindentedList"
        forced_root_block : false,   
        menubar:false,
        statusbar: false,
        toolbar: false,
        content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
    });*/
</script>

<style type="text/css">
.take-our-survey-div{
    margin-top: 100px;
}

.take-our-survey-button{
    display: none;
    border: 1px solid white;
    background-color: rgb(33, 177, 76);
    cursor: pointer;
    width: 174px;
    height: 40px;
    font-family: Arial;
    font-size: 19px;
    font-weight: normal;
    float: left;
    border-radius: 0px;
}
    
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}
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
.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
.content_2{height:246px;overflow-y: hidden;}
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
  
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo Yii::app()->request->baseUrl;?>/js//minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

	<script>
		(function($){
			$(window).load(function(){
				/*$(".content_2").mCustomScrollbar({
					scrollInertia:150
				});*/			

			});
		})(jQuery);
	</script>
    
    
<script type="text/javascript">
			$(function() {
				
    			$('#go').leanModal({ top : 200, closeButton: ".modal_close" });		
			});
			$(function() {
				
    			$('#typego').leanModal({ top : 200, closeButton: ".modal_close" });		
			});
		</script>
<script type="text/javascript">

function categoryTag_add(){
	  $('.error').hide();
	  $('.simple-sucess').hide();
        var cat_tag_id=$("#cat_tag_id").val();
        var description=$("#description").val();
        if (description=="") {
			alert("description is blank");
	        $("#description").focus();
	      return false;
	    }
		$.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/category_description') ;?>',
		        data: "category_description="+description+"&tag_id="+cat_tag_id,
		        success: function(response){
		          //alert(response)
                    if(response == "exist"){
                        alert("Tag Already Exist");
                        $( ".modal_close" ).click();
                    }else{
                        //alert("Tag Update Successfully");
                        $( ".modal_close" ).click();
                        location.reload();
                        
                    }
		       }
		    });	
		   
	  
	    return false;
}
function typeTag_add(){
	  $('.error').hide();
	  $('.simple-sucess').hide();
	  
      var type_tag_id=$("#type_tag_id").val();
      var typedescription=$("#typedescription").val();
		if (typedescription=="") {
			alert("description is blank");
	        $("#typedescription").focus();
	      return false;
	    }
		$.ajax ( {
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/type_description') ;?>',
		        data: "type_description="+typedescription+"&tag_id="+type_tag_id,
		        success: function(response){
		        	if(response == "exist"){
                        alert("Tag Already Exist");
                        $( ".modal_close" ).click();
                    }else{
                        //alert("Tag Update Successfully");
		        	    $( ".modal_close" ).click();
                         location.reload();
                    }
               }
		    });	
		   
	  
	    return false;
}
</script>

<script type="text/javascript">
$(document).ready(function(){
    $("#more").click(function() {
        
        
        $("#toggle_column").toggle();
        if($("#more").html()=="More"){
            $(".topics").hide();
            $(".menu1").hide();
            $("#show_mytopics_tbl").hide();
            $("#show_popular_tbl").hide();
            $("#show_agree_tbl").hide();
            $("#show_date_tbl").hide();
            $("#show_last_post_tbl").hide();
            $("#show_tbl_detail").hide();
         
            $("#more").html("Less");
        }else{
            $(".topics").show();
            $(".menu1").show();
            $("#show_tbl_detail").show();
            $("#more").html("More");
        }
    });
    $("#typetagmore").click(function() {
        
        $("#toggle_typetag_column").toggle();
        if($("#typetagmore").html()=="More"){
            $(".topics").hide();
            $(".menu1").hide();
            $("#show_mytopics_tbl").hide();
            $("#show_popular_tbl").hide();
            $("#show_agree_tbl").hide();
            $("#show_date_tbl").hide();
            $("#show_last_post_tbl").hide();
            $("#show_tbl_detail").hide();
         
            $("#typetagmore").html("Less");
        }else{
            $(".topics").show();
            $(".menu1").show();
            $("#show_tbl_detail").show();
        
            $("#typetagmore").html("More");
        }
    });
});
</script>
<?php
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
?>
<script type="text/javascript">
var currect_section = "<?php echo (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1)?"last_post":"alltopics"; ?>";
$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
$(document).ready(function(){
    
    	$("#mytopics,#popular,#agree,#date,#last_post,#alltopics").click(function() {
            var ID = $(this).attr("id");
            $("#show_mytopics_tbl").hide();
            $("#show_popular_tbl").hide();
            $("#show_agree_tbl").hide();
            $("#show_date_tbl").hide(); 
            $("#show_last_post_tbl").hide(); 
            $("#show_tbl_detail").hide();
    	   	$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
            
            if(ID=='mytopics'){
                
                <?php if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){?>
                    currect_section = "mytopics";
                    $('#mytopics').css({ 'color':'#000000' });
                    document.getElementById('popular').style.color = '#c3c3c3';
                    document.getElementById('agree').style.color = '#c3c3c3';
                    document.getElementById('date').style.color = '#c3c3c3';
                    document.getElementById('last_post').style.color = '#c3c3c3';
                    $("#show_mytopics_tbl").show();
                <?php }else{?>
                    window.location.href='<?php echo Yii::app()->createUrl('site/LoginUser');?>';
                <?php }?>
                
            }else if(ID=='popular'){
                currect_section = "popular";
                
                $('#popular').css({ 'color':'#000000' });
                document.getElementById('mytopics').style.color = '#c3c3c3';
                document.getElementById('agree').style.color = '#c3c3c3';
                document.getElementById('date').style.color = '#c3c3c3';
                document.getElementById('last_post').style.color = '#c3c3c3';
                $("#show_popular_tbl").show();
                    
            }else if(ID=='agree'){
                currect_section = "agree";
                
                $('#agree').css({ 'color':'#000000' });
                document.getElementById('mytopics').style.color = '#c3c3c3';
                document.getElementById('popular').style.color = '#c3c3c3';
                document.getElementById('date').style.color = '#c3c3c3';
                document.getElementById('last_post').style.color = '#c3c3c3';
                $("#show_agree_tbl").show();
                    
            }else if(ID=='date'){
                currect_section = "date";
                
                $('#date').css({ 'color':'#000000' });
                document.getElementById('mytopics').style.color = '#c3c3c3';
                document.getElementById('agree').style.color = '#c3c3c3';
                document.getElementById('popular').style.color = '#c3c3c3';
                document.getElementById('last_post').style.color = '#c3c3c3';
                $("#show_date_tbl").show();
                    
            }else if(ID=='last_post'){
                currect_section = "last_post";
                
                $('#last_post').css({ 'color':'#000000' });
                document.getElementById('mytopics').style.color = '#c3c3c3';
                document.getElementById('agree').style.color = '#c3c3c3';
                document.getElementById('popular').style.color = '#c3c3c3';
                document.getElementById('date').style.color = '#c3c3c3';
                $("#show_last_post_tbl").show();
                    
            }else if(ID=='alltopics'){
                currect_section = "alltopics";
                $("#show_tbl_detail").show();
            }
            $.unblockUI();
        });    
    $.unblockUI();  
	 
    $("#catall,#typeall").click(function(){
        $("#right_cattag_detail").hide();
        $("#right_typetag_detail").hide();
        $("#show_tbl_detail").show();
    });
    /*if('<?php echo (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1) ?>'==true){
        $("#agree").trigger("click");
    }*/
 });
 


    
   
 
//$('#show_tbl_detail').show();
</script>
<?php 
    unset($_SESSION['default_topic_ids']);
    unset($_SESSION['my_topic_ids']);
 ?>
 <div style="clear:both"></div>
  <div class="main">
  	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
    <div class="main_left">
        <?php $this->renderPartial('/topics/_topics_list_left_panel',$this->data);?>
    </div>
    <div class="main_mid new-width-t-r-t">
      <div class="topics">
        <div class="topic_head">
            <?php
            $tagCountTemp="";
            if(isset($this->data["tagCount"]) && $this->data["tagCount"] > 0){
                $tagCountTemp=" (".$this->data["tagCount"].")";
            } 
            echo isset($_GET['tag']) ? $_GET['tag'].$tagCountTemp  : "All TOPICS";
             
	      //if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
              //if(isset(Yii::app()->session['group_id']) && Yii::app()->session['group_id']==1){
              if(Yii::app()->session['group_id']==1 || Yii::app()->session['group_id']==3){  
	        ?>
              
	        <a href="<?php echo Yii::app()->createUrl('topics/Createnewtopic')?>" class="newtopic"><img src="<?php echo Yii::app()->baseUrl;?>/images/new_topic.jpg"/></a>
	        <?php
	        }
	        ?>
        </div>
      </div>
       <div class="menu1">
           <?php $agreeMenuDisplay = (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1)?"inline":"none"; ?>
            <a id="agree" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer; display: <?php echo $agreeMenuDisplay; ?>" >Agree &nbsp;|&nbsp;</a> 
            <a id="popular" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:  <?php //echo (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1)?"#c3c3c3":"#000000" ?>;" >Active &nbsp;|&nbsp;</a> 
            <a id="date" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;" >New &nbsp;|&nbsp;</a>
            <a id="last_post" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color: #000000;" >Last Post</a>
            <a id="mytopics" style="display:none; padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color: #c3c3c3;" >My</a>  
      
      </div>
      
    <!-- =======================START:COMMAN TABLE================================================-->
      <?php 
        if($_GET['searchtopics']== ''){ 
      ?>
      <div style="width:98%;display: none;<?php //echo (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1)?"none":"block"; ?>;padding-left: 10px; padding-bottom: 20px;" id="show_tbl_detail">
      <?php foreach($TopicListModel AS $TopicList){ ?>
        <?php $style=(!empty($TopicList->pin_to_top) && $TopicList->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicList->id;?>" <?php echo $style; ?>>
        <h2 style="font-family: tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicList->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
                <?php echo substr($TopicList->topic_title,0, 132) ?>
            </a></h2>
        <p class="toptext" style="font-family: tahoma; word-wrap: break-word;">
            <?php if(!empty($TopicList->topic_description)){
                 //echo $TopicList->topic_description;
                 echo strip_tags(myhelpers::get_cropped_text($TopicList->topic_description, 180));//substr($TopicList->topic_description,0, 180);
        	     if(strlen($TopicList->topic_description) > 180){
        	        echo "...";
        	     }
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153);padding-top: 2px; margin-left:20px;" class="datetime">
        <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
            <?php echo count($TopicList->all_posts_relation);?>&nbsp;&nbsp;
            <?php
                /*if(count($TopicList->all_posts_relation) > 0){
                    $stringtime= strtotime($TopicList->all_posts_relation[0]->created_date);
                    echo "Latest:".date('d/m/Y - H:i',$stringtime);
                }*/
            ?>
          </font>          
         </div>           
        </p>
      </div>
        <?php
                if($_SESSION['default_topic_ids']==""){
                    $_SESSION['default_topic_ids'] = $TopicList->id;
                }else{
                    $_SESSION['default_topic_ids'] .= ",".$TopicList->id;
                }     
        
            }
        ?>        
     </div>
     <?php }?>            

       <!-- =======================END:COMMAN TABLE================================================-->
      
       <!-- =======================START:MYTOPIC TABLE================================================-->
       
      <div style="padding-left: 10px;width:98%; vertical-align: top;display: none; " id="show_mytopics_tbl">
      <?php foreach($TopicListBymytopicsModel AS $TopicListBymytopics){ ?>
          <?php $style=(!empty($TopicListBymytopics->pin_to_top) && $TopicListBymytopics->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicListBymytopics->id;?>" <?php echo $style; ?>>
        <h2 style="font: Tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicListBymytopics->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
                
                 <?php echo substr($TopicListBymytopics->topic_title,0, 132)?>
                 
            </a>
        </h2>
        <p class="toptext" style="word-wrap: break-word;">
            <?php if(!empty($TopicListBymytopics->topic_description)){
                 //echo $TopicList->topic_description;
                 echo strip_tags(myhelpers::get_cropped_text($TopicListBymytopics->topic_description, 180));//substr($TopicListBymytopics->topic_description,0, 180);
        	     if(strlen($TopicListBymytopics->topic_description) > 180){
        	        echo "...";
        	     }
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153); margin-bottom: 2px; margin-left:20px;" class="datetime">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
                <?php echo count($TopicListBymytopics->all_posts_relation);?>&nbsp;&nbsp;
                <!-- Latest:
                        <?php
                        if(count($TopicListBymytopics->all_posts_relation) > 0){
                            $stringtime= strtotime($TopicListBymytopics->all_posts_relation[0]->created_date);
                            //echo date('d/m/Y - H:i',$stringtime);
                        }
                       ?> 
                -->
              </font>          
         </div>           
        </p>
      </div>
        <?php
        
                if($_SESSION['my_topic_ids']==""){
                    $_SESSION['my_topic_ids'] = $TopicListBymytopics->id;
                }else{
                    $_SESSION['my_topic_ids'] .= ",".$TopicListBymytopics->id;
                }     
            
            }
        ?>        
     </div>
       

       <!-- =======================END:MYTOPIC TABLE================================================--> 
      
       
       
       <!-- =======================START:POPULAR TABLE================================================-->
      <?php 
        if($_GET['searchtopics']!= ''){ 
            $display="block";
        }else{
            $display="none";
        }
      ?>
      <div style="padding-left: 10px;width:98%; vertical-align: top; display:none ;" id="show_popular_tbl">
        <?php
            $popular_last_id = 0;
            foreach($TopicListBypopularModel AS $TopicListBypopular){
        ?>
      <?php $style=(!empty($TopicListBypopular->pin_to_top) && $TopicListBypopular->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicListBypopular->id;?>" <?php echo $style; ?>>
        <h2 style="font: Tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicListBypopular->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
             <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
             <?php echo substr($TopicListBypopular->topic_title,0, 132)?>
             
            </a> 
        </h2>
        <p class="toptext" style="word-wrap: break-word;">
            <?php if(!empty($TopicListBypopular->topic_description)){
                 //echo $TopicList->topic_description;
                 echo strip_tags(myhelpers::get_cropped_text($TopicListBypopular->topic_description, 180));//substr($TopicListBypopular->topic_description,0, 180);
        	     if(strlen($TopicListBypopular->topic_description) > 180){
        	        echo "...";
        	     }
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153); margin-bottom: 2px; margin-left:20px;" class="datetime">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
                <?php echo count($TopicListBypopular->all_posts_relation);?>&nbsp;&nbsp;
                <!-- Latest:
                        <?php
                        if(count($TopicListBypopular->all_posts_relation) > 0){
                            $stringtime= strtotime($TopicListBypopular->all_posts_relation[0]->created_date);
                            //echo date('d/m/Y - H:i',$stringtime);
                        }
                       ?>                    
                -->
              </font>          
         </div>           
         </p>
      </div>
            <?php
                $popular_last_id = $TopicListBypopular->id;
            }
            ?>
     </div>
       

       <!-- =======================END:POPULAR TABLE================================================--> 
       
       
       <!-- =======================START:AGREE TABLE================================================-->
      <?php 
        if($_GET['searchtopics']!= '' || (isset(Yii::app()->session['dialog_id']) && TopicQuestions::model()->count('dialog_id=:did AND question1<>""', array(':did'=>$dialogID))>=1)){ 
            $display="block";
        }else{
            $display="none";
        }
        $display = "none";
      ?>
      <div style="padding-left: 10px;width:98%; vertical-align: top; display:<?=$display ?> ;" id="show_agree_tbl">
        <?php
            $agree_last_id = 0;
            foreach($TopicListByagreeModel AS $TopicListByagree){
        ?>
      <?php $style=(!empty($TopicListByagree->pin_to_top) && $TopicListByagree->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicListByagree->id;?>" <?php echo $style; ?>>
        <h2 style="font: Tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicListByagree->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
             <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
             <?php echo substr($TopicListByagree->topic_title,0, 132)?>
             
            </a> 
        </h2>
        <p class="toptext" style="word-wrap: break-word;">
            <?php if(!empty($TopicListByagree->topic_description)){
                 //echo $TopicList->topic_description;
                 echo strip_tags(myhelpers::get_cropped_text($TopicListByagree->topic_description, 180));//substr($TopicListByagree->topic_description,0, 180);
        	     if(strlen($TopicListByagree->topic_description) > 180){
        	        echo "...";
        	     }
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153); margin-bottom:2px; margin-left:20px;" class="datetime">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
                <?php echo count($TopicListByagree->all_posts_relation);?>&nbsp;&nbsp;
                <!--Latest:
                        <?php
                        if(count($TopicListByagree->all_posts_relation) > 0){
                            $stringtime= strtotime($TopicListByagree->all_posts_relation[0]->created_date);
                            //echo date('d/m/Y - H:i',$stringtime);
                        }
                       ?>                    
                -->      
            </font>          
        </div>           
         </p>
      </div>
            <?php
                $agree_last_id = $TopicListByagree->id;
            }
            ?>
     </div>
       

       <!-- =======================END:AGREE TABLE================================================--> 
       
       
       
       
       <!-- =======================START:DATE TABLE================================================-->

      <div style="padding-left: 10px;width:98%; vertical-align: top;display: none;" id="show_date_tbl">
        <?php
            $date_last_id = 0;
            foreach($TopicListBydateModel AS $TopicListBydateModel){
          ?>
      <?php $style=(!empty($TopicListBydateModel->pin_to_top) && $TopicListBydateModel->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicListBydateModel->id;?>" <?php echo $style; ?>>
        <h2 style="font: Tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicListBydateModel->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
            <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
             <?php echo substr($TopicListBydateModel->topic_title,0, 132)?>
            
             </a>
        </h2>
        <p class="toptext">
            <?php if(!empty($TopicListBydateModel->topic_description)){
                 //echo $TopicList->topic_description;
                 echo "<div style='word-wrap: break-word;'>".strip_tags(myhelpers::get_cropped_text($TopicListBydateModel->topic_description, 180));//substr($TopicListBydateModel->topic_description, 0, 180);
        	     if(strlen($TopicListBydateModel->topic_description) > 180){
        	        echo "...";
        	     }
                     echo "</div>";
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153); margin-bottom: 2px; margin-left:20px;" class="datetime">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
                <?php echo count($TopicListBydateModel->all_posts_relation);?>&nbsp;&nbsp;
                <!-- Latest: 
                        <?php
                        if(count($TopicListBydateModel->all_posts_relation) > 0){
                            $stringtime= strtotime($TopicListBydateModel->all_posts_relation[0]->created_date);
                            //echo date('d/m/Y - H:i',$stringtime);
                        }
                       ?> 
                -->
            </font>          
        </div>           
        </p>
      </div>
        <?php
            $date_last_id = $TopicListBydateModel->id;
        }
        ?>
     </div>
       
       <!-- =======================END:DATE TABLE================================================--> 
       
       
       
       <!-- =======================START:LAST POST TABLE================================================-->

      <div style="padding-left: 10px;width:98%; vertical-align: top;display: block;" id="show_last_post_tbl">
        <?php
            $last_post_last_id = 0;
            foreach($TopicListBylastpostModel AS $TopicListBylastpostModel){
          ?>
      <?php $style=(!empty($TopicListBylastpostModel->pin_to_top) && $TopicListBylastpostModel->pin_to_top==1)?"style='background-color:rgb(255,252,192)'":""; ?>
      <div class="topic1" id="<?php echo $TopicListBylastpostModel->id;?>" <?php echo $style; ?>>
        <h2 style="font: Tahoma;size: auto;text-decoration-color:#3C1B85 ;">
            <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicListBylastpostModel->id))?>" style="text-decoration: none;color: #3C1B85;font-size: 17.5px;">
            <img src="<?php echo Yii::app()->baseUrl;?>/images/Square.png"/>
             <?php echo substr($TopicListBylastpostModel->topic_title,0, 132)?>
            
             </a>
        </h2>
        <p class="toptext">
            <?php if(!empty($TopicListBylastpostModel->topic_description)){
                 //echo $TopicList->topic_description;
                 echo "<div style='word-wrap: break-word;'>".strip_tags(myhelpers::get_cropped_text($TopicListBylastpostModel->topic_description, 180));//substr($TopicListBylastpostModel->topic_description, 0, 180);
        	     if(strlen($TopicListBylastpostModel->topic_description) > 180){
        	        echo "...";
        	     }
                echo "</div>";
             } ?>
         </p>
        <p class="topictext">
        <div style="color: rgb(153, 153, 153); margin-bottom: 2px; margin-left:20px;" class="datetime">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>
            <font size="-1">
                <?php echo count($TopicListBylastpostModel->all_posts_relation);?>&nbsp;&nbsp;
                    <?php
                    if(count($TopicListBylastpostModel->all_posts_relation) > 0){
                        $stringtime= strtotime($TopicListBylastpostModel->all_posts_relation[0]->created_date);
                        //echo "Latest:";
                        echo date('d/m/Y - H:i',$stringtime);
                    }
                   ?>
            </font>          
        </div>           
        </p>
      </div>
        <?php
            $last_post_last_id = $TopicListBylastpostModel->id;
        }
        ?>
     </div>
       
       <!-- =======================END:LAST POST TABLE================================================--> 
    
    
       <!-- =======================START:FOR CATEGORY TAG DETAIL===========================================// -->
       
        <table style="width:100%; vertical-align: top;display: none;" id="toggle_column" >
            
            <tr style="background: none repeat scroll 0 0 #3C1B85;height: 23px;margin-top: 10px;width: 100%;">
                <td class="topic_head" style="width: 100%;">
                    <div style="float: left;">Category</div>
                    <div style="float: left;padding-left: 70%;">
                        
                        <?php
                          if($tagdetailmodel->user_id == Yii::app()->session['user_id']){
                        ?>
                        <a href="#signup" name="signup" rel="leanModal" id="go" style="color: #FFFFFF;font-size: 12px; font-weight: normal; text-transform: none;">Edit Tag</a>
                    
                        <?php
                        }
                        ?>
                    </div>
                </td>
                
            </tr>
            <tr>
                <td>
                    <table class="content_box form_lable" style="width:100%; vertical-align: top;">
                            
                        <tr>
                        	<td height="30" style="vertical-align: top; color: #3C1B85;font-size: small;font-weight: normal; "><?php echo ucwords($tagdetailmodel->cat_tag);?>
                            
                                <!-- <?php
                                if($tagdetailmodel->user_id == Yii::app()->session['user_id']){
                                ?>
                                <a href="#signup" name="signup" rel="leanModal" id="go" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Tag</a>
                                <?php
                                }
                                ?> -->
                            </td>
                        </tr>
                        
                        <tr>
                        	<td class="fontweight">
                        	    <?php echo $tagdetailmodel->cat_tag_description;?>
                        	</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; ">CreatedBy/Date</td>
                        </tr>
                        <tr>
                        	<td class="fontweight" >
                                <table>
                                    <tr>
                                        <td style="color: #666666;font: 8pt/16px Arial,Helvetica,sans-serif;">
                                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$tagdetailmodel->categoryTags_username->id))?>"><?php echo $tagdetailmodel->categoryTags_username->username;?> </a>/        
                                        </td>
                                        <td style="color: #666666;font: 8pt/16px Arial,Helvetica,sans-serif;">
                                            <?php
                                            $stringtime= strtotime($tagdetailmodel->created_date);
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
         
    <!-- =======================END:FOR CATEGORY TAG DETAIL===========================================// -->     
    <!-- =======================START:FOR TYPE TAG DETAIL===========================================// -->
        <table style="width:99%; vertical-align: top;display: none;margin: 8px 10px;" id="toggle_typetag_column" >
            <tr style="background: none repeat scroll 0 0 #3C1B85;height: 23px;margin-top: 10px;width: 100%;">
                
                <td class="topic_head" style="width: 100%;">
                    <div style="float: left;">rules</div>
                    <div style="float: left;padding-left: 75%;">
                        
                        <?php
                          if($typetagdetailmodel->user_id == Yii::app()->session['user_id']){
                        ?>
                        <a href="#typesignup" name="signup" rel="leanModal" id="typego" style="color: #FFFFFF;font-size: 12px; font-weight: normal; text-transform: none;">Edit Tag</a>
                    
                        <?php
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="content_box form_lable" style="width:100%; vertical-align: top;">
                        <tr>
                        	<td height="30" style="vertical-align: top; color: #3C1B85;font-size: small;font-weight: normal; "><?php echo ucwords($typetagdetailmodel->type_tag);?>
                            
                             <!--   <?php
                                if($typetagdetailmodel->user_id == Yii::app()->session['user_id']){
                                ?>
                                <a href="#typesignup" name="signup" rel="leanModal" id="typego" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Tag</a>
                                <?php
                                }
                                ?>
                             -->
                            </td>
                        </tr>    
                        
                        <tr>
                        	<td class="fontweight">
                        	    <?php echo $typetagdetailmodel->type_tag_description;?>
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
                                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$typetagdetailmodel->typeTags_username->id))?>"><?php echo $typetagdetailmodel->typeTags_username->username;?> </a>/        
                                        </td>
                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                            <?php
                                            $stringtime= strtotime($typetagdetailmodel->created_date);
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
         
    <!-- =======================END:FOR TYPE TAG DETAIL===========================================// -->      
    </div>
 
    <div class="main_right" style="float:left">
    	<?php
		if(isset($_GET['tag']) && !empty($_GET['tag'])){
		    $class = 'class="active"';
		    $allclass = '';
		}else{
		    $allclass = 'class="active"';
		    $class = '';
		}
		?>
		<div class="category">
			<div class="category_head" style="font-size:14px">Tags</div>
			<div class="content_2 content"  style="height:auto;">
		    	<ul style="overflow-x: hidden;overflow-y: hidden; font-size:14px;">
		        	<li class="top">
		        		<a href="<?php echo Yii::app()->createUrl('topics/TopicsList', array('dialog_id'=>$dialogID))?>" <?php echo $allclass;?> >ALL TOPICS</a>
		        	</li>
		        	<?php 
                                
                                $curDialogCatsModel = CategoryTags::model()->findAll(array('select'=>'cat_tag','condition'=>'dialog_id=:dID', 'params'=>array(':dID'=>$dialogID)));
		        	$curDialogCats = array();
                                if(count($curDialogCatsModel)>0) {
                                    $curDialogCats = array();
                                    foreach($curDialogCatsModel as $dialCatMod) {
                                        $curDialogCats[] = trim($dialCatMod['cat_tag']);
                                    }
                                }
                                
                                $tmp_cat_tags_array = array();
		        	foreach($tagmodel as $tag_cat){
		          		$ex_cat_tag = explode(",",$tag_cat->category_tags);
		            	for($i=0;$i<count($ex_cat_tag);$i++){
                                    if(in_array(trim($ex_cat_tag[$i]), $curDialogCats)){
		             		$tmp_cat_tags_array[] = trim($ex_cat_tag[$i]); 
                                    }
		            	}
		        	}
                                
                                $short_array=array_count_values($tmp_cat_tags_array);
		         	arsort($short_array);
					foreach($short_array as $key=>$value){
						if(!empty($key)){
		            		if($key == $_GET['tag']){
		                		//this variable is used in header of topic name and count. 
		                		$this->data["tagCount"]=$value; 
		            		}
		         	?>
		            <li>
		                <a href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$key,'searchtopics'=>'mytagscat', 'dialog_id'=>$dialogID))?>" <?php if($key == $_GET['tag']){ echo $class; }?> ><?php echo $key;?> <?php echo ($value>1) ? " (".$value.")" : ""; ?></a>
		            </li>
		        	<?php
						}
					}
		        	?>
				</ul>
			</div>  
		</div>
    	<!-- =======================START:CATEGORY TAG DETAIL===========================================// -->      
		<?php
		/*
		commented by atul 2015-12-23 05-36 PM
		if(!empty($tagdetailmodel)){
		?>
		<div id="right_cattag_detail">
        	<div class="categoryr_head" id="tag_title">Category Tag</div>
        	<div class="cat1">
          		<div class="tag1" id="tag_title" style="font: 15px Arial,Helvetica,sans-serif;"><?php echo ucwords($tagdetailmodel->cat_tag);?></div>
          		<div class="tagtext">
					<?php
            	    echo substr($tagdetailmodel->cat_tag_description,0, 100);
            	    if(strlen($tagdetailmodel->cat_tag_description) > 100){
            	        echo "...";
            	    }
                    ?>&nbsp;&nbsp;&nbsp;<a style="cursor: pointer;" id="more">More</a>
				</div>
        	</div>
      	</div>
      	<?php
		}
		*/
		?>
		<!-- =======================END:FOR CATEGORY TAG DETAIL===========================================// -->      

    	<!-- =======================START:ROLES DETAIL===========================================// -->      
		<?php if(!empty($typetagdetailmodel)){ ?>
		<div id="right_typetag_detail">
        	<div class="categoryr_head" id="tag_title">Rules</div>
        	<div class="cat1">
          		<div class="tag1" id="tag_title"><?php echo ucwords($typetagdetailmodel->type_tag);?></div>
          		<div class="tagtext">
                <?php
            	echo substr($typetagdetailmodel->type_tag_description,0, 100);
            	if(strlen($typetagdetailmodel->type_tag_description) > 100){
            		echo "...";
            	}
                ?>&nbsp;&nbsp;&nbsp;<a style="cursor: pointer;" id="typetagmore">More</a>
               	</div>
          		<div class="date" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: bold;"> Created by/Date:</div>
          		<div class="tagtext">
            		<a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$typetagdetailmodel->typeTags_username->id))?>"><?php echo ucfirst($typetagdetailmodel->typeTags_username->username);?></a>, <a><?php echo date('d-m-Y',strtotime($typetagdetailmodel->created_date));?></a>
            	</div>
        	</div>
		</div>
      	<?php } ?>
        <!-- =======================END:ROLES DETAIL===========================================// -->      
	
        <?php if(Yii::app()->session['user_id'] && (!isset($_GET['survey']) || $_GET['survey']!='done')): ?>
            <!--//////////////// START:: ADD TAKE OUR SURVEY BUTTON -->
            <?php /*
            <div class="take-our-survey-div">
                <button class='take-our-survey-button'>Take our Survey</button>
            </div>
             */ ?>
            <!--//////////////// END:: ADD TAKE OUR SURVEY BUTTON -->
        <?php endif; ?>
        </div>
    <div style="clear:both"></div>

 

    <!-- =======================START:CATEGORY CREATE POPUP ===========================================// -->      
    <div id="signup" style="display: none;">
        
    <form action="" id="registerSubmit" onsubmit="return categoryTag_add();">
    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0">
        <tr>
            <th class="tagtitle-new" align="left">Create New Category Tag<a class="modal_close" style="right: 3px;top: 3px;"></a></th>
        </tr>
        <tr>
            <td width="30%" style="padding:5px 12px;">
                <div class="create-new-tag-lable">Tag Name</div>
                <div class="create-new-tag-div" style="border: 1px solid #00A2E8">
                    <?php echo $tagdetailmodel->cat_tag;?>
                </div>
                <div class="create-new-tag-lable">Tag Description</div>
                <div>
                    <textarea id="description" name="description" style="width:250px;height:50px" ><?php echo $tagdetailmodel->cat_tag_description;?></textarea>                        
                    <input type="hidden" name="cat_tag_id" id="cat_tag_id" value="<?php echo $tagdetailmodel->id;?>" />
                </div>
                <div style="padding:5px 0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" valign="top">&nbsp;</td>
                            <td width="63" align="right" valign="top">&nbsp;</td>
                            <td width="10" align="right" valign="top">&nbsp;</td>
                            <td align="right" valign="top">
                                <input class="Submit fl" type="submit" value="Save" name="submit" onclick="selectDescription();"/>                                 
                            </td>
                        
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
	</form>
        
        
        
        
        
    </div>
    <!-- =======================END:CATEGORY CREATE POPUP ===========================================// -->      
    
    <!-- =======================START:RULES CREATE POPUP ===========================================// -->      

    <div id="typesignup" style="display: none;">
        
    <form action="" id="registerSubmit" onsubmit="return typeTag_add();">
    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0" >
        <tr>
            <th class="tagtitle-new" align="left">Create New Rule Tag<a class="modal_close" style="right: 3px;top: 3px;"></a></th>
        </tr>
        <tr>
            <td width="30%" style="padding:5px 12px;">
                <div class="create-new-tag-lable">Tag Name</div>
                <div class="create-new-tag-div" style="border: 1px solid #00A2E8">
				    <?php echo $typetagdetailmodel->type_tag;?>
                </div>
                <div class="create-new-tag-lable">Tag Description</div>
                <div>
				    <textarea id="typedescription" name="typedescription" type="text" style="width:250px;height:50px" ><?php echo $typetagdetailmodel->type_tag_description;?></textarea>
                    <input type="hidden" name="type_tag_id" id="type_tag_id" value="<?php echo $typetagdetailmodel->id;?>" />
                </div>
                <div style="padding:5px 0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" valign="top">&nbsp;</td>
                            <td width="63" align="right" valign="top">
                                <!--<a style="text-decoration: none;" href="/wedialog">
                                    <input class="Submit fl" type="button" value="Cancel" name="submit">
                                </a>                              
                                <img src="<?php //echo Yii::app()->createUrl('images/new-cancel-buttan.png');?>" width="63" height="19" />-->
                            </td>
                            <td width="10" align="right" valign="top">&nbsp;</td>
                            <td align="right" valign="top">
                                <input class="Submit fl" type="submit" value="Save" name="submit" onclick="selectDescription();"/>                                 
                                <!--<img src="<?php //echo Yii::app()->createUrl('images/new-save-buttan.png');?>" width="65" height="19" />-->
                            </td>
                        
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
	</form>        
        
    
        
    </div>
    
   </div> 
    
<script>
    function selectDescription(){
        //tinyMCE.triggerSave();
    }
</script>
    
    
    <!-- =======================END:RULES CREATE POPUP ===========================================// -->      
    	
<script>
//var next_page = 1;
//var last_id = '<?php echo $last_id;?>';

var alltopics_next_page = 1;
var mytopics_next_page = 1;
var popular_next_page = 1;
var agree_next_page = 1;
var date_next_page = 1;
var last_post_next_page = 1;

var alltopics_last_id = '<?php echo $_SESSION['default_topic_ids'];?>';
//alert(alltopics_last_id);
var mytopics_last_id = '<?php echo $_SESSION['my_topic_ids'];?>';
var popular_last_id = <?php echo $popular_last_id;?>;
var agree_last_id = <?php echo $agree_last_id;?>;
var date_last_id = <?php echo $date_last_id;?>;
var last_post_last_id = <?php echo $last_post_last_id;?>;

var alltopics_ajax_msg = "";
var mytopics_ajax_msg = "";
var popular_ajax_msg = "";
var agree_ajax_msg = "";
var date_ajax_msg = "";
var last_post_ajax_msg = "";

var currect_section_div_id = "";
$(function(){

    var scrollFunction = function(){
    	
        var mostOfTheWayDown = ($(document).height() - $(window).height()) * 2 / 3;
        if ($(window).scrollTop() > mostOfTheWayDown) {
        	data_str = "";
            if(currect_section == "alltopics" && alltopics_ajax_msg==""){
        		data_str = "currect_section=alltopics&next_page="+alltopics_next_page+"&last_id="+alltopics_last_id;
        		currect_section_div_id = "show_tbl_detail";
        		if(alltopics_last_id!=0){
        			$("#loading_div").show();
        		}
            }else if(currect_section == "mytopics" && mytopics_ajax_msg==""){
                //alert(mytopics_last_id);
            	data_str = "currect_section=mytopics&next_page="+mytopics_next_page+"&last_id="+mytopics_last_id;
            	currect_section_div_id = "show_mytopics_tbl";
            	if(mytopics_last_id!=0){
        			$("#loading_div").show();
        		}
            }else if(currect_section == "popular" && popular_ajax_msg==""){
            	data_str = "currect_section=popular&next_page="+popular_next_page+"&last_id="+popular_last_id;
            	currect_section_div_id = "show_popular_tbl";
            	if(popular_last_id!=0){
        			$("#loading_div").show();
        		}
            }else if(currect_section == "agree" && agree_ajax_msg==""){
            	data_str = "currect_section=agree&next_page="+agree_next_page+"&last_id="+agree_last_id;
            	currect_section_div_id = "show_agree_tbl";
            	if(agree_last_id!=0){
        			$("#loading_div").show();
        		}
            }else if(currect_section == "date" && date_ajax_msg==""){
            	data_str = "currect_section=date&next_page="+date_next_page+"&last_id="+date_last_id;
            	currect_section_div_id = "show_date_tbl";
            	if(date_last_id!=0){
        			$("#loading_div").show();
        		}
            }else if(currect_section == "last_post" && last_post_ajax_msg==""){
            	data_str = "currect_section=last_post&next_page="+last_post_next_page+"&last_id="+last_post_last_id;
            	currect_section_div_id = "show_last_post_tbl";
            	if(last_post_last_id!=0){
        			$("#loading_div").show();
        		}
            }
            if(data_str != ""){
	            $(window).unbind("scroll");
                //$.blockUI({ css: { backgroundColor: '#00A4B3', color: '#fff'} });
               // alert(alltopics_last_id);
              // $("#loading_div").show();
                $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});

                $.ajax({
	                url: "<?php echo Yii::app()->createUrl('topics/Gettopics', $_GET); ?>",
	                data: data_str,
	                dataType: "html",
	                type: "POST",
	                success: function(topic_data){
	                    //alert(topic_data);
	                    var topic_result = topic_data.split("======");
	                    /*if(topic_result[0] > 0){*/
	                    	$(window).scroll(scrollFunction);

	                    	last_id = topic_result[1];
                            
                            
		                     if(currect_section == "alltopics"){
		    	            	alltopics_next_page++;
		    	            	alltopics_last_id = last_id; 
		    	            }else if(currect_section == "mytopics"){
		    	            	mytopics_next_page++;
		    	            	mytopics_last_id = last_id;
		    	            }else if(currect_section == "popular"){
		    	            	popular_next_page++;
		    	            	popular_last_id = last_id;
                                    }else if(currect_section == "agree"){
		    	            	agree_next_page++;
		    	            	agree_last_id = last_id;
		    	            }else if(currect_section == "date"){
		    	            	date_next_page++;
		    	            	date_last_id = last_id;
		    	            }else if(currect_section == "last_post"){
		    	            	last_post_next_page++;
		    	            	last_post_last_id = last_id;
		    	            }
	                    /*}*/
	                    //$(window).scroll(scrollFunction);

	                    //$("#topic_list_table").append(topic_result[2]);
	                    $("#"+currect_section_div_id).append(topic_result[2]);
	     				$("#loading_div").hide();               
                        //$.unblockUI();
	                }
	            });
                $.unblockUI();
	            //next_page++;
            }
        }
       //
    };
    
    $(window).scroll(scrollFunction);
    
}); 
</script>

<script type='text/javascript'>
    $(".take-our-survey-button").click(function(){
        var retUrl = "<?php echo Yii::app()->request->hostInfo.Yii::app()->request->getRequestUri().'&survey=done'; ?>";
        $.ajax({
            url: "<?php echo Yii::app()->createAbsoluteUrl('topics/createSSOUrl'); ?>",
            type: "POST",
            data: {uid: "<?php echo Yii::app()->session['user_id']; ?>", retUrl: retUrl},
            success: function(data){
                window.open(data);
            }
        });
        return false;
    });
</script>

<div style="height: 51px; width: 100%; float: left;display: none; position: fixed; margin-top: 600px;" id="loading_div">
<img style="float: right; margin-right: 300px;" src="../images/ajax-loader.gif">
</div>