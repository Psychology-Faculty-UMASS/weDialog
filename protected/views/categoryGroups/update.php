<?php
/* @var $this CategoryGroupsController */
/* @var $model CategoryGroups */

$this->breadcrumbs=array(
	'Category Groups'=>array('CategoryGroups/admin'),
	'Update',
);
?>

<h1>Update CategoryGroups <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>