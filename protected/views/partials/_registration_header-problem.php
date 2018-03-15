<div class="header">
    <div class="header_main">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('dialogs/DialogList'); ?>">
		<div class="logo" style="width:540px; height:90px; text-overflow:clip;"text-overflow:clip;">
			<a href="https://wedialog.net/dialogs/DialogList">
 <!--         <img src="<?php echo Yii::app()->baseUrl;?>/images/logo.png"> -->
           <?php if(!empty(Yii::app()->session['dialog_name'])): ?>
              <?php if(!empty(Yii::app()->session['dialog_created_by']) && !empty(Yii::app()->session['user_id']) && (Yii::app()->session['dialog_created_by']==Yii::app()->session['user_id']) || Yii::app()->session['group_id']==1): ?>
                  <a href="<?php echo Yii::app()->createUrl('dialogs/updatedialog', array('dialog_id'=>Yii::app()->session['dialog_id'])); ?>">
                  <span><?php echo Yii::app()->session['dialog_name']; ?></span></a>
              <?php elseif(!empty(Yii::app()->session['user_id'])): ?>  
                  <a href="<?php echo Yii::app()->createUrl('topics/TopicsList', array('dialog_id'=>Yii::app()->session['dialog_id'])); ?>"><span><?php echo Yii::app()->session['dialog_name']; ?></span></a>
              <?php else: ?>
                  <span><?php echo Yii::app()->session['dialog_name']; ?></span>                  
              <?php endif; ?>
            <?php endif; ?>
        </div>
      </a>
      
   <!--   <div class="banner-logo" style="float:right;"> 
     
      <div class="banner-logo">
      	<img src="<?php echo Yii::app()->baseUrl;?>/images/people.png"> -->

   

</script>
   
      </div>
      <!-- <div class="logo-side-text">ALPHA</div> 
       width:20%
      -->
      <div style="float:right; position:relative; width:20%;">
	     <ul class="topmenu1" >
            <?php
            //echo $this->action->id.'===='.$this->id;exit;
            $home_url = Yii::app()->createUrl('site/LoginUser');
            if(!empty($this->data['user_id'])){
                $home_url = Yii::app()->createUrl('Site/Viewuser',array('people_id'=>$this->data['user_id']));
            }
            ?>
            <li>
            	<a <?php if($this->action->id == 'Viewpeople'){?> style="color: #FFF;" <?php }?> href="<?php echo $home_url?>">
            		Home
            	</a>
            </li>
            <?php
            if(!empty($this->data['user_id'])){
            ?>
			
			<?php
			if($this->data['group_id']=='3'){
			?>
			<li>
				<a <?php if($this->action->id == 'updateAdmin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('Admin/update',array("id"=>$this->data['user_id']));?>">
					Admin
				</a>
			</li>
                        <?php
			}
			if($this->data['group_id']=='1'){
			?>
                            <li>
                                <a <?php if($this->action->id == 'admin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('Admin/update',array("id"=>$this->data['user_id']));?>">
                                        Admin
                                </a>
                            </li>
			<?php
			}
			?>
                        <li>
                            <a <?php if($this->action->id == 'UserProfile'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/UserProfile');?>" id="top-menu-user-name">
                                    <?php echo ucwords($this->data['user_name'])?><span id="drop-arrow" class="arrow-down"></span>
                            </a>
                            
                            <ul class="top-menu-dropdown" id="top-menu-dropdown1">
                                <li class="top-menu-dropdown-profile">
                                    <a <?php if($this->action->id == 'UserProfile'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/UserProfile');?>">
                                            Profile
                                    </a>
                                </li>
                                </br>
                                <li class="top-menu-dropdown-logout">
                                    <a href="<?php echo Yii::app()->createUrl('logout');?>">Logout</a></li>
                                </li>
                            </ul>
			</li>
            
            <?php
			}else{
			?>
            <li>
            	<a <?php if($this->action->id == 'LoginUser'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/LoginUser')?>">Login</a>
            </li>
            <li>
            	<a <?php if($this->action->id == 'register'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/register')?>">Register</a>
            </li>
            <?php
			}
			?>
      	</ul>
      	<?php if(Yii::app()->controller->action->id == 'Viewtopic' OR Yii::app()->controller->action->id == 'viewrule' OR Yii::app()->controller->action->id == 'viewteam'){?>
      <div class="social_media1">
        <script>function fbs_click() {u=location.href;t=document.title;window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
        <a target="_blank" href="https://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['SERVER_NAME']; echo $_SERVER['REQUEST_URI']?>"><img src="<?php echo Yii::app()->createUrl('images/facebook.png');?>" /></a> 
		<a class="twitter popup" href="http://twitter.com/share"><img src="<?php echo Yii::app()->baseurl;?>/images/twitter.png"/></a>
        <?php if(Yii::app()->controller->action->id == 'Viewtopic'){?>  
            <a href="mailto:?Subject=Topics&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewrule'){?>  
            <a href="mailto:?Subject=Rules&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewteam'){?>  
            <a href="mailto:?Subject=Teams&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
      </div>
      <?php }?>
      </div>
      <?php //echo $this->action->id;exit;?>  
<?php
/*
if($login_check){
	if($this->data['group_id']=="1" || $this->data['group_id']=="2" || $this->data['group_id']=="3"){
?>
      <div class="header_raw2">
        <div class="topmenu">
          <ul>
                  <li style="padding-left: 5px;"><a <?php if($this->id == 'topics'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('topics/TopicsList');?>">Topics</a></li>
                  <li><a <?php if($this->id == 'typeTags'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('TypeTags/rules')?>">Rules</a></li>
                  <li><a <?php if($this->id == 'team'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('team/teamlist');?>">Teams</a></li>
                  <li><a <?php if($this->action->id == 'PeopleList'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/PeopleList')?>">People</a></li>
                  <li><a <?php if($this->action->id == 'about'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('general/about');?>">About</a></li>
                  <?php if($this->data['group_id']=='3'){?>
                    <li><a <?php if($this->action->id == 'updateAdmin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('Admin/updateAdmin',array("id"=>$this->data['user_id']));?>">Admin</a></li>
                  <?php }?>
                  <?php if($this->data['group_id']=='1'){?>
                  <li>
                  	<a <?php if($this->action->id == 'admin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('admin',array("id"=>$this->data['user_id']));?>">Admin</a>
				  </li>
              <?php }?>
          </ul>
        </div>
      </div>
      <?php if(Yii::app()->controller->action->id == 'Viewtopic' OR Yii::app()->controller->action->id == 'viewrule' OR Yii::app()->controller->action->id == 'viewteam'){?>
      <div class="social_media1">
        <script>function fbs_click() {u=location.href;t=document.title;window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
        <a target="_blank" href="https://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['SERVER_NAME']; echo $_SERVER['REQUEST_URI']?>"><img src="<?php echo Yii::app()->createUrl('images/facebook.png');?>" /></a> 
		<a class="twitter popup" href="http://twitter.com/share"><img src="<?php echo Yii::app()->baseurl;?>/images/twitter.png"/></a>
        <?php if(Yii::app()->controller->action->id == 'Viewtopic'){?>  
            <a href="mailto:?Subject=Topics&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewrule'){?>  
            <a href="mailto:?Subject=Rules&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewteam'){?>  
            <a href="mailto:?Subject=Teams&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
      </div>
      <?php }?>
<?php 
    }
 }else{
 ?>
        <div class="header_raw2">
        <div class="topmenu">
          <ul>
              <?php //if(!empty($this->data['user_id'])){?>
                  <li style="padding-left: 5px;"><a <?php if($this->id == 'topics'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('topics/TopicsList');?>">Topics</a></li>
                  <li><a <?php if($this->id == 'typeTags'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('TypeTags/rules')?>">Rules</a></li>
                  <li><a <?php if($this->id == 'team'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('team/teamlist');?>">Teams</a></li>
                  
                  <li><a <?php if($this->action->id == 'PeopleList'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('site/PeopleList')?>">People</a></li>
                  <!--
                  <li><a href="<?php echo Yii::app()->createUrl('site/UserProfile');?>">Home</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('Site/Viewpeople',array('people_id'=>$this->data['user_id']));?>">Home</a></li>
                  -->
                  <li><a <?php if($this->action->id == 'about'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('general/about');?>">About</a></li>
                  
                  <?php if($this->data['group_id']=='3'){?>
                    <li><a <?php if($this->action->id == 'updateAdmin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('Admin/updateAdmin',array("id"=>$this->data['user_id']));?>">Admin</a></li>
                  <?php }?>    
                  <?php if($this->data['group_id']=='1'){?>
                  <li><a <?php if($this->action->id == 'admin'){?> style="color: #FFF;" <?php }?> href="<?php echo Yii::app()->createUrl('admin',array("id"=>$this->data['user_id']));?>">Admin</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'cat'));?>">Category Tag</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'type'));?>">Type Tag</a></li>
              <?php }//}?>
          </ul>
        </div>
      </div>
      <?php
     // echo Yii::app()->controller->action->id;exit;      
    // echo '<pre>';
     // print_r($_SERVER);exit; ?>
      <?php if(Yii::app()->controller->action->id == 'Viewtopic' OR Yii::app()->controller->action->id == 'viewrule' OR Yii::app()->controller->action->id == 'viewteam'){?>
      <div class="social_media1">
        <script>function fbs_click() {u=location.href;t=document.title;window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
        <a target="_blank" href="https://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['SERVER_NAME']; echo $_SERVER['REQUEST_URI']?>"><img src="<?php echo Yii::app()->createUrl('images/facebook.png');?>" /></a> 
		<a class="twitter popup" href="http://twitter.com/share"><img src="<?php echo Yii::app()->baseurl;?>/images/twitter.png"/></a>
        <?php if(Yii::app()->controller->action->id == 'Viewtopic'){?>  
            <a href="mailto:?Subject=Topics&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewrule'){?>  
            <a href="mailto:?Subject=Rules&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
        <?php if(Yii::app()->controller->action->id == 'viewteam'){?>  
            <a href="mailto:?Subject=Teams&Body=I saw this and thought of you!  <?php echo 'http://'.Yii::app()->request->getServerName().$_SERVER['REQUEST_URI'];?>" title="Share by Email"><img src="<?php echo Yii::app()->baseUrl;?>/images/message.png"  alt="Email"/></a>
        <?php }?>
      </div>
      <?php }?>
<?php
}
*/
?>   
	<div style="clear:both"></div>
	</div>
</div>
  
  <!--<div class="header">
    <div class="header_main">
      <div class="logo" >passio<span>net</span>
      	<div class="slogan">People-to-people dialog</div>
      </div>
      <div class="logo" ><div style="text-align: center;"><div style="text-align: center;"><span style="font-family: Verdana; font-weight: bold;"><span style="color: rgb(204, 153, 51);">passio</span><span style="color: rgb(51, 51, 255);">net</span></span><span style="font-family: Verdana;"><span style="color: rgb(51, 51, 255);"><small><small><small><small><small><span style="color: black; font-family: Arial Narrow;"></span></small></small></small></small></small></span></span><br /><span style="font-family: Verdana;"><span style="color: rgb(51, 51, 255);"><small><small><small><small><small><span style="color: black; font-family: Arial Narrow;">People-to-people dialog</span></small></small></small></small></small></span></span><span style="font-family: Verdana;"><span style="color: rgb(51, 51, 255);"></span></span><br style="font-family: Helvetica,Arial,sans-serif;" /></div><span style="font-family: Verdana; font-weight: bold;"><span style="color: rgb(51, 51, 255);"></span></span></div>
      
      <div class="logo-side-text">BETA</div>
     <ul class="topmenu1" >
            <?php if(!empty($this->data['user_id'])){
            if($this->data['group_id']=='1'){?>
                <li><a href="<?php echo Yii::app()->createUrl('site/UserProfile');?>">Panel</a></li>
            <?php }?>
                <li><a href="<?php echo Yii::app()->createUrl('site/UserProfile');?>"><?php echo ucwords($this->data['user_name'])?></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('logout');?>">Logout</a></li></li>
            <?php }else{ ?>
                <li><a href="<?php echo Yii::app()->createUrl('site/LoginUser')?>">Login</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site')?>">Register</a></li>
            <?php }?>
      </ul>
      <div class="header_raw2">
        <div class="topmenu">
          <ul>
              <?php if(!empty($this->data['user_id'])){?>
                  <li><a href="<?php echo Yii::app()->createUrl('/');?>">Home</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('site/PeopleList')?>">People</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('topics/TopicsList');?>">Topics</a></li>
                  <?php if($this->data['group_id']=='1'){?>
                  <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'cat'));?>">Category Tag</a></li>
                  <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'type'));?>">Type Tag</a></li>
              <?php }}?>
          </ul>
        </div>
      </div>
    </div>
  </div>-->



<!--<div class="header">
<div class="header_main">
  <div class="logo"><a href="#"><img src="<?php echo Yii::app()->baseUrl;?>/images/logo.png"></a></div>
  <div class="header_raw2">
    <div class="topmenu">
      <ul>
          <?php if(!empty($this->data['user_id'])){?>
              <li><a href="<?php echo Yii::app()->createUrl('/');?>">Home</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('site/PeopleList')?>">People</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('topics/TopicsList');?>">Topics</a></li>
              <?php if($this->data['group_id']=='1'){?>
              <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'cat'));?>">Category Tag</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('topics/Viewtags',array('tag'=>'type'));?>">Type Tag</a></li>
          <?php }}?>
      </ul>
    </div>
    <div class="topmenu" style="float: right;">
        <ul>
            <?php if(!empty($this->data['user_id'])){
            if($this->data['group_id']=='1'){?>
                <li><a href="<?php echo Yii::app()->createUrl('site/UserProfile');?>">Panel</a></li>
            <?php }?>
                <li><a href="<?php echo Yii::app()->createUrl('site/UserProfile');?>"><?php echo ucwords($this->data['user_name'])?></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('logout');?>">Logout</a></li></li>
            <?php }else{ ?>
                <li><a href="<?php echo Yii::app()->createUrl('site/LoginUser')?>">Login</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('site')?>">Register</a></li>
            <?php }?>
        </ul>
    </div>
  </div>
</div>
</div>-->
<script>
    $("#top-menu-user-name").click(function(){
        if($(".top-menu-dropdown").css("display")=="none"){
            $(".top-menu-dropdown").css("display","block");
            //$("#drop-arrow").removeClass("arrow-up");
            //$("#drop-arrow").addClass("arrow-down");
        }
        else{
            $(".top-menu-dropdown").css("display","none");
            //$("#drop-arrow").removeClass("arrow-down");
            //$("#drop-arrow").addClass("arrow-up");
        }
        return false;
    });
    
</script>
