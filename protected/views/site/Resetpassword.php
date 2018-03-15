<?php
$this->pageTitle=Yii::app()->name . ' - Change Password';
$this->breadcrumbs=array(
    'Change Password',
);
?>
<style type="text/css">
    .failure_msg {
        background-color: #e85449;
        color: white;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        padding: 5px;
    }
</style>
<h2 align="center">Hi! <?php echo $model->username;?>,</h2>
<div class="form" align="center">
    <h3>Please enter a new password below.</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'Ganti-form',
    // 'action'=>Yii::app()->createUrl('site/PerformResetPassword'),
)); ?>

    <table id="login_detail" border="0" cellpadding="4" cellspacing="0" align="center">
              
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <?php $this->renderPartial('/partials/_flash_msgs'); ?>
                    </td>
                </tr>              
                <tr>
                <td align="right" width="21%"><span class="star">*</span>New Password : </td>
                <td width="79%">
                    <input name="Ganti[password]" id="ContactForm_email_pass" type="password" required minlength="4" pattern="\S+" required>
                    <input name="Ganti[tokenhid]" id="ContactForm_email_token" type="hidden" value="<?php echo $model->token?>">
                </td>
              </tr>
             
              <tr>
                <td>&nbsp;</td>
                <td><?php echo CHtml::submitButton('Submit'); ?></td>
              </tr>
              
             </table>
 
    <!-- <div class="row">
            <?php $this->renderPartial('/partials/_flash_msgs'); ?>
            New Password : <input name="Ganti[password]" id="ContactForm_email_pass" type="password" required minlength="4" pattern="\S+" required>
            <input name="Ganti[tokenhid]" id="ContactForm_email_token" type="hidden" value="<?php echo $model->token?>">
    </div>
     
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div> -->
 
<?php $this->endWidget(); ?>
 
</div><!-- form -->