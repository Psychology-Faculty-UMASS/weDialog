<!--<div class="category" id="rightboxtoggle5">
	<div class="categoryr_head"><?php echo ucwords($rule_model->type_tag);?></div>
    <div class="categoryr_head" onclick="javascript: topicdetailmore2('<?php echo $rule_model->id; ?>')" style="cursor: pointer;font-family: Arial;font-size: 14px;">About Rule</div>
	<div style="padding-left: 10px;">
    	<div style="margin-top:5px;margin-bottom:5px;font-size: 14px;"><?php echo ucwords($rule_model->type_tag);?></div>
        <div class="tagtext">
		<?php
		echo substr($rule_model->type_tag_description,0, 300);
	    if(strlen($rule_model->type_tag_description) > 300){
	        echo "...";
	    }
		?>
		</div>
        <div onclick="javascript: topicdetailmore2('<?php echo $rule_model->id; ?>')" style="cursor: pointer;color: #065A95;">More</div>
        <!--
        <div class="date"> Created by/Date:</div>
        <div class="tagtext">
        	<a style="text-decoration: none;" href="<?php //echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$rule_model->user_id)) ?>">
				<b><?php //echo ucfirst($rule_model->typeTags_username->username);?></b></a>, <?php //echo $date1=date('m/d/Y',strtotime($rule_model->created_date));?>  
		</div>
		-->
	</div>
</div>
<!--
<div style="margin-top:12px;">
	<label>
		<span class="rules_label" >RULES:</span>
	</label><br />
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
</div>
-->