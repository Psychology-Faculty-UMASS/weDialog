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
	font-weight: bold;
	font-family:Arial, Helvetica, sans-serif;
	padding:3px 0px;
}
.form_lable_normal {
	color: #125D90;
	font-weight: normal;
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
//$('#show_tbl_detail').show();	
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
	<div class="main_left">
		<?php $this->renderPartial('/topics/_topics_list_left_panel',$this->data);?>
	</div>
    <div class="main_mid new-width-t-r-t">
		<div class="topics">
        <div class="topic_head">
        	<a style="cursor: pointer;" onclick="$('.more_dis').hide();$('.edittopic').hide();$('.common').show();">Rules</a>
        	<div class="edittopic topic_head" style="display:none; float:right; width:auto; padding: 0 1%;">
            <?php
            if($this->data['group_id']==1){
            ?>
                <a style="color:white;" href="<?php echo Yii::app()->createUrl('site/editcms',array('id'=>5));?>">EDIT</a>
            <?php
			}
			?>
           </div>
           <?php //if(isset(Yii::app()->session['user_id']) && Yii::app()->session['user_id'] > 0){?>
           <div class="common" style="float:right">
            <a href="<?php echo Yii::app()->createUrl('TypeTags/createnewrules');?>" class="categorytag" style="float: right;color: white;padding-right: 1px;">
                <img src="<?php echo Yii::app()->createUrl('images/new_rule.jpg');?>" />
           </a>
           </div>
           <?php //} ?>
        </div>
      <!--==============End:create Rules tag==============================-->
      </div class="menu1">
       <div style="padding-top: 12px;padding-left: 9px;" class="common"  > 
            <a onclick="menu(this.id);" id="agree" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:#000000;" >AGREE &nbsp;|&nbsp;</a>
            <!--<a onclick="menu(this.id);" id="disagree" style="padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3;" >DISAGREE &nbsp;|&nbsp;</a>-->
            <a onclick="menu(this.id);" id="new" style="padding: 0 0 0 3px;vertical-align: top; text-decoration: none;cursor: pointer;color:#c3c3c3;">NEW</a>  
            <?php if($this->data['group_id']==1){ ?>
                <a href="<?php echo Yii::app()->createUrl('TypeTags/order');?>" style="float:right;padding: 0 5px 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3;">SELECT</a>
            <?php } ?>
      </div>
      
    <!-- =======================START:COMMAN TABLE================================================-->
            <div style="width:98%;display: block;padding-left: 10px;" id="show_tbl_detail">
                <div class="common">
                <?php
                 $this->renderPartial('/typeTags/_rules',$this->data);?>    
                </div>
                    <div class="topic1 more_dis" style="display:none;" >
                        <div class="fontweight" style="color: #666666;font:Arial,Helvetica,sans-serif;font-size: 13px;"><?php echo $model_cms->description;?><br /><br /><span style="color: #666666;">Created by/Date:</span><br /><span style="color: #c3c3c3;font-weight: bold;">Wedialog,</span><br /><?php echo date('m/d/Y',strtotime($model_cms->updated));?></div>
                    </div>
        </div>
       <!-- =======================END:COMMAN TABLE================================================-->
    </div>
    <div class="main_right" style="float: left; width:252px;">
    	<!-- //============================START:  RIGHT PANEL   =======================  -->
	    <div class="category" id="toggle_column">
	        <div class="topics">
	            <div class="topic_head">
					<a  style="cursor: pointer;" onclick="$('.more_dis').show();$('.edittopic').show();$('.common').hide();">RULES</a>
	            </div>
	        </div>
	        <div class="short_dis" >
	            <div class="fontweight" style="padding-left: 10px; padding-right: 5px; color: #666666;font-family:Trebuchet MS,Tahoma,Arial,Helvetica,sans-serif;font-size: 14px;line-height:135%;">
	                <?php /* ?>
                        <?php echo substr($model_cms->description,0, 300);?>.....<br />
	                <div style="font-size:0px;cursor: pointer;color: #065A95;" onclick="$('.more_dis').show();$('.edittopic').show();$('.common').hide();">
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
    document.getElementById('agree').style.color = "#c3c3c3";
    //document.getElementById('disagree').style.color = "#c3c3c3";
    document.getElementById(id).style.color = "#000000";
     
    list_by="created_date";//for order NEW menu
    if(document.getElementById('agree').style.color == "rgb(0, 0, 0)"){
         list_by="likes";//for order AGREE menu
    }/*else if(document.getElementById('disagree').style.color == "rgb(0, 0, 0)"){
         list_by="dislikes";//for order DISAGREE menu
    }*/
    
       $.ajax({
			type: 'POST', 
			url: "<?php echo Yii::app()->createUrl('TypeTags/pagination');?>",
			data: "limit="+"<?php echo 20;?>"+"&list_by="+list_by,
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
$(window).scroll(function() {
    
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        list_by="created_date";//for order NEW menu
    if(document.getElementById('agree').style.color == "rgb(0, 0, 0)"){
         list_by="likes";//for order AGREE menu
    }/*else if(document.getElementById('disagree').style.color == "rgb(0, 0, 0)"){
         list_by="dislikes";//for order DISAGREE menu
    }*/
       $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
       
       $.ajax({
			type: 'POST', 
			url: "<?php echo Yii::app()->createUrl('TypeTags/pagination');?>",
			data: "limit="+"<?php echo ($_SESSION['limit'])+20;?>"+"&list_by="+list_by,
			async:false,
			success: function(response){  
			     $('#show_tbl_detail').html(response);
                 //alert(response);return false;
			}
		});
       $.unblockUI(); 
   }
   
});

function likedislikerules(id,likedislike){
    var user_id = '<?php echo Yii::app()->session['user_id']?>';
    if(user_id != '' && user_id > 0){
        $.ajax({
    			type: 'POST', 
    			url: "<?php echo Yii::app()->createUrl('TypeTags/likedislike');?>",
    			data: "id="+id+"&likedislike="+likedislike,
    			async:false,
    			success: function(response){
    			    //alert(response);
    			    if(response == 'inactive')	
    			    {
    			    	$('#already_voted_message_'+id).show();
    			    	$('#already_voted_message_'+id).html("your ip is block for likedishlike.");
    			    	return false;
    			    }
    			     if(response=="available"){
    			         $('#already_voted_message_'+id).show();
    			     }
                     else{
                        if(likedislike == 'like'){
                            $('#likevaluespan_'+id).html(response);
                        }else if (likedislike == 'dislike'){
                            $('#dislikevaluespan_'+id).html(response);
                        }
                        //alert(response);return false;
                     }
                     
    			}
    		});
        }else{
            //alert('Please login first');
            window.location.href='<?php echo Yii::app()->createUrl('site/LoginUser')?>';
        }
        
         
 }  
</script>