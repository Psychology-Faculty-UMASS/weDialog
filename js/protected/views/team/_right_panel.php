<div class="category" id="rightboxtoggle5" style="border-bottom:none">
	<!-- <div class="categoryr_head"><?php echo ucwords($team_model->name);?></div>-->
    <div class="categoryr_head" onclick="javascript: topicdetailmore2('<?php echo $team_model->id; ?>')" style="cursor: pointer;font-family: Arial;font-size: 14px;">About Team</div>
    <div style="padding-left: 10px;">
		<div style="margin-top:5px;margin-bottom:5px;font-size: 14px;"><?php echo $team_model->name;?></div>
        <div class="tagtext">
        <?php
    	echo substr($team_model->description,0, 300);
    	if(strlen($team_model->description) > 300){
    		echo "...";
    	}
        ?>
        </div>
        <div onclick="javascript: topicdetailmore2('<?php echo $team_model->id; ?>')" style="cursor: pointer;color: #065A95;">More</div>
        <?php /* ?>
          <div class="date"> Created by/Date:</div>
          <div class="tagtext">
          <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$team_model->user_id)) ?>">
                     <b><?php echo ucfirst($team_model->team_to_user_relation->username);?></b></a>, <?php echo $date1=date('d.m.Y',strtotime($team_model->created_date));?>  
          </div>
        <?php */ ?>
        <!--<div style="margin-top:5px;margin-bottom:5px;">Members : <?php echo $team_model->members;?></div>-->
	</div>
</div>
<div style="float:left;width:98%;text-align:center;">
	<input class="topic" style="cursor:pointer; text-align:center; background: none repeat scroll 0 0 #3C1B85; height:25px; border-radius: 5px;"  onclick="confirmmember('<?php echo ucwords($team_model->name);?>');" value="JOIN" />
	<br />
    <span style="color:#FFF;margin-top:5px;"><?php echo $team_model->members;?> Members</span>
    <!--
    <button class="topic" style="cursor: pointer;width:70px;padding-top:4px;background: none repeat scroll 0 0 #3C1B85;height: 25px;text-decoration: none;" onclick="confirmmember('<?php echo ucwords($team_model->name);?>');">JOIN</button>
    <div style="clear: both;"></div>
    <div style="float:right;color:#097DD5;margin-top:5px;"><?php echo $team_model->members;?> Members</div>
    -->
</div>
<div style="clear: both;"></div>
<?php if(strtolower($this->action->id)!=='viewteam'): ?>
<div style="margin-top: 12px;">
	<label ><span class="rules_label">RULES:</span></label><br />
    <?php 
    foreach($rule_order_no_model as $rule_order_no_model_temp){
    ?>
    <div>
    	<a href="<?php echo Yii::app()->createUrl('TypeTags/rules')?>" style="text-decoration: none;">
        	<b><input type="button" value="<?php echo $rule_order_no_model_temp->type_tag;?>" class="rules_button"/></b>
		</a>
	</div>
    <?php
    }
    ?>
</div>
<?php endif; ?>