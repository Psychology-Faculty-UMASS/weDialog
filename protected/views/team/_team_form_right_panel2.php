<div class="category">
    <div class="category_head">Teams</div>
    <div class="content_2 content" style="overflow-x: hidden;overflow-y: hidden;">
        <ul>
            <?php 
                if(isset($team_post_model) && count($team_post_model) > 0){
                    foreach($team_post_model as $team){?>
                        <li><a href="<?php echo Yii::app()->createUrl('team/viewteam',array('id'=>$team->id));?>"><?php echo $team->name; echo ($team->posts > 0) ? " (".$team->posts.")" : ""; ?></a></li>
                    <?php
                    }
                }
            ?>    
        </ul>
    </div>
</div>
<p id="demo"></p>


