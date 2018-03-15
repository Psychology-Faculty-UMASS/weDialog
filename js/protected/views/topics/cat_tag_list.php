<tr>
    <td colspan="3">
        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="logo" style="width:20%"><a href="<?php echo Yii::app()->createUrl('/')?>"><img src="<?php echo Yii::app()->createUrl()?>/images/logo.png" width="179" height="52" /></a></td>
                <td class="page_title">Category Tags</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
	<td class="middle_column1">
    	<table class="content_box1 form_lable1" width="98%" border="1" cellpadding="0" cellspacing="0">
             <tr align="center" height="10" style=" background-color:#09C; color:#FFF;">
                 <td height="25">TagName</td>
                 <!-- <td>TagDescription</td> -->
                 <td>TagAuthor</td>
                 <td>CreatedDate</td>
            </tr>
            
            <?php 
            $tmp_cat_tags_array = array();
            
            foreach($tagmodel as $tag_cat){
              $ex_cat_tag=explode(",",$tag_cat->category_tags);
              
			    for($i=0;$i<count($ex_cat_tag);$i++){ 
			     if(!empty($ex_cat_tag[$i]) || $ex_cat_tag[$i] !=''){?>
			            
                    <tr align="center" height="25">
                         <td><?php echo $ex_cat_tag[$i]; ?></td>
                         <!-- <td>my tag description</td> -->
                         <td><?php echo $tag_cat->topics_username->username ?></td>
                         <td><?php 
                                $stringtime= strtotime($tag_cat->created_date);
                                echo date('d-m-Y',$stringtime);?>
                         </td>
                    </tr>
            <?php } }}
			?>
        </table>
       
    </td>
</tr>