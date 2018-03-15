<?php
$form = $this->beginWidget('CActiveForm', array(
											'id'=>'admin-login-form',
											'enableAjaxValidation'=>false,
										    'enableClientValidation'=>true,
										    'clientOptions'=>array(
																'validateOnSubmit'=>true,
													        ),
										)
						);
?>
<h1>Login</h1>
<p>Please fill out the following form with your login credentials:</p>
<?php  $this->renderPartial('/partials/_flash_msgs',$this->data); ?> 
<div class="form">
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'login_username'); ?>
		<?php echo $form->textField($model,'login_username'); ?>
		<?php echo $form->error($model,'login_username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'login_password'); ?>
		<?php echo $form->passwordField($model,'login_password'); ?>
		<?php echo $form->error($model,'login_password'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
</div><!-- form -->
<?php $this->endWidget(); ?>