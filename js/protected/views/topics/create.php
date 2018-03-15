<?php
/* @var $this TopicsController */
/* @var $model Topics */

$this->breadcrumbs=array(
	'Manage Topics'=>Yii::app()->createUrl('topics/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Topics', 'url'=>array('index')),
	array('label'=>'Manage Topics', 'url'=>array('admin')),
);
?>

<h1>Create Topics</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>