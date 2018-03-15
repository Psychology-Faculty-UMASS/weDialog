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
</style>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />  
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo Yii::app()->request->baseUrl;?>/js//minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/css/select2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.min.js"></script>

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
      <div class="topics"> <div class="topic_head"><?php if($Tagtypemodel->id){?> Edit <?php }else{?> PROPOSE NEW <?php }?> Rule</div></div>
        <?php
            $selected_rules=array();
            foreach($Tagtype_selected_model as $Tagtype_selected_model_temp){
                $selected_rules[]=$Tagtype_selected_model_temp->id;
            }
            //$selected_rules = implode(',',$selected_rules);
            
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
                <td height="5" colspan="2" align="left"><img src="images/spacer.gif" width="1" height="1" /></td>
            </tr>
            <tr>
                <td align="right" width="21%">Rules tag :</td>
            <td width="79%">
            	<select class="populate select2-offscreen" style="width:300px;border-color: #125D90 !important;" id="type_tags" name="TypeTags[order][]" multiple="" tabindex="-1">
                <?php 
                    $tmp_tags_array = array();
                    foreach($Tagtypemodel as $tag){
                        $Selected   = '';
                        if(in_array($tag->id, $selected_rules)){
                            $Selected   = 'selected="selected"';
                        }
                        ?>
                         <option <?php echo $Selected;?> value="<?php echo $tag->id; ?>"><?php echo $tag->type_tag; ?></option>
                        <?php 
        			}
        		      ?>
                </select>
                <script> 
                    //http://runnable.com/UmuP-67-dQlIAAFU/events-in-select2-for-jquery
                    //$("#type_tags").select2();
                    $(function(){
                        var test1 = $('#type_tags');
                        $(test1).select2()
                            .on("change", function(e) {
                     
                            })
                        
                            .on("select2-selecting", function(e) {
                                SetTempID(e.val, 'sel');
                            
                            })
                            .on("removed", function(e) {
                                SetTempID(e.val, 'del');
                            })
                    });
                    function SetTempID(selid, option){
                        if(option == 'sel'){
                            var tempval = $('#temp_id').val();
                            var fillval;
                            if(tempval == ''){
                                fillval = selid; 
                            }
                            else{
                                fillval = tempval+','+selid;
                            }
                            $('#temp_id').val(fillval);
                        }
                        else if(option == 'del'){
                            var tempstr = '';
                            var tempval = String($('#temp_id').val()).split(',');
                            if(tempval.length > 0){
                                var r=0; 
                                for(var p=0; p<tempval.length; p++){
                                    if(tempval[p] != selid){
                                        if(r == 0){
                                            tempstr = tempval[p];            
                                        }
                                        else{
                                            tempstr = tempstr+','+tempval[p];
                                        }
                                        r++;   
                                    }
                                }    
                            }
                            $('#temp_id').val(tempstr)
                        }
                    }
                </script>            
            </td>
          </tr>
            <input type="hidden" id="temp_id" name="temp_id" value="<?php echo implode(',', $selected_rules)?>" />
         
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
</script>