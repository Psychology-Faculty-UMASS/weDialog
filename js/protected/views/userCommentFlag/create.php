<?php
/* @var $this UserCommentFlagController */
/* @var $model UserCommentFlag */

$this->breadcrumbs=array(
	'User Comment Flags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserCommentFlag', 'url'=>array('index')),
	array('label'=>'Manage UserCommentFlag', 'url'=>array('admin')),
);
?>

<h1>Create UserCommentFlag</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>