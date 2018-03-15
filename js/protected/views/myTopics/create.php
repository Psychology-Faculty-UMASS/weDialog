<?php
/* @var $this MyTopicsController */
/* @var $model MyTopics */

$this->breadcrumbs=array(
	'My Topics'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MyTopics', 'url'=>array('index')),
	array('label'=>'Manage MyTopics', 'url'=>array('admin')),
);
?>

<h1>Create MyTopics</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>