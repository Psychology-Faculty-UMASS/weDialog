<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
	<div class="main_left">
		<?php
        $this->renderPartial('_left_panel',$this->data);
        ?>
	</div>
	<div class="main_mid" style="width:690px">
    	<div class="topics">
        	<div class="topic_head" style="width: 25%;">
            	<?php echo $cms_about_model->title;?>
            </div>
            <div style="float: right;" class="topic_head">
                <?php
                if($this->data['group_id']==1){
                ?>
                    <a style="color:white;" href="<?php echo Yii::app()->createUrl('site/editcms',array('id'=>$cms_about_model->id));?>">EDIT ABOUT CMS</a>
                <?php
				}
				?>
            </div>  
		</div>
        <div class="topic1" >
        	<div class="topic-details" style="text-align: justify;">
            <?php
            if(!empty($cms_about_model->description)){
				echo $cms_about_model->description;
			}
			?>
                <br /><br /><span style="color: #666666;">Created by/Date:</span>
                <br /><span style="color: #065A95;font-weight: bold;">wedialog,</span>
                <br /><?php echo date('m/d/Y',strtotime($cms_about_model->updated));?>             
			</div>
		</div>
	</div>           
    <!--
    <div class="main_right"></div>
	-->
</div>