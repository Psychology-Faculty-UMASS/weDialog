<?php
/* @var $this CommentReplyController */
/* @var $model CommentReply */

$this->breadcrumbs=array(
	'Comment Replies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CommentReply', 'url'=>array('index')),
	array('label'=>'Create CommentReply', 'url'=>array('create')),
	array('label'=>'Update CommentReply', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CommentReply', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CommentReply', 'url'=>array('admin')),
);
?>

<h1>View CommentReply #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'comment_id',
		'user_id',
		'reply',
		'created_date',
	),
)); ?>
