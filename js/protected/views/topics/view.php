<?php
/* @var $this TopicsController */
/* @var $model Topics */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Topics', 'url'=>array('index')),
	array('label'=>'Create Topics', 'url'=>array('create')),
	array('label'=>'Update Topics', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Topics', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Topics', 'url'=>array('admin')),
);
?>

<h1>View Topics #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'topic_title',
		'topic_description',
		'created_date',
		'status',
	),
)); ?>
