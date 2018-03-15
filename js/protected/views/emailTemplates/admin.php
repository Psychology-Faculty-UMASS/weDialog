<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />

<?php 
/* @var $this TypeTagsController */
/* @var $model TypeTags */

$this->breadcrumbs=array(
	'Manage Email Templates',
);
?>
<div class="admin_login_form_titel" style="width:98%">
	<table width="100%">
		<tr>
			<td>Manage Team</td>
			<td></td>
			<td style="float: right;"></td>
		</tr>
	</table>
</div>
<?php $this->renderPartial('/partials/_flash_msgs'); ?>
   
<div class="admin_login_form_box_details">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'team-grid',
	'htmlOptions'=>array('style'=>'padding: 0px'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		'subject',
	//	'description',
		array(
            'header'=>'Action',
    		'class'=>'CButtonColumn',
    		'template'=>'{update}{view}',
            'htmlOptions' => array('style' => 'width:10%;text-align:center;'),
    		'buttons'=>array(    		   		
                'update'=>array(
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',                       
					'url'=>'Yii::app()->createUrl("emailTemplates/update", array("id" => $data->id))',
                    'label'=>'Update Templates',
                    'options'=>array('style'=>'margin:2px;'),
                    'visible'=>$this->data["group_id"]=="1"? "true":"false",
    			),                 
                'view'=>array(
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',                       
					'url'=>'Yii::app()->createUrl("emailTemplates/view", array("id" => $data->id))',
                    'label'=>'View Templates',
                    'options'=>array('style'=>'margin:2px;'),
    			),                
    		),
    	), 
	),
)); ?>
</div>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('Team/Manage_team'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" /> 

</form>