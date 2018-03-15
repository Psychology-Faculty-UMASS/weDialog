<?php
/* @var $this FlagReasonController */
/* @var $model FlagReason */

$this->breadcrumbs=array(
	'Flag Reasons'=>array('Admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>
<h1>Update FlagReason</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>