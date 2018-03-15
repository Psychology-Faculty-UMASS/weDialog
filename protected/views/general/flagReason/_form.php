<?php
/* @var $this FlagReasonController */
/* @var $model FlagReason */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'flag-reason-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions' =>array(
			'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
 
    <div class="row">
        <?php echo $form->labelEx($model,'flag_type'); ?>
       	<?php // echo $form->textField($model,'flag_type',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model,'flag_type',array("Red"=>"Red","Green"=>"Green")); ?>
        <?php // echo $form->dropDownList($model,'flag_type','',array('value'=>'Red,Green','empty'=>'Select flag type','style'=>'width:210px;'));?>
		<?php echo $form->error($model,'flag_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->