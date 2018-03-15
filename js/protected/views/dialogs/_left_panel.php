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
<div class="left_main_menu">
	<ul>
		<li><a class="active" href="<?php echo Yii::app()->createUrl('dialogs/DialogList')?>">DIALOGS</a></li>
		<li><a href="<?php echo Yii::app()->createUrl('general/about')?>">ABOUT</a></li>
	</ul>
</div>