<?php
/* @var $this AllPostsFlagsController */
/* @var $model AllPostsFlags */
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
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'all_posts_id'); ?>
		<?php echo $form->textField($model,'all_posts_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commented_by'); ?>
		<?php echo $form->textField($model,'commented_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flag_reason_id'); ?>
		<?php echo $form->textField($model,'flag_reason_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flag_type'); ?>
		<?php echo $form->textField($model,'flag_type',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'block_user'); ?>
		<?php echo $form->textField($model,'block_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hide_post'); ?>
		<?php echo $form->textField($model,'hide_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adminprocess'); ?>
		<?php echo $form->textField($model,'adminprocess'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flag_status'); ?>
		<?php echo $form->textField($model,'flag_status'); ?>
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