<?php
/* @var $this CategoryGroupsController */
/* @var $model CategoryGroups */

$this->breadcrumbs=array(
	'Category Groups'=>array('admin'),
	$model->id,
);
?>

<h1>View CategoryGroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'groups',
		'total',
		'created_by',
		'date',
		'status',
	),
)); ?>