<?php
/* @var $this AllPostsController */
/* @var $model AllPosts */

$this->breadcrumbs=array(
	'All Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AllPosts', 'url'=>array('index')),
	array('label'=>'Manage AllPosts', 'url'=>array('admin')),
);
?>

<h1>Create AllPosts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>