<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/css/select2.css" />

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>

<table style="width:98%;margin: 0;padding: 0;"  id="postamessage" >
    <tr>
        <td id="postamessagetd" style="padding-left: 5px; height: 30px;font-size: 14px;color: #999999;cursor: pointer;border: solid 1px #D5D5D5;"> Write new message : </td>
    </tr>
</table>
  
<table class="content_box form_lable" style="width:100%;height: 16px; vertical-align: top;">
    <tr>
        <td>
            <table style="width:99%; vertical-align: top;">
                <tr>
                    <td> 
                        <?php
                            $form = $this->beginWidget('CActiveForm', array('id'=>'user-comment-form',
                                                                                'enableAjaxValidation'=>false,
                                                                                'enableClientValidation'=>true,
                                                                                'clientOptions'=>array(
                                                                                    'validateOnSubmit'=>true,
                                                                                ),
                                                                                'htmlOptions'=>array(
                                                                                    'enctype'=>'multipart/form-data',
                                                                                ),                                                                                                                                        
                                                                            )
                                                                        );
                        ?>
                        <table style="width:100%; vertical-align: top; display:none" id="showmessage">
                            <tr>
                                <td colspan="3">
                                    <textarea id="post_comment_area" name="post_comment_area" style="width:100%; height:250px; resize: none; font-size:14px; font-family: Arial,Helvetica,Tahoma,sans-serif;"></textarea>
                                </td>
                            </tr>
                            <tr style="display:none">
                                <td>
                                    <textarea id="comment" name="comment" style="width:600px; height:250px;"></textarea>
                                </td>
                            </tr>
                                                        
                            <tr>
                                <td align="right" width="21%" class="title_font_size">Tag : </td>
                                <td width="79%">
                                    <select class="populate select2-offscreen tag1" style="width:300px" id="Posts_category_tags" name="Posts[category_tags][]" multiple="" tabindex="-1">
                                        <?php $value = "aa"; $new_string = "'aa','vv'";
                                        /*$tmp_cat_tags_array = array();
                                        foreach($Tagcatmodel as $tag_cat){
                                             $tmp_cat_tags_array[] = trim($tag_cat->cat_tag);  
                                                }

                                     if(($TopicModel->id  > 0) && !empty($TopicModel->category_tags)){
                                      $test = explode(",",$TopicModel->category_tags);
                                      $temp_array = array();
                                        foreach($test as $acb => $value){
                                            $temp_array[] = $value; 
                                            */?>
                                     <option selected="" value="<?php echo $value;?>"><?php echo $value;?></option>
                                     <?php /*}}                    
                                                $uniq_array=array_unique($tmp_cat_tags_array);
                                        for($i=0;$i<count($uniq_array);$i++){
                                              if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>
                                              <option value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>
                                                                        <?php                           	
                                                $tagS_Array[]='"'.$uniq_array[$i].'"';
                                              } 
                                        }
                                        $new_string=implode(",",$tagS_Array);
                                     */?>
                                    </select>

                                    <script>  
                                      $("#Posts_category_tags").select2();
                                        var test = $('#Posts_category_tags');
                                        $(test).select2({
                                          tags:[<?php echo $new_string;?>],
                                          multiple: true,
                                          width: "300px",
                                      });
                                    </script>
                                        &nbsp;&nbsp;<a href="#signup" name="signup" rel="leanModal" id="go" class="categorytag">New Tag</a>
                                </td>
                                <td>
                                    <input value="Post" class="type" id="submit-post" style="float: right;" type="submit"/>
                                </td>
                            </tr>
                            
                        </table>
                        <?php $this->endWidget();?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">
    $(function() {

		$('#go').leanModal({ top : 200, closeButton: ".modal_close" });		

	});

	$(function() {

		$('#typego').leanModal({ top : 200, closeButton: ".modal_close" });		

	});
    
    /*$("#user-comment-form").submit(function(){
        var comment = $("#post_comment_area").val();
        comment = comment.linkify();
        $("#post_comment_area").val(comment);
        return true;
    });*/
    
    if(!String.linkify) {
    String.prototype.linkify = function() {

        // http://, https://, ftp://
        var urlPattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;

        // www. sans http:// or https://
        var pseudoUrlPattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

        // Email addresses
        var emailAddressPattern = /[\w.]+@[a-zA-Z_-]+?(?:\.[a-zA-Z]{2,6})+/gim;

        return this
            .replace(urlPattern, '<a href="$&">$&</a>')
            .replace(pseudoUrlPattern, '$1<a href="http://$2">$2</a>')
            .replace(emailAddressPattern, '<a href="mailto:$&">$&</a>');
    };
}

function categoryTag_add(){
      $('.error').hide();
	  $('.simple-sucess').hide();
      
        var tagname = $("input#tagname").val();
        var description=$("#description").val();
        var save_for_post=true;

        if (tagname=="") {
			alert("Please enter Tagname");
	        $("#tagname").focus();
	      return false;
	    }

		$.ajax ({
		       type: "POST",
		        url: '<?php echo Yii::app()->createUrl('general/category_description') ;?>',
		        data: "category_description="+description+"&tag_value="+tagname+"&save_for_post=true",
		        success: function(response){
                    if(response == "exist"){
                        alert("Tag Already Exist");
                        $( ".modal_close" ).click();
                    }else{
                        $( ".modal_close" ).click();
                            //$("#Posts_category_tags").html(response);
                    }
		       }
		    });	
	    return false;
}

function selectDescription(){
        return true;
        //tinyMCE.triggerSave();

    }
</script>

<div id="signup" style="display: none;">

    <form action="" id="registerSubmit" onsubmit="return categoryTag_add();">

    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0">

        <tr>

            <td class="tagtitle-new" align="left">Create New Tag<a class="modal_close" style="right: 3px;top: 3px;"></a></td>

        </tr>

        <tr>

            <td width="30%" style="padding:5px 12px;">

                <div class="create-new-tag-lable">Tag Name</div>

                <div class="create-new-tag-div" style="border: 1px solid #00A2E8">

                    <input id="tagname" class="input-class" name="tagname" type="text"/>

                </div>

                <div class="create-new-tag-lable">Tag Description</div>

                <div>

                    <textarea id="description" name="description" style="width:250px;height:50px" ></textarea>                        

                </div>

                <div style="padding:5px 0px;">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                            <td align="right" valign="top">&nbsp;</td>

                            <td width="63" align="right" valign="top">

                                <!--<a style="text-decoration: none;" href="/wedialog">

                                    <input class="Submit fl" type="button" value="Cancel" name="submit">

                                </a>                              

                                <img src="<?php //echo Yii::app()->createUrl('images/new-cancel-buttan.png');?>" width="63" height="19" />-->

                            </td>

                            <td width="10" align="right" valign="top">&nbsp;</td>

                            <td align="right" valign="top">

                                <input class="Submit fl" type="submit" value="Save" name="submit" onclick="selectDescription();"/>                                 

                                <!--<img src="<?php //echo Yii::app()->createUrl('images/new-save-buttan.png');?>" width="65" height="19" />-->

                            </td>

                        

                        </tr>

                    </table>

                </div>

            </td>

        </tr>

    </table>

	</form>

</div>