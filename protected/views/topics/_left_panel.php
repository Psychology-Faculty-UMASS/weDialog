
<!--
<a href="javascript:void(0);" id="click_mytopics" style="text-decoration: none;">
	<input type="button" value="My topics" class="topic" id="selected"/>
</a>
<a href="javascript:void(0);" id="click_popular" style="text-decoration: none;">
	<input type="button" value="ACTIVE" class="topic" id="selected_popular"/>
</a>
<div id="mytopic_left" style="display: block;padding-top: 10px;">
	<ul>
    <?php
    foreach($MyTopicList as $MyTopics){
    ?>
    	<li> 
        	<a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$MyTopics->id))?>">
            	<?php echo substr($MyTopics->topic_title,0, 54) ?>
            </a>        
		</li>
	<?php
	}
	?>
	</ul>
</div>
<div id="topic_popular_left" style="display:none ;padding-top: 10px;">
	<ul>
    <?php
    foreach($PopularTopicListModel as $MyTopics2){
    ?>            
    	<li>
    		<a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$MyTopics2->id))?>">
				<?php echo substr($MyTopics2->topic_title,0, 54) ?>
            </a>
		</li>
	<?php
	}
	?>
    </ul>
</div>
-->
<style>
.main_left {
	margin-top:-12px;
}
.left_main_menu {
	display: none;
}
.left_main_menu_short {
	display: block;
}
.filte_a_tag{
    color: #3c1b85;
}
.answer{
    margin-left:30px;
    color:#3c1b85;
    height: 1px;
    font-weight:normal;
    font-family:Arial,Helvetica,sans-serif;
}
.answer_selected{
    font-weight:bold;
}
/*general styles for all CSS Checkboxes*/
input[type=checkbox].css-checkbox {
	  position: absolute; 
    overflow: hidden; 
    clip: rect(0 0 0 0); 
    height:1px; 
    width:1px; 
    margin:-1px; 
    padding:0;
    border:0;
}
input[type=checkbox].css-checkbox + label.css-label {
	padding-left:20px;
	height:14px; 
	display:inline-block;
	line-height:15px;
	background-repeat:no-repeat;
	background-position: 0 0;
	/*font-size:15px;*/
	vertical-align:middle;
	cursor:pointer;
}
input[type=checkbox].css-checkbox:checked + label.css-label {
	background-position: 0 -15px;
}
.css-label{
	background-image:url(<?php echo Yii::app()->createAbsoluteUrl("/images/dark-check-green.png")?>);
}
</style>
<div class="left_main_menu_short "style="margin-bottom:10px">
	<ul>
	
		<li><a href="https://www.wedialog.net/topics/TopicsList?dialog_id=35">TOPICS</a></li>
	
	</ul>
</div>
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'filter-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions' =>array(
		'validateOnSubmit'=>true,
	),
));
?>
<div>
	<a class="filte_a_tag" href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_id))?>">

    	<input style="margin:0px; width:100%; text-align:left;" type="button" value="EXPLORE VIEWS" class="topic"/>
	</a>
	<a class="filte_a_tag" href="javascript:void(0);" onclick="hideshowpost()">
    	<input style="margin:0px; width:100%; text-align:left; background-color:#0091ce;" type="button" value="POSTS" class="topic"/>
    </a>
	<!--</a><h5 style="margin-left: 17px;margin-top: 10px;color:#3c1b85;height:2px;cursor:pointer;font-size:13px;" onclick="hideshowpost()">POSTS</h5>-->
	<div id="post" style="display: none;">
	<?php 
    $id_no=0;
    foreach ($topic_question_model as $topic_question) {
    	if($topic_question->question1!=""){ 
	?>
    	<tr style="height:1px;">
			<td>
				<h5 style="margin-left: 25px;margin-top: 3px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow1()"><?php echo $topic_question->question1;?></div></h5>
			</td>
		</tr>
		<div id="opt1">
			<?php 
			$opt1 =	explode(',',$topic_question->option1);
			$option_value1 = array_combine($opt1, $opt1);
			foreach ($option_value1 as $option_value) {
				$id_no++; 
			?>
        	<tr >
            	<td>                                
                <?php
                $temp=0;
                if(Yii::app()->session['filter_submit']!=""){
                    if(isset(Yii::app()->session['filter']['post']['question1'])){
                        foreach(Yii::app()->session['filter']['post']['question1'] as $temp_arr_for_selecded_option){
                            foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                if($temp_arr_for_selecded_option_val ==$option_value){
                                    $temp=1;
                                    break;  
                                }   
                            }
                        }    
                    }
                }
				?>
                        <!-- START:: GET POST CATEGORY IN HIDDEN FIELDS -->
                        <input type="hidden" id="topic_question_1_category_name" value="<?php echo $topic_question->question1; ?>"/>
                        <input type="hidden" class="topic_question_1_category_option" value="<?php echo $option_value;?>"/>
                        <!-- END:: GET POST CATEGORY IN HIDDEN FIELDS -->
                        
	                <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
	                    <input type="checkbox" class="css-checkbox checkbox_common" id="post_question1_<?php echo $id_no?>" name="Filter[post][question1][][<?php echo $topic_question->question1;?>]" value="<?php echo $option_value;?>" <?php if($temp) echo  'checked=""'?> />
	                	<label for="post_question1_<?php echo $id_no?>" name="Filter[post][question1][][<?php echo $topic_question->question1;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value;?></label>
	                </h5>
				</td>
			</tr>
			<?php
			}	
			?>
		</div>
        <?php
        }
        if($topic_question->question2!=""){
        ?>
		<tr>
			<td>
				<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow2()"><?php echo $topic_question->question2;?></div></h5>
			</td>
		</tr>
		<div id="opt2">
		<?php 
			$opt2 =	explode(',',$topic_question->option2);
			$option_value2 = array_combine($opt2, $opt2);
			foreach ($option_value2 as $option_value_second) {
            	$id_no++;
		?>
        	<tr>
            	<td>
                <?php
                $temp=0;
                if(Yii::app()->session['filter_submit']!=""){
                    if(isset(Yii::app()->session['filter']['post']['question2'])){
                        foreach(Yii::app()->session['filter']['post']['question2'] as $temp_arr_for_selecded_option){
                            foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                if($temp_arr_for_selecded_option_val ==$option_value_second){
                                    $temp=1;
                                    break;  
                                }   
                            }
                        }    
                    }
                }
                ?>
                    <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
                        <input type="checkbox" class="css-checkbox checkbox_common" id="post_question2_<?php echo $id_no?>" name="Filter[post][question2][][<?php echo $topic_question->question2;?>]" value="<?php echo $option_value_second;?>" <?php if($temp) echo  'checked=""'?> />
                        <label for="post_question2_<?php echo $id_no?>" name="Filter[post][question2][][<?php echo $topic_question->question2;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value_second;?></label>
                    </h5>
                </td>
			</tr>
            <?php
			}	
			?>
		</div>
        <?php
        }
        if($topic_question->question3!=""){ 
        ?>
		<tr>	
			<td>
				<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow3()"><?php echo $topic_question->question3;?></div></h5>
			</td>
		</tr>
		<div id="opt3">
		<?php 
			$opt3 =	explode(',',$topic_question->option3);
			$option_value3 = array_combine($opt3, $opt3);
			foreach ($option_value3 as $option_value_three) {
               $id_no++;
		?>
        	<tr id='opt3'>
            	<td>
                <?php
                $temp=0;
                if(Yii::app()->session['filter_submit']!=""){
                    if(isset(Yii::app()->session['filter']['post']['question3'])){
                        foreach(Yii::app()->session['filter']['post']['question3'] as $temp_arr_for_selecded_option){
                            foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                if($temp_arr_for_selecded_option_val ==$option_value_three){
                                    $temp=1;
                                    break;  
                                }   
                            }
                        }    
                    }
                }
				?>
                    <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
                        <input type="checkbox" class="css-checkbox checkbox_common" id="post_question3_<?php echo $id_no?>" name="Filter[post][question3][][<?php echo $topic_question->question3;?>]" value="<?php echo $option_value_three;?>" <?php if($temp) echo  'checked=""'?> />
                        <label for="post_question3_<?php echo $id_no?>" name="Filter[post][question3][][<?php echo $topic_question->question3;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value_three;?></label>
                    </h5>
                </td>
			</tr>
            <?php
			}	
			?>
		</div>
		<?php	
		}	
	}	
    ?>
    	<div style="clear:both"></div>
    </div>
<script type="text/javascript"> 
function hideshow1(){	
	 $("#opt1").toggle();
}
function hideshow2(){	
	 $("#opt2").toggle();
}

function hideshow3(){	
	 $("#opt3").toggle();
}
function hideshowpost(){
	$("#post").toggle();
    hideshow_button();
}
</script>
</div>
<div>
	<a class="filte_a_tag" href="javascript:void(0);" onclick="hideshow_vote()">
    	<input style="margin:0px; width:100%; text-align:left; background-color:#0091ce;" type="button" value="VOTES" class="topic"/>
    </a>
        		<!--<h5 style="margin-left: 17px;margin-top: 10px;color:#3c1b85;height:2px;cursor:pointer;font-size:13px;" onclick="hideshow_vote()">VOTE</h5>-->
			<div id="vote" style="display: none;">
			<?php 
            foreach ($topic_question_model as $topic_question) {
                if($topic_question->question1!=""){
                ?>
               	<tr style="height:1px;">
		      			<td>
							<h5 style="margin-left: 25px;margin-top: 3px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_vote1()"><?php echo $topic_question->question1;?></div></h5>
						</td>
					</tr>
					<div id="vote_opt_1">
            	 		<?php 
						$opt1 =	explode(',',$topic_question->option1);
							$option_value1 = array_combine($opt1, $opt1);
							foreach ($option_value1 as $option_value) {
						      $id_no++;
                            ?>
                                <tr>
                                <td>    
                                    <?php
                                        $temp=0;
                                        if(Yii::app()->session['filter_submit']!=""){
                                            if(isset(Yii::app()->session['filter']['vote']['question1'])){
                                                foreach(Yii::app()->session['filter']['vote']['question1'] as $temp_arr_for_selecded_option){
                                                    foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                                        if($temp_arr_for_selecded_option_val ==$option_value){
                                                            $temp=1;
                                                            break;  
                                                        }   
                                                    }
                                                }    
                                            }
                                        }
                                    ?>
                                    <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
                                        <input type="checkbox" class="css-checkbox checkbox_common" id="vote_question1_<?php echo $id_no?>" name="Filter[vote][question1][][<?php echo $topic_question->question1;?>]" value="<?php echo $option_value;?>" <?php if($temp) echo  'checked=""'?> />
                                        <label for="vote_question1_<?php echo $id_no?>" name="Filter[vote][question1][][<?php echo $topic_question->question1;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value;?></label>
                                    </h5>
                                </td>
                                </tr>
                            <?php
							}	
						?>
						</div>
                    <?php
                    }
                    if($topic_question->question2!=""){     
                    ?>
					<tr>
					<td>
						<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_vote2()"><?php echo $topic_question->question2;?></div></h5>
					</td>
					</tr>
				<div id="opt_vote_2">
				<?php 
						$opt2 =	explode(',',$topic_question->option2);
							$option_value2 = array_combine($opt2, $opt2);
							foreach ($option_value2 as $option_value_second) {
		                        $id_no++;
                            ?>
                                <tr>
                                <td>
                                    <?php
                                        $temp=0;
                                        if(Yii::app()->session['filter_submit']!=""){
                                            if(isset(Yii::app()->session['filter']['vote']['question2'])){
                                                foreach(Yii::app()->session['filter']['vote']['question2'] as $temp_arr_for_selecded_option){
                                                    foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                                        if($temp_arr_for_selecded_option_val ==$option_value_second){
                                                            $temp=1;
                                                            break;  
                                                        }   
                                                    }
                                                }    
                                            }
                                        }
                                    ?>
                                    <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
                                        <input type="checkbox" class="css-checkbox checkbox_common" id="vote_question2_<?php echo $id_no?>" name="Filter[vote][question2][][<?php echo $topic_question->question2;?>]" value="<?php echo $option_value_second;?>" <?php if($temp) echo  'checked=""'?> />
                                        <label for="vote_question2_<?php echo $id_no?>" name="Filter[vote][question2][][<?php echo $topic_question->question2;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value_second;?></label>
                                    </h5>
                                </td>
                                </tr>
                            <?php
							}	
						?>
				</div>
                    <?php
                    }
                    if($topic_question->question3!=""){     
                    ?>
					<tr>	
					<td>
						<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_vote3()"><?php echo $topic_question->question3;?></div></h5>
					</td>
					</tr>
				<div id="opt_vote_3">
					<?php 
						$opt3 =	explode(',',$topic_question->option3);
							$option_value3 = array_combine($opt3, $opt3);
							foreach ($option_value3 as $option_value_three) {
                                $id_no++;
                            ?>
                                <tr id='opt3'>
                                <td>
                                    <?php
                                        $temp=0;
                                        if(Yii::app()->session['filter_submit']!=""){
                                            if(isset(Yii::app()->session['filter']['vote']['question3'])){
                                                foreach(Yii::app()->session['filter']['vote']['question3'] as $temp_arr_for_selecded_option){
                                                    foreach($temp_arr_for_selecded_option as $temp_arr_for_selecded_option_val){
                                                        if($temp_arr_for_selecded_option_val ==$option_value_three){
                                                            $temp=1;
                                                            break;  
                                                        }   
                                                    }
                                                }    
                                            }
                                        }
                                    ?>
                                    <h5 class="answer <?php if($temp) echo 'answer_selected'?>">
                                        <input type="checkbox" class="css-checkbox checkbox_common" id="vote_question3_<?php echo $id_no?>" name="Filter[vote][question3][][<?php echo $topic_question->question3;?>]" value="<?php echo $option_value_three;?>" <?php if($temp) echo  'checked=""'?> />
                                        <label for="vote_question3_<?php echo $id_no?>" name="Filter[vote][question3][][<?php echo $topic_question->question3;?>_lbl]" class="css-label lite-green-check"><?php echo $option_value_three;?></label>
                                    </h5>
                                </td>
                                </tr>
                            <?php
							}	
						?>
				</div>
				<?php		
                    }
		  		}	
            ?>  
           </div>
<script type="text/javascript"> 
function hideshow_vote1(){	
	 $("#vote_opt_1").toggle();
}
function hideshow_vote2(){	
	 $("#opt_vote_2").toggle();
}

function hideshow_vote3(){	
	 $("#opt_vote_3").toggle();
}
function hideshow_vote(){	
	 $("#vote").toggle();
     hideshow_button();
}
/*
$( document ).ready(function() {
    //for hide post and vote when page load
    hideshowpost();
    hideshow_vote();
    $("#login_detail").hide();
    
});
*/
function hideshow_button(){	
    if($("#vote").is(":hidden") && $("#post").is(":hidden")){
        $("#login_detail").hide();
    }else{
        $("#login_detail").show();
    }
}

</script>
</div>
<?php /*?>
 <div> 	
            <a class="filte_a_tag" href="javascript:void(0);" onclick="hideshow_flage()">
                <input style="margin-left: 1px;width:188px;margin-top: 0px;text-align: left;font: 14px Arial, Helvetica, sans-serif;background-color:#0091ce;" type="button" value="FLAGE" class="topic"/>
            </a>
       		<!--<h5 style="margin-left: 17px;margin-top: 10px;color:#3c1b85;height:2px;cursor:pointer;font-size:13px;" onclick="hideshow_flage()">FLAGE</h5>-->
			<div id="flage">
			<?php 
			foreach ($topic_question_model as $topic_question) {
			     if($topic_question->question1!=""){      
                ?>
               	<tr style="height:1px;">
		      			<td>
							<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_flage1()"><?php echo $topic_question->question1;?></div></h5>
						</td>
					</tr>
					<div id="opt_flage_1">
            	 		<?php 
						$opt1 =	explode(',',$topic_question->option1);
							$option_value1 = array_combine($opt1, $opt1);
							foreach ($option_value1 as $option_value) { ?>
                            <tr ><td>
                                <?php
                                    $selecded_div="";
                                    if(isset($selected_option)){ 
                                        if($selected_option["question_no"]=="question1" && $selected_option["question"]==$topic_question->question1 && $selected_option["option"]==$option_value && $selected_option["type"]=="flage"){
                                            $selecded_div="answer_selected";
                                        }
                                    ?>
                                    <?php 
                                    }
                                    ?>
                                    <h5 class="answer <?php echo $selecded_div?>">
                                <a class="filte_a_tag" href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_id,"filter"=>'filter',"question_no"=>"question1","question"=>$topic_question->question1,"option"=>$option_value,"question_id"=>$topic_question->id,"type"=>"flage"))?>">
                                <?php echo $option_value;?></a></h5></td></tr>
                            <?php
							}	
						?>
						</div>
                    <?php
                    }
                    if($topic_question->question2!=""){     
                    ?>
					<tr>
					<td>
						<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_flage2()"><?php echo $topic_question->question2;?></div></h5>
					</td>
					</tr>
				<div id="opt_flage_2">
				<?php 
						$opt2 =	explode(',',$topic_question->option2);
							$option_value2 = array_combine($opt2, $opt2);
							foreach ($option_value2 as $option_value_second) { ?>
                            <tr><td>
                                <?php
                                    $selecded_div="";
                                    if(isset($selected_option)){ 
                                        if($selected_option["question_no"]=="question2" && $selected_option["question"]==$topic_question->question2 && $selected_option["option"]==$option_value_second && $selected_option["type"]=="flage"){
                                            $selecded_div="answer_selected";
                                        }
                                    ?>
                                    <?php 
                                    }
                                    ?>
                                    <h5 class="answer <?php echo $selecded_div?>">
                                <a class="filte_a_tag" href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_id,"filter"=>'filter',"question_no"=>"question2","question"=>$topic_question->question2,"option"=>$option_value_second,"question_id"=>$topic_question->id,"type"=>"flage"))?>">
                                <?php echo $option_value_second;?></a></h5></td></tr>
                            <?php
							}	
						?>
				</div>
                <?php
                    }
                    if($topic_question->question3!=""){ 
    
                    ?>
					<tr>	
					<td>
						<h5 style="margin-left: 25px;margin-top: 10px;color: #666666;height: 1px;"><div style="cursor: pointer;font-size: 13px;" onclick="hideshow_flage3()"><?php echo $topic_question->question3;?></div></h5>
					</td>
					</tr>
				<div id="opt_flage_3">
					<?php 
						$opt3 =	explode(',',$topic_question->option3);
							$option_value3 = array_combine($opt3, $opt3);
							foreach ($option_value3 as $option_value_three) { ?>
                            <tr id='opt3'><td>
                                <?php
                                    $selecded_div="";
                                    if(isset($selected_option)){ 
                                        if($selected_option["question_no"]=="question3" && $selected_option["question"]==$topic_question->question3 && $selected_option["option"]==$option_value_three && $selected_option["type"]=="flage"){
                                            $selecded_div="answer_selected";
                                        }
                                    ?>
                                    <?php 
                                    }
                                    ?>
                                    <h5 class="answer <?php echo $selecded_div?>">
                                <a class="filte_a_tag" href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_id,"filter"=>'filter',"question_no"=>"question3","question"=>$topic_question->question3,"option"=>$option_value_three,"question_id"=>$topic_question->id,"type"=>"flage"))?>">
                                <?php echo $option_value_three;?></a></h5></td></tr>
                            <?php
							}	
						?>
				</div>
				<?php	
                    }	
		  		}	
            ?>  
           </div>
<script type="text/javascript"> 
function hideshow_flage1(){	
	 $("#opt_flage_1").toggle();
}
function hideshow_flage2(){	
	 $("#opt_flage_2").toggle();
}

function hideshow_flage3(){	
	 $("#opt_flage_3").toggle();
}
function hideshow_flage(){	
	 $("#flage").toggle();
}
</script>
</div>
<?php */?>
<table width="100%" cellspacing="0" cellpadding="4" border="0" id="login_detail" style="display: none;">
	<tbody>
		<tr>
			<td><input type="submit" value="Filter" name="filter_submit" class="Submit" style="width: 100% !important; height:24px !important; font-size: 12px !important; padding-top:5px; margin-top:-3px;" /></td>
			<td>
                <!--<input type="button" value="CLEAR" name="CLEAR" class="Submit" style="width: 100% !important;" onclick="$('.checkbox_common').attr('checked', false);"/>-->
                <a style="text-decoration:none;" href="<?php echo Yii::app()->createUrl('topics/Viewtopic',array('topic_id'=>$topic_id))?>">
                    <input name="CLEAR" class="Submit" style="width: 100% !important; height:24px !important; font-size: 12px !important; padding-top:5px; margin-top:-3px;" type="button" value="CLEAR"/>
                </a>
            </td>
		</tr>
	</tbody>
</table>
<!--<div style="margin-top:28px;margin-left:28px;">
    <a style="text-decoration: none;" href="javascript:void(0)">
        <input type="submit" class="activedialog" name="filter_submit" value="Filter" style="cursor:pointer;" />
    </a>
</div>-->
<?php $this->endWidget(); ?>