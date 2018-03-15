<?php
/* @var $this TopicsController */
/* @var $model Topics */

$this->breadcrumbs=array(
	'Manage Dialogs'=>Yii::app()->createUrl('dialogs/admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dialogs', 'url'=>array('index')),
	array('label'=>'Create Dialogs', 'url'=>array('create')),
	array('label'=>'View Dialogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dialogs', 'url'=>array('admin')),
);
?>

<h1>Update Dialogs <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>