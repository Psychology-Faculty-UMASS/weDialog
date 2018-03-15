    <?php
       foreach($typetagmodel AS $tag){ ?>
      <div class="topic1" id="<?php echo $tag->id;?>" style="padding: 10px 10px 10px 10px; ">
            <h2 style="font-family: tahoma;size: auto;text-decoration-color:#065A95 ;">
                <a href="<?php echo Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$tag->id))?>" style="text-decoration: none;color: #065A95;font-size: 17.5px;">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/Square1.png"/>
                    <?php echo ucfirst(substr($tag->type_tag,0, 132)) ?>
                </a>
            </h2>
            <p class="toptext" style="font-family: tahoma;margin-top:5px;">
                <?php if(!empty($tag->type_tag_description)){
                     echo substr($tag->type_tag_description,0, 335);
            	     if(strlen($tag->type_tag_description) > 335){
            	        echo "...";
            	     }
                 } ?>
            </p>
            <p class="topictext">
                <div id="already_voted_message_<?php echo $tag->id;?>" style="margin-top:5px;margin-bottom:5px;background-color: #FFFA9D;display:none;border:1px solid #000000;width:30%">You already voted!</div>
                <div class="likedislike" style="float: left;width: 80%;color: rgb(153, 153, 153);padding-top: 5px; Arial,Helvetica,sans-serif;">
                    <div style="float: left;">
                        <!--<div style="float: left;width: 50%;" class="likedislike"></div>
                        <div style="float: left;width: 50%;" class="likedislike"></div>-->
                        <img onclick="likedislikerules('<?php echo $tag->id;?>','like');" style="cursor:pointer;" src="<?php echo Yii::app()->baseUrl.'/images/newgreen.jpg';?>" id="greenup" alt=""/>&nbsp;<span id="likevaluespan_<?php echo $tag->id;?>"><?php echo $tag->likes;?></span>&nbsp;&nbsp;
                        <img onclick="likedislikerules('<?php echo $tag->id;?>','dislike');" style="cursor:pointer;" src="<?php echo Yii::app()->baseUrl.'/images/newred.jpg';?>" id="reddown" alt=""/>&nbsp;<span id="dislikevaluespan_<?php echo $tag->id;?>"><?php echo $tag->dislikes;?></span>&nbsp;&nbsp;
                        
                    </div>
                    <div style="float: left;width: 25%;color: #065A95; margin-left:20px;">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" id="comment-icon-rules" alt="" style="position:relative; top:2px;"/>
                        <span style="position:relative; top:-3px;"> <?php echo count($tag->all_posts_relation); ?>&nbsp;&nbsp;</span>
                    </div>
                    <div style="float: left;">
                        <?php
                            if(count($tag->all_posts_relation) > 0){
                                $stringtime= strtotime($tag->all_posts_relation[0]->created_date);
                                echo "". date('m/d/y - H:i',$stringtime);
                            }
                        ?>
                    </div>
                </div>
            </p>
       </div>
        <?php
            }
        ?>    
