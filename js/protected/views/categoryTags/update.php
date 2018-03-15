<?php
/* @var $this CategoryTagsController */
/* @var $model CategoryTags */

$this->breadcrumbs=array(
	'Category Tags'=>Yii::app()->createUrl('categoryTags/admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryTags', 'url'=>array('index')),
	array('label'=>'Create CategoryTags', 'url'=>array('create')),
	array('label'=>'View CategoryTags', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryTags', 'url'=>array('admin')),
);
?>

<h1>Update CategoryTags </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>