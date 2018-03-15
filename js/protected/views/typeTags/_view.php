<?php
/* @var $this TypeTagsController */
/* @var $data TypeTags */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_tag')); ?>:</b>
	<?php echo CHtml::encode($data->type_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_tag_description')); ?>:</b>
	<?php echo CHtml::encode($data->type_tag_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />


</div>