<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
	<div class="main_left">
		<?php
        $this->renderPartial('/topics/_topics_list_left_panel',$this->data);
        ?>
	</div>
    <div class="main_mid" style="width:605px;">
      <div class="topics">
        <div class="topic_head" style="width:98%; padding-left:2%;">
        <a  style="color:white;" href="<?php echo Yii::app()->createUrl('Site/viewpeople',array('people_id'=>$UserProfileModel->id)) ?>"><div style="float: left;">Profile</div></a>
            <div style="float:right; padding-right:1%;">
                <?php
                if($UserProfileModel->id == Yii::app()->session['user_id']){
                ?>
                <a href="<?php echo Yii::app()->createUrl('site/EditUser')?>" style="color: #FFFFFF;font-size: 12px; font-weight: normal; text-transform: none;"><img src="<?php echo Yii::app()->baseUrl;?>/images/edit_profile.jpg"/></a>
                <?php
                }
                ?>
            </div>        
        </div>
      </div>
      <div class="topic1" >
        <div class="profile-out-div"> 
            <?php
            $Src = Yii::app()->baseurl.'/'.Yii::app()->params['profile_img'].$UserProfileModel->profile_image;
            
            if($UserProfileModel->profile_image == ""){
                $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
            }
            ?>
            <? if($UserProfileModel->facebook_id != 0 &&  $UserProfileModel->facebook_id!=""){
                    if($UserProfileModel->profile_image==""){
                         //$Src= 'https://graph.facebook.com/'.$UserProfileModel->facebook_id.'/picture?type=large' ;
                    }
            }?>
            <? if($UserProfileModel->twitter_id != 0 &&  $UserProfileModel->twitter_id!=""){
                         //$Src= Yii::app()->session['twitter_image'] ;
               
            }?>
            <a  style="color:white;" href="<?php echo Yii::app()->createUrl('Site/viewpeople',array('people_id'=>$UserProfileModel->id)) ?>"><img  src="<?php echo $Src;?>" class="align_left"/></a>
        
            <div class="profile-right-div-2">
                <div class="name-2"><?php echo $UserProfileModel->username;?></div>
            </div><br />
         </div>        
         <div class="topic-details">
            
                <?php if(!empty($UserProfileModel->user_description)){
                     echo $UserProfileModel->user_description;
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
                        <div style="float: left;margin-top:3px;">
                        <a class="people_label_value_right" href="#" style="text-decoration: none;">
                            <b><input style="cursor:pointer;background-color: #22b14c;font: 14px Arial;" type="button" value="<?php echo $TypeTags_favorite_rule_model->type_tag;?>" class="field button2"/></b>
                        </a>&nbsp;</div>
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
                <label ><span class="people_label_right"><?php echo $UserProfileModel->username;?> Teams:</span></label><br />
                <?php foreach($team_model as $team_model){
                ?>
                        <a class="people_label_value_right" href="<?php echo Yii::App()->createUrl("Team/viewteam",array("id"=>$team_model->id));?>" target="_blank"><?php echo $team_model->name;?></a>&nbsp;&nbsp;
                <?php }?>
              </p>  
             <?php }?>
            <?php if(!empty($UserProfileModel->facebook_link)){?>
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Facebook:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $UserProfileModel->facebook_link;?>" target="_blank"><?php echo $UserProfileModel->facebook_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($UserProfileModel->twitter_link)){?>   
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Website:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $UserProfileModel->twitter_link;?>" target="_blank"><?php echo $UserProfileModel->twitter_link;?></a></p>
                
             <?php }?>
             <?php if(!empty($UserProfileModel->website_link)){?>   
             <p style="padding-top: 20px;">
                <label ><span class="people_label_right">Website:</span></label><br />
                <a class="people_label_value_right" href="<?php echo $UserProfileModel->website_link;?>" target="_blank"><?php echo $UserProfileModel->website_link;?></a></p>
                
             <?php }?>   
         </div>
         <div class="people_label_value_right">
                <p style="padding-top: 20px;">
                    <label ><span class="people_label_right">Posts:</span></label>
                        <?php echo count($UserProfileModel->user_all_post_relation); ?>&nbsp;&nbsp;&nbsp;
                    <label ><span class="people_label_right">Topics:</span></label>
                        <?php echo count($UserProfileModel->user_topics_relation); ?>
                    <?php
                    $green_total_cooment = myhelpers::getGreentotalCountPeople($UserProfileModel->id,'Green');
                    $red_total_cooment = myhelpers::getGreentotalCountPeople($UserProfileModel->id,'Red');
                   ?>
                </p>
               <p style="padding-top: 20px;"> 
                   <label style="float: left;"><span class="people_label_right">Flags:&nbsp;&nbsp;</span></label> 
                   <?php if($green_total_cooment > 0){?>
                            <a class="people_label_value_right"  style="color: white;" href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$UserProfileModel->id,'type'=>'green'))?>">
                                <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:1%" title="<?php echo $green_total_cooment;?> Green Flags">
                                    <div style="margin-top:-3px; font-size:11px;"><?php echo $green_total_cooment;?></div>
                                </div>
                            </a>
                   <?php }else{ ?>
                                <div class="people_label_value_right" style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:1%" title="<?php echo $green_total_cooment;?> Green Flags">
                                    <div style="margin-top:-3px; font-size:11px;">0</div>
                                </div>
                   <?php }
                        if($red_total_cooment > 0){ ?>
                            <a class="people_label_value_right" href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$UserProfileModel->id,'type'=>'red'))?>">
                                <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="<?php echo $red_total_cooment;?> Red  Flags">
                                    <div style="margin-top:-3px; font-size:11px;"><?php echo $red_total_cooment;?></div>
                                </div>
                            </a>
                   <?php }else{ ?>
                                <div class="people_label_value_right" style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="<?php echo $red_total_cooment;?> Red  Flags">
                                    <div style="margin-top:-3px; font-size:11px;">0</div>
                                </div>
                   <?php } ?>
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
                    <?php echo date('m/d/Y',strtotime($UserProfileModel->created_date));?>
                    </div>
                </p>
         </div>
      </div>  
     </div>
     <!--
	 <div class="main_right"></div>
     -->
</div>
