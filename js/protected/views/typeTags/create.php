<?php
/* @var $this TypeTagsController */
/* @var $model TypeTags */

$this->breadcrumbs=array(
	'Type Tags'=>Yii::app()->createUrl('typeTags/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TypeTags', 'url'=>array('index')),
	array('label'=>'Manage TypeTags', 'url'=>array('admin')),
);
?>

<h1>Create TypeTags</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>