<?php
/* @var $this CategoryTagsController */
/* @var $model CategoryTags */

$this->breadcrumbs=array(
	'Category Tags'=>Yii::app()->createUrl('categoryTags/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryTags', 'url'=>array('index')),
	array('label'=>'Manage CategoryTags', 'url'=>array('admin')),
);
?>

<h1>Create CategoryTags</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>