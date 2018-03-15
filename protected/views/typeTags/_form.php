<?php
/* @var $this TypeTagsController */
/* @var $model TypeTags */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'type-tags-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type_tag'); ?>
		<?php echo $form->textField($model,'type_tag',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type_tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_tag_description'); ?>
		<?php echo $form->textArea($model,'type_tag_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'type_tag_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
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