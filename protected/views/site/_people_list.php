<table style="width: 100%;" data-id="as">
    <tr>                    
        <td style="width:85px; vertical-align: top;">
            <?php
            $Src = '../'.Yii::app()->params['profile_img'].$PeopleList->profile_image;
            
            if($PeopleList->profile_image == ""){
                $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
            }
            ?>
            <?php if($PeopleList->facebook_id != 0 &&  $PeopleList->facebook_id!=""){
                    if($PeopleList->profile_image==""){
                         $Src= 'http://graph.facebook.com/'.$PeopleList->facebook_id.'/picture?type=large' ;
                    }
            }?>
           <?php /* ?><a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$PeopleList->id))?>"><?php */ ?>
           <a href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id))?>">
            <img  src="<?php echo $Src;?>" width="45" height="45" style="background-color:#bde3e7;"/>
           </a>
           <?php
            $green_total_cooment = myhelpers::getGreentotalCountPeople($PeopleList->id,'Green');
            $red_total_cooment = myhelpers::getGreentotalCountPeople($PeopleList->id,'Red');
           ?>
           <div style="clear:both; height:3px;"></div>
           <?php if($green_total_cooment > 0){?>
                    <a href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id,'type'=>'green'))?>">
                        <div style="background-color:#07D000; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center; margin-right:10%" title="<?php echo $green_total_cooment;?> Green Flags"><?php echo $green_total_cooment;?></div>
                    </a>
           <?php }
                if($red_total_cooment > 0){
           ?>
                    <a href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id,'type'=>'red'))?>">
                        <div style="background-color:#FA3002; color:white; font-size:11px; width:20px;height:12px; float:left; text-align:center;" title="<?php echo $red_total_cooment;?> Red  Flags"><?php echo $red_total_cooment;?></div>
                    </a>
           <?php } ?>
        </td>
        <td style="width:12px;">&nbsp;</td>
        <td style="width:100%; vertical-align: top;">
            <table width="100%" style="vertical-align: top;padding: 0px;" cellspacing="0" cellpadding="0" border="0">
                <tr id="people-list-name" style="vertical-align: top;">
                    <td id="people-list-name" style="float:left;">
                       <?php /* ?> <a href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$PeopleList->id))?>" style="text-decoration: none;color: #065A95 !important; "><?php */ ?>
                       <a href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$PeopleList->id))?>" style="text-decoration: none; font-weight: normal; font-size:20px; color: #065A95 !important;">
                            <?php echo ucfirst($PeopleList->username)?>
                        </a>
                    </td>    
                </tr>
                <tr>
                    <td height="20" style="word-wrap: normal;color: #666666;">
                          <?php if(!empty($PeopleList->user_description)){
                             //echo $PeopleList->user_description;
                             echo substr($PeopleList->user_description,0, 180);
                    	     if(strlen($PeopleList->user_description) > 180){
                    	        echo "...";
                    	     }
                         } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="40%" >
                            <tr>
  <!--                           <td style=" color: rgb(153, 153, 153);">Posts -->
								<td>  
								<img src="<?php echo Yii::app()->baseUrl ?>/images/comment-icon.png" style="position:relative; top:6px;"/>	
								<?php echo $PeopleList['Totalpostscount']; //count($PeopleList->user_all_post_relation); ?></td>
                                <!--<td style="color: rgb(153, 153, 153)">Topics(<?php echo count($PeopleList->user_topics_relation); ?>)</td>-->
                                <td style="color: rgb(153, 153, 153)">
                                    <?php
                                        if(count($PeopleList->user_all_post_relation) > 0){
                                            $stringtime= strtotime($PeopleList->user_all_post_relation[0]->created_date);
                                            //echo "Last:". date('m/d/y  - H:i',$stringtime);
                                            echo date('m/d/y ',$stringtime);
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
             </table>                    
        </td>
    </tr> 
    <tr>
        <td height="5" colspan="3">&nbsp;</td>
    </tr>
</table>