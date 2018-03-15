<?php
/* @var $this MyTopicsController */
/* @var $data MyTopics */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('my_topics_ids')); ?>:</b>
	<?php echo CHtml::encode($data->my_topics_ids); ?>
	<br />


</div>