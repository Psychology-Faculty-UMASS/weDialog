<div class="category">
    <div class="category_head">category</div>
    <div class="content_2 content" style="overflow-x: hidden;overflow-y: hidden;">
    <ul>
    <?php 
    $tmp_cat_tags_array = array();
    foreach($tagmodel as $tag_cat){
      $ex_cat_tag=explode(",",$tag_cat->category_tags);
	    for($i=0;$i<count($ex_cat_tag);$i++){
	     $tmp_cat_tags_array[] = trim($ex_cat_tag[$i]);  
	    }
	}
    $short_array=array_count_values($tmp_cat_tags_array);
     arsort($short_array);
            
	foreach($short_array as $key=>$value){
		 if(!empty($key)){?>
         <li><a href="javascript:void(0);" onclick="javascript: catdetailmore('<?php echo $key; ?>')"><?php echo $key; echo ($value>1) ? " (".$value.")" : ""; ?></a></li>
	<? } }
	?>    
    </ul>
    </div>
</div>
<?php /* ?>
<div class="category">
    <div class="category_head">Rules</div>
    <div class="content_2 content" style="overflow-x: hidden;overflow-y: hidden;">
    <ul >
      <?php 
        $tmp_tags_array = array();
        foreach($tagmodel as $tag){
          $ex_type_tag=explode(",",$tag->type_tags);
		    for($i=0;$i<count($ex_type_tag);$i++){
		     $tmp_tags_array[] = trim($ex_type_tag[$i]);  
		    }
		}
        $short_type_array=array_count_values($tmp_tags_array);
         arsort($short_type_array);
                    
		foreach($short_type_array as $key=>$value){ 
		            
			 if(!empty($key)){?>
            <li><a href="javascript:void(0);" onclick="javascript: typedetailmore('<?php echo $key; ?>')"><?php echo $key; echo ($value>1) ? " (".$value.")" : ""; ?></a></li>
		<? } }
		?>      
    </ul>
    </div>
</div>
<?php */ ?>
<p id="demo"></p>


