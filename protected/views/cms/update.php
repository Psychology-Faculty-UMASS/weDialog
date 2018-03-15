<?php
/* @var $this CmsController */
/* @var $model Cms */

$this->breadcrumbs=array(
	'Cms'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cms', 'url'=>array('index')),
	array('label'=>'Create Cms', 'url'=>array('create')),
	array('label'=>'View Cms', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cms', 'url'=>array('admin')),
);
?>

<h1>Update Cms <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>