<?php
/* @var $this IpAddressController */
/* @var $model IpAddress */

$this->breadcrumbs=array(
	'Ip Addresses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List IpAddress', 'url'=>array('index')),
	array('label'=>'Create IpAddress', 'url'=>array('create')),
	array('label'=>'Update IpAddress', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IpAddress', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IpAddress', 'url'=>array('admin')),
);
?>

<h1>View IpAddress #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip_address',
		'status',
		'created_date',
	),
)); ?>
