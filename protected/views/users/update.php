<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Manage Users'=>Yii::app()->createUrl('users/admin'),
	'Update',
);
?>
<h1>Update User Profile</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>