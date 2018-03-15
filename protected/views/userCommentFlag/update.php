<?php
/* @var $this UserCommentFlagController */
/* @var $model UserCommentFlag */

$this->breadcrumbs=array(
	'User Comment Flags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserCommentFlag', 'url'=>array('index')),
	array('label'=>'Create UserCommentFlag', 'url'=>array('create')),
	array('label'=>'View UserCommentFlag', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserCommentFlag', 'url'=>array('admin')),
);
?>

<h1>Update UserCommentFlag <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>