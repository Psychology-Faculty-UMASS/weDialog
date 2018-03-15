<?php 
$dialogID = '';
if(!empty(Yii::app()->session['dialog_id'])) {
    $dialogID = Yii::app()->session['dialog_id'];
}

if(isset($_GET['dialog_id'])){
    $dialogID = $_GET['dialog_id'];
    $dialogModel = Dialogs::model()->findByPk($dialogID);
    if(!$dialogModel){
        throw new CHttpException(404, 'Not Found.');
    }
}
?>
<style>
.left_main_menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: rgb(10, 131, 220);
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
    /*
    width: 200px;
    */
    width: 100%;
}
.left_main_menu li a {
    display: block;
    color: white;
    padding: 10px 4px  8px 16px;
    text-decoration: none;
}
.left_main_menu li .active {
    background-color: rgb(60, 27, 133);
    color: white;
}
.left_main_menu li a:hover {
    background-color: rgb(60, 27, 133);
    color: white;
}
</style>
<?php
$dialog_class = "";
$topic_class = "";
$rules_class = "";
$teams_class = "";
$people_class = "";
$about_class = "";
$current_controller = Yii::app()->controller->id;
if($current_controller == "dialogs"){
	$dialog_class = "class=\"active\"";
}else if($current_controller == "topics"){
	$topic_class = "class=\"active\"";
}else if($current_controller == "typeTags"){
	$rules_class = "class=\"active\"";
}else if($current_controller == "team"){
	$teams_class = "class=\"active\"";
}else if($current_controller == "site"){
	$people_class = "class=\"active\"";
}else if($current_controller == "general"){
	$about_class = "class=\"active\"";
}

if(isset(Yii::app()->session['dialog_id']) && !empty(Yii::app()->session['dialog_id'])){
    $dialogArr = array('dialog_id'=>Yii::app()->session['dialog_id']);
}
else {
    $dialogArr = array();
}
?>
<div class="left_main_menu">
	<ul>
                <li><a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('dialogs/DialogList')?>">DIALOGS</a></li>
		<li><a <?php echo $topic_class;?> href="<?php echo Yii::app()->createUrl('topics/TopicsList', $dialogArr)?>">TOPICS</a></li>
		<li><a <?php echo $rules_class;?> href="<?php echo Yii::app()->createUrl('TypeTags/rules', $dialogArr)?>">RULES</a></li>
		<li><a <?php echo $teams_class;?> href="<?php echo Yii::app()->createUrl('team/teamlist', $dialogArr)?>">TEAMS</a></li>
		<li><a <?php echo $people_class;?> href="<?php echo Yii::app()->createUrl('site/PeopleList', array("dialog_id"=>$dialogID))?>">PEOPLE</a></li>
		<li><a <?php echo $about_class;?> href="<?php echo Yii::app()->createUrl('general/about')?>">ABOUT</a></li>
	</ul>
</div>
<?php
/*
if(isset($_GET['tag']) && !empty($_GET['tag'])){
    $class = 'class="active"';
    $allclass = '';
}else{
    $allclass = 'class="active"';
    $class = '';
}
?>
<div class="category">
	<div class="category_head">category</div>
	<div class="content_2 content">
    	<ul style="overflow-x: hidden;overflow-y: hidden;">
        	<li class="top">
        		<a href="<?php echo Yii::app()->createUrl('topics/TopicsList')?>" <?php echo $allclass;?> >ALL</a>
        	</li>
        	<?php 
        	$tmp_cat_tags_array = array();
        	foreach($tagmodel as $tag_cat){
          		$ex_cat_tag = explode(",",$tag_cat->category_tags);
            	for($i=0;$i<count($ex_cat_tag);$i++){
             		$tmp_cat_tags_array[] = trim($ex_cat_tag[$i]);  
            	}
        	}
         	$short_array=array_count_values($tmp_cat_tags_array);
         	arsort($short_array);
			foreach($short_array as $key=>$value){
				if(!empty($key)){
            		if($key == $_GET['tag']){
                		//this variable is used in header of topic name and count. 
                		$this->data["tagCount"]=$value; 
            		}
         	?>
            <li>
                <a href="<?php echo Yii::app()->createUrl('topics/TopicsList',array('tag'=>$key,'searchtopics'=>'mytagscat'))?>" <?php if($key == $_GET['tag']){ echo $class; }?> ><?php echo $key;?> <?php echo ($value>1) ? " (".$value.")" : ""; ?></a>
            </li>
        	<?php
				}
			}
        	?>
		</ul>
	</div>  
</div>
<?php
*/
?>