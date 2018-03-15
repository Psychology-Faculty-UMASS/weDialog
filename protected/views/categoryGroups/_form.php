<?php
/* @var $this CategoryGroupsController */
/* @var $model CategoryGroups */
/* @var $form CActiveForm */
?>

<div class="form">



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-groups-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions' =>array(
			'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groups'); ?>
		<?php echo $form->textField($model,'groups',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'groups'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->