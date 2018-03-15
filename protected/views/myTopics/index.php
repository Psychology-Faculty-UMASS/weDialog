<?php
/* @var $this MyTopicsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'My Topics',
);

$this->menu=array(
	array('label'=>'Create MyTopics', 'url'=>array('create')),
	array('label'=>'Manage MyTopics', 'url'=>array('admin')),
);
?>

<h1>My Topics</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
