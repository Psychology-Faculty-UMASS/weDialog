<?php 
$dialogID = '';
if(!empty(Yii::app()->session['dialog_id'])) {
    $dialogID = Yii::app()->session['dialog_id'];
}

if(isset($_GET['dialog_id'])){
    $dialogID = $_GET['dialog_id'];
    $dialogModel = Dialogs::model()->findByPk($dialogID);
    if(!$dialogModel){
        throw new CHttpException(404, 'Not Found.');
    }
}
if(!empty($dialogID)) {
    $dialogModel = Dialogs::model()->findByPk($dialogID);
    if(!$dialogModel){
        throw new CHttpException(404, 'Not Found.');
    }
    else{
        if($dialogModel->dialog_about_exists){
            $addNew = false;
        }
        else{
            $addNew = true;
        }
        
    }
}
?>
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
                    <a style="" id="edit-about-us-but" href="<?php echo Yii::app()->createUrl('site/editcms',array('id'=>$cms_about_model->id));?>">EDIT</a>
                <?php
				}
				?>
            </div>  
		</div>
        <div class="topic1" >
        	<div class="topic-details" style="text-align: left; font-family: Trebuchet MS, Helvetica, Arial, Sans-serif; font-size: 14.5px; line-height: 140%;">
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
<script>
    $(document).ready(function(){
        var addNewAbout = "<?php echo $addNew; ?>";
        $("#edit-about-us-but").click(function(){
            if(addNewAbout){
                if(confirm("Would you like to create a new About for this dialog?") == true) {
                    window.location.href="<?php echo Yii::app()->createUrl('dialogs/createAbout', array('dialog_id'=>$dialogID)); ?>";
                    return false;
                } else {
                    return true;
                }
            }
            else{
                return true;
            }
        });
    });
</script>