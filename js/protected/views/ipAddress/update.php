<?php
/* @var $this IpAddressController */
/* @var $model IpAddress */

$this->breadcrumbs=array(
	'Ip Addresses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IpAddress', 'url'=>array('index')),
	array('label'=>'Create IpAddress', 'url'=>array('create')),
	array('label'=>'View IpAddress', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IpAddress', 'url'=>array('admin')),
);
?>

<h1>Update IpAddress <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>