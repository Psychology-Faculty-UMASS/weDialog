<style>
    .rules_label{
        font-family: Arial;
        font-size: 22px;
        font-weight: normal;
    }
    
    .take-our-survey-div{
        margin-top: 100px;
    }
    
    .take-our-survey-button{
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
</style>
<!--
Removed margin to set Rules at top in right sixde panel as requested by client... 2015-12-21 06-40 PM
<div style="margin-top: 12px;padding-left: 10px;">
-->
<div class="right_fix_div" style="position: relative;">
    <label ><span class="rules_label">RULES:</span></label>
    <?php 
    foreach($rule_order_no_model as $rule_order_no_model_temp){
    ?>
    <div>
    	<a href="<?php echo Yii::app()->createUrl('TypeTags/rules')?>" style="text-decoration: none;">
        	<input type="button" value="<?php echo $rule_order_no_model_temp->type_tag;?>" class="rules_button"/>
		</a>
	</div>
    <?php
    }
    ?>
    <div>&nbsp;</div>
    <?php if(Yii::app()->session['user_id']): ?>
        <!--//////////////// START:: ADD TAKE OUR SURVEY BUTTON -->
        <div class="take-our-survey-div">
            <button class='take-our-survey-button'>Take our Survey</button>
        </div>
        <!--//////////////// END:: ADD TAKE OUR SURVEY BUTTON -->
    <?php endif; ?>
</div>
<?php
/*
ATUL: according to client request hide this panel on 2015-12-22 06-55 PM 
?>
<div class="category" id="rightboxtoggle5" style="border-bottom:none;margin-top:-5px">
	<!-- <div class="categoryr_head"><?php echo ucwords($TopicModel->topic_title);?></div>-->
    <div class="categoryr_head" onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')" style="cursor: pointer;">About Topic</div>
    <div style="padding-left: 10px;margin-top:10px;">
    	<div class="tagtext">
        	<p>
          	<?php
    	    echo substr($TopicModel->topic_description,0, 300);
    	    if(strlen($TopicModel->topic_description) > 300){
    	        echo "...";
    	    }
            ?>
            </p>
		</div>
        <div onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')" style="cursor: pointer;color: #3C1B85;">More</div>
        <!--<div class="date"> Created by/Date:</div>
        <div class="tagtext">
        	<a  style="text-decoration: none;" href="<?php //echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$TopicModel->topics_username->id)) ?>">
            <b><?php //echo ucfirst($TopicModel->topics_username->username);?></b></a>, <?php //echo $date1=date('m/d/Y',strtotime($TopicModel->created_date));?>  
		</div>-->
        <div class="date"> Category:</div>
        <div class="tagtext">
        <?php
        $typecattag=explode(",",$TopicModel->category_tags);
        for($i=0;$i<count($typecattag);$i++){
		?>
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
		<?php
		}	
        ?>          
        </div>
	</div>
</div>
<?php
*/
?>

<script type='text/javascript'>
    $(".take-our-survey-button").click(function(){
        $.ajax({
            url: "<?php echo Yii::app()->createAbsoluteUrl('topics/createSSOUrl'); ?>",
            type: "POST",
            data: {uid: "<?php echo Yii::app()->session['user_id']; ?>"},
            success: function(data){
                window.open(data);
            }
        });
        return false;
    });
</script>