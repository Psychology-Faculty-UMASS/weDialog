<?php
/* @var $this AiiaController */
/* @var $model Aiia */

$this->breadcrumbs=array(
	'Manage Aiia'=>array('admin'),
	$model->id,
);

?>

<h1>View Aiia #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'discriptor',
		'created_by',
		'date',
		'status',
	),
)); ?>
