<?php
/* @var $this TypeTagsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Type Tags',
);

$this->menu=array(
	array('label'=>'Create TypeTags', 'url'=>array('create')),
	array('label'=>'Manage TypeTags', 'url'=>array('admin')),
);
?>

<h1>Type Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
