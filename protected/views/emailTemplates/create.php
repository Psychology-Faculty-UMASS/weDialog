<?php
$this->breadcrumbs=array(
	'Email Templates'=>array('emailTemplates/admin'),
	'Create',
);
?>

<div class="middle_main">
    <?php // $this->renderPartial('/partials/_breadcumb_div',$this->data); ?>

<div class="middle_details_div">

<?php  $this->renderPartial('/partials/_flash_msgs',$this->data); ?>    

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
 </div>
</div>
<div class="clearfix"></div>
</div>
