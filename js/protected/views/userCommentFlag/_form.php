<?php
/* @var $this UserCommentFlagController */
/* @var $model UserCommentFlag */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-comment-flag-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_comment_id'); ?>
		<?php echo $form->textField($model,'user_comment_id'); ?>
		<?php echo $form->error($model,'user_comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flag_reason_id'); ?>
		<?php echo $form->textField($model,'flag_reason_id'); ?>
		<?php echo $form->error($model,'flag_reason_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flag_type'); ?>
		<?php echo $form->textField($model,'flag_type',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'flag_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'block_user'); ?>
		<?php echo $form->textField($model,'block_user'); ?>
		<?php echo $form->error($model,'block_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hide_post'); ?>
		<?php echo $form->textField($model,'hide_post'); ?>
		<?php echo $form->error($model,'hide_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adminprocess'); ?>
		<?php echo $form->textField($model,'adminprocess'); ?>
		<?php echo $form->error($model,'adminprocess'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->