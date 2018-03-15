        <a href="javascript:void(0);" id="click_mytopics" style="text-decoration: none;">
        	<input type="button" value="My Team" class="topic" id="selected"/>
        </a>
        <a href="javascript:void(0);" id="click_popular" style="text-decoration: none;">
        	<input type="button" value="Popular" class="topic" id="selected_popular"/>
        </a>
        <div id="mytopic_left" style="display: block;padding-top: 10px;padding-left:3px;">
        <ul>
          <?php foreach($MyTeamListModel as $MyTeam){?>
            <li> 
                <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('Team/viewteam',array('id'=>$MyTeam->id))?>">
            		<?php echo substr($MyTeam->name,0, 54) ?>
            	</a>        
            </li>
          <?php } ?> 
        
        </ul>
        </div>
        <div id="topic_popular_left" style="display:none ;padding-top: 10px;padding-left:3px;">
            <ul>
            <?php foreach($PopularTeamListModel as $PopularTeam){?>            
            <li>
                <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('Team/viewteam',array('id'=>$PopularTeam->id))?>">
                 <?php echo substr($PopularTeam->name,0, 54) ?>
                </a>
            </li>
            <?php } ?>
            </ul>
        </div>
