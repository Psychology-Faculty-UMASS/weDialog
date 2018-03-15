<?php 
$dialogID = '';
if(!empty(Yii::app()->session['dialog_id'])) {
    $dialogID = Yii::app()->session['dialog_id'];
}

if(isset($_GET['dialog_id'])){
    $dialogID = $_GET['dialog_id'];
}
$aboutLink = Yii::app()->createUrl('dialogs/about?dialog_id=36');
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
}else if($current_controller == "about"){
	$about_class = "class=\"active\"";
}else if($current_controller == "general"){
	$about_class = "class=\"active\"";
}
//echo $current_controller;
if(isset(Yii::app()->session['dialog_id']) && !empty(Yii::app()->session['dialog_id'])){
    $dialogArr = array('dialog_id'=>Yii::app()->session['dialog_id']);
}
else {
    $dialogArr = array();
}

?>
<div class="left_main_menu">
	<ul>
<!--                <li><a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('dialogs/DialogList')?>">HOME</a></li>
		<li><a <?php echo $topic_class;?> href="<?php echo Yii::app()->createUrl('topics/TopicsList', $dialogArr)?>">TOPICS</a></li>
		<li><a <?php echo $rules_class;?> href="<?php echo Yii::app()->createUrl('TypeTags/rules', $dialogArr)?>">RULES</a></li>
		<li><a <?php echo $teams_class;?> href="<?php echo Yii::app()->createUrl('team/teamlist', $dialogArr)?>">TEAMS</a></li>
		<li><a <?php echo $people_class;?> href="<?php echo Yii::app()->createUrl('site/PeopleList', array("dialog_id"=>$dialogID))?>">PEOPLE</a></li>-->
            
            
        <li><a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('Site/Viewuser',array('people_id'=>$this->data['user_id']))?>">HOME</a></li>
		<li><a <?php echo $topic_class;?> href="<?php echo Yii::app()->createUrl('topics/TopicsList', array("dialog_id"=>$dialogID))?>">TOPICS</a></li>
		<li><a <?php echo $rules_class;?> href="<?php echo Yii::app()->createUrl('TypeTags/rules', array("dialog_id"=>$dialogID))?>">RULES</a></li>
		<li><a <?php echo $teams_class;?> href="<?php echo Yii::app()->createUrl('team/teamlist', array("dialog_id"=>$dialogID))?>">TEAMS</a></li>
		<li><a <?php echo $people_class;?> href="<?php echo Yii::app()->createUrl('site/PeopleList', array("dialog_id"=>$dialogID))?>">PEOPLE</a></li>
		<li><a <?php echo $about_class;?> href="<?php echo Yii::app()->createUrl('dialogs/about', array("dialog_id"=>$dialogID))?>">ABOUT</a></li>
                
            
            
        <!--<li><a <?php echo $about_class;?> href="<?php echo $aboutLink; ?>">ABOUT</a></li>-->
	</ul>
        <?php

    if(Yii::app()->controller->action->id=="TopicsList")
    {
      $topPostsSql = "SELECT COUNT(*) FROM all_posts AS allposts INNER JOIN topics ON allposts.main_id=topics.id WHERE topics.status='Active' AND topics.dialog_id='".$dialogID."' AND allposts.status=1 AND allposts.user_id NOT IN (SELECT id FROM users WHERE status='Inactive')";
        //$topPostsSql = "SELECT COUNT(*) FROM all_posts AS allposts INNER JOIN topics ON allposts.main_id=topics.id WHERE topics.dialog_id='".$dialogID."' AND allposts.status=1 AND allposts.user_id NOT IN (SELECT id FROM users WHERE status='Inactive')";
        $topPostsCount = Yii::app()->db->createCommand($topPostsSql)->queryScalar();

    $topSecCountSQL = "SELECT COUNT(sumTotal.totalRedFlag) FROM
                                    (SELECT all_posts.*,
                                    (SELECT COUNT(all_posts_flags.all_posts_id) FROM all_posts_flags WHERE all_posts_flags.all_posts_id = all_posts.id AND all_posts_flags.flag_type='Red') as totalRedFlag
                                    FROM all_posts
                                    INNER JOIN topics as tops ON all_posts.main_id=tops.id
                                    WHERE all_posts.status = 1 AND tops.dialog_id='".$dialogID."') AS sumTotal WHERE sumTotal.totalRedFlag>0";
                        $command = Yii::app()->db->createCommand($topSecCountSQL);
                        $topSecCount = $command->queryScalar();
        ?>
        <div class="top-posts-container">
            <a href="<?php echo Yii::app()->createUrl('site/TopPosts', array('dialog_id'=>$dialogID)); ?>">Top Posts</a>
            <span><?php echo $topPostsCount; ?> Posts</span>

        <?php if(Yii::app()->session['group_id']==1 || Yii::app()->session['group_id']==3){ ?>
            <span><?php echo $topSecCount; ?> Red-flag</span>
        <?php } ?>
        </div> 
    <?php } ?>
</div>

<div class="horizontal_main_menu">
	<ul>
		<li><a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('Site/Viewuser',array('people_id'=>$this->data['user_id']))?>">HOME</a></li>
		<li><a <?php echo $topic_class;?> href="<?php echo Yii::app()->createUrl('topics/TopicsList', array("dialog_id"=>$dialogID))?>">TOPICS</a></li>
		<li><a <?php echo $rules_class;?> href="<?php echo Yii::app()->createUrl('TypeTags/rules', array("dialog_id"=>$dialogID))?>">RULES</a></li>
		<li><a <?php echo $teams_class;?> href="<?php echo Yii::app()->createUrl('team/teamlist', array("dialog_id"=>$dialogID))?>">TEAMS</a></li>
        <li class="sm-only hm_dropdown" id="hzntl-dropdown">
            <a>MORE<span class="drop-arrow"></span></a>
            <div id="hzntl-dropdown-cnt" class="hm-dropdown-content">
                    <br/>
                    <a href="<?php echo Yii::app()->createUrl('site/TopPosts', array('dialog_id'=>$dialogID)); ?>">TOP POSTS</a>
                    <a <?php echo $people_class;?> href="<?php echo Yii::app()->createUrl('site/PeopleList', array("dialog_id"=>$dialogID))?>">PEOPLE</a>
                    <a <?php echo $about_class;?> href="<?php echo Yii::app()->createUrl('dialogs/about', array("dialog_id"=>$dialogID))?>">ABOUT</a>
					<a <?php echo $dialog_class;?> href="<?php echo Yii::app()->createUrl('dialogs/DialogList')?>">DIALOGS</a>
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
