<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_id')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_id')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_description')); ?>:</b>
	<?php echo CHtml::encode($data->user_description); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_link')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_link')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website_link')); ?>:</b>
	<?php echo CHtml::encode($data->website_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>