<?php
/* @var $this FlagReasonController */
/* @var $model FlagReason */

$this->breadcrumbs=array(
	'Flag Reasons'=>array('Admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FlagReason', 'url'=>array('index')),
	array('label'=>'Create FlagReason', 'url'=>array('create')),
	array('label'=>'Update FlagReason', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FlagReason', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FlagReason', 'url'=>array('admin')),
);
?>

<h3>View FlagReason #<?php echo $model->id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'flag_type',
		'reason',
		'status',
	),
)); ?>
