<script>
	$.blockUI({ message: '<img src="<?php echo Yii::app()->createUrl('images/loading_icon.gif');?>">'});
</script>
<?php
   foreach($teammodel AS $team){ ?>
  <div class="topic1" id="<?php echo $team->id;?>">
        <h2 style="font-family: tahoma;size: auto;text-decoration-color:#065A95 ;">
            <a href="<?php echo Yii::app()->createUrl('team/viewteam',array('id'=>$team->id))?>" style="text-decoration: none;color: #065A95;font: 16px;">
                <img src="<?php echo Yii::app()->baseUrl;?>/images/Square2.png"/>
                <?php echo ucfirst(substr($team->name,0, 132)) ?>
            </a>
        </h2>
        <p class="toptext" style="font-family: tahoma;margin-top:5px;">
            <?php if(!empty($team->description)){
                 echo substr($team->description,0, 180);
        	     if(strlen($team->description) > 180){
        	        echo "...";
        	     }
             } ?>
        </p>
        <p class="topictext" style="margin-top:5px;">
            <div style="float: left;width: 80%;color: rgb(153, 153, 153);padding-top: 5px;font: 13px Arial,Helvetica,sans-serif;">
                <div style="float: left;width: 23%;">
                    Members:(<?php echo $team->members;?>)&nbsp;&nbsp;

                </div>
                <div style="float: left;width: 21%; margin-left:20px;">
                    <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png"/>
                    <span style="position:relative; top:-6px;"> <?php echo $team->posts;?>&nbsp;&nbsp;</span>
                </div>
                <div style="float: left;width: 46%;">
                    <?php
                        if(count($team->all_posts_relation) > 0){
                            $stringtime= strtotime($team->all_posts_relation[0]->created_date);
                            echo "Last:". date('d/m/Y - H:i',$stringtime);
                        }
                    ?>                        
                </div>
            </div>
        </p>
   </div>
    <?php
        }
    ?>    
<script>
	$.unblockUI();
</script>