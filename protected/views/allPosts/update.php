<?php
/* @var $this AllPostsController */
/* @var $model AllPosts */

$this->breadcrumbs=array(
	'All Posts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AllPosts', 'url'=>array('index')),
	array('label'=>'Create AllPosts', 'url'=>array('create')),
	array('label'=>'View AllPosts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AllPosts', 'url'=>array('admin')),
);
?>

<h1>Update AllPosts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>