<?php
/* @var $this AllPostsController */
/* @var $model AllPosts */

$this->breadcrumbs=array(
	'All Posts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AllPosts', 'url'=>array('index')),
	array('label'=>'Create AllPosts', 'url'=>array('create')),
	array('label'=>'Update AllPosts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AllPosts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AllPosts', 'url'=>array('admin')),
);
?>

<h1>View AllPosts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'post_type',
		'main_id',
		'user_id',
		'comment',
		'main_comment_id',
		'comment_id',
		'like',
		'dislike',
		'like_ids',
		'dislike_ids',
		'status',
		'created_date',
	),
)); ?>
