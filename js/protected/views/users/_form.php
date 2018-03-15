<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions' =>array(
			'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'facebook_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_id'); ?>
		<?php echo $form->textField($model,'twitter_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'twitter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <div class="row">
        	<?php echo $form->labelEx($model,'user_description'); ?>
			<div style="height: 5px"></div> 
	       	<?php
	        $this->widget(
	            'application.extensions.NHCKEditor.CKEditorWidget', 
	            array(
	                //  [Required] CModel object
	                'model' => $model,
	                'attribute' => 'user_description',
	                'htmlOptions' => array(),
	            )
	        );
			?>
            <?php echo $form->error($model,'user_description'); ?>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'facebook_link'); ?>
		<?php echo $form->textField($model,'facebook_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'facebook_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_link'); ?> 
		<?php echo $form->textField($model,'twitter_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'twitter_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website_link'); ?>
		<?php echo $form->textField($model,'website_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'website_link'); ?>
	</div>
    <div class="admin-edit-box-group">   
       <?php echo $form->labelEx($model,'created_date'); ?>
       <?php 
            Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker',array(
                    'model'=>$model, //Model object
                    'attribute'=>'created_date', //attribute name
                    'mode'=>'datetime', //use "time","date" or "datetime" (default)
                    'options'=>array( // jquery plugin options
                        'dateFormat'=>'yy-mm-dd',                                

                    ),
                    'htmlOptions'=>array(                        
                        'readonly'=>true,
                        'size'=>30,                                    
                        'style'=>'width:20%',
                    ),                                                          
                ));
       ?>   
       <?php echo $form->error($model,'created_date'); ?>                
       
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'save' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->