        <a href="javascript:void(0);" id="click_mytopics" style="text-decoration: none;">
        	<input type="button" value="My Rules" class="topic" id="selected"/>
        </a>
        <a href="javascript:void(0);" id="click_popular" style="text-decoration: none;">
        	<input type="button" value="Popular" class="topic" id="selected_popular"/>
        </a>
        <div id="mytopic_left" style="display: block;padding-top: 10px;padding-left:3px;">
        <ul>
          <?php foreach($MyRuleListModel as $MyRule){?>
            <li> 
                <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$MyRule->id))?>">
            		<?php echo substr($MyRule->type_tag,0, 54) ?>
            	</a>        
            </li>
          <?php } ?> 
        
        </ul>
        </div>
        <div id="topic_popular_left" style="display:none ;padding-top: 10px;padding-left:3px;">
            <ul>
            <?php foreach($PopularRuleListModel as $PopularRule){?>            
            <li>
                <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$PopularRule->id))?>">
                 <?php echo substr($PopularRule->type_tag,0, 54) ?>
                </a>
            </li>
            <?php } ?>
            </ul>
        </div>
