<?php
/* @var $this MyTopicsController */
/* @var $model MyTopics */

$this->breadcrumbs=array(
	'My Topics'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MyTopics', 'url'=>array('index')),
	array('label'=>'Create MyTopics', 'url'=>array('create')),
	array('label'=>'Update MyTopics', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MyTopics', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MyTopics', 'url'=>array('admin')),
);
?>

<h1>View MyTopics #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'my_topics_ids',
	),
)); ?>
