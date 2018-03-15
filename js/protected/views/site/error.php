<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<h1>Error <?php echo $error['code']; ?></h1>
<div class="cl"></div>
<!--
<div class="content_left">
<img border="0" alt="" src="<?php //echo Yii::app()->baseUrl;?>/images/404_img.jpg">
</div>
-->
<div class="content_right">

</div>
<div class="error">
<h2>
<?php echo $error['message']; ?></h2>
</div>