<?php
/* @var $this TopicsController */
/* @var $model Topics */

$this->breadcrumbs=array(
	'Manage Dialogs'=>Yii::app()->createUrl('dialogs/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dialogs', 'url'=>array('index')),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>Create Dialogs</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>