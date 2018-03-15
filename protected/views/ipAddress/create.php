<?php
/* @var $this IpAddressController */
/* @var $model IpAddress */

$this->breadcrumbs=array(
	'Ip Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IpAddress', 'url'=>array('index')),
	array('label'=>'Manage IpAddress', 'url'=>array('admin')),
);
?>

<h1>Create IpAddress</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>