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
		echo $form->labelEx($model,'login_username');
		echo $form->textField($model,'login_username',array('size'=>60,'maxlength'=>255));
		echo $form->error($model,'login_username');
		?>
	</div>
	<div class="row">
		<?php
		echo $form->labelEx($model,'login_password');
		echo $form->passwordField($model,'login_password',array('type'=>"password",'size'=>60,'maxlength'=>255));
		echo $form->error($model,'login_password');
		?>
	</div>
	<div class="row">
		<?php 
		echo $form->labelEx($model,'email');
		echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255));
		echo $form->error($model,'email');
		?>
	</div>
        <?php if(Yii::app()->session['group_id'] == 1){ ?>
            <div class="row">
                <?php echo $form->labelEx($model,'login_check');?>
                <?php //echo $form->checkBox($model,'login_check');?>
                <?php echo $form->dropDownList($model,'login_check',array("0"=>"OFF","1"=>"ON")); ?>
            <?php //echo $form->error($model,'login_check');?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'ip_address_check');?>
                <?php echo $form->dropDownList($model,'ip_address_check',array("0"=>"OFF","1"=>"ON")); ?>
                <?php echo $form->error($model,'ip_address_check');?>
            </div>
        <?php } ?>
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>