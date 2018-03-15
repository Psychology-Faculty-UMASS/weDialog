<?php
/* @var $this AiiaController */
/* @var $model Aiia */

$this->breadcrumbs=array(
    'Manage AIIAS'=>Yii::app()->createUrl('Aiia/admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Aiia', 'url'=>array('index')),
	array('label'=>'Manage Aiia', 'url'=>array('admin')),
);
?>

<h1>Create Aiia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>