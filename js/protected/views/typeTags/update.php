<?php
/* @var $this TypeTagsController */
/* @var $model TypeTags */

$this->breadcrumbs=array(
	'Type Tags'=>Yii::app()->createUrl('typeTags/admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List TypeTags', 'url'=>array('index')),
	array('label'=>'Create TypeTags', 'url'=>array('create')),
	array('label'=>'View TypeTags', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TypeTags', 'url'=>array('admin')),
);
?>

<h1>Update TypeTags <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>