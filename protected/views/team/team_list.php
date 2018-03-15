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

<style>
.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
.content_2{height:246px;overflow-y: hidden;}
.td-conten-bg{
	background: none repeat scroll 0 0 #FFFFCC;
	border: 1px solid #0066FF;
	padding: 5px;
}
.form_lable {
	color: #125D90;
	font-family:Arial, Helvetica, sans-serif;
	padding:3px 0px;
}
.form_lable_normal {
	color: #125D90;

	font-family:Arial, Helvetica, sans-serif;
	padding:3px 0px;
}
</style>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo Yii::app()->createUrl("js/jquery.blockUI.js");?>"></script>

<script>
    $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
    $(document).ready(function(){
        $(".content_2").mCustomScrollbar({
    		scrollInertia:150
    	});
        $.unblockUI();
    });    
</script>
    
<script type="text/javascript">
	$(function() {
		$('#typego').leanModal({ top : 200, closeButton: ".modal_close" });		
	});
</script>

<?php 
    unset($_SESSION['default_topic_ids']);
    unset($_SESSION['my_topic_ids']);
?>
<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
	<div class="main_left" style="border-bottom:none;">
 		<!--================================Start: left Panel===================================>-->
        <?php $this->renderPartial('/topics/_topics_list_left_panel',$this->data);
        /* 
            if(isset($_GET['tag']) && !empty($_GET['tag'])){
                $class = 'class="active"';
                $allclass = '';
            }else{
                $allclass = 'class="active"';
                $class = '';
            }
            ?>
            <div class="category">
            <div class="category_head">category</div>
                <div class="content_2 content">
                <ul style="overflow-x: hidden;overflow-y: hidden;">
                    <li class="top"><a href="<?php echo Yii::app()->createUrl('topics/TopicsList')?>" <?php echo $allclass;?> >ALL</a></li>
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
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$key,'searchtopics'=>'mytagscat'))?>" <?php if($key == $_GET['tag']){ echo $class; }?> ><?php echo $key;?> <?php echo ($value>1) ? " (".$value.")" : ""; ?></a>
                        </li>
                    <?  } }
                    ?>
                </ul>
              </div>  
            </div>
            <div class="rules">
            </div>
     	*/ 
     ?>       
<!--==========================End: left Panel==================================================>-->    
    </div>
    <div class="main_mid new-width-t-r-t">
      <div class="topics">
        <div class="topic_head">
        	<a style="color:white;" href="<?php Yii::app()->createUrl('Team/teamlist');?>">Groups</a>
        	<div class="edittopic topic_head" style="display:none; width:auto; float:right; padding: 0 1%;">
            <?php
            if($this->data['group_id']==1){
            ?>
            	<a style="color:white;" href="<?php echo Yii::app()->createUrl('site/editcms',array('id'=>6));?>">EDIT TEAM CMS</a>
            <?php
			}
			?>
			</div>
			<?php
			//if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){
			?>
	        <div class="common" style="float:right;">
				<a href="<?php echo Yii::app()->createUrl('team/createteam');?>" class="categorytag">
	            	<img src="<?php echo Yii::app()->createUrl('images/new_team.jpg');?>" />
	        	</a>
	        </div>
			<?php
			//}
			?>
        </div>
      </div class="menu1">
       <div style="padding-top: 12px;padding-left: 8px;" class="common" > 
            <a onclick="menu(this.id);" id="members" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:#000000;" >MEMBERS &nbsp;|&nbsp;</a>
            <a onclick="menu(this.id);" id="posts" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:#c3c3c3;" >POSTS &nbsp;|&nbsp;</a>
            <a onclick="menu(this.id);" id="new" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:#c3c3c3;">NEW</a>  
      </div>
      
    <!-- =======================START:COMMAN TABLE================================================-->
            <div style="width:98%;padding-left: 10px;display: ;" id="show_tbl_detail">
                <div class="common"><!--<div class="topic1 common">-->
                <?php $this->renderPartial('/team/_team_list',$this->data);?>    
                </div>
                    <div class="topic1 more_dis" style="display:none;" >
                        <div class="fontweight" style="color: #666666;font:Arial,Helvetica,sans-serif;"><?php echo $model_cms->description;?><br /><br /><span style="color: #666666;">Created by/Date:</span><br /><span style="color: #c3c3c3;font-weight: bold;">wedialog,</span><br /><?php echo date('m/d/Y',strtotime($model_cms->updated));?></div>
                    </div>
        </div>
       <!-- =======================END:COMMAN TABLE================================================-->
    </div>
    <div class="main_right" style="float: left; width:253px">
        <!-- //============================START:  RIGHT PANEL   =======================  -->
        <div class="category" id="toggle_column">
            <div class="topics">
                <div class="topic_head" style="width:95%;">
                    <div style="float: left;">
                        <div style="font-size:15px;color: white;cursor: pointer;" onclick="$('.more_dis').show();$('.edittopic').show();$('.common').hide();"> About Groups</div>
                    </div>
                </div>
            </div>
            <div class="short_dis" >
                <div class="fontweight" style="padding-left: 10px; padding-right:5px; color: #666666;font-family: Trebuchet MS, Tahoma, Arial,Helvetica,sans-serif;font-size: 14px;line-height:135%;">
                    <?php /* ?>
                    <?php echo substr($model_cms->description,0, 300);?>.....<br />
                    /<div style="font-family:Trebuchet MS,Tahoma,Arial,Helivetica,sans-serif;font-size:14px;color:#065A95;cursor: pointer;" onclick="$('.more_dis').show();$('.edittopic').show();$('.common').hide();">
                        More
                    </div> 
                    <?php */ ?>    
                    <?php echo $model_cms->description; ?><br />
                </div>
            </div>
        <!-- //============================END:  RIGHT PANEL    =======================  -->
    </div>
  </div>    
 </div> 
<script>
function menu(id){
    $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
    setTimeout(function(){
    document.getElementById('new').style.color = "#c3c3c3";
    document.getElementById('members').style.color = "#c3c3c3";
    document.getElementById('posts').style.color = "#c3c3c3";
    document.getElementById(id).style.color = "#000000";
     
    list_by="created_date";//for order NEW menu
    if(document.getElementById('members').style.color == "rgb(0, 0, 0)"){
         list_by="members";//for order members menu
    }else if(document.getElementById('posts').style.color == "rgb(0, 0, 0)"){
         list_by="posts";//for order DISAGREE menu
    }
    
       $.ajax({
			type: 'POST', 
			url: "<?php echo Yii::app()->createUrl('team/pagination');?>",
			data: "limit="+"<?php echo 30;?>"+"&list_by="+list_by,
			async:false,
			success: function(response){  
			     $('#show_tbl_detail').html(response);
                 //alert(response);return false;
			}
		});
            
    $.unblockUI(); 
    }, 300);
}
</script>
<script>
/*
$(window).scroll(function() {
    
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        list_by="created_date";//for order NEW menu
    if(document.getElementById('members').style.color == "rgb(0, 0, 0)"){
         list_by="members";//for order AGREE menu
    }else if(document.getElementById('posts').style.color == "rgb(0, 0, 0)"){
         list_by="posts";//for order DISAGREE menu
    }
      $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});

       $.ajax({
			type: 'POST', 
			url: "<?php echo Yii::app()->createUrl('team/pagination');?>",
			data: "limit="+"<?php echo ($_SESSION['limit'])+30;?>"+"&list_by="+list_by,
			async:false,
			success: function(response){  
			     $('#show_tbl_detail').html(response);
                 //alert(response);return false;
			}
		});
     $.unblockUI();   
   }
   
}); 
*/
</script>