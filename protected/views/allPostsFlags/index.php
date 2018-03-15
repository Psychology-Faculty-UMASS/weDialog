<?php
/* @var $this AllPostsFlagsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'All Posts Flags',
);

$this->menu=array(
	array('label'=>'Create AllPostsFlags', 'url'=>array('create')),
	array('label'=>'Manage AllPostsFlags', 'url'=>array('admin')),
);
?>

<h1>All Posts Flags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
