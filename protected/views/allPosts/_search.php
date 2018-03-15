<?php
/* @var $this AllPostsController */
/* @var $model AllPosts */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_type'); ?>
		<?php echo $form->textField($model,'post_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main_id'); ?>
		<?php echo $form->textField($model,'main_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main_comment_id'); ?>
		<?php echo $form->textField($model,'main_comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'like'); ?>
		<?php echo $form->textField($model,'like'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dislike'); ?>
		<?php echo $form->textField($model,'dislike'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'like_ids'); ?>
		<?php echo $form->textArea($model,'like_ids',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dislike_ids'); ?>
		<?php echo $form->textArea($model,'dislike_ids',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->