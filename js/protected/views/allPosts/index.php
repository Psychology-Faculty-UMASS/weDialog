<?php
/* @var $this AllPostsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'All Posts',
);

$this->menu=array(
	array('label'=>'Create AllPosts', 'url'=>array('create')),
	array('label'=>'Manage AllPosts', 'url'=>array('admin')),
);
?>

<h1>All Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
