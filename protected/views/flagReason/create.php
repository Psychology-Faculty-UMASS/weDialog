<?php
/* @var $this FlagReasonController */
/* @var $model FlagReason */

$this->breadcrumbs=array(
	'Flag Reasons'=>array('Admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FlagReason', 'url'=>array('index')),
	array('label'=>'Manage FlagReason', 'url'=>array('admin')),
);
?>

<h1>Create FlagReason</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>