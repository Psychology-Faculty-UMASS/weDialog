<?php
/* @var $this AllPostsController */
/* @var $data AllPosts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_type')); ?>:</b>
	<?php echo CHtml::encode($data->post_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_id')); ?>:</b>
	<?php echo CHtml::encode($data->main_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_comment_id')); ?>:</b>
	<?php echo CHtml::encode($data->main_comment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_id')); ?>:</b>
	<?php echo CHtml::encode($data->comment_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('like')); ?>:</b>
	<?php echo CHtml::encode($data->like); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dislike')); ?>:</b>
	<?php echo CHtml::encode($data->dislike); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_ids')); ?>:</b>
	<?php echo CHtml::encode($data->like_ids); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dislike_ids')); ?>:</b>
	<?php echo CHtml::encode($data->dislike_ids); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>