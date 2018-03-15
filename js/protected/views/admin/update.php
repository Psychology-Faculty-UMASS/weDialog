<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Update Admin Profile',
);
?>
<h1>Update Admin Profile</h1>
<?php echo $this->renderPartial('/partials/_flash_msgs'); ?>
<?php echo $this->renderPartial('_form', $this->data); ?>