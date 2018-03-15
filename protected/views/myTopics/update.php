<?php
/* @var $this MyTopicsController */
/* @var $model MyTopics */

$this->breadcrumbs=array(
	'My Topics'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MyTopics', 'url'=>array('index')),
	array('label'=>'Create MyTopics', 'url'=>array('create')),
	array('label'=>'View MyTopics', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MyTopics', 'url'=>array('admin')),
);
?>

<h1>Update MyTopics <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>