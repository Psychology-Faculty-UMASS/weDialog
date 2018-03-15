<?php
/* @var $this AllPostsController */
/* @var $model AllPosts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'all-posts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'post_type'); ?>
		<?php echo $form->textField($model,'post_type'); ?>
		<?php echo $form->error($model,'post_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'main_id'); ?>
		<?php echo $form->textField($model,'main_id'); ?>
		<?php echo $form->error($model,'main_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'main_comment_id'); ?>
		<?php echo $form->textField($model,'main_comment_id'); ?>
		<?php echo $form->error($model,'main_comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id'); ?>
		<?php echo $form->error($model,'comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'like'); ?>
		<?php echo $form->textField($model,'like'); ?>
		<?php echo $form->error($model,'like'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dislike'); ?>
		<?php echo $form->textField($model,'dislike'); ?>
		<?php echo $form->error($model,'dislike'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'like_ids'); ?>
		<?php echo $form->textArea($model,'like_ids',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'like_ids'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dislike_ids'); ?>
		<?php echo $form->textArea($model,'dislike_ids',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'dislike_ids'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
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