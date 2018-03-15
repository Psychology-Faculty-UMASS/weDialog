<!DOCTYPE html>
<html>
<head>
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1">
    <script>
		window.onload = function() {
		if (screen.width < 550) {
			var mvp = document.getElementById('vp');
			mvp.setAttribute('content','user-scalable=no,width=550,max-width=550');
			}
		}
</script>
	<link href="<?php echo Yii::app()->request->baseUrl;?>/css/tagstyle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl;?>/css/form.css" rel="stylesheet" type="text/css" />    

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.yiiactiveform.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/573ae372/ckeditor.js"></script>

    <title> 
        <?php if(!empty(Yii::app()->session['dialog_name'])): ?>            
                  <?php echo Yii::app()->session['dialog_name']; ?>
              <?php else: ?>
 <?php //print_R(Yii::app()->session);?>
                 <?php echo Yii::app()->session['meta_title']; ?>                  
              <?php endif; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
    <meta name="description" content="<?php if(isset($this->data['meta_description'])){
            echo strip_tags($this->data['meta_description']);
        }else{
            echo strip_tags(Yii::app()->params['meta_description']);
        }
        ?>" /> 
     
    <meta property="og:image" content="<?php echo Yii::app()->baseUrl;?>/images/fb-share.png"/>
    
    
    <meta name="keywords" content="<?php if(isset($this->data['meta_keyword'])){
        echo $this->data['meta_keyword'];
    }else{
        echo Yii::app()->params['meta_keyword']; 
    }?>" />
    <!--<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>-->
</head>
<body>
<div class="wrapper">
    <?php $this->renderPartial('/partials/_registration_header',$this->data); ?> 
    <?php echo $content;?>
    <?php $this->renderPartial('/partials/_registration_footer',$this->data); ?> 
</div>
</body>
</html>