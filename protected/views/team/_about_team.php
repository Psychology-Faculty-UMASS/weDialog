<div class="main_mid1" id="toggle_column" style="width:95%;display: none;margin: 0 15px;">
    <!--<div class="topics">
        <div class="topic_head" style="width:98%;">
        <div style="float: left;">
            About Team
        </div>
        <div style="float:right;">
            <?php if($team_model->user_id == Yii::app()->session['user_id']){ ?>
            <a href="<?php echo Yii::app()->createUrl('Team/updateteam',array('id'=>$team_model->id))?>" style="text-transform:none;color: #FFFFFF;font-size: 14px; float: right;text-decoration: none;"><img src="<?php echo Yii::app()->baseUrl;?>/images/edit_team.jpg"/></a>
            <?php } ?>       
        </div>
        </div>
    </div>-->
    
    <div class="topic1" style="padding: 0;">
        <div style="padding-bottom:13px;float:left;">
            <?php if($team_model->user_id == Yii::app()->session['user_id']){ ?>
                    <a href="<?php echo Yii::app()->createUrl('Team/updateteam',array('id'=>$team_model->id))?>" style="text-transform:none;color: #FFFFFF;font-size: 14px; float: right;text-decoration: none;">
                        <input style="cursor:pointer;" type="button" value="EDIT" class="inactivedialog"/>
                    </a>
            <?php } ?>
        </div>
        <div style="padding-bottom:13px;float:right;">
            <a href="<?php echo Yii::app()->createUrl('Team/viewteam',array('id'=>$team_model->id))?>" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="DIALOG" class="inactivedialog"/>
            </a>
            <!--
            <a href="#" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="PEOPLE" class="inactivedialog"/>
            </a>
            -->
            <a href="javascript::void(0);" onclick="javascript: topicdetailmore2('<?php echo $team_model->id; ?>')" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="ABOUT" class="activedialog"/>
            </a>
        </div>
        <div style="clear: both;"></div>
        
        
        <div id="topic_title" style="font-family: Tahoma;font-size: 16px;padding-bottom: 5px;cursor: pointer;"></div>
        <div class="fontweight" style="font-size: 14px;" id="topic_descriptionhtml"></div>
        <div class="date"> Created by/Date:</div>
        <div class="tagtext" style="width: 20%;">
        <div id="createdbyhtml" style="float: left;">,</div>
        <div id="date1_html" ></div>
        <div style="clear:both"></div>
        </div>
    </div>
</div>
