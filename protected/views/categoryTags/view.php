<?php
/* @var $this CategoryTagsController */
/* @var $model CategoryTags */

$this->breadcrumbs=array(
	'Category Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryTags', 'url'=>array('index')),
	array('label'=>'Create CategoryTags', 'url'=>array('create')),
	array('label'=>'Update CategoryTags', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryTags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryTags', 'url'=>array('admin')),
);
?>

<h1>View CategoryTags #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cat_tag',
		'cat_tag_description',
		'user_id',
		'created_date',
	),
)); ?>
