<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/css/select2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.js"></script>


<style type="text/css">
.uservalidate{
    color: red;
    font-weight: lighter;
}
</style>
<tr>
	<td colspan="3">
    	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td class="logo" style="width:20%"><a href="#"><img src="<?php echo Yii::app()->createUrl()?>/images/logo.png" width="179" height="52" /></a></td>
                <td class="page_title">Create new topic</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
	
    <td class="middle_column" style="width: 50%;" >
    
<?php
$form = $this->beginWidget('CActiveForm', array(
											'id'=>'topic-form',
                                            //'action'=>Yii::app()->createUrl('site/Createnewtopic'),
											'enableAjaxValidation'=>false,
										    'enableClientValidation'=>true,
										    'clientOptions'=>array(
																'validateOnSubmit'=>true,
													        ),
										)
						);
?>

    	<table class="content_box form_lable" >
        	<tr>
            	<td height="20">Topic Title</td>
            </tr>
            
            <tr>
            	<td>
                    <?php
                        echo $form->textField($TopicModel,'topic_title',array("class"=>"input_box"));
                    ?>
                </td>
            </tr>
            <tr>
                <td height="5">
                <?php
                    echo $form->error($TopicModel,'topic_title',array("class"=>"uservalidate"));
                ?>
                </td>
            </tr>
            <tr>
            <td>Topic Description</td>
            </tr>
            <tr>
            	<td height="5"></td>
            </tr>
            <tr>
            	<td>
                    <?php
                    $this->widget(
                        'application.extensions.NHCKEditor.CKEditorWidget', 
                        array(
                            'model' => $TopicModel,
                            'attribute' => 'topic_description',
                            'editorOptions' => array(
                                                    
                                                                                'toolbar'=>array(
                                                    
                                                                                   //array('Styles','Format','Font','FontSize'),
                                                    
                                                                                  //array('colors','TextColor','BGColor'),
                                                    
                                                                                  array('paragraph', 'NumberedList','BulletedList','-','Outdent','Indent','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
                                                    
                                                                                 //array('insert','Table','HorizontalRule'),
                                                    
                                                                                  // array('tools','Maximize'),
                                                    
                                                                                   array('links','Link','Unlink','Anchor'),
                                                    
                                                                                  array('editing','Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt'),
                                                    
                                                                                    array('clipboard','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
                                                    
                                                                                  // array('basicstyles','Bold','Italic','Underline','Strike','-','RemoveFormat'),
                                                    
                                                                                )
                                                    
                                                                            ),
                            'htmlOptions' => array("class"=>"textarea_box"),
                        )
                    );
                    ?>                                                                
                </td>
            </tr>
            <tr>
                <td height="5">
                <?php
                    echo $form->error($TopicModel,'topic_description',array("class"=>"uservalidate"));
                ?>
                </td>
            </tr>
            <tr>
            <td>Category Tags</td>
            </tr>
            <tr>
            	<td height="5"></td>
            </tr>
            <tr>
            	<td>
                <?php 
            $tmp_cat_tags_array = array();
            foreach($tagmodel as $tag_cat){
              $ex_cat_tag=explode(",",$tag_cat->category_tags);
			    for($i=0;$i<count($ex_cat_tag);$i++){
			     $tmp_cat_tags_array[] = trim($ex_cat_tag[$i]);  
			    }
			}
			$uniq_array=array_unique($tmp_cat_tags_array);
            for($i=0;$i<count($uniq_array);$i++){
                  if(!empty($uniq_array[$i])){
                    $tagS_Array[]='"'.$uniq_array[$i].'"';
                  } 
            }            
            $new_string=implode(",",$tagS_Array);
            //echo $new_string;exit;
            ?>
                  <?php echo $form->textField($TopicModel,'category_tags',array('style'=>'width:98%','class'=>'new-account-input-width','placeholder'=>'Tags field',array('id'=>'selecttags'))); ?>
                    <script>            
                        $("#Topics_category_tags").select2({
                        tags:[<?php echo $new_string ?>],
                        maximumInputLength: 10
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td height="5">
                </td>
            </tr>
            <tr>
            <td>Type Tags</td>
            </tr>
            <tr>
            	<td height="5"></td>
            </tr>
            <tr>
            	<td>
                <?php 
            $tmp_tags_array = array();
            foreach($tagmodel as $tag){
              $ex_type_tag=explode(",",$tag->type_tags);
			    for($i=0;$i<count($ex_type_tag);$i++){
			     $tmp_tags_array[] = trim($ex_type_tag[$i]);  
			    }
			}
			$uniq_type_array=array_unique($tmp_tags_array);
            for($i=0;$i<count($uniq_type_array);$i++){
                  if(!empty($uniq_type_array[$i])){
                    $tagS_type_Array[]='"'.$uniq_type_array[$i].'"';
                  } 
            }            
            $new_type_string=implode(",",$tagS_type_Array);
			?>
            
            
                  <?php echo $form->textField($TopicModel,'type_tags',array('style'=>'width:98%','class'=>'new-account-input-width','placeholder'=>'Tags field',array('id'=>'selecttags'))); ?>
                    <script>            
                        $("#Topics_type_tags").select2({
                        tags:[<?php echo $new_type_string ?>],
                        maximumInputLength: 10
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td height="5">
                </td>
            </tr>
            <tr>
            	<td height="5"></td>
            </tr>
            <tr>
            	<td>
                    <input type="image" src="<?php echo Yii::app()->createUrl()?>/images/create-1.png" width="65" height="25" />
                	<a href="#"><img src="<?php echo Yii::app()->createUrl()?>/images/cancel-1.png" width="65" height="25" /></a>
                    
                </td>
            </tr>
            <tr>
            	<td height="5"></td>
            </tr>
        </table>
<?php $this->endWidget(); ?>
    </td>
    <td class="right_column" width="25%"">
    	<table class="content_box form_lable" style="width:100%">
        	<tr>
            	<td height="20">Category Tags</td>
            </tr>
            <?php 
            $tmp_cat_tags_array = array();
            foreach($tagmodel as $tag_cat){
              $ex_cat_tag=explode(",",$tag_cat->category_tags);
			    for($i=0;$i<count($ex_cat_tag);$i++){
			     $tmp_cat_tags_array[] = trim($ex_cat_tag[$i]);  
			    }
			}
			            
			foreach(array_count_values($tmp_cat_tags_array) as $key=>$value){?>
				<tr>
			    	<td height="20" style="font-weight: lighter !important;"><?php echo $key; echo ($value>1) ? " (".$value.")" : ""; ?></td>
			    </tr> 
			             
			<?  }
			?>
	   </table>
       <table class="content_box form_lable" style="width:100%">
            <tr>
                <td height="20">Type Tags</td>
            </tr>
            
            <?php 
            $tmp_tags_array = array();
            foreach($tagmodel as $tag){
              $ex_type_tag=explode(",",$tag->type_tags);
			    for($i=0;$i<count($ex_type_tag);$i++){
			     $tmp_tags_array[] = trim($ex_type_tag[$i]);  
			    }
			}
			            
			foreach(array_count_values($tmp_tags_array) as $key=>$value){?>
				<tr>
			    	<td height="20" style="font-weight: lighter !important;"><?php echo $key; echo ($value>1) ? " (".$value.")" : ""; ?></td>
			    </tr> 
			             
			<?  }
			?>

            
            
        </table>
    </td>
</tr>
