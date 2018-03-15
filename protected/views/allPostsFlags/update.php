<?php
/* @var $this AllPostsFlagsController */
/* @var $model AllPostsFlags */

$this->breadcrumbs=array(
	'All Posts Flags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AllPostsFlags', 'url'=>array('index')),
	array('label'=>'Create AllPostsFlags', 'url'=>array('create')),
	array('label'=>'View AllPostsFlags', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AllPostsFlags', 'url'=>array('admin')),
);
?>

<h1>Update AllPostsFlags <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>