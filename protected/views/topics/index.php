<?php
/* @var $this TopicsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Topics',
);

$this->menu=array(
	array('label'=>'Create Topics', 'url'=>array('create')),
	array('label'=>'Manage Topics', 'url'=>array('admin')),
);
?>

<h1>Topics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
