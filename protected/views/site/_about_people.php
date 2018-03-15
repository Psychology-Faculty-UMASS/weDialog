<div class="main_mid1" id="toggle_column" style="width:100%;display: none;margin-left:0px;">
    <div class="topics">
        <div class="topic_head" style="width:98%;">
        <div style="float: left;">
            About USER
        </div>
        <div style="float:right;">
            <?php if($user_model->id == Yii::app()->session['user_id']){ ?>
            <a href="<?php echo Yii::app()->createUrl('site/editUser') ?>" style="text-transform:none;color: #FFFFFF;font-size: 13px; float: right;text-decoration: none;"><img src="<?php echo Yii::app()->baseUrl;?>/images/edit_profile.jpg"/></a>
    		<?php } ?>       
        </div>
        </div>
    </div>
    <div class="topic1" >
        <div class="profile-out-div"> 
            <?php
            $Src = Yii::app()->baseurl.'/'.Yii::app()->params['profile_img'].$user_model->profile_image;
            
            if($user_model->profile_image == ""){
                $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
            }
            ?>
            <?php if($user_model->facebook_id != 0 &&  $user_model->facebook_id!=""){
                    if($user_model->profile_image==""){
                         $Src= 'https://graph.facebook.com/'.$user_model->facebook_id.'/picture?type=large' ;
                    }
            }?>
            <?php if($user_model->twitter_id != 0 &&  $user_model->twitter_id!=""){
                         $Src= Yii::app()->session['twitter_image'] ;
               
            }?>
            <div class="profile-right-div-2">
            <!--<a  style="color:white;" href="<?php echo Yii::app()->createUrl('Site/viewpeople',array('people_id'=>$user_model->id)) ?>"><img  src="<?php echo $Src;?>" class="align_left"/>
        		<div class="name-2"><?php echo $user_model->username;?></div></div><br /></a>
              -->
              <a onclick="$('#show_tbl_detail_menue').show();$('#show_tbl_detail').show();$('#toggle_column').hide();" style="cursor: pointer;">
              	<img  src="<?php echo $Src;?>" class="align_left"/>
        		<div class="name-2"><?php echo $user_model->username;?></div></div><br />
               </a>
         </div>        
         <div class="topic-details">
            
                <?php if(!empty($user_model->user_description)){
                     echo $user_model->user_description;
                 } ?>
             
         </div>
         <div>
            <?php if(!empty($aiia_model)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">As an Individual I am:</span></label><br />
                <?php foreach($aiia_model as $aiia_model){
                ?>
                        <a class="people_label_value_right" href="#"><?php echo $aiia_model->discriptor;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
             <?php if(!empty($TypeTags_favorite_rule_model)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Favorite Rules:</span></label><br />
                <?php foreach($TypeTags_favorite_rule_model as $TypeTags_favorite_rule_model){
                ?>
                        <div style="float: left;margin:3px;">
                        <a class="people_label_value_right" href="#" style="text-decoration: none;">
                            <b><input style="cursor:pointer;background-color: #22b14c;font: 14px Arial;" type="button" value="<?php echo $TypeTags_favorite_rule_model->type_tag;?>" class="field button2"/></b>
                        </a></div>
                <?php }?>
              <div style="clear: both;"></div>
              </p>  
             <?php }?>
             <?php if(!empty($CategoryGroups_model)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Groups:</span></label><br />
                <?php foreach($CategoryGroups_model as $CategoryGroups_model){
                ?>
                        <a class="people_label_value_right" href="#"><?php echo $CategoryGroups_model->groups;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
             <?php if(!empty($team_model)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right"><?php echo $user_model->username;?> Teams:</span></label><br />
                <?php foreach($team_model as $team_model){
                ?>
                        <a class="people_label_value_right" href="<?php echo Yii::App()->createUrl("Team/viewteam",array("id"=>$team_model->id));?>" target="_blank"><?php echo $team_model->name;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
            <?php if(!empty($user_model->facebook_link)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Facebook:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->facebook_link;?>" target="_blank"><?php echo $user_model->facebook_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($user_model->twitter_link)){?>   
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Website:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->twitter_link;?>" target="_blank"><?php echo $user_model->twitter_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($user_model->website_link)){?>   
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Website:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $user_model->website_link;?>" target="_blank"><?php echo $user_model->website_link;?></a></p>
                
             <?php }?>   
         </div>
         <div class="people_label_value_right">
                <p style="padding-top: 20px;"> 
                    <label ><span class="people_label_right">Posts:</span></label>
                        <?php echo count($user_model->user_all_post_relation); ?>&nbsp;&nbsp;&nbsp;
                    <label ><span class="people_label_right">Topics:</span></label>
                        <?php echo count($user_model->user_topics_relation); ?>
                    <?php
                    $green_total_cooment = myhelpers::getGreentotalCountPeople($user_model->id,'Green');
                    $red_total_cooment = myhelpers::getGreentotalCountPeople($user_model->id,'Red');
                   ?>
                </p>
               <p style="padding-top: 20px;"> 
                   <label style="float: left;"><span class="people_label_right">Flags:&nbsp;&nbsp;</span></label> 
 
                </p>
                <div style="clear: both;"></div> 
                <p style="padding-top: 20px;">
                    <label style="float: left;"><span class="people_label_right">Agree:&nbsp;&nbsp;</span></label> 
                    <div  class="people_label_value_right">
                    <?php
                        $agree=($green_total_cooment/($green_total_cooment+$red_total_cooment))*100;
                        echo round($agree, 2)."%";
                    ?>
                    </div>
                </p>              
                <p style="padding-top: 20px;">
                    <label style="float: left;"><span class="people_label_right">Date joined:&nbsp;&nbsp;</span></label>
                    <div  class="people_label_value_right">
                        <?php echo date('m/d/Y',strtotime($user_model->created_date));?>
                    </div>
                </p>
         </div> 
    </div>      
</div>
