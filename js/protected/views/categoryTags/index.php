<?php
/* @var $this CategoryTagsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Tags',
);

$this->menu=array(
	array('label'=>'Create CategoryTags', 'url'=>array('create')),
	array('label'=>'Manage CategoryTags', 'url'=>array('admin')),
);
?>

<h1>Category Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
