<div class="main_mid1" id="toggle_column" style="width:95%;display: none;margin: 0 15px;">
    <!--<div class="topics">
        <div class="topic_head" style="width:98%;">
        <div style="float: left;">
            About topic
        </div>
        <div style="float:right;">
            <?php if($TopicModel->user_id == Yii::app()->session['user_id']){ ?>
            <a href="<?php echo Yii::app()->createUrl('topics/updatetopic',array('topic_id'=>$TopicModel->id))?>" style="text-transform:none;color: #FFFFFF;font-size: 13px; float: right;text-decoration: none;"><img src="<?php echo Yii::app()->baseUrl;?>/images/edit_topic.jpg"/></a>
            <?php } ?>       
        </div>
        </div>
    </div>-->
    <div class="topic1" style="padding: 0;">
        <div style="padding-bottom:13px;float:left;">
            <?php if($TopicModel->user_id == Yii::app()->session['user_id']){ ?>
                    <a href="<?php echo Yii::app()->createUrl('topics/updatetopic',array('topic_id'=>$TopicModel->id))?>" style="text-transform:none;color: #FFFFFF;font-size: 13px; float: right;text-decoration: none;">
                        <input style="cursor:pointer;" type="button" value="EDIT" class="inactivedialog"/>
                    </a>
            <?php } ?>
        </div>
        <div style="padding-bottom:13px;float:right;">
            <a href="<?php echo Yii::app()->createUrl('Topics/viewtopic',array('topic_id'=>$TopicModel->id))?>" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="DIALOG" class="inactivedialog"/>
            </a>
            <!--
            <a href="#" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="PEOPLE" class="inactivedialog"/>
            </a> 
            -->
            <a href="javascript::void(0);" onclick="javascript: topicdetailmore2('<?php echo $TopicModel->id; ?>')" style="text-decoration: none;">
                <input style="cursor:pointer;" type="button" value="ABOUT" class="activedialog" />
            </a>
        </div>
        <div style="clear: both;"></div>
        
        
        <div id="topic_title" style="font-family: Tahoma;font-size: 17.5px;padding-bottom: 5px;"></div>
        <div class="fontweight" style="font-size: 14px; word-wrap: break-word;" id="topic_descriptionhtml"></div>
        <div class="date"> Created by/Date:</div>
        <div class="tagtext" style="width: 20%;">
        <div id="createdbyhtml" style="float: left;">,</div>
        <div id="date1_html" ></div>
        <div style="clear:both"></div>
        </div>
        
        <div class="date"> Tag:</div>
        <div class="tagtext fontweight" id="category_tagshtml"></div>
        <!--<div class="date"> Rules</div>-->
        <div class="tagtext fontweight" id="type_tagshtml"></div>
    </div>
</div>
