<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-ui.min.js"></script>
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

<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl?>/css/select2.css" />

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/select2.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.leanModal.min.js"></script>



<script type="text/javascript">

	$(function() {

		$('#go').leanModal({ top : 200, closeButton: ".modal_close" });		

	});

	$(function() {

		$('#typego').leanModal({ top : 200, closeButton: ".modal_close" });		

	});

        

	$(function() {

       $('#question_1').leanModal({ top : 200, closeButton: ".modal_close" });

       //$('#question_option').html($("#TopicQuestions_question1").val()); 

    }); 

     

	$(function() {

		$('#question_2').leanModal({ top : 200, closeButton: ".modal_close" });

        //$('#question_option').html($("#TopicQuestions_question2").val());

    }); 

    

	$(function() {

		$('#question_3').leanModal({ top : 200, closeButton: ".modal_close" });

        //$('#question_option').html($("#TopicQuestions_question3").val());

    }); 

    

    

</script>

<script type="text/javascript">

    function setquestion(question_number){

        $("#new_category_question_name").val(question_number);

        var temp=$("#TopicQuestions_question"+question_number).val();

        $("#question_option").html(temp);

    }

    
/*
function catdetailmore(tagvalue){

    

    var tag_value=tagvalue;

    

    $.ajax ( {

		       type: "POST",

		        url: '<?php //echo Yii::app()->createUrl('general/categorytagdetail') ;?>',

		        data: "tag_value="+tag_value,

		        success: function(response){

                        var cat_array= response.split("||");

                        

                       $("#tagvaluehtml").html(cat_array[0]);

                       $("#tagdescriptionhtml").html(cat_array[1]);

                       $("#datehtml").html(cat_array[2]);

                       $("#cat_username").html(cat_array[3]);

                      

                    

		       }

		    });	

        

        $("#toggle_column").show();

        $("#show_tbl_detail").hide();

        $("#toggle_typetag_column").hide();

        

    

}
*/


function alldivshow(){

    

        $("#toggle_column").hide();

        $("#toggle_typetag_column").hide();

        $("#show_tbl_detail").show();

        

    

}



function typedetailmore(tagvalue){

    

    var tag_value=tagvalue;

    

    $.ajax ( {

		       type: "POST",

		        url: '<?php echo Yii::app()->createUrl('general/typetagdetail') ;?>',

		        data: "tag_value="+tag_value,

		        success: function(response){

                        var type_array= response.split("||");

                        

                       $("#typetagvaluehtml").html(type_array[0]);

                       $("#typetagdescriptionhtml").html(type_array[1]);

                       $("#typedatehtml").html(type_array[2]);

                       $("#type_username").html(type_array[3]);

                      

                    

		       }

		    });	

        

        $("#toggle_column").hide();

        $("#show_tbl_detail").hide();

        $("#toggle_typetag_column").show();

        

    

}




/*
function categoryTag_add(){
      $('.error').hide();
	  $('.simple-sucess').hide();
      
        var tagname = $("input#tagname").val();
        var description=$("#description").val();
        var topic_title=$("#Topics_topic_title").val();
        var topic_discription1=$("#Topics_topic_description").val();

        if (tagname=="") {
			alert("Please enter Tagname");
	        $("#tagname").focus();
	      return false;
	    }

		$.ajax ({
		       type: "POST",
		        url: '<?php //echo Yii::app()->createUrl('general/category_description') ;?>',
		        data: "category_description="+description+"&tag_value="+tagname+"&topic_title="+topic_title+"&topic_discription1="+topic_discription1,
		        success: function(response){
                    if(response == "exist"){
                        alert("Tag Already Exist");
                        $( ".modal_close" ).click();
                    }else{
                        $( ".modal_close" ).click();
                            $("#Topics_category_tags").html(response);
                    }
		       }
		    });	
	    return false;
}
*/
$( document ).ready(function() {
    
    //Start :for hide new option link

    if($("#TopicQuestions_question1").val()=="0"){

        $("#question_1").hide();

    }

    if($("#TopicQuestions_question2").val()=="0"){

        $("#question_2").hide();

    }

    if($("#TopicQuestions_question3").val()=="0"){

        $("#question_3").hide();

    }

    

    $( "#TopicQuestions_question1" ).change(function() {

        $("#question_1").show();

        if($("#TopicQuestions_question1").val()=="0"){

            $("#question_1").hide();

        }

    });

    $( "#TopicQuestions_question2" ).change(function() {

        $("#question_2").show();

        if($("#TopicQuestions_question2").val()=="0"){

            $("#question_2").hide();

        }

    });

    $( "#TopicQuestions_question3" ).change(function() {

        $("#question_3").show();

        if($("#TopicQuestions_question3").val()=="0"){

            $("#question_3").hide();

        }

    });

    //End :for hide new option link



});

function selectcategroup(category,question_number){

    //$('#TopicQuestions_option'+question_number).val('');

	$.ajax ({

	       type: "POST",

	        url: '<?php echo Yii::app()->createUrl('general/selectcategorygroup') ;?>',

	        data: "category="+category+"&question_number="+question_number,

            async: false,

	        success: function(response){	           

	                $("#TopicQuestions_option"+question_number).select2('data', null);  

                    $("#TopicQuestions_option"+question_number).html(response);
	       }

	});    

}



function categoryGroup_add(){

      var question_number = $("#new_category_question_name").val(); 

      $('.error').hide();

	  $('.simple-sucess').hide();

        var categoryname = $("#TopicQuestions_question"+question_number).val();

        

        if(categoryname == '0'){

            alert('Please select question');

            return false;

        }

        var groupname = $("input#groupname").val();

        if (groupname=="") {

			alert("Please enter Group name");

	        $("#groupname").focus();

	      return false;

	    }

        

		$.ajax ( {

		       type: "POST",

		        url: '<?php echo Yii::app()->createUrl('general/categorygroupcreate') ;?>',

		        data: "groupname="+groupname+"&categoryname="+categoryname+"&question_number="+question_number,

		        success: function(response){

                    if(response == "exist"){

                        alert("Group Already Exist");

                        $( ".modal_close" ).click();

                    }else{

                        $( ".modal_close" ).click();

                            //$("#TopicQuestions_option"+question_number).html(response);

                            $("#TopicQuestions_option"+question_number).append(response)

                    }

		       }

		    });	

	    return false;    

}






/*
function typeTag_add(){

      //CKEDITOR.instances.Topics_topic_description.updateElement(),

	  $('.error').hide();

	  $('.simple-sucess').hide();

	  

      var typetagname = $("input#typetagname").val();

      var typedescription=$("#typedescription").val();

      var topic_title=$("#Topics_topic_title").val();

      var topic_discription1=$("#Topics_topic_description").val();

        

		if (typetagname=="") {

			alert("Please enter Tagname");

	        $("#typetagname").focus();

	      return false;

	    }

		$.ajax ( {

		       type: "POST",

		        url: '<?php //echo Yii::app()->createUrl('general/type_description') ;?>',

		        //data: "type_description="+typedescription+"&tag_value="+typetagname,

                data: "type_description="+typedescription+"&tag_value="+typetagname+"&topic_title="+topic_title+"&topic_discription1="+topic_discription1,

                

		        success: function(response){

		        	 if(response == "exist"){

	                        alert("Tag Already Exist");

	                        $( ".modal_close" ).click();

	                    }else{

	                       // alert(response);

	                        $( ".modal_close" ).click();

	                        

	                        $("#Topics_type_tags").html(response);

                    }

               }

		    });	

		   

	  

	    return false;

}
*/






function getTags(value1,event){



	var keyCode = ('which' in event) ? event.which : event.keyCode;

	if(keyCode==13){

		

		var category_description=prompt("Tag Does not Exist..Do you want to add this New Tag ?\n\n\n Enter the Description ");

		if (category_description!=null)

		  {

			$.ajax ( {

		        type: "POST",

		        url: '<?php echo Yii::app()->createUrl('general/category_description') ;?>',

		        data: "category_description="+category_description+"&tag_value="+value1,

		        

		        success: function(response){

		            //alert(response);

		        	var span = "<span id=span_"+response+" style='margin-left:10px;'><input type='hidden' name='alltags[]' value= '"+response+"' ><img src='<?php echo Yii::app()->createUrl()?>/images/delete-new-icon.png' width='15' height='15' style='cursor:pointer;' id=del_"+response+" onclick='RemoveSpan(this.id)' />"+response+"</span>";

		        	$("#cattaglist").append(span);

		        	$("#catetagsautocomplete").html("");

		        	$("#tags").val("");

		        	$("#tags").focus();

		       }

		    });	

		  }

		

	}else{

		$.ajax ( {

	        type: "POST",

	        url: '<?php echo Yii::app()->createUrl('general/catetag') ;?>',

	        data: "category_tags="+value1,

	        success: function(response){

	            //alert(response);

	            $("#catetagsautocomplete").html(response);

	       }

	    });	

	}

		

}

function cat_tag(tag_id){

	var span = "<span id=span_"+tag_id+" style='margin-left:10px;'><input type='hidden' name='alltags[]' value= '"+tag_id+"' ><img src='<?php echo Yii::app()->createUrl()?>/images/delete-new-icon.png' width='15' height='15' style='cursor:pointer;' id=del_"+tag_id+" onclick='RemoveSpan(this.id)' />"+tag_id+"</span>";

	$("#cattaglist").append(span);

	$("#catetagsautocomplete").html("");

	$("#tags").val("");

	$("#tags").focus();

	//alert(tag_id);return false;

}



function RemoveSpan(del_id){

	var tmp_span = del_id.split('_');

	$("#span_"+tmp_span[1]).remove();

}



//===================================START:TYPE TAGS================================================//

function gettypeTags(value1,event){



	var keyCode = ('which' in event) ? event.which : event.keyCode;

	if(keyCode==13){

		

		var type_description=prompt("Tag Does not Exist..Do you want to add this New Tag ?\n\n\n Enter the Description ");

		if (type_description!=null)

		  {

			$.ajax ( {

		        type: "POST",

		        url: '<?php echo Yii::app()->createUrl('general/type_description') ;?>',

		        data: "type_description="+type_description+"&tag_value="+value1,

		        

		        success: function(response){

		            //alert(response);

		        	var span = "<span id=span_"+response+" style='margin-left:10px;'><input type='hidden' name='alltypetags[]' value= '"+response+"' ><img src='<?php echo Yii::app()->createUrl()?>/images/delete-new-icon.png' width='15' height='15' style='cursor:pointer;' id=del_"+response+" onclick='RemoveTypeSpan(this.id)' />"+response+"</span>";

		        	$("#typetaglist").append(span);

		        	$("#typetagsautocomplete").html("");

		        	$("#typetags").val("");

		        	$("#typetags").focus();

		       }

		    });	

		  }

		

	}else{

		$.ajax ( {

	        type: "POST",

	        url: '<?php echo Yii::app()->createUrl('general/typetag') ;?>',

	        data: "type_tags="+value1,

	        success: function(response){

	            //alert(response);

	            $("#typetagsautocomplete").html(response);

	       }

	    });	

	} 

		

}

function type_tag(tag_id){

	var span = "<span id=spantype_"+tag_id+" style='margin-left:10px;padding:0;position:absolute;right:24px;bottom:-12px;list-style:none;'><input type='hidden' name='alltypetags[]' value= '"+tag_id+"' ><img src='<?php echo Yii::app()->createUrl()?>/images/delete-new-icon.png' width='15' height='15' style='cursor:pointer;' id=del_"+tag_id+" onclick='RemoveTypeSpan(this.id)' />"+tag_id+"</span>";

	$("#typetaglist").append(span);

	$("#typetagsautocomplete").html("");

	$("#typetags").val("");

	$("#typetags").focus();

	//alert(tag_id);return false;

}



function RemoveTypeSpan(del_id){

	var tmp_span = del_id.split('_');

	$("#spantype_"+tmp_span[1]).remove();

}



//===================================END:TYPE TAGS================================================//



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

    opacity: 0.1!important;    

    display: none;

}

#lean_overlay1 {

    position: fixed;

    z-index:100;

    top: 0px;

    left: 0px;

    height:100%;

    width:100%;

    background: #000;

    opacity: 0.1!important;    

    display: none;

}


.fontweight{

    font-weight: lighter;

    vertical-align: top;

}

</style>





<div class="main">

    <div class="main_mid3" style="margin-top:10px;">

      <div class="topics"> <div class="topic_head"><?php echo $DialogModel->isNewRecord ? 'Create New Dialog' : 'Update Dialog';?></div></div>

        <?php

            $form = $this->beginWidget('CActiveForm', array(

            		'id'=>'dialog-form',

                    //'action'=>Yii::app()->createUrl('site/Createnewtopic'),

            		'enableAjaxValidation'=>false,

            	    'enableClientValidation'=>true,

            	    'clientOptions'=>array(

            			'validateOnSubmit'=>true,

                    ),

                    'htmlOptions'=>array(

                        'onsubmit'=>'return checkvalidation();',

                    ),

            	)

            );

        ?>      

        <table border="0" cellpadding="4" cellspacing="0" width="100%" id="show_tbl_detail" class="topic_detail">

          <tbody>

        <tr>

            <td align="right" width="21%" class="title_font_size">*Dialog Title  :</td>

            <td width="79%">

                <?php

                    if(Yii::app()->session['dialog_title']){

                        $value=Yii::app()->session['dialog_title'];

                    }

                    echo $form->textField($DialogModel,'dialog_title',array("class"=>"tag1","value"=>$value,"maxlength"=>"124"));

                ?>

                <?php echo $form->error($DialogModel,'dialog_title',array("class"=>"uservalidate"));?>

            </td>

          </tr>

         <tr>

            <td align="right" width="21%" class="title_font_size"></td>

            <td width="10%">

                <?php

                    if(Yii::app()->session['dialog_hide']){

                        $value=Yii::app()->session['dialog_hide'];

                    }

                    echo $form->checkBox($DialogModel,'hide',array("style"=>"width:3%; margin-right:0px;","value"=>$value));

                ?>
                <label for="Dialogs_hide" style="cursor:pointer">Hide in dialog list</label>
                <?php echo $form->error($DialogModel,'hide');?>

            </td>

          </tr>

          <tr>

            <td align="right" valign="top" class="title_font_size">Dialog Description :</td>

            <td>

            <?php

                if(Yii::app()->session['dialog_description1']){

                    

                    $value_description = Yii::app()->session['dialog_description1'];

                    echo $value_description;

                }

            ?>

            <?php echo $form->textArea($DialogModel,'dialog_description',array("value"=>$value_description, "style"=>"width:99%; height:65px"));?>

            <?php echo $form->error($DialogModel,'dialog_description',array("class"=>"uservalidate"));?>

            <input type="hidden" name="new_category_question_name" id="new_category_question_name" value=""/>

            </td>

          </tr>



           <tr>

            <td align="right" width="21%" class="title_font_size">Question1 : </td>

            <td width="79%">

            <select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_question1" name="TopicQuestions[question1]" tabindex="-1" onchange="javascript:selectcategroup(this.value,'1');">

			<?php 

                $categorygroupmodel_array = array();

                foreach($categorygroupmodel as $categorygroup){

                     $categorygroupmodel_array[] = trim($categorygroup->category);  

    			}

            ?>

                <option value="0">Select Question 1</option>            

            <?php    

    			$uniq_array=array_unique($categorygroupmodel_array);

                for($i=0;$i<count($uniq_array);$i++){

                      if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>

                      <option <?php if(isset($TopicQuestionModel) && count($TopicQuestionModel) > 0 && $TopicQuestionModel->question1 == $uniq_array[$i]){?> selected="" <?php }?> value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>

						<?php                           	

                        $tagS_Array[]='"'.$uniq_array[$i].'"';

                      } 

                }

                $new_string=implode(",",$tagS_Array);

             ?>

            </select>
            &nbsp;&nbsp;<a href="#newquestionform" name="newquestion" rel="leanModal" id="new_question_but" class="categorytag" onclick="setquestion('1')" style="display: inline;">New Question</a>
            <br />

            <span id="TopicQuestions_question1_err" style="color: red;display: none;">Please select Topic Question 1</span>

            <script>  

              $("#TopicQuestions_question1").select2();

                var test = $('#TopicQuestions_question1');

                $(test).select2({

            	  tags:[<?php echo $new_string;?>],

                  multiple: false,

                  width: "300px",

              });

            </script>             

            </td>

          </tr>
        
      
        <tr>
        	<td align="right" width="21%" class="title_font_size">Option : </td>
        	<td width="79%">
        	<select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_option1" name="TopicQuestions[option1][]" multiple="" tabindex="-1">
            <?php 
        		$tmp_group_array = array();
                $selected_question1="";
                if($TopicQuestionModel->question1!=""){
                    $selected_question1=$TopicQuestionModel->question1;
                }
        		foreach($catgroupmodel as $catgroup){
  		            if($selected_question1==$catgroup->category){
  		                 $tmp_group_array[] = trim($catgroup->groups);
  		            }
        		}
        		
        	 if(($TopicQuestionModel->id  > 0) && $TopicQuestionModel->question1!=''){
        	  $test = explode(",",$TopicQuestionModel->option1);
        	  $temp_array = array();
        		foreach($test as $acb => $value){
        			$temp_array[] = $value; 
        			?>
        	 <option selected="" value="<?php echo $value;?>"><?php echo $value;?></option>
        	 <?php }}                    
        		$uniq_array=array_unique($tmp_group_array);
        		for($i=0;$i<count($uniq_array);$i++){
        			  if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>
        			  <option value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>
        				<?php                           	
        				$tagS_Array[]='"'.$uniq_array[$i].'"';
        			  } 
        		}
        		$new_string=implode(",",$tagS_Array);
        	 ?>
        	</select>
        	
            <script>  
        	  $("#TopicQuestions_option1").select2();
        		var test = $('#TopicQuestions_option1');
        		$(test).select2({
        		  tags:[<?php echo $new_string;?>],
        		  multiple: true,
        		  width: "300px",
        	  });
        	</script>
        		&nbsp;&nbsp;<a href="#newgroup1" name="newgroup1"  rel="leanModal" id="question_1" class="categorytag" onclick="setquestion('1')">New Option</a>
                <br />
                <span id="TopicQuestions_option1_err" style="color: red;display: none;">Please select Topic Question's option 1</span>
        	</td>
          </tr>
          
      
          <?php /*
           <tr>

            <td align="right" width="21%" class="title_font_size">Question2 : </td>

            <td width="79%">

            <select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_question2" name="TopicQuestions[question2]" tabindex="-1" onchange="selectcategroup(this.value,'2');">

			<?php 

                $categorygroupmodel_array = array();

                foreach($categorygroupmodel as $categorygroup){

                     $categorygroupmodel_array[] = trim($categorygroup->category);  

    			}

                ?>

                <option value="0">Select Question 2</option>

                <?php

    			$uniq_array=array_unique($categorygroupmodel_array);

                for($i=0;$i<count($uniq_array);$i++){

                      if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>

                      <option <?php if(isset($TopicQuestionModel) && count($TopicQuestionModel) > 0 && $TopicQuestionModel->question2 == $uniq_array[$i]){?> selected="" <?php }?> value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>

						<?php                           	

                        $tagS_Array[]='"'.$uniq_array[$i].'"';

                      } 

                }

                $new_string=implode(",",$tagS_Array);

             ?>

            </select>

            <br />

             <span id="TopicQuestions_question2_err" style="color: red;display: none;">Please select Topic Question 2</span>

            <script>  

              $("#TopicQuestions_question2").select2();

                var test = $('#TopicQuestions_question2');

                $(test).select2({

                    tags:[<?php echo $new_string;?>],

                    multiple: false,

                    width: "300px",

                });

            </script>             

            </td>

          </tr>
        
       
        <tr>
        	<td align="right" width="21%" class="title_font_size">Option : </td>
        	<td width="79%">
        	<select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_option2" name="TopicQuestions[option2][]" multiple="" tabindex="-1">
            <?php 
        		$tmp_group_array = array();
                $selected_question2="";
                if($TopicQuestionModel->question2!=""){
                    $selected_question2=$TopicQuestionModel->question2;
                }
        		foreach($catgroupmodel as $catgroup){
  		            if($selected_question2==$catgroup->category){
  		                 $tmp_group_array[] = trim($catgroup->groups);
  		            }
        		}
        		
        	 if(($TopicQuestionModel->id  > 0) && $TopicQuestionModel->question2!=''){
        	  $test = explode(",",$TopicQuestionModel->option2);
        	  $temp_array = array();
        		foreach($test as $acb => $value){
        			$temp_array[] = $value; 
        			?>
        	 <option selected="" value="<?php echo $value;?>"><?php echo $value;?></option>
        	 <?php }}                    
        		$uniq_array=array_unique($tmp_group_array);
        		for($i=0;$i<count($uniq_array);$i++){
        			  if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>
        			  <option value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>
        				<?php                           	
        				$tagS_Array[]='"'.$uniq_array[$i].'"';
        			  } 
        		}
        		$new_string=implode(",",$tagS_Array);
        	 ?>
        	</select>
        	<script>  
        	  $("#TopicQuestions_option2").select2();
        		var test = $('#TopicQuestions_option2');
        		$(test).select2({
        		  tags:[<?php echo $new_string;?>],
        		  multiple: true,
        		  width: "300px",
        	  });
        	</script>
        		&nbsp;&nbsp;<a href="#newgroup1" name="newgroup1"  rel="leanModal" id="question_2" class="categorytag" onclick="setquestion('2')">New Option</a>
                <br />
                <span id="TopicQuestions_option2_err" style="color: red;display: none;">Please select Topic Question's option 2</span>
        	</td>
          </tr>
          
     
           <tr>

            <td align="right" width="21%" class="title_font_size">Question3 : </td>

            <td width="79%">

            <select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_question3" name="TopicQuestions[question3]" tabindex="-1" onchange="selectcategroup(this.value,'3');">

			<?php 

                $categorygroupmodel_array = array();

                foreach($categorygroupmodel as $categorygroup){

                     $categorygroupmodel_array[] = trim($categorygroup->category);  

    			}

                ?>

                    <option value="0">Select Question 3</option>            

                <?php    

    			$uniq_array=array_unique($categorygroupmodel_array);

                for($i=0;$i<count($uniq_array);$i++){

                      if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>

                      <option <?php if(isset($TopicQuestionModel) && count($TopicQuestionModel) > 0 && $TopicQuestionModel->question3 == $uniq_array[$i]){?> selected="" <?php }?> value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>

						<?php                           	

                        $tagS_Array[]='"'.$uniq_array[$i].'"';

                      } 

                }

                $new_string=implode(",",$tagS_Array);

             ?>

            </select>

            <br />

             <span id="TopicQuestions_question3_err" style="color: red;display: none;">Please select Topic Question 3</span>

            <script>  

              $("#TopicQuestions_question3").select2();

                var test = $('#TopicQuestions_question3');

                $(test).select2({

            	  tags:[<?php echo $new_string;?>],

                  multiple: false,

                  width: "300px",

              });

            </script>             

            </td>

          </tr>

          
         
        <tr>
        	<td align="right" width="21%" class="title_font_size">Option : </td>
        	<td width="79%">
        	<select class="populate select2-offscreen tag1" style="width:300px" id="TopicQuestions_option3" name="TopicQuestions[option3][]" multiple="" tabindex="-1">
            <?php 
        		$tmp_group_array = array();
                $selected_question3="";
                if($TopicQuestionModel->question3!=""){
                    $selected_question3=$TopicQuestionModel->question3;
                }
        		foreach($catgroupmodel as $catgroup){
  		            if($selected_question3==$catgroup->category){
  		                 $tmp_group_array[] = trim($catgroup->groups);
  		            }
        		}
        		
        	 if(($TopicQuestionModel->id  > 0) && $TopicQuestionModel->question3!=''){
        	  $test = explode(",",$TopicQuestionModel->option3);
        	  $temp_array = array();
        		foreach($test as $acb => $value){
        			$temp_array[] = $value; 
        			?>
        	 <option selected="" value="<?php echo $value;?>"><?php echo $value;?></option>
        	 <?php }}                    
        		$uniq_array=array_unique($tmp_group_array);
        		for($i=0;$i<count($uniq_array);$i++){
        			  if(!empty($uniq_array[$i])  && !in_array($uniq_array[$i],$temp_array)){ ?>
        			  <option value="<?php echo $uniq_array[$i]; ?>"><?php echo $uniq_array[$i]; ?></option>
        				<?php                           	
        				$tagS_Array[]='"'.$uniq_array[$i].'"';
        			  } 
        		}
        		$new_string=implode(",",$tagS_Array);
        	 ?>
        	</select>
        	<script>  
        	  $("#TopicQuestions_option3").select2();
        		var test = $('#TopicQuestions_option3');
        		$(test).select2({
        		  tags:[<?php echo $new_string;?>],
        		  multiple: true,
        		  width: "300px",
        	  });
        	</script>
        		&nbsp;&nbsp;<a href="#newgroup1" name="newgroup1"  rel="leanModal" id="question_3" class="categorytag" onclick="setquestion('3')">New Option</a>
                <br />
                <span id="TopicQuestions_option3_err" style="color: red;display: none;">Please select Topic Question's option 3</span>
        	</td>
          </tr>
          */ ?>

          <tr>

            <td height="5" colspan="2" align="left"><img src="images/spacer.gif" width="1" height="1" /></td>

            </tr>


            <tr>

                <td></td>

                <td>

                    <input type="hidden" value="" id="QuestionOption1_value" name="QuestionOption1_value" />

                    <input type="hidden" value="" id="QuestionOption2_value" name="QuestionOption2_value" />

                    <input type="hidden" value="" id="QuestionOption3_value" name="QuestionOption3_value" />

                    <input class="Submit fl" name="submit" value="SAVE" type="submit"/>

                    <a href="<?php echo Yii::app()->createUrl('');?>" style="text-decoration: none;"><input class="Submit fl" name="submit" value="Cancel" type="button"/></a>

                </td>

            </tr>

         

          </tbody></table>

         <?php $this->endWidget(); ?>

         

         

        <!-- =======================START:FOR CATEGORY TAG DETAIL===========================================// -->

                   <table class="content_box form_lable" style="width:99%; display: none;" id="toggle_column" >

                        <tr>

                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; " id="tagvaluehtml">&nbsp;

                            </td>

                        </tr>

                        <tr>

                        	<td class="fontweight" id="tagdescriptionhtml">&nbsp;

                        	</td>

                        </tr>

                        <tr>

                            <td>&nbsp;</td>

                        </tr>

                        <tr>

                            <td style="vertical-align: top; ">CreatedBy/Date</td>

                        </tr>

                        <tr>

                        	<td class="fontweight">

                                <table>

                                    <tr>

                                        <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="cat_username">

                                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$tagdetailmodel->categoryTags_username->id))?>"> </a>        

                                        </td>

                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="datehtml">&nbsp;

                                          

                                        </td>

                                    </tr>

                                </table>

                        	</td>

                        </tr>

                        <tr>

                        	<td height="5"></td>

                        </tr>

                        

                    </table>

          

         

    <!-- =======================END:FOR CATEGORY TAG DETAIL===========================================// -->     

    <!-- =======================START:FOR TYPE TAG DETAIL===========================================// -->

                  <table class="content_box form_lable" style="width:99%; vertical-align: top;display: none;" id="toggle_typetag_column">

                        <tr>

                        	<td height="30" style="vertical-align: top; font: bolder !important;font-size: large; " id="typetagvaluehtml">&nbsp;

                            </td>

                        </tr>    

                        

                        <tr>

                        	<td class="fontweight" id="typetagdescriptionhtml">&nbsp;

                        	</td>

                        </tr>

                        <tr>

                            <td>&nbsp;</td>

                        </tr>

                        <tr>

                            <td style="vertical-align: top; ">CreatedBy/Date</td>

                        </tr>

                        <tr>

                        	<td class="fontweight">

                                <table>

                                    <tr>

                                        <td style="color:blue !important;font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="type_username">

                                            <a  style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('site/DisplayPeople',array('people_id'=>$typetagdetailmodel->typeTags_username->id))?>"> </a>        

                                        </td>

                                        <td style="font-weight: lighter;font-size: 12px;font-family: Verdana,Geneva,sans-serif;" id="typedatehtml">&nbsp;

                                        </td>

                                    </tr>

                                </table>

                        	</td>

                        </tr>

                        <tr>

                        	<td height="5"></td>

                        </tr>

                        

                    </table>

         

    <!-- =======================END:FOR TYPE TAG DETAIL===========================================// -->

         

         

         <div class="footer_manage" style="background-color:#E2F5FA;"></div> 

         

    </div>

    <!--
    <div class="main_right">
        <?php //$this->renderpartial('/topics/_topic_form_left_panel',$this->data);?>
    </div>
    -->

</div>

  

  



<tr>

	

    <td class="middle_column" style="width: 75%;" >

    

    </td>

    

    <td class="right_column" style="width: 25%;padding-top: 5px;">



          

    </td>                       

        

        

</tr>



<div id="signup" style="display: none;">

    <form action="" id="registerSubmit" onsubmit="return categoryTag_add();">

    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0">

        <tr>

            <td class="tagtitle-new" align="left">Create Category Tag<a class="modal_close" style="right: 3px;top: 3px;"></a></td>

        </tr>

        <tr>

            <td width="30%" style="padding:5px 12px;">

                <div class="create-new-tag-lable">Tag Name</div>

                <div class="create-new-tag-div" style="border:1px solid #00A2E8">

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





<div id="newgroup1" style="display: none;background-color: #fff;">

    <form action="" id="registerSubmit" onsubmit="return categoryGroup_add();">

    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0" style="width: 250px;">

        <tr>

            <td class="tagtitle-new" align="left" style="cursor: pointer;">ADD NEW OPTION - <span id="question_option"></span><a class="modal_close" style="right: 3px;top: 3px;"></a></td>

        </tr>

        <tr>

            <td width="30%" style="padding:5px 12px;">

                <div class="create-new-tag-lable" style="color: #666;">New option name</div>

                <div class="create-new-tag-div" style="border:1px solid #00A2E8">

                    <input id="groupname" class="input-class" name="groupname" type="text" value="" style="color: #666;"/>

                </div>

                <div style="padding:5px 0px;">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                            <td align="right" valign="top">&nbsp;</td>

                            <td width="63" align="right" valign="top">

                            </td>

                            <td width="10" align="right" valign="top">&nbsp;</td>

                            <td align="right" valign="top">

                                <input class="Submit fl" type="submit" value="Save" name="submit"/>                                 

                            </td>

                        

                        </tr>

                    </table>

                </div>

            </td>

        </tr>

    </table>

	</form>

</div>

<!-- START:: New Question Form -->
<div id="lean_overlay1"></div>
<div id="newquestionform" style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 670.5px; margin-left: -125px; top: 188px; background-color: rgb(255, 255, 255);">

    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0" style="width: 250px;">

        <tr>

            <td class="tagtitle-new" align="left" style="cursor: pointer;">ADD NEW QUESTION <a class="modal_close" id="newquestion_modal_close" style="right: 3px;top: 3px;"></a></td>

        </tr>

        <tr>

            <td width="30%" style="padding:5px 12px;">

                <div class="create-new-tag-lable" style="color: #666;">New question name</div>

                <div class="create-new-tag-div" style="border: 1px solid #00A2E8">

                    <input id="newquestion_name" class="input-class" name="newquestion_name" type="text" value="" style="color: #666;"/>

                </div>

                <div style="padding:5px 0px;">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                            <td align="right" valign="top">&nbsp;</td>

                            <td width="63" align="right" valign="top">

                            </td>

                            <td width="10" align="right" valign="top">&nbsp;</td>

                            <td align="right" valign="top">

                                <input class="Submit fl" type="button" value="Save" id="save_new_question_form_button"/>                                 

                            </td>

                        

                        </tr>

                    </table>

                </div>

            </td>

        </tr>

    </table>

</div>
<!-- END:: New Question Form -->

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

<div id="typesignup" style="display: none;">

            

    <form action="" id="registerSubmit" onsubmit="return typeTag_add();">

    <table class="topic_detail" width="100%" border="0" class="tag" cellpadding="0" cellspacing="0" >

        <tr>

            <td class="tagtitle-new" align="left">Create Rules Tag<a class="modal_close" style="right: 3px;top: 3px;"></a></td>

        </tr>

        <tr>

            <td width="30%" style="padding:5px 12px;">

                <div class="create-new-tag-lable">Tag Name</div>

                <div class="create-new-tag-div" style="border:1px solid #00A2E8">

				    <input id="typetagname" class="input-class" name="typetagname" type="text" />

                </div>

                <div class="create-new-tag-lable">Tag Description</div>

                <div>

				    <textarea id="typedescription" name="typedescription" type="text" style="width:250px;height:50px" ></textarea>

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



<script>

function checkvalidation(){
    error=0;
/*
    //Start : for Question validation //

    $("#TopicQuestions_question1_err").hide();

    $("#TopicQuestions_question2_err").hide();

    $("#TopicQuestions_question3_err").hide();

    

    if($("#TopicQuestions_question1").val()=="0"){

        error=1;

        $("#TopicQuestions_question1_err").show();

    }

    if($("#TopicQuestions_question2").val()=="0"){

        error=1;

        $("#TopicQuestions_question2_err").show();

    }

    if($("#TopicQuestions_question3").val()=="0"){

        error=1;

        $("#TopicQuestions_question3_err").show();

    }

    //End : for Question validation //

*/    

    //Start : for OPtion validation //
    $("#TopicQuestions_option1_err").hide();
    //$("#TopicQuestions_option2_err").hide();
    //$("#TopicQuestions_option3_err").hide();

    if($("#TopicQuestions_question1").val()!="0"){
        if($("#TopicQuestions_option1").val()==null){
            error=1;
            $("#TopicQuestions_option1_err").show();
        }    
    }    
    
    /*if($("#TopicQuestions_question2").val()!="0"){
        if($("#TopicQuestions_option2").val()==null){
            error=1;
            $("#TopicQuestions_option2_err").show();
        }
    }
    
    if($("#TopicQuestions_question3").val()!="0"){
        if($("#TopicQuestions_option3").val()==null){
            error=1;
            $("#TopicQuestions_option3_err").show();
        }
    }*/
    //End : for OPtion validation //

    if(error){
        return false;   
    }
    
//TO Set select2 in selected order //
    var fev_val = '';
    var new_tag = '';
    $("#s2id_TopicQuestions_option1 .select2-search-choice").each(function(){
        var test =  $(this).find('div').html();
        if(test!=''){
            if(fev_val == ''){  
                var test2 =  $('#TopicQuestions_option1 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = test2;
            }else{
                var test2 =  $('#TopicQuestions_option1 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = fev_val+','+test2;
            }
        }
    });
    $('#QuestionOption1_value').val(fev_val);
    /*var fev_val = '';
    var new_tag = '';
    $("#s2id_TopicQuestions_option2 .select2-search-choice").each(function(){
        var test =  $(this).find('div').html();
        if(test!=''){
            if(fev_val == ''){  
                var test2 =  $('#TopicQuestions_option2 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = test2;
            }else{
                var test2 =  $('#TopicQuestions_option2 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = fev_val+','+test2;
            }
        }
    });
    $('#QuestionOption2_value').val(fev_val);
    var fev_val = '';
    var new_tag = '';
    $("#s2id_TopicQuestions_option3 .select2-search-choice").each(function(){
        var test =  $(this).find('div').html();
        if(test!=''){
            if(fev_val == ''){  
                var test2 =  $('#TopicQuestions_option3 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = test2;
            }else{
                var test2 =  $('#TopicQuestions_option3 option').filter(function () { return $(this).html() == test; }).val();              
                fev_val = fev_val+','+test2;
            }
        }
    });
    $('#QuestionOption3_value').val(fev_val);*/
//TO Set select2 in selected order //    
    return true;
}

$(function() {
    $( "#newgroup1" ).draggable();
});

$("#new_question_but").click(function(){
    $("#newquestionform").css("display","block");
    $("#lean_overlay1").css("opacity", "0.5");
    $("#lean_overlay1").css("display", "block");
    return false;
});

$("#newquestion_modal_close").click(function(){
    $("#newquestion_name").val("");
    $("#newquestionform").css("display","none");
    $("#lean_overlay1").css("display", "none");
    return false;
});

$("#save_new_question_form_button").click(function(){
    var newQuestionName = $("#newquestion_name").val();
    $("#newquestion_name").val("");
    $("#newquestionform").css("display","none");
    $("#lean_overlay1").css("display", "none");
    $("#lean_overlay1").css("opacity", "0.5");
    var questionExists = false;
    $("#TopicQuestions_question1 option").each(function(){
        if($(this).html()==newQuestionName) {
            questionExists = true;
        }
    });
    if(!questionExists) {
        $("#TopicQuestions_question1").append('<option value="'+newQuestionName+'">'+newQuestionName+'</option>');
        $("#TopicQuestions_question2").append('<option value="'+newQuestionName+'">'+newQuestionName+'</option>');
        $("#TopicQuestions_question3").append('<option value="'+newQuestionName+'">'+newQuestionName+'</option>');
    }
    else {
        alert("Question already exists");
    }
});

</script>