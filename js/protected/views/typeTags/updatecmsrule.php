<!--<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>-->
<script src="<?php echo Yii::app()->createUrl('js/tinymce/tinymce.min.js');?>"></script>

<script>
    tinymce.init({selector:'textarea',
        paste_auto_cleanup_on_paste : true,
        forced_root_block : false, 
        statusbar: false,
        mode : "none",
        height : "350px",
        toolbar_items_size : 'small',
        /*
        plugins: "paste",
        menubar:true,
        toolbar: true,
        theme: "modern",
        */
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
        //toolbar2: "",
        image_advtab: true,

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
</style>
<div class="main">
    <div class="main_mid3" style="width: 90%;">
      <div class="topics"> <div class="topic_head">
        <?php
        if($_GET['id'] == 5){
            $update_title = 'EDIT RULES';   
        }else if($_GET['id'] == 6){
            $update_title = 'EDIT TEAMS';
        }else if($_GET['id'] == 1){
            $update_title = 'EDIT ABOUT US';
        }else {
            $update_title = 'EDIT TOPICS';
        }
        echo $update_title;
        ?>      
      </div></div>
        <?php
            $form = $this->beginWidget('CActiveForm', array(
            		'id'=>'rule-cms-form',
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
            <td align="right" width="21%">Title  :</td>
            <td width="79%">
                <?php
                    echo $form->textField($model,'title',array("class"=>"tag1","maxlength"=>"124"));
                    echo $form->error($model,'title',array("style"=>"color:red"));
                ?>
            </td>
          </tr>
          	<tr>
            <td align="right" valign="top">Description :</td>
            <td width="79%">
                <?php
                    echo $form->textArea($model,'description');
                    echo $form->error($model,'description',array("style"=>"color:red;height:350px;"));
                    echo $form->hiddenField($model,'created');
                    echo $form->hiddenField($model,'updated'); 	
                    echo $form->hiddenField($model,'status');
                ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
                <input class="Submit fl" name="submit" value="SAVE" type="submit"/>
                <?php
                if($_GET['id'] == 5){
                    $redirect_url = Yii::app()->createUrl('TypeTags/rules');   
                }else if($_GET['id'] == 6){
                    $redirect_url = Yii::app()->createUrl('team/teamlist');
                }else if($_GET['id'] == 1){
                    $redirect_url = Yii::app()->createUrl('general/about');
                }else{
                    $redirect_url = Yii::app()->createUrl('');
                }
                ?>
                <a href="<?php echo $redirect_url;?>" style="text-decoration: none;"><input class="Submit fl" name="submit" value="Cancel" type="button"/></a>
            </td>
          </tr>
         
          </tbody></table>
         <?php $this->endWidget(); ?>
    </div>
</div>