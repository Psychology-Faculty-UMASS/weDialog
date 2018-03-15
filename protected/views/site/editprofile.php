<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
/*   tinymce.init({selector:'textarea',
        plugins: "autolink",
        paste_auto_cleanup_on_paste :true,
        forced_root_block : false,    
        menubar:false,
        statusbar: false,
        toolbar: false,
        content_css : "<?php echo Yii::app()->request->baseUrl;?>/css/mycontent.css" 
    }); */
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
<script>
function descriptorTag_add(){
       
    var descriptorname = $("input#descriptorname").val();
    //var description=$("#description").val();
    
    if (descriptorname=="") {
		alert("Please enter new tag Name");
        $("#descriptorname").focus();
      return false;
    }
    
	$.ajax ( {
	       type: "POST",
	        url: '<?php echo Yii::app()->createUrl('General/aiiadescriptor') ;?>',
	        data: "descriptorname="+descriptorname,
	        success: function(response){
                if(response == "exist"){
                    alert("Descriptor Already Exist");
                    $( ".modal_close" ).click();
                }else{
                   // alert(response);
                    $( ".modal_close" ).click();
                    
                    $("#Users_aiia_discriptor").html(response);
                }
	       }
	    });	
	   
    return false;
}
</script>                
<div class="main">
<?php /*?><div class="main_left" style="width: 140px;padding-left:0px">
    <?php
        $Src = Yii::app()->baseurl.'/'.Yii::app()->params['profile_img'].$UserEditModel->profile_image;
        
        if($UserEditModel->profile_image == ""){
            $Src = Yii::app()->baseUrl.'/images/img-1.png'; 
        }
        ?>
        <? if($UserEditModel->facebook_id != 0 &&  $UserEditModel->facebook_id!=""){
                if($UserEditModel->profile_image==""){
                     $Src= 'https://graph.facebook.com/'.$UserEditModel->facebook_id.'/picture?type=large' ;
                }
        }?>
        <? if($UserEditModel->twitter_id != 0 &&  $UserEditModel->twitter_id!=""){
                     $Src= Yii::app()->session['twitter_image'] ;
           
        }?>
         
        <img  src="<?php echo $Src;?>" width="140" height="130"/>
    
</div><?php */ ?>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/css/select2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>

<script type="text/javascript">
	$(function() {
		$('#go').leanModal({ top : 200, closeButton: ".modal_close" });		
	});
</script>


<div class="main_mid2">
  <div class="topics">
    <div class="topic_head">EDIT PROFILE</div>
  </div>
  
 <div class="login">
        <?php
            $form = $this->beginWidget('CActiveForm', array('id'=>'user-edit-form',
                    'enableAjaxValidation'=>false,
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                    'htmlOptions'=>array(
                        'enctype'=>'multipart/form-data',
                        'onsubmit'=>'return OnSubmitValidation()',                        
                    ),                                                                                                                                        
                )
            );
        ?>
        <table id="aboutme_form" border="0" cellpadding="4" cellspacing="0" width="100%">
          <tbody>
          <tr>
                <td align="right" valign="top" class="title_font_size">About me:</td>
                <td width="455px !important" height="100px !important">
                    <?php echo $form->textArea($UserEditModel,'user_description',array("class"=>"aboutme_box"));?>
                </td>
          </tr>
          <tr>
            <td align="right" width="30%" class="title_font_size">As an individual I am: </td>
            <td width="70%">
            <select class="populate select2-offscreen tag1" style="width:467px" id="Users_aiia_discriptor" name="Users[aiia_discriptor][]" multiple="" tabindex="-1">
			<?php 
                $tmp_Aiia_array = array();
                foreach($Aiia_model as $aii_descriptor){
                     $tmp_Aiia_array[$aii_descriptor->id] = trim($aii_descriptor->discriptor);  
    			}
                
             if(($UserEditModel->id  > 0) && !empty($UserEditModel->aiia_discriptor)){
              $test = explode(",",$UserEditModel->aiia_discriptor);
              $temp_array = array();
                foreach($test as $acb => $value){
                    $temp_array[] = $value; 
                    ?>
             <option selected="" value="<?php echo $value;?>"><?php echo $tmp_Aiia_array[$value];?></option>
    		 
             <?php }}                    
                
                
    			$uniq_array=array_unique($tmp_Aiia_array);
                foreach($uniq_array as $acb => $value){
                      if(!empty($acb)  && !in_array($acb,$temp_array)){ ?>
                      <option value="<?php echo $acb; ?>"><?php echo $value; ?></option>
						<?php                           	
                        $tagS_Array[]='"'.$value.'"';
                      } 
                }
                $new_string=implode(",",$tagS_Array);
             ?>
            </select>

            <script>  
              $("#Users_aiia_discriptor").select2();
                var test = $('#Users_aiia_discriptor');
                $(test).select2({
            	  tags:[<?php echo $new_string;?>],
                  multiple: true,
                  width: "300px",
              });
            </script>     
                    
            <a href="#signup" name="signup" rel="leanModal" id="go" class="categorytag">New Tag</a>
            </td>
          </tr>
          <tr>
            <td align="right" width="21%" class="title_font_size">Favorite Rules: </td>
            <td width="79%">
            <select class="populate select2-offscreen tag1" style="width:467px" id="Users_favorite_rule" name="Users[favorite_rule][]" multiple="" tabindex="-1">
			<?php 
                $tmp_Rules_array = array();
                foreach($TypeTags_model as $TypeTags_rule){
                     $tmp_Rules_array[$TypeTags_rule->id] = trim($TypeTags_rule->type_tag);  
    			}
                
             if(($UserEditModel->id  > 0) && !empty($UserEditModel->favorite_rule)){
              $test = explode(",",$UserEditModel->favorite_rule);
              $temp_array = array();
                foreach($test as $acb => $value){
                    $temp_array[] = $value; 
                    ?>
             <option selected="" value="<?php echo $value;?>"><?php echo $tmp_Rules_array[$value];?></option>
    		 
             <?php }}                    
                
                
    			$uniq_array=array_unique($tmp_Rules_array);
                foreach($uniq_array as $acb => $value){
                      if(!empty($acb)  && !in_array($acb,$temp_array)){ ?>
                      <option value="<?php echo $acb; ?>"><?php echo $value; ?></option>
						<?php                           	
                        $tagS_Array[]='"'.$value.'"';
                      } 
                }
                $new_string=implode(",",$tagS_Array);
             ?>
            </select>

            <script>  
              $("#Users_favorite_rule").select2();
                var test = $('#Users_favorite_rule');
                $(test).select2({
            	  tags:[<?php echo $new_string;?>],
                  multiple: true,
                  width: "300px",
              });
            </script>             
            </td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          <?php /* hide questions
          
        <?php
        foreach($groupcategories as $groupcategories){
        ?>
          <tr>
            <td align="right" width="21%" class="title_font_size"><?php echo $groupcategories->category;?>:</td>
            <td width="79%">
            
            <?php
                $cat_name=str_replace(" ","_",$groupcategories->category);//ex:Web Development out put Web_Development
            ?>
            <select class="populate select2-offscreen tag1" style="width:450px" id="Users_category_<?php echo $cat_name;?>" name="Users[category][<?php echo $groupcategories->category;?>][]" multiple="" tabindex="-1">
			<?php 
                $tmp_category_groups_array = array();
                foreach($CategoryGroups_model as $CategoryGroups){
                    if($CategoryGroups->category==$groupcategories->category){
                        $tmp_category_groups_array[$CategoryGroups->id] = trim($CategoryGroups->groups);
                    }  
    			}
                
             if(($UserEditModel->id  > 0) && !empty($UserEditModel->category_groups_id)){
              $test = explode(",",$UserEditModel->category_groups_id);
              $temp_array = array();
                foreach($test as $acb => $value){
                    if(in_array($value,array_keys($tmp_category_groups_array))){
                        $temp_array[] = $value; 
                    ?>
                        <option selected="" value="<?php echo $value;?>"><?php echo $tmp_category_groups_array[$value];?></option>
             <?php 
                    }
                  }
              }                    
                
                
    			$uniq_array=array_unique($tmp_category_groups_array);
                foreach($uniq_array as $acb => $value){
                      if(!empty($acb)  && !in_array($acb,$temp_array)){ ?>
                     <option value="<?php echo $acb; ?>"><?php echo $value; ?></option>
						<?php                           	
                        $tagS_Array[]='"'.$value.'"';
                      } 
                }
                $new_string=implode(",",$tagS_Array);
             ?>
            </select>

            <script>  
              $("#Users_category_<?php echo $cat_name;?>").select2();
                var test = $('#Users_category_<?php echo $cat_name;?>');
                $(test).select2({
            	  tags:[<?php echo $new_string;?>],
                  multiple: true,
                  width: "300px",
              });
            </script>
            
            <!--Start : for hide checkbox -->
            <?php
            if(($UserEditModel->id  > 0) && !empty($UserEditModel->category_groups_id_hide)){
                $checked="0";
              $test = explode(",",$UserEditModel->category_groups_id_hide);
              $temp_array = array();
                foreach($test as $acb => $value){
                    if(in_array($value,array_keys($tmp_category_groups_array))){
                        $checked="1";
                    }
                  }
              }
              if($checked){
              ?>
                <input type="checkbox" name="category_hide[<?php echo $groupcategories->category;?>]" style="width:20px!important;" checked="true"/>Hide              
              <?php  
              }else{
              ?>
                <input type="checkbox" name="category_hide[<?php echo $groupcategories->category;?>]" style="width:20px!important;"/>Hide
              <?php  
              }
              ?>          
            <!--End : for hide checkbox -->
            </td>
          </tr>
        <?php
        }
        ?>  
          
          
          
         end of hide questions */  ?>
          
          
          
         
          
          
          
          
          
          
          
          
          <tr>
            <td align="right" width="21%" class="title_font_size">Facebook:</td>
            <td width="79%">
                <?php echo $form->textField($UserEditModel,'facebook_link',array("class"=>"input_box"));?>
                <?php echo $form->error($UserEditModel,'facebook_link',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>
            <td align="right" width="21%" class="title_font_size">Twitter:</td>
            <td width="79%">
                <?php echo $form->textField($UserEditModel,'twitter_link',array("class"=>"input_box"));?>
                <?php echo $form->error($UserEditModel,'twitter_link',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>
            <td align="right" width="21%" class="title_font_size">Website:</td>
            <td width="79%">
                <?php echo $form->textField($UserEditModel,'website_link',array("class"=>"input_box"));?>
                <?php echo $form->error($UserEditModel,'website_link',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>
            <td align="right"><span class="star" class="title_font_size">*</span>Email:</td>
            <td>
                <?php echo $form->textField($UserEditModel,"email",array("class"=>"inputbox"));?>
                <?php echo $form->error($UserEditModel,'email',array("class"=>"uservalidate"));?>
            </td>
          </tr>
                            
         <!-- <tr>
            <td align="right" width="21%"><span class="star">*</span>User Name :</td>
            <td width="79%">
                <?php //echo $form->textField($UserEditModel,'username',array("class"=>"input_box","readonly"=>true));?>
                <?php //echo $form->error($UserEditModel,'username',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>
            <td align="right"><span class="star">*</span>Password :</td>
            <td>
                <?php //echo $form->textField($UserEditModel,'password',array("class"=>"input_box"));?>
                <?php //echo $form->error($UserEditModel,'password',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          <tr>-->
            <td align="right" class="title_font_size">Profile Image :</td>
            <td>
                <?php
                    $prifile_image = Yii::app()->baseUrl.'/images/img-1.png';
                    if(!empty($UserEditModel->profile_image)){ 
                        $prifile_image =  Yii::app()->baseUrl.'/'.Yii::app()->params['profile_img'].$UserEditModel->profile_image;   
                    }
                ?>                                
                <img  src="<?php echo $prifile_image;?>" width="100" height="100"/>

            </td>
          </tr>
          
          <tr>
            <td align="right" class="title_font_size"><span class="star">*</span>Profile Image :</td>
            <td>
                <?php echo $form->fileField($UserEditModel,'profile_image',array("class"=>"input_box"));?>
                <?php echo $form->error($UserEditModel,'profile_image',array("class"=>"uservalidate"));?>
            </td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>
                <input type="hidden" name="favorite_value" id="favorite_value" value=""/>
                <input type="hidden" name="aiia_discriptor_value" id="aiia_discriptor_value" value=""/>
                <input class="Submit" name="submit" value="Save" type="submit"/>
                <a href="<?php echo Yii::app()->createUrl('site/Viewpeople',array('people_id'=>$UserEditModel->id)) ?>" style="text-decoration: none;"><input class="Submit" name="submit" value="Cancel" type="button"/></a>
            </td>
          </tr>
         </tbody></table>
   <?php $this->endWidget(); ?>
 </div>
</div>
<div class="main_right">
</div>
</div>     



<!--Start : For new Tag popup  -->
<div id="signup" style="display: none;">
    <form action="" id="registerSubmit" onsubmit="return descriptorTag_add();">
    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0">
        <tr>
            <td class="tagtitle-new" align="left">As an individual I am:<a class="modal_close" style="right: 3px;top: 3px;"></a></td>
        </tr>
        <tr>
            <td width="30%" style="padding:5px 12px;">
                <div class="create-new-tag-lable">Create new tag:</div>
                <div class="create-new-tag-div" style="1px solid #00A2E8">
                    <input id="descriptorname" class="input-class" name="descriptorname" type="text"/>
                </div>
                <!--<div class="create-new-tag-lable">Tag Description</div>
                <div>
                    <textarea id="description" name="description" style="width:250px;height:50px" ></textarea>                        
                </div>-->
                <div style="padding:5px 0px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" valign="top">&nbsp;</td>
                            <td width="63" align="right" valign="top">
                            </td>
                            <td width="10" align="right" valign="top">&nbsp;</td>
                            <td align="right" valign="top">
                                <input class="Submit fl" type="submit" value="Save" name="submit"/>                                 
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
<!--End : For new Tag popup  -->
<script>
function OnSubmitValidation(){
    var fev_val = '';
    var new_tag = '';
    $("#s2id_Users_favorite_rule .select2-search-choice").each(function(){
        var test =  $(this).find('div').html();
        if(test!=''){
            if(fev_val == ''){  
                var test2 =  $('#Users_favorite_rule option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = test2;
            }else{
                var test2 =  $('#Users_favorite_rule option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = fev_val+','+test2;
            }
        }
    });
    $('#favorite_value').val(fev_val);
    
    
    $("#s2id_Users_aiia_discriptor .select2-search-choice").each(function(){
        var tag =  $(this).find('div').html();
        if(tag!=''){
            if(new_tag == ''){  
                var tag2 =  $('#Users_aiia_discriptor option').filter(function () { return $(this).html() == tag; }).val();              
                new_tag = tag2;
            }else{
                var tag2 =  $('#Users_aiia_discriptor option').filter(function () { return $(this).html() == tag; }).val();              
                new_tag = new_tag+','+tag2;
            }
        }
    });    
    $('#aiia_discriptor_value').val(new_tag);
   
    
    
    return true;
}
</script>