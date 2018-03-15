<?php
/* @var $this AiiaController */
/* @var $model Aiia */

$this->breadcrumbs=array(
	'Manage AIIA'=>Yii::app()->createUrl('Aiia/admin'),
	'Update',
);
?>

<h1>Update Aiia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>