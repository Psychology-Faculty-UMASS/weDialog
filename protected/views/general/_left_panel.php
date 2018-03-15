
<?php 
if(!empty(Yii::app()->session['dialog_id'])) {
    $aboutLink = Yii::app()->createUrl('dialogs/about');
}
else{
    $aboutLink = Yii::app()->createUrl('general/about');
}
?>
<div class="left_main_menu">
	<ul>
		<li><a href="<?php echo Yii::app()->createUrl('dialogs/DialogList')?>">DIALOGS</a></li>
		<li><a class="active" href="<?php echo Yii::app()->createUrl('general/about'); ?>">ABOUT</a></li>
	</ul>
</div>