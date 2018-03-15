<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'email-templates-form',
        //'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions' =>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data',
            'name' => 'event_form',
             
        ),
    )); 
?>
<div class="row-fluid">
        <div class="admin_inner_middle_div">
        <div class="admin_form_box_titel">
        <table width="100%" height="33px">
            <tr>
                <td>
                    <?php
                        if($model->id){
                            echo "Update Template";
                        }else{
                            echo "Create Template";
                        }
                    ?>
                </td>
            </tr>
        </table>
        </div>
            <div class="admin_form_box_details">
			<?php
			if($_GET['id'] == 3){
			?>
		 <div class="admin_details_row">
            <div class="admin-edit-box-group">		
    		  <?php 
         		echo $form->labelEx($model,'notification_flag');
				echo $form->checkBox($model,'notification_flag',array('value'=>1, 'uncheckValue'=>0));
        		echo $form->error($model,'notification_flag');
              ?>	
            </div>
        <div class="clearfix"></div>
        </div>
        <?php 
			}
        ?>	
        <div class="admin_details_row">
            <div class="admin-edit-box-group">		
    		  <?php 
         		echo $form->labelEx($model,'name');
        		echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255));
        		echo $form->error($model,'name');
              ?>	
            </div>
        <div class="clearfix"></div>
        </div>
    
    	 <div class="admin_details_row">
           <div class="admin-edit-box-group">	
    		  <?php 
         		echo $form->labelEx($model,'subject');
        		echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255));
        		echo $form->error($model,'subject');
              ?>    	   
           </div>
        <div class="clearfix">&nbsp;</div>
        </div>
        <div class="clearfix"></div>
    	 <div class="admin_details_row">
            <div class="admin-edit-box-group" style="width:99%;">	
			<?php
            echo $form->labelEx($model,'description');
	        $this->widget(
	            'application.extensions.NHCKEditor.CKEditorWidget', 
	            array(
	                //  [Required] CModel object
	                'model' => $model,
	                'attribute' => 'description',
	                'htmlOptions' => array(),
	            )
	        );
			echo $form->error($model,'description');
			?>

    	    </div>
                        <div>NOTE : Plaese Do not change in #WORD# in description, that words are fatch dynemic data</div>

        <div class="clearfix"></div>
        </div>
    
    	 <div class="admin_details_row">
            <div class="admin-edit-box-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',
                array(
                'onclick'=>'CKEDITOR.instances.EmailTemplates_description.updateElement()','class'=>'login_button','style'=>'width:80px;',
            )); ?>
            <a href="<?php echo Yii::app()->createUrl('emailTemplates/admin');?>" style="text-decoration: none;"><input type="button" name="Back" value="Back" class="login_button" style="width:80px;"/></a>            
                    
    	    </div>
        <div class="clearfix"></div>
        </div>

</div>
</div><div class="clearfix"></div>
 <?php $this->endWidget(); ?>