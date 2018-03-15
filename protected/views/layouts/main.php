<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1">
    <script>
		window.onload = function() {
		if (screen.width < 550) {
			var mvp = document.getElementById('vp');
			mvp.setAttribute('content','user-scalable=no,width=550,max-width=550');
}
</script>
	<!-- blueprint CSS framework --> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.yiiactiveform.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            .grid-view table.items th{
                    background: darkblue !important;
            }
        </style>
</head>

<body>

<div class="container" id="page"> 

	<div id="header">
		<div id="logo"><a href="https://www.wedialog.net/dialogs/DialogList"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
		$menu_array = array('items'=>array(
								array('label'=>'Login', 'url'=>Yii::app()->createUrl('admin')),
							)
					);
		if(!empty($this->data['user_id']) && $this->data['user_id']!=""){
			$menu_array = array('items'=>array(
				array('label'=>'Home', 'url'=>Yii::app()->createUrl('admin'),'visible'=>$this->data['group_id']=="1"),
                                array('label'=>'Home', 'url'=>Yii::app()->createUrl('Admin/updateAdmin',array("id"=>Yii::app()->session['user_id'])),'visible'=>$this->data['group_id']=="3"),
				array('label'=>'People', 'url'=>Yii::app()->createUrl('users/admin')),
                                array('label'=>'Posts', 'url'=>Yii::app()->createUrl('allPosts/admin')),
								array('label'=>'Flags', 'url'=>Yii::app()->createUrl('allPostsFlags/admin')),
                                array('label'=>'Topics', 'url'=>Yii::app()->createUrl('topics/admin')),
                                array('label'=>'Tags', 'url'=>Yii::app()->createUrl('categoryTags/admin')),
				array('label'=>'Rules', 'url'=>Yii::app()->createUrl('typeTags/admin')),
                                array('label'=>'Groups', 'url'=>Yii::app()->createUrl('Team/admin')),
                                array('label'=>'Questions', 'url'=>Yii::app()->createUrl('categoryGroups/admin')),
/*                            	array('label'=>'Admin', 'url'=>Yii::app()->createUrl('Users/viewAdminList'),'visible'=>$this->data['group_id']=="1"), */
                                array('label'=>'Dialogs','url'=>Yii::app()->createUrl('dialogs/admin')),

 
                                array('label'=>'Reasons', 'url'=>Yii::app()->createUrl('FlagReason/admin'),'visible'=>$this->data['group_id']=="1"),
                                array('label'=>'AIIA', 'url'=>Yii::app()->createUrl('Aiia/admin'),'visible'=>$this->data['group_id']=="1"),
                                array('label'=>'IpAddress', 'url'=>Yii::app()->createUrl('IpAddress/admin'),'visible'=>$this->data['group_id']=="1"),
                                array('label'=>'Email Templates', 'url'=>Yii::app()->createUrl('EmailTemplates/admin'),'visible'=>$this->data['group_id']=="1"),
							
                                array('label'=>'Logout ('.Yii::app()->session['user_name'].')', 'url'=>array('admin/logout'))
                                //array('label'=>'Topic Flags', 'url'=>Yii::app()->createUrl('UserCommentFlag/admin')),
                                //array('label'=>'Rules Flags', 'url'=>Yii::app()->createUrl('TypeTagsCommentFlag/admin')),
                                //array('label'=>'Team Flags', 'url'=>Yii::app()->createUrl('TeamCommentFlag/admin')),
 
                               
                                

							),
						);
		}
		$this->widget('zii.widgets.CMenu', $menu_array);
		?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> wedialog.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>