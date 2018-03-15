<?php
/* @var $this TopicsController */
/* @var $model Topics */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'topics-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions' =>array(
			'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model,'user_id',CHtml::listData(Users::model()->findAll(), 'id', 'username'),array('empty'=>'Select Username','style'=>'width:210px;'));?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php
		echo $form->labelEx($model,'topic_title');
		echo $form->textField($model,'topic_title',array('size'=>60,'maxlength'=>255));
		echo $form->error($model,'topic_title');
		?>
	</div>
    <div class="row"> 
			<?php echo $form->labelEx($model,'topic_description');?>
            <div style="height: 5px"></div>
			<?php
	        $this->widget(
	            'application.extensions.NHCKEditor.CKEditorWidget', 
	            array(
	                //  [Required] CModel object
	                'model' => $model,
	                'attribute' => 'topic_description',
	                'htmlOptions' => array(),
	            )
	        );
			echo $form->error($model,'topic_description');
			?>
    </div>
	<div class="row">
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->