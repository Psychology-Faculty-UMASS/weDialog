<?php
/* @var $this FlagReasonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Flag Reasons',
);

$this->menu=array(
	array('label'=>'Create FlagReason', 'url'=>array('create')),
	array('label'=>'Manage FlagReason', 'url'=>array('admin')),
);
?>

<h1>Flag Reasons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
