<?php
/* @var $this CategoryGroupsController */
/* @var $model CategoryGroups */

$this->breadcrumbs=array(
	'Category Groups'=>array('CategoryGroups/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryGroups', 'url'=>array('index')),
	array('label'=>'Manage CategoryGroups', 'url'=>array('admin')),
);
?>

<h1>Create CategoryGroups</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>