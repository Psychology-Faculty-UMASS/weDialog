<?php
/* @var $this AllPostsFlagsController */
/* @var $model AllPostsFlags */

$this->breadcrumbs=array(
	'All Posts Flags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AllPostsFlags', 'url'=>array('index')),
	array('label'=>'Create AllPostsFlags', 'url'=>array('create')),
	array('label'=>'Update AllPostsFlags', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AllPostsFlags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AllPostsFlags', 'url'=>array('admin')),
);
?>

<h1>View AllPostsFlags #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'all_posts_id',
		'commented_by',
		'flag_reason_id',
		'flag_type',
		'block_user',
		'hide_post',
		'adminprocess',
		'flag_status',
		'created_date',
	),
)); ?>
