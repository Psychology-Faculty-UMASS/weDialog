<?php
/* @var $this CommentReplyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comment Replies',
);

$this->menu=array(
	array('label'=>'Create CommentReply', 'url'=>array('create')),
	array('label'=>'Manage CommentReply', 'url'=>array('admin')),
);
?>

<h1>Comment Replies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
