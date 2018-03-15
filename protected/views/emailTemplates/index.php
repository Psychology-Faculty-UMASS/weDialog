<?php
/* @var $this EmailTemplatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Email Templates',
);

$this->menu=array(
	array('label'=>'Create EmailTemplates', 'url'=>array('create')),
	array('label'=>'Manage EmailTemplates', 'url'=>array('admin')),
);
?>

<h1>Email Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
