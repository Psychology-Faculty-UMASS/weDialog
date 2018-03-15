<script>
function runSuccessErrorDivEffect() {
	setTimeout(function(){
		removeSuccessErrorDiv();
	}, 7000);
}
function removeSuccessErrorDiv(){
	jQuery("#success_msg").hide(500);
    jQuery("#failure_msg").hide(500);
}
runSuccessErrorDivEffect();
</script>
<?php 
$div_id = "";
if(Yii::app()->user->hasFlash('success_msg')){
	$div_id = "success_msg";
	$msg = Yii::app()->user->getFlash('success_msg');
}else if(Yii::app()->user->hasFlash('failure_msg')){
	$div_id = "failure_msg";
	$msg = Yii::app()->user->getFlash('failure_msg');
}

if($div_id != ""){
?>
<div class="sitetopSuccessDiv <?php echo $div_id;?>" id="<?php echo $div_id;?>" onclick="removeSuccessErrorDiv();">
	<?php echo $msg; ?>
</div>
<?php
}
?> 