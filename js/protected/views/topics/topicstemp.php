<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
    tinymce.init({selector:'textarea',
        plugins: "autolink",
        paste_auto_cleanup_on_paste :true,
        forced_root_block : false,   
        menubar:false,
        statusbar: false,
        toolbar: false,
        content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
    });
</script>

<style type="text/css">
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}
</style>

<style>
		.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
		.content_2{height:246px;}
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
            
            $("#show_mytopics_tbl").hide();
            $("#show_popular_tbl").hide();
            $("#show_date_tbl").hide(); 
            $("#show_tbl_detail").hide();
         
            $("#more").html("Less");
        }else{
            $("#show_tbl_detail").show();
            $("#more").html("More");
        }
    });
    $("#typetagmore").click(function() {
        
        $("#toggle_typetag_column").toggle();
        if($("#typetagmore").html()=="More"){
            
            $("#show_mytopics_tbl").hide();
            $("#show_popular_tbl").hide();
            $("#show_date_tbl").hide(); 
            $("#show_tbl_detail").hide();
         
            $("#typetagmore").html("Less");
        }else{
            $("#show_tbl_detail").show();
        
            $("#typetagmore").html("More");
        }
    });
});
</script>
<script type="text/javascript">
var currect_section = "alltopics";
$(document).ready(function(){
	$("#mytopics,#popular,#date,#alltopics").click(function() {
		var ID = $(this).attr("id");

        $("#show_mytopics_tbl").hide();
        $("#show_popular_tbl").hide();
        $("#show_date_tbl").hide(); 
        $("#show_tbl_detail").hide();
 
        if(ID=='mytopics'){
        	currect_section = "mytopics";
            $("#show_mytopics_tbl").show();
        }else if(ID=='popular'){
        	currect_section = "popular";
            $("#show_popular_tbl").show();    
        }else if(ID=='date'){
        	currect_section = "date";
            $("#show_date_tbl").show();    
        }else if(ID=='alltopics'){
        	currect_section = "alltopics";
            $("#show_tbl_detail").show();
        }
    });

    $("#catall,#typeall").click(function() {
        $("#right_cattag_detail").hide();
        $("#right_typetag_detail").hide();
        $("#show_tbl_detail").show();
    });
});
</script>
<tr>
    <td colspan="3">
        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="logo" style="width:20%"><a href="<?php echo Yii::app()->createUrl('/')?>"><img src="<?php echo Yii::app()->createUrl()?>/images/logo.png" width="179" height="52" /></a></td>
                <td class="page_title">Topics</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td class="left_column" style="padding-top: 8px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                    <td class="td-conten-bg">
                    	<div class="content_2 content">
                			  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="form_lable" floot="none">
                                <tr>
                                	<td height="20">Category Tags</td>
                                </tr>
                                <tr>
                                	<td height="20" id="catall">
                                        <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/TopicsList')?>"> 
                                                   ALL
                                        </a>
                                    </td>
                                </tr>
	
                                
                                  <?php 
                                    $tmp_cat_tags_array = array();
                                    foreach($tagmodel as $tag_cat){
                                      $ex_cat_tag=explode(",",$tag_cat->category_tags);
                        			    for($i=0;$i<count($ex_cat_tag);$i++){
                        			     $tmp_cat_tags_array[] = trim($ex_cat_tag[$i]);  
                        			    }
                        			}
                                     $short_array=array_count_values($tmp_cat_tags_array);
                                     arsort($short_array);
                                            
                        			foreach($short_array as $key=>$value){
                        			 
                        			 if(!empty($key)){?>
                        				<tr>
                        			    	<td class="form_lable_normal" height="20" style="font-weight: lighter !important;">
                                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$key,'searchtopics'=>'mytagscat'))?>"> <?php echo $key;?> </a>
                                            <?php echo ($value>1) ? " (".$value.")" : ""; ?></td>
                        			    </tr> 
                        			             
                        			<?  } }
                        			?>
                                  
                                </table>
                                
                                
                		</div>
                    </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                    <td class="td-conten-bg">
                    	<div class="content_2 content">
                			  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="form_lable" >
                                <tr>
                                	<td height="20">Type Tags</td>
                                </tr>
                                <tr>
                                	<td height="20" id="typeall">
                                        <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/TopicsList')?>"> 
                                               ALL
                                        </a>
                                    </td>
                                </tr>
                                
                                  <?php 
                                    $tmp_tags_array = array();
                                    foreach($tagmodel as $tag){
                                      $ex_type_tag=explode(",",$tag->type_tags);
                        			    for($i=0;$i<count($ex_type_tag);$i++){
                        			     $tmp_tags_array[] = trim($ex_type_tag[$i]);  
                        			    }
                        			}
                        			 $short_type_array=array_count_values($tmp_tags_array);
                                     arsort($short_type_array);
                                                
                        			foreach($short_type_array as $key=>$value){ 
                        			 if(!empty($key)){?>
                        				<tr>
                        			    	<td height="20" style="font-weight: lighter !important;">
                                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$key,'searchtopics'=>'mytagstype'))?>"> <?php echo $key;?> </a>
                                            <?php echo ($value>1) ? " (".$value.")" : ""; ?></td>
                        			    </tr> 
                        			             
                        			<? } }
                        			?>
                                  
                                </table>
                                
                                
                		</div>
                    </td>
              </tr>              
                                          
              
          </table> 
          
          
    </td>
    
    <td class="middle_column">
        <table style="width:98%;">
                    <tr style="width:30px; height:30px; margin:5px 0 0 0;">
                        <td style="float:left;padding-left: 10px;" >
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="mytopics" >My Topics |</a>  
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="popular">Popular|</a> 
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="date">Date|</a>
                         <!--    <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;cursor: pointer; " id="alltopics">All</a> -->
                            <!--
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('searchtopics'=>'mytopics'))?>">My Topics |</a> 
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('searchtopics'=>'popular'))?>">Popular|</a> 
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('searchtopics'=>'mostcreated'))?>">Date|</a>
                            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none; " href="<?php echo Yii::app()->createUrl('topics/TopicsList')?>">All Tocips</a>
                            -->
                        </td>
                        <td style="float:right;padding-right: 10px;" >                
                            <a href="<?php echo Yii::app()->createUrl('topics/Createnewtopic')?>">
                                <img src="<?php echo Yii::app()->createUrl()?>/images/create-btn.png" width="121" height="25" />
                            </a>
                        </td> 
                    </tr>
         </table>
    <!-- =======================START:COMMAN TABLE================================================-->
        
        <table class="content_box form_lable" style="width:98%;" id="show_tbl_detail" >
             <?php
            $alltopics_last_id = 0;
            foreach($TopicListModel AS $TopicList){
            ?>
                    <!-- <tr>
                    	<td height="5"></td>
                    </tr>
                    <tr style=" border:#0066FF 1px solid; float:left; width:98%;">
                        <td > <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicList->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;"> <?php echo $TopicList->topic_title?> </a></td>
                    </tr>
                    <tr>
                    	<td height="5"></td>
                    </tr>-->
           <tr id="<?php echo $TopicList->id;?>" >
              <td style="width:100%">
                <table style="width: 100%;">
                    <tr>
                        <td style="width:100%" colspan="2">
                            <table style="width: 100%;">
                                <tr>                    
                                    <td style="width:100%; vertical-align: top;">
                                        <table width="100%" style="vertical-align: top;padding: 0px;" cellspacing="0" cellpadding="0" border="0">
                                            <tr style="vertical-align: top;">
                                                <td style=" float:left;font-size:18px;">
                                                    <a href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$TopicList->id))?>" style="color: #125D90;font-size: 12px; font-weight: bold; text-decoration: none;">
                                                     <?php echo $TopicList->topic_title?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="20" style="word-wrap: normal;color: #125D90;font-size: 12px;">
                                                    <?php if(!empty($TopicList->topic_description)){
                                                         //echo $TopicList->topic_description;
                                                         echo substr($TopicList->topic_description,0, 100);
                                                	     if(strlen($TopicList->topic_description) > 100){
                                                	        echo "...";
                                                	     }
                                                     } ?>
                                                     
                                                </td>
                                            </tr>
                                        </table>                    
                                    </td>
                                    
                                </tr>                                                                                                
                            </table>
                        </td>                    
                    </tr>
                    <tr>
                    	<td height="5" colspan="2"></td>
                    </tr>
                    <tr>
                    	<td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: bold;">Posts&nbsp;(<?php echo $TopicList->Totalcommentscount ?>)</td>
                        <td height="20" style="color: #125D90;font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: bold;width: 100px;">Last:
                                <?php if(!empty($TopicList->Lastdatetime) || $TopicList->Lastdatetime !=Null){
                                $stringtime= strtotime($TopicList->Lastdatetime);
                                echo date('d/m/Y',$stringtime);?>
                                - 
                                <?php
                                $stringtime= strtotime($TopicList->Lastdatetime);
                                echo date('H:i',$stringtime);
                                }?>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2"><hr style="border: 1px solid red;" /></td>
                    </tr>
               </table>
            </td>                    
         </tr>
        <?php
        $alltopics_last_id = $TopicList->id;
        }
        ?>
      
       </table>
       <!-- =======================END:COMMAN TABLE================================================-->
       
       
       <!-- =======================START:MYTOPIC TABLE================================================-->
       <table class="content_box form_lable" style="width:98%; vertical-align: top;display: none;" id="show_mytopics_tbl" >
            
       </table>
       
       
       <!-- =======================END:MYTOPIC TABLE================================================--> 
       
       <!-- =======================START:POPULAR TABLE================================================-->
       <table class="content_box form_lable" style="width:98%; vertical-align: top;" id="show_popular_tbl">
            
       </table>
       
       
       <!-- =======================END:POPULAR TABLE================================================--> 
       
       
       <!-- =======================START:DATE TABLE================================================-->
       <table class="content_box form_lable" style="width:98%; vertical-align: top;display: none;" id="show_date_tbl" >
           
       </table>
       <!-- =======================END:DATE TABLE================================================--> 


       <!-- =======================START:FOR CATEGORY TAG DETAIL===========================================// -->
        <table style="width:99%; vertical-align: top;display: none;" id="toggle_column" >
            <tr>
                <td>
                    <table class="content_box form_lable" style="width:100%; vertical-align: top;">
                            
                        <tr>
                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; "><?php echo ucwords($tagdetailmodel->cat_tag);?>
                            
                                <?php
                                if($tagdetailmodel->user_id == Yii::app()->session['user_id']){
                                ?>
                                <a href="#signup" name="signup" rel="leanModal" id="go" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Tag</a>
                                <?php
                                }
                                ?>
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
                        	<td class="fontweight">
                                <table>
                                    <tr>
                                        <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$tagdetailmodel->categoryTags_username->id))?>"><?php echo $tagdetailmodel->categoryTags_username->username;?> </a>/        
                                        </td>
                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
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
        <table style="width:99%; vertical-align: top;display: none;" id="toggle_typetag_column" >
            <tr>
                <td>
                    <table class="content_box form_lable" style="width:100%; vertical-align: top;">
                        <tr>
                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; "><?php echo ucwords($typetagdetailmodel->type_tag);?>
                            
                                <?php
                                if($typetagdetailmodel->user_id == Yii::app()->session['user_id']){
                                ?>
                                <a href="#typesignup" name="signup" rel="leanModal" id="typego" style="color: #125D90;font-size: 12px; float: right; font-weight: bold; text-decoration: none;">Edit Tag</a>
                                <?php
                                }
                                ?>
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
    </td>
    
    <td class="right_column" width="25%" style="padding-top: 8px;">
        <table class="content_box form_lable" style="width:98%" id="right_cattag_detail">
         
           <?php if(!empty($tagdetailmodel)){ ?>
            <tr>
            	<td height="30" id="tag_title" style="vertical-align: top; font: bolder !important;font-size: small; ">Category Tags
                </td>
            </tr>
			<tr>
            	<td height="30" id="tag_title" style="vertical-align: top; font: bolder !important;font-size: small; "><?php echo ucwords($tagdetailmodel->cat_tag);?>
                </td>
            </tr>
            <tr>
            	<td height="20" style="word-wrap: normal" class="fontweight">
            	    <?php
            	    echo substr($tagdetailmodel->cat_tag_description,0, 100);
            	    if(strlen($tagdetailmodel->cat_tag_description) > 100){
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
                <td style="text-align: left;!important;color: #666666;">CreatedBy/Date:</td>
            </tr>
            <tr>
            	<td class="fontweight">
                    <table>
                        <tr>
                            <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$tagdetailmodel->categoryTags_username->id))?>"><?php echo $tagdetailmodel->categoryTags_username->username;?> </a>/        
                            </td>
                            <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
                                <?php 
                                $stringtime= strtotime($tagdetailmodel->created_date);
                                echo date('d-m-Y',$stringtime);?>     
                            </td>
                        </tr>
                    </table>
            	</td>
            </tr>
       <?php } ?>
       </table>
       
       <table class="content_box form_lable" style="width:98%" id="right_typetag_detail">
           
           <?php if(!empty($typetagdetailmodel)){ ?>
           <tr>
            	<td height="30" id="tag_title" style="vertical-align: top; font: bolder !important;font-size: small; ">Type Tags
                </td>
            </tr>
			<tr>
            	<td height="30" id="tag_title" style="vertical-align: top; font: bolder !important;font-size: small; "><?php echo ucwords($typetagdetailmodel->type_tag);?>
                </td>
            </tr>
            <tr>
            	<td height="20" style="word-wrap: normal" class="fontweight">
            	    <?php
            	    echo substr($typetagdetailmodel->type_tag_description,0, 100);
            	    if(strlen($typetagdetailmodel->type_tag_description) > 100){
            	        echo "...";
            	    }
                    ?>
                    <div style="height: 10;" ></div>
                    <div id="typetagmore" >More</div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: left;!important;color: #666666;">CreatedBy/Date:</td>
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
       <?php } ?>
       </table>
    </td>
</tr>

<div id="signup" style="display: none;">
			<div id="signup-ct">
				<div id="signup-header">
					<h2>Update Tag</h2>
					<a class="modal_close"></a>
				</div>
				
				<form action="" id="registerSubmit" onsubmit="return categoryTag_add();">
     
				  <div class="txt-fld">
				    <div style="float: left;">Tag Name : &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $tagdetailmodel->cat_tag;?></div>
				  
				  </div>
				  <div class="txt-fld">
				    <label for="description">Description</label>
				    <textarea id="description" name="description" type="text" style="width:250px;height:50px"  ><?php echo $tagdetailmodel->cat_tag_description;?></textarea>
				    <input type="hidden" name="cat_tag_id" id="cat_tag_id" value="<?php echo $tagdetailmodel->id;?>" /> 
				  </div>
				  
				  				  <div class="btn-fld">
				  <button type="submit" name="submit" value="Register" >Update &raquo;</button>
</div>
				 </form>
			</div>
</div>

<div id="typesignup" style="display: none;">
			<div id="typesignup-ct">
				<div id="typesignup-header">
					<h2>Update Tag</h2>
					<a class="modal_close" ></a>
				</div>
				
				<form action="" id="registerSubmit" onsubmit="return typeTag_add();">
     
				  <div class="txt-fld">
				   <div style="float: left;">Tag Name : &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $typetagdetailmodel->type_tag;?></div>
				  </div>
				  <div class="txt-fld">
				    <label for="description">Description</label>
				    <textarea id="typedescription" name="typedescription" type="text" style="width:250px;height:50px" ><?php echo $typetagdetailmodel->type_tag_description;?></textarea>
                    <input type="hidden" name="type_tag_id" id="type_tag_id" value="<?php echo $typetagdetailmodel->id;?>" />
				    
				  </div>
				  
				  				  <div class="btn-fld">
				  <button type="submit" name="submit" value="Register" >Update &raquo;</button>
</div>
				 </form>
			</div>
</div>	
<script>
//var next_page = 1;
//var last_id = < ?php echo $last_id;?>;

var alltopics_next_page = 1;
var mytopics_next_page = 1;
var popular_next_page = 1;
var date_next_page = 1;

var alltopics_last_id = <?php echo $alltopics_last_id;?>;
var mytopics_last_id = <?php echo $mytopics_last_id;?>;
var popular_last_id = <?php echo $popular_last_id;?>;
var date_last_id = <?php echo $date_last_id;?>;

var alltopics_ajax_msg = "";
var mytopics_ajax_msg = "";
var popular_ajax_msg = "";
var date_ajax_msg = "";

var currect_section_div_id = "";
$(function(){
    var scrollFunction = function(){
        var mostOfTheWayDown = ($(document).height() - $(window).height()) * 2 / 3;
        if ($(window).scrollTop() > mostOfTheWayDown) {
        	data_str = "";
            if(currect_section == "alltopics" && alltopics_ajax_msg==""){
        		data_str = "currect_section=alltopics&next_page="+alltopics_next_page+"&last_id="+alltopics_last_id;
        		currect_section_div_id = "show_tbl_detail";
            }else if(currect_section == "mytopics" && mytopics_ajax_msg==""){
            	data_str = "currect_section=mytopics&next_page="+mytopics_next_page+"&last_id="+mytopics_last_id;
            	currect_section_div_id = "show_mytopics_tbl";
            }else if(currect_section == "popular" && popular_ajax_msg==""){
            	data_str = "currect_section=popular&next_page="+popular_next_page+"&last_id="+popular_last_id;
            	currect_section_div_id = "show_popular_tbl";
            }else if(currect_section == "date" && date_ajax_msg==""){
            	data_str = "currect_section=date&next_page="+date_next_page+"&last_id="+date_last_id;
            	currect_section_div_id = "show_date_tbl";
            }
            if(data_str != ""){
	            $(window).unbind("scroll");
	            $.ajax({
	                url: "Gettopics",
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
		    	            }else if(currect_section == "date"){
		    	            	date_next_page++;
		    	            	date_last_id = last_id;
		    	            }
	                    /*}*/
	                    //$(window).scroll(scrollFunction);

	                    //$("#topic_list_table").append(topic_result[2]);
	                    $("#"+currect_section_div_id).append(topic_result[2]);
	                }
	            });
	            //next_page++;
            }
        }
    };
    $(window).scroll(scrollFunction);
}); 
</script>