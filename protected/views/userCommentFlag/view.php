<?php
/* @var $this UserCommentFlagController */
/* @var $model UserCommentFlag */

$this->breadcrumbs=array(
	'User Comment Flags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserCommentFlag', 'url'=>array('index')),
	array('label'=>'Create UserCommentFlag', 'url'=>array('create')),
	array('label'=>'Update UserCommentFlag', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserCommentFlag', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserCommentFlag', 'url'=>array('admin')),
);
?>

<h1>View UserCommentFlag #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'user_comment_id',
		'flag_reason_id',
		'flag_type',
		'block_user',
		'hide_post',
		'adminprocess',
		'created_date',
	),
)); ?>
