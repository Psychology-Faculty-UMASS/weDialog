<?php
/* @var $this CmsController */
/* @var $model Cms */

$this->breadcrumbs=array(
	'Cms'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Cms', 'url'=>array('index')),
	array('label'=>'Create Cms', 'url'=>array('create')),
	array('label'=>'Update Cms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cms', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cms', 'url'=>array('admin')),
);
?>

<h1>View Cms #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'created',
		'updated',
		'status',
	),
)); ?>
