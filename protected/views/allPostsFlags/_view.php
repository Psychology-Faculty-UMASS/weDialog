<?php
/* @var $this AllPostsFlagsController */
/* @var $data AllPostsFlags */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('all_posts_id')); ?>:</b>
	<?php echo CHtml::encode($data->all_posts_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commented_by')); ?>:</b>
	<?php echo CHtml::encode($data->commented_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flag_reason_id')); ?>:</b>
	<?php echo CHtml::encode($data->flag_reason_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flag_type')); ?>:</b>
	<?php echo CHtml::encode($data->flag_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block_user')); ?>:</b>
	<?php echo CHtml::encode($data->block_user); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('hide_post')); ?>:</b>
	<?php echo CHtml::encode($data->hide_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adminprocess')); ?>:</b>
	<?php echo CHtml::encode($data->adminprocess); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flag_status')); ?>:</b>
	<?php echo CHtml::encode($data->flag_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>