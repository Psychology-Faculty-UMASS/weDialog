<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
    tinymce.init({selector:'textarea',
        plugins: "autolink",
        paste_auto_cleanup_on_paste : true,
        forced_root_block : false, 
        menubar:false,
        statusbar: false,
        toolbar: false,
        mode : "none",
      content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css",
    });
</script>
<style>
		.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
		.content_2{height:245px;}
		.td-conten-bg{
			background: none repeat scroll 0 0 #FFFFCC;
   			border: 1px solid #0066FF;
    		padding: 5px;
		}
		.form_lable {
			color: #125D90;
			font-size: 12px;
			font-weight: bold;
			font-family:Arial, Helvetica, sans-serif;
			padding:3px 0px;
		}
		.form_lable_normal {
			color: #125D90;
			font-size: 12px;
			font-weight: normal;
			font-family:Arial, Helvetica, sans-serif;
			padding:3px 0px;
		}
        
        .mce-panel {
            border: 0px solid #DDD;
            background-repeat: repeat-x;
            background-image: linear-gradient(to bottom, #FDFDFD, #DDD);
            background-color: #F0F0F0;
        }
</style>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />  
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo Yii::app()->request->baseUrl;?>/js//minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
	(function($){
		$(window).load(function(){
			/* custom scrollbar fn call */
			$(".content_2").mCustomScrollbar({
				scrollInertia:150
			});			
			/* 
			demo fn 
			functions below are for demo and examples
			*/
		});
	})(jQuery);
</script>



<style type="text/css">
.uservalidate{
    color: red;
    font-weight: lighter;
}
#lean_overlay {
    position: fixed;
    z-index:100;
    top: 0px;
    left: 0px;
    height:100%;
    width:100%;
    background: #000;
    display: none;
}
</style>
<style type="text/css">
.fontweight{
    font-weight: lighter;
    vertical-align: top;
}
</style>


<div class="main">
    <div class="main_mid3">
      <div class="topics"> <div class="topic_head"><?php if($rule_model->id){?> Edit <?php }else{?> PROPOSE NEW <?php }?> Rule</div></div>
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            		'id'=>'rule-form',
                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
            		'enableAjaxValidation'=>false,
            	    'enableClientValidation'=>true,
            	    'clientOptions'=>array(
            			'validateOnSubmit'=>true,
                    ),
            	)
            );
        ?>      
        <table border="0" cellpadding="4" cellspacing="0" width="100%" id="show_tbl_detail" class="topic_detail">
          <tbody>
          	<tr>
            <td align="right" width="21%" class="title_font_size">Rule Name  :</td>
            <td width="79%">
                <?php echo $form->textField($rule_model,'type_tag',array("class"=>"tag1","maxlength"=>"255"));?>
                <?php echo $form->error($rule_model,'type_tag',array("class"=>"uservalidate"));?>
            </td>
          </tr>
         
          <tr>
            <td align="right" valign="top" class="title_font_size">Rule Description :</td>
            <td>
                <?php echo $form->textArea($rule_model,'type_tag_description');?>
                <?php echo $form->error($rule_model,'type_tag_description',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>
            <td height="5" colspan="2" align="left"><img src="images/spacer.gif" width="1" height="1" /></td>
            </tr>

          
            <tr>
                <td></td>
                <td>
                    <input class="Submit fl" name="submit" value="SAVE" type="submit" onclick="selectDescription();"/>
                    <a href="<?php echo Yii::app()->createUrl('TypeTags/rules');?>" style="text-decoration: none;"><input class="Submit fl" name="submit" value="Cancel" type="button"/></a>
                </td>
            </tr>
         
          </tbody></table>
         <?php $this->endWidget(); ?>
         <div class="footer_manage" style="background-color:#E2F5FA;"></div>
    </div>
    <div class="main_right">
        <!--================Start:Rules Right Panel-========================-->
        <div class="category">
        <div class="category_head">Rules</div>
        <div class="content_2 content" style="overflow-x: hidden;overflow-y: hidden;">
            <ul>
                <?php 
                    if(isset($rule_post_model) && count($rule_post_model) > 0){
                        foreach($rule_post_model as $rule){?>
                            <li><a href="<?php echo Yii::app()->createUrl('TypeTags/viewrule',array('tag_id'=>$rule->id));?>"><?php echo $rule->type_tag;?><?php if(count($rule->tag_type_to_comment_relation) >0 ){echo " (".count($rule->tag_type_to_comment_relation).") ";}?></a></li>
                        <?php
                        }
                    }
                ?>    
            </ul>
        </div>
    </div>
    <p id="demo"></p>
  <!--================End:Rules Right Panel-========================-->
    </div>
</div>
<script>
    function selectDescription(){
        tinyMCE.triggerSave();
    }
      
$( window ).load(function() {
    //for right panal position=fixed so use this to solve footer problem 
    $height=$(".main_right").height();
    $height_main_mid3=$(".main_mid3").height();
    if($height>$height_main_mid3)
    $(".footer_manage").height($height-$height_main_mid3-15);    
    
});
</script>