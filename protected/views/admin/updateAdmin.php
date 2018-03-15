<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Update Admin Profile',
);
?>
<h1>Update Admin Profile</h1>
<?php echo $this->renderPartial('/partials/_flash_msgs'); ?>

<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
$form = $this->beginWidget('CActiveForm', array(
						'id'=>'admin-form',
						'enableAjaxValidation'=>true,
						'enableClientValidation'=>true,
						'clientOptions'=>array(
										'validateOnSubmit'=>true,
										),
					)
	);
?>
<div class="form">
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php 
		echo $form->labelEx($model,'username');
		echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255));
		echo $form->error($model,'username');
		?>
	</div>
    <div class="row">
		<?php 
		echo $form->labelEx($model,'email');
		echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255));
		echo $form->error($model,'email');
		?>
	</div>
	<div class="row">
		<?php
		echo $form->labelEx($model,'password');
		echo $form->passwordField($model,'password',array('type'=>password,'size'=>60,'maxlength'=>255.));
		echo $form->error($model,'password');
		?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>