<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo Yii::app()->request->baseUrl;?>/css/tagstyle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl;?>/css/form.css" rel="stylesheet" type="text/css" />    

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.yiiactiveform.js"></script>

    <title>
    <?php 
        if(isset($this->data['meta_title'])){
            echo $this->data['meta_title'];
        }else{
           echo Yii::app()->params['meta_title'];
     }?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <?php /*
    <meta name="description" content="<?php if(isset($this->data['meta_description'])){
            echo $this->data['meta_description'];
        }else{
            echo Yii::app()->params['meta_description'];
        }
        ?>" /> 
     */ ?>
    <meta property="og:image" content="<?php echo Yii::app()->baseUrl;?>/images/fb-share.png"/>
    <meta name="description" content="People-to-People Dialog" />
    
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