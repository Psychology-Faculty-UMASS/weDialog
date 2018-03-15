<?php
/* @var $this IpAddressController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ip Addresses',
);

$this->menu=array(
	array('label'=>'Create IpAddress', 'url'=>array('create')),
	array('label'=>'Manage IpAddress', 'url'=>array('admin')),
);
?>

<h1>Ip Addresses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
