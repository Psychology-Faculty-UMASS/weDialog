<?php
/* @var $this TypeTagsController */
/* @var $model TypeTags */

$this->breadcrumbs=array(
	'Type Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TypeTags', 'url'=>array('index')),
	array('label'=>'Create TypeTags', 'url'=>array('create')),
	array('label'=>'Update TypeTags', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TypeTags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TypeTags', 'url'=>array('admin')),
);
?>

<h1>View TypeTags #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type_tag',
		'type_tag_description',
		'user_id',
		'created_date',
	),
)); ?>
