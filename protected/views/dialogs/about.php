<div class="main">
	<div style="text-align:center; width:100%; float:left;"><?php $this->renderPartial('/partials/_flash_msgs'); ?></div>
	<div class="main_left">
		<?php
        $this->renderPartial('_left_panel_1',$this->data);
        ?>
	</div>
	<div class="main_mid" style="width:690px">
    	<div class="topics">
        	<div class="topic_head" style="width: 25%; height: 23px;">
                    <?php echo $model->dialog_about_title;?>
                </div>
            <div style="float: right;" class="topic_head">
                <?php
                if($this->data['group_id']==1){
                ?>
                    <a style="" href="<?php echo Yii::app()->createUrl('dialogs/editAbout');?>">EDIT</a>
                <?php
				}
				?>
            </div>  
		</div>
        <div class="topic1" >
        	<div class="topic-details" style="text-align: left; font-family: Trebuchet MS, Helvetica, Arial, Sans-serif; font-size: 14.5px; line-height:140%">
            <?php
            if(!empty($model->dialog_about_description)){
				echo $model->dialog_about_description;
			}
			?>
                <br /><br /><span style="color: #666666;">Created by/Date:</span>
                <br /><span style="color: #065A95;font-weight: bold;">wedialog,</span>
                <br /><?php echo date('m/d/Y',strtotime($model->dialog_about_updated));?>             
			</div>
		</div>
	</div>           
    <!--
    <div class="main_right"></div>
	-->
</div>