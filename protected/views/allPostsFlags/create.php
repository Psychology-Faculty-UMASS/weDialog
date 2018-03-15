<?php
/* @var $this AllPostsFlagsController */
/* @var $model AllPostsFlags */

$this->breadcrumbs=array(
	'All Posts Flags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AllPostsFlags', 'url'=>array('index')),
	array('label'=>'Manage AllPostsFlags', 'url'=>array('admin')),
);
?>

<h1>Create AllPostsFlags</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>