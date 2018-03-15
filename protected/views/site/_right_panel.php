<style>
.font_bold_color{
    color: #666666;
}
</style>
<div class="category" id="rightboxtoggle5" style="border-bottom:none;padding-bottom:0px;">
    <div class="categoryr_head" onclick="javascript: profileviewAbout('<?php echo $user_model->id; ?>')" style="cursor: pointer;font-family: Arial;font-size: 13px;">About</div>
    <div style="padding-left: 10px;">
     <div onclick="javascript: profileviewAbout('<?php echo $user_model->id; ?>')" style="margin-top:5px;margin-bottom:5px; font:14px Arial; cursor: pointer;color: #065A95;"><?php echo $user_model->username;?></div>
      <div class="tagtext">
      <?php
        echo substr($user_model->user_description,0, 290);
        if(strlen($user_model->user_description) > 290){
            echo "...";
        }
        ?>
      </div>
      <div onclick="javascript: profileviewAbout('<?php echo $user_model->id; ?>')" style="cursor: pointer;color: #065A95;">More</div>
      
      <div>
          <?php if(!empty($aiia_model)){?>
             <p style="padding-top: 5px;">
                <label ><span class="people_label_right font_bold_color">As an Individual I am:</span></label><br />
                <?php foreach($aiia_model as $aiia_model){
                ?>
                        <a class="people_label_value_right" href="#"><?php echo $aiia_model->discriptor;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
          <?php }?>
      </div>
       <!--<div class="date">Posts(<?php echo count($user_model->user_all_post_relation); ?>)&nbsp;&nbsp;&nbsp;&nbsp;Topics(<?php echo count($user_model->user_topics_relation); ?>)</div>-->
    </div>
 </div>
 
 
    <div style="padding-left: 10px;background-color: #FFFFFF;">
             <?php if(!empty($TypeTags_favorite_rule_model)){?>
             <p style="padding-top: 5px;margin-bottom: 1px;">
                <label ><span class="people_label_right font_bold_color">Favorite Rules:</span></label>
                <?php
                    $i=0; 
                    foreach($TypeTags_favorite_rule_model as $TypeTags_favorite_rule_model){
                    if($i>=3){
                        break;
                    }
                    $i++;
                ?>
                        <div style="margin:3px 3px 3px 0px;">
                        <a href="#" class="people_label_value_right">
                            <b><input style="cursor:pointer;background-color: #22b14c;font: 14px Arial;" type="button" value="<?php echo $TypeTags_favorite_rule_model->type_tag;?>" class="field button2"/></b>
                        </a></div>
                <?php }?>
              <div style="clear: both;"></div>
              </p>  
             <?php }?>
             <?php if(!empty($CategoryGroups_model)){?>
             <p  style="padding-top: 5px;">
                <label ><span class="people_label_right font_bold_color">Groups:</span></label><br />
                <?php if($topic_question_answer_model->college){ ?>
                <a href="#" class="people_label_value_right"><?php echo $topic_question_answer_model->college;?>&nbsp;&nbsp;</a>
                <?php } ?>
                <?php foreach($CategoryGroups_model as $CategoryGroups_model){
                ?>
                        
                        <a href="#" class="people_label_value_right"><?php echo $CategoryGroups_model->groups;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
             <?php if(!empty($team_model)){?>
             <p style="padding-top: 5px;">
                <label ><span class="people_label_right font_bold_color"><?php echo $user_model->username;?> Teams:</span></label><br />
                <?php foreach($team_model as $team_model){
                ?>
                        <a class="people_label_value_right" href="<?php echo Yii::App()->createUrl("Team/viewteam",array("id"=>$team_model->id));?>" target="_blank"><?php echo $team_model->name;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
            <?php if(!empty($user_model->facebook_link)){?>
             <p style="padding-top: 5px;">
                <label ><span class="people_label_right font_bold_color">Facebook:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->facebook_link;?>" target="_blank"><?php echo $user_model->facebook_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($user_model->twitter_link)){?>   
             <p>
                <label ><span class="people_label_right font_bold_color">Twitter:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->twitter_link;?>" target="_blank"><?php echo $user_model->twitter_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($user_model->website_link)){?>   
             <p>
                <label ><span class="people_label_right font_bold_color">Website:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->website_link;?>" target="_blank"><?php echo $user_model->website_link;?></a></p>
             <?php }?>
             <div class="people_label_value_right" style="background-color: #FFFFFF;">
                    <label ><span class="people_label_right font_bold_color">Posts:</span></label>
                        <?php echo count($user_model->user_all_post_relation); ?>&nbsp;&nbsp;&nbsp;
                    <label ><span class="people_label_right font_bold_color">Topics:</span></label>
                        <?php echo count($user_model->user_topics_relation); ?>
                    <?php
                    $green_total_cooment = myhelpers::getGreentotalCountPeople($PeopleList->id,'Green');
                    $red_total_cooment =  myhelpers::getGreentotalCountPeople($PeopleList->id,'Green');
                   ?>
                   <p>
                        <label style="float: left;"><span class="people_label_right font_bold_color">Flags:&nbsp;&nbsp;</span></label> 
                       <?php if($green_total_cooment > 0){?>
                                <a class="people_label_value_right" style="color: white;" href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$user_model->id,'type'=>'green'))?>">
                                    <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:1%; margin-top:2px;" title="<?php echo $green_total_cooment;?> Green Flags">
                                        <div style="font-size:11px;"><?php echo $green_total_cooment;?></div>
                                    </div>
                                </a>
                       <?php }else{ ?>
                                    <div class="people_label_value_right" style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:1%; margin-top:2px;" title="<?php echo $green_total_cooment;?> Green Flags">
                                        <div style="font-size:11px;">0</div>
                                    </div>
                       <?php }
                            if($red_total_cooment > 0){ ?>
                                <a class="people_label_value_right" href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$user_model->id,'type'=>'red'))?>">
                                    <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-top:2px;" title="<?php echo $red_total_cooment;?> Red  Flags">
                                        <div style="font-size:11px;"><?php echo $red_total_cooment;?></div>
                                    </div>
                                </a>
                       <?php }else{ ?>
                                    <div class="people_label_value_right" style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-top:2px;" title="<?php echo $red_total_cooment;?> Red  Flags">
                                        <div style="font-size:11px;">0</div>
                                    </div>
                       <?php } ?>
                    </p>
                    <div style="clear: both;"></div>
                    <p class="people_label_value_right">
                        <label style="float: left;"><span class="people_label_right font_bold_color">Agree:&nbsp;&nbsp;</span></label> 
                        <?php
                            $agree=($green_total_cooment/($green_total_cooment+$red_total_cooment))*100;
                            echo round($agree, 2)."%";
                        ?>
                    </p>              
                    <p class="people_label_value_right">
                        <label ><span class="people_label_right font_bold_color">Joined:</span></label>
                        <?php echo date('m/d/Y',strtotime($user_model->created_date));?></p>
                    <p style="height: 1px;"></p>
             </div>                
         </div>

<script type="text/javascript">
function profileviewAbout(id)
{
    window.location.href="<?php echo Yii::app()->createUrl("site/ViewpeopleAbout") ?>?people_id="+id;
}
</script>