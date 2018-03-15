<?php
/* @var $this CmsController */
/* @var $model Cms */

$this->breadcrumbs=array(
	'Cms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cms', 'url'=>array('index')),
	array('label'=>'Manage Cms', 'url'=>array('admin')),
);
?>

<h1>Create Cms</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>