<?php
/* @var $this CommentReplyController */
/* @var $model CommentReply */

$this->breadcrumbs=array(
	'Comment Replies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CommentReply', 'url'=>array('index')),
	array('label'=>'Create CommentReply', 'url'=>array('create')),
	array('label'=>'View CommentReply', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CommentReply', 'url'=>array('admin')),
);
?>

<h1>Update CommentReply <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>