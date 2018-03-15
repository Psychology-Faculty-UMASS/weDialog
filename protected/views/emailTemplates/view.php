<?php
/* @var $this EmailTemplatesController */
/* @var $model EmailTemplates */

$this->breadcrumbs=array(
	'Email Templates'=>array('emailTemplates/admin'),
    'Update Email Templates'=>array('update','id'=>$model->id),
	$model->name,
);
?><div class="middle_main">
    <?php //$this->renderPartial('/partials/_breadcumb_div',$this->data); ?>

<div class="middle_details_div">

<?php  $this->renderPartial('/partials/_flash_msgs',$this->data); ?>    

<div class="row-fluid">
    <div class="admin_inner_middle_div">
    <div class="admin_form_box_titel">
        <table width="100%" height="33px">
            <tr>
                <td>View Email Template</td>
                <!--<td style="text-align: right;"><a href="<?php echo Yii::app()->createUrl('emailTemplates/update',array('id'=>$model->id));?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/update.png" width="25" height="25" border="0" title="Update Email Template"/></a>&nbsp;<a href="<?php echo Yii::app()->createUrl('emailTemplates/admin');?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/back.png" width="25" height="25" border="0" title="Back to Email Templates List"/></a></td>
                -->
            </tr>
        </table>
    </div>
        <div class="admin_form_box_details">
            <?php $this->widget('zii.widgets.CDetailView', array(
            	'data'=>$model,
            	'attributes'=>array(
            		'name',
            		'subject',
            		//'description',
                     array(
                      'name'=>'description',                 
                      'type'=>'html',                 
                    ),
            	),
            )); ?>
        </div>
    </div>
    <div class="clearfix"></div>
 </div>
</div>
<div class="clearfix"></div>
</div>