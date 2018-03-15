<style>
.as_wrapper{
	margin:0 auto;
	width:500px;
	font-family:Arial;
	color:#333;
	font-size:14px;
}
.as_country_container{
	padding:20px;
	border:2px dashed #17A3F7;
	margin-bottom:10px;
}
</style>
<script src="<?php echo Yii::app()->createUrl("js/jquery.blockUI.js");?>"></script>

<script type="text/javascript">
var currect_section = "toppeople";
$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
$(document).ready(function(){
	//$("#toppeople,#oledestpeople,#newestpeople,#allpeople").click(function() {
    
    $("#toppeople,#agreepeople,#newestpeople,#allpeople,#greenflagpeople,#redflagpeople").click(function() {
        var ID = $(this).attr("id");
        $("#show_toppeople_tbl").hide();
        $("#show_agreepeople_tbl").hide();
        //$("#show_oldestpeople_tbl").hide(); 
        $("#show_newestpeople_tbl").hide();
        $("#show_greenflag_tbl").hide();
        $("#show_redflag_tbl").hide();
        $("#tbl_people_list").hide();

        $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
 
        if(ID=='toppeople'){
            currect_section = "toppeople";
            $('#toppeople').css({ 'color':'#000000' });
            //document.getElementById('oledestpeople').style.color = '#c3c3c3';
            document.getElementById('agreepeople').style.color = '#c3c3c3';
            document.getElementById('newestpeople').style.color = '#c3c3c3';
            document.getElementById('greenflagpeople').style.color = '#c3c3c3';
            document.getElementById('redflagpeople').style.color = '#c3c3c3';
            
            $("#show_toppeople_tbl").show();
        }/*else if(ID=='oledestpeople'){ 
            currect_section = "oledestpeople";
            $("#show_oldestpeople_tbl").show();
            document.getElementById('toppeople').style.color = '#c3c3c3';
            $('#oledestpeople').css({ 'color':'#000000' });
            document.getElementById('newestpeople').style.color = '#c3c3c3';
                
        }*/else if(ID=='agreepeople'){
            currect_section = "agreepeople";
            document.getElementById('toppeople').style.color = '#c3c3c3';
            $('#agreepeople').css({ 'color':'#000000' });
            document.getElementById('newestpeople').style.color = '#c3c3c3';
            document.getElementById('redflagpeople').style.color = '#c3c3c3';
            document.getElementById('greenflagpeople').style.color = '#c3c3c3';
            
            $("#show_agreepeople_tbl").show();
                
        }else if(ID=='greenflagpeople'){ 
            currect_section = "greenflagpeople";
            document.getElementById('toppeople').style.color = '#c3c3c3';
            document.getElementById('agreepeople').style.color = '#c3c3c3';
            $('#greenflagpeople').css({ 'color':'#000000' });
            document.getElementById('newestpeople').style.color = '#c3c3c3';
			document.getElementById('redflagpeople').style.color = '#c3c3c3';
            
            $("#show_greenflag_tbl").show();
                
        }else if(ID=='redflagpeople'){ 
            currect_section = "redflagpeople";
            document.getElementById('toppeople').style.color = '#c3c3c3';
            document.getElementById('agreepeople').style.color = '#c3c3c3';
            $('#redflagpeople').css({ 'color':'#000000' });
            document.getElementById('newestpeople').style.color = '#c3c3c3';
			document.getElementById('greenflagpeople').style.color = '#c3c3c3';
            
            $("#show_redflag_tbl").show();
                
        }else if(ID=='newestpeople'){ 
            currect_section = "newestpeople";
            document.getElementById('toppeople').style.color = '#c3c3c3';
            document.getElementById('agreepeople').style.color = '#c3c3c3';
			document.getElementById('greenflagpeople').style.color = '#c3c3c3';
			document.getElementById('redflagpeople').style.color = '#c3c3c3';
            //document.getElementById('oledestpeople').style.color = '#c3c3c3';
            $('#newestpeople').css({ 'color':'#000000' });
            
            $("#show_newestpeople_tbl").show();
                
        }else if(ID=='allpeople'){
            currect_section = "allpeople";
            document.getElementById('toppeople').style.color = '#c3c3c3';
            document.getElementById('agreepeople').style.color = '#c3c3c3';
			document.getElementById('greenflagpeople').style.color = '#c3c3c3';
			document.getElementById('redflagpeople').style.color = '#c3c3c3';
            //document.getElementById('oledestpeople').style.color = '#c3c3c3';
            $('#newestpeople').css({ 'color':'#000000' });
            
            $("#tbl_people_list").show();
            
        }
        $.unblockUI();
    });
    $.unblockUI();
 });
//$('#show_toppeople_tbl').show();
</script>
<div style="clear:both"></div>
<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
	<div class="main_left">
    	<?php $this->renderPartial('/topics/_topics_list_left_panel',$this->data);?>
    </div>
    <div class="main_mid">
       <div class="topics">
            <div class="topic_head">People</div>
                <!--<a href="<?php //echo Yii::app()->createUrl('topics/Createnewtopic')?>" class="newtopic"><img src="<?php //echo Yii::app()->baseUrl;?>/images/new_topic.jpg"/></a>-->
       </div>
       <div class="menu1" style="padding-bottom: 16px;" >
            <a style="padding: 0; vertical-align: top;font-size: small; text-decoration: none;cursor: pointer;color: #000000; " id="toppeople" >POSTS &nbsp;|&nbsp;</a>
            <a style="padding: 0; vertical-align: top;font-size: small; text-decoration: none;cursor: pointer;color: #c3c3c3; display:'<?php echo (!$dialogHasQuestions)?"none":""; ?>'" id="agreepeople" >AGREE &nbsp;|&nbsp;</a>
            <a style="padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3 " id="newestpeople">NEW &nbsp;|&nbsp;</a>
			<a style="padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3 " id="greenflagpeople"> GREEN FLAG &nbsp;|&nbsp;</a>
            <a style="padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3 " id="redflagpeople">RED FLAG </a>
		<!-- <a style="padding: 0 0 0 3px;vertical-align: top; font-size: small;text-decoration: none;cursor: pointer;color:#c3c3c3; " id="oledestpeople">Oldest &nbsp;|&nbsp;</a> -->
            
      </div>
      
      
      
        <!-- ============================START:COMMON=============================-->
        <table class="content_box form_lable" style="width:98%;display: none;" id="tbl_people_list" >
            <?php
            $allpeople_last_id = 0;
            
            foreach($PeopleListModel AS $PeopleList){$i++;
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            
            <?php
            $allpeople_last_id = $PeopleList->id;
            }
            ?>
        </table>
     <!-- ============================END:COMMON=============================-->
     <!-- ============================START:TOP=============================-->
        
        <table class="content_box form_lable" style="width:98%;display: block;" id="show_toppeople_tbl" >
        
            <?php
            $toppeople_last_id = 0;
            foreach($TopicListBytoppeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            
            <?php
            $toppeople_last_id = $PeopleList->id;
            }
            ?>
        </table>
     <!-- ============================END:TOP=============================-->   
     <!-- ============================START:OLDEST=============================-->
       <?php /* ?>
        <!--<table class="content_box form_lable" style="width:98%;display:none;" id="show_oldestpeople_tbl">
            <?php
            $oldpeople_last_id = 0;
            
            foreach($TopicListByoldestpeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            <?php
            $oldpeople_last_id = $PeopleList->id;
            
            }
            ?>
        </table>-->
		<?php */ ?>
     <!-- ============================END:OLDEST=============================-->
     <!-- ============================START:NEWEST=============================-->
        <table class="content_box form_lable" style="width:98%;display:none;" id="show_newestpeople_tbl">
            <?php
            $newpeople_last_id = 0;
            
            foreach($TopicListBynewestpeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            <?php
            $newpeople_last_id = $PeopleList->id;
            
            }
            ?>
        </table>
     <!-- ============================END:NEWEST=============================-->
     
     <!-- ============================START:AGREE=============================-->
        <table class="content_box form_lable" style="width:98%;display:none;" id="show_agreepeople_tbl">
            <?php
            $agreepeople_last_id = 0;
            
            foreach($TopicListByagreepeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            <?php
            $agreepeople_last_id = $PeopleList->id;
            
            }
            ?>
        </table>
     <!-- ============================END:AGREE=============================-->
     
     <!-- ============================START:GREEN Flag=============================-->
        <table class="content_box form_lable" style="width:98%;display:none;" id="show_greenflag_tbl">
            <?php
            $greenflagpeople_last_id = 0;
            
            foreach($TopicListBygreenflagpeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            <?php
            $greenflagpeople_last_count = $PeopleList->Totalcount;
            
            }
            ?>
        </table>
     <!-- ============================END:GREEN Flag=============================-->
     <!-- ============================START:RED Flag=============================-->
        <table class="content_box form_lable" style="width:98%;display:none;" id="show_redflag_tbl">
            <?php
            $redflagpeople_last_id = 0;
            foreach($TopicListByredflagpeople AS $PeopleList){
            ?>
            <tr id="<?php echo $PeopleList->id;?>" class="tr_people_data">
                <td style="width:100%">
                    <?php $this->renderPartial('/site/_people_list',array('PeopleList'=>$PeopleList));?>
                </td>                    
            </tr>
            <?php
            $redflagpeople_last_count = $PeopleList->Totalcount;
            
            }
            ?>
        </table>
     <!-- ============================END:RED Flag=============================-->
    </div>
    <div class="main_right"></div>
</div>


<script>

//var next_page = 1;
//var last_id = < ?php echo $last_id;?>;
var allpeople_next_page = 1;
var toppeople_next_page = 1;
var agreepeople_next_page = 1;
//var oldpeople_next_page = 1;
var greenflagpeople_next_page = 1;
var redflagpeople_next_page = 1;
var newpeople_next_page = 1;

var allpeople_last_id = <?php echo $allpeople_last_id;?>;
var toppeople_last_id = <?php echo $toppeople_last_id;?>;
var agreepeople_last_id = <?php echo $agreepeople_last_id;?>;
//var oldpeople_last_id = <?php //echo $oldpeople_last_id;?>;
var greenflagpeople_last_count = <?php echo $greenflagpeople_last_count;?>;
var redflagpeople_last_count = <?php echo $redflagpeople_last_count;?>;
var newpeople_last_id = <?php echo $newpeople_last_id;?>;

var allpeople_ajax_msg = "";
var toppeople_ajax_msg = "";
var agreepeople_ajax_msg = "";
//var oldpeople_ajax_msg = "";
var greenflagpeople_ajax_msg = "";
var redflagpeople_ajax_msg = "";
var newpeople_ajax_msg = "";

var currect_section_div_id = "tbl_toppeople_list";
$(function(){
    var scrollFunction = function(){
        var mostOfTheWayDown = ($(document).height() - $(window).height()) * 2 / 3;
        if ($(window).scrollTop() > mostOfTheWayDown) {
        	data_str = "";
            if(currect_section == "allpeople" && allpeople_ajax_msg==""){
        		data_str = "currect_section=allpeople&next_page="+allpeople_next_page+"&last_id="+allpeople_last_id;
        		currect_section_div_id = "tbl_people_list";
            }else if(currect_section == "toppeople" && toppeople_ajax_msg==""){
            	data_str = "currect_section=toppeople&next_page="+toppeople_next_page+"&last_id="+toppeople_last_id;
            	currect_section_div_id = "show_toppeople_tbl";
            }else if(currect_section == "agreepeople" && agreepeople_ajax_msg==""){
            	data_str = "currect_section=agreepeople&next_page="+agreepeople_next_page+"&last_id="+agreepeople_last_id;
            	currect_section_div_id = "show_agreepeople_tbl";
            }else if(currect_section == "greenflagpeople" && greenflagpeople_ajax_msg==""){
            	data_str = "currect_section=greenflagpeople&next_page="+greenflagpeople_next_page+"&last_id="+greenflagpeople_last_count;
            	currect_section_div_id = "show_greenflag_tbl";
            }else if(currect_section == "redflagpeople" && redflagpeople_ajax_msg==""){
            	data_str = "currect_section=gedflagpeople&next_page="+redflagpeople_next_page+"&last_id="+redflagpeople_last_count;
            	currect_section_div_id = "show_redflag_tbl";
            }/*else if(currect_section == "oledestpeople" && oldpeople_ajax_msg==""){
            	data_str = "currect_section=oledestpeople&next_page="+oldpeople_next_page+"&last_id="+oldpeople_last_id;
            	currect_section_div_id = "show_oldestpeople_tbl";
            }*/else if(currect_section == "newestpeople" && newpeople_ajax_msg==""){
            	data_str = "currect_section=newestpeople&next_page="+newpeople_next_page+"&last_id="+newpeople_last_id;
            	currect_section_div_id = "show_newestpeople_tbl";
            }
            
            if(data_str != ""){
                $.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});

	            $(window).unbind("scroll");
	            $.ajax({
	                url: "Getpeoplelistdata1",
	                data: data_str,
	                dataType: "html",
	                type: "POST",
	                success: function(people_data){
	                   //alert(people_data);
	                    var people_result = people_data.split("======");
                    	$(window).scroll(scrollFunction);

                    	last_id = people_result[1];
                        if(currect_section == "allpeople"){
	    	            	allpeople_next_page++;
	    	            	allpeople_last_id = last_id;
							//$("#"+currect_section_div_id).append(people_result[2]);
	    	            }else if(currect_section == "toppeople"){
	    	            	toppeople_next_page++;
	    	            	toppeople_last_id = last_id;
							//$("#"+currect_section_div_id).append(people_result[2]);
	    	            }else if(currect_section == "agreepeople"){
	    	            	agreepeople_next_page++;
	    	            	agreepeople_last_id = last_id;
							//$("#"+currect_section_div_id).append(people_result[2]);
	    	            }else if(currect_section == "greenflagpeople"){
	    	            	greenflagpeople_next_page++;
	    	            	greenflagpeople_last_id = last_id;
							//$("#"+currect_section_div_id).html(people_result[2]);
						}else if(currect_section == "redflagpeople"){
	    	            	redflagpeople_next_page++;
	    	            	redflagpeople_last_id = last_id;
							//$("#"+currect_section_div_id).html(people_result[2]);
						}/*else if(currect_section == "oledestpeople"){
	    	            	oldpeople_next_page++;
	    	            	oldpeople_last_id = last_id;
	    	            }*/else if(currect_section == "newestpeople"){
	    	            	newpeople_next_page++;
	    	            	newpeople_last_id = last_id;
							//$("#"+currect_section_div_id).append(people_result[2]);
	    	            }
                        $("#"+currect_section_div_id).append(people_result[2]);
	                }
	            });
                $.unblockUI(); 
	        }
           }
         };
    $(window).scroll(scrollFunction);
});
</script>