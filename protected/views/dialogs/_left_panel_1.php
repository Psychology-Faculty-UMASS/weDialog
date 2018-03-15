<?php 
$dialogID = '';
if(!empty(Yii::app()->session['dialog_id'])) {
    $dialogID = Yii::app()->session['dialog_id'];
}

if(isset($_GET['dialog_id'])){
    $dialogID = $_GET['dialog_id'];
}
$aboutLink = Yii::app()->createUrl('general/about');
if(!empty($dialogID)) {
    $dialogModel = Dialogs::model()->findByPk($dialogID);
    if(!$dialogModel){
        throw new CHttpException(404, 'Not Found.');
    }
    else{
        if($dialogModel->dialog_about_exists){
            $aboutLink = Yii::app()->createUrl('dialogs/about', array('dialog_id'=>$dialogID));
        }
        else{
            $aboutLink = Yii::app()->createUrl('general/about');
        }
    }
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
    font-size: 16px;
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
                <li><a <?php echo $about_class;?> href="<?php echo Yii::app()->createUrl('dialogs/about', array("dialog_id"=>$dialogID))?>">ABOUT</a></li>
		<!--<li><a <?php echo $about_class;?> href="<?php echo $aboutLink; ?>">ABOUT</a></li>-->
	</ul>
</div>
<div class="horizontal_main_menu">
	<ul>
        <li><a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('dialogs/DialogList', $dialogArr)?>">HOME</a></li>
		<li><a <?php echo $topic_class;?> href="<?php echo Yii::app()->createUrl('topics/TopicsList', $dialogArr)?>">TOPICS</a></li>
		<li><a <?php echo $rules_class;?> href="<?php echo Yii::app()->createUrl('TypeTags/rules', $dialogArr)?>">RULES</a></li>
		<li><a <?php echo $teams_class;?> href="<?php echo Yii::app()->createUrl('team/teamlist', $dialogArr)?>">TEAMS</a></li>

        <li class="sm-only hm_dropdown" id="hzntl-dropdown">
            <a>MORE<span class="drop-arrow"></span></a>
            <div id="hzntl-dropdown-cnt" class="hm-dropdown-content">
                <div>
                    <br/>
					<a href="<?php echo Yii::app()->createUrl('site/TopPosts', array('dialog_id'=>$dialogID)); ?>">TOP POSTS</a>
                    <a <?php echo $people_class;?> href="<?php echo Yii::app()->createUrl('site/PeopleList', array("dialog_id"=>$dialogID))?>">PEOPLE</a>
                    <a <?php echo $about_class;?> href="<?php echo Yii::app()->createUrl('dialogs/about', array("dialog_id"=>$dialogID))?>">ABOUT</a>
                    <?php
                        if(!empty($this->data['user_id'])){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('logout');?>">LOGOUT</a></li>
                    <?php
                        }else{
                    ?>
                        <a <?php if($this->action->id == 'LoginUser'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/LoginUser')?>">LOGIN</a>
                    <?php
                        }
                    ?>
                </div>
        </li>     
		<!--<li><a <?php echo $about_class;?> href="<?php echo $aboutLink; ?>">ABOUT</a></li>-->
	</ul>
</div>

<script type="text/javascript">
    var dropdownElem = $('#hzntl-dropdown');
    var dropdownCntnt = $('#hzntl-dropdown-cnt');
    dropdownElem.click(function(){
        dropdownElem.first().toggleClass('active');
        dropdownCntnt.toggle();
    });
</script>
