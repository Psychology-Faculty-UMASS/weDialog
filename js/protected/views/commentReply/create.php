<?php
/* @var $this CommentReplyController */
/* @var $model CommentReply */

$this->breadcrumbs=array(
	'Comment Replies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CommentReply', 'url'=>array('index')),
	array('label'=>'Manage CommentReply', 'url'=>array('admin')),
);
?>

<h1>Create CommentReply</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>