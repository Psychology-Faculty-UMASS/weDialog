<script language="javascript" type="text/javascript">

$(document).ready(function(){
   
<!--	$('.twitter').click(function(){
	            location.href="<?php echo Yii::app()->createUrl('site/index?oauth_provider=twitter');?>";
	}); -->
});
</script>
<style type="text/css">
.uservalidate{
    color: red;
    font-weight: lighter;
}
.content{margin:0px 0 0px 0px; width:auto; height:auto; padding:0px; overflow:auto;}		
.content_2{height:100px;}
.td-conten-bg{
	background: none repeat scroll 0 0 #FFFFCC;
	border: 1px solid #0066FF;
padding: 5px;
}
.form_lable {
	color: #125D90;
	font-size: 14px;
	/*font-weight: bold;*/
	font-family:Arial, Helvetica, sans-serif;
	padding:0px 0px;
}
.form_lable_normal {
	color: #125D90;
	font-size: 14px;
	font-weight: normal;
	font-family:Arial, Helvetica, sans-serif;
	padding:3px 0px;
}


.success_msg {
   background-color: #5BA0C9;
   color: white;
   font-size: 14px;
   font-weight: bold;
   margin-bottom: 10px;
   padding: 5px;
}
.failure_msg {
    background-color: #e85449;
    color: white;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
    padding: 5px;
}
</style>
<?php

if($_COOKIE['cookieemail']!=""){
    $email = $_COOKIE['cookieemail'];
}else{
    $email ="";
}
if($_COOKIE['cookiepass']!=""){
    $pass = $_COOKIE['cookiepass'];
}else{
    $pass ="";
}
?> 

  <div class="main">
    <div class="main_mid2 login-box">
    
    <div>
        <div class="input_box" style="padding-left:7px!important;font-size: 14px;">
            <?php $this->renderPartial('/partials/_flash_msgs'); ?>
        </div>
    </div>
    
     <div class="login">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'user-login-form',
                        'action'=>Yii::app()->createUrl('site/LoginUser'),
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )
                );
            ?>
            <table id="login_detail" border="0" cellpadding="4" cellspacing="0" width="100%">
              <tbody>
              	  	
              	<tr>
              	  <td align="center" valign="middle">
                    <div>
                        <span style=" font-size: 18px;">Please login below, or use Facebook login</span>
                    </div>
                  </td>
            	  </tr>

				 <tr>
              	  <td align="center" valign="middle">
                    <div>
                        <span style="font-size: 18px;">Not registered? Then please <a href="<?php echo Yii::app()->createUrl('site/index')?>" style="text-decoration: none;color:#3AA2F0;">REGISTER</a>
                    </div>
                  </td>
            	  </tr>
				<tr>
              	  <td align="center" valign="middle">
                    <div>
                        <a href="javascript:void(0);" class="facebook"><img src="<?=Yii::app()->baseUrl?>/images/facebook.jpg" style="vertical-align:middle; margin:0px; margin-top:10px; margin-bottom:10px;"></a>
                    </div>
                  </td>
            	 </tr>
              	<tr>
                <td align="center" valign="middle">
                    <div style="float: center;margin-top: -3px;">
<!--                        <a href="javascript:void(0);" class="twitter"><img src="<?=Yii::app()->baseUrl?>/images/twitter.jpg" style="vertical-align:middle; margin:0px;"/></a> -->
                    </div>
                    <?php echo $form->textField($UserLoginModel,"email",array("class"=>"input_box","value"=>$email,"placeholder"=>Email));?>
                    <?php echo $form->error($UserLoginModel,'email',array("class"=>"uservalidate"));?>
                </td>
              </tr>
              <tr>
                <td align="center" valign="middle">
                    <?php  echo $form->passwordField($UserLoginModel,'password',array("class"=>"input_box","value"=>$pass,"placeholder"=>Password));?>
                    <?php echo $form->error($UserLoginModel,'password',array("class"=>"uservalidate"));?>
                </td>
              </tr>
              <tr>
				<td align="center" valign="middle">
                    <div>
                    <?php 
						 $check = '';
						 if($_COOKIE['cookieemail'] != "" && $_COOKIE['cookiepass'] != ""){
							$check = 'checked="checked"';
						 }
		
						 echo $form->checkbox($UserLoginModel,'remember_me',array("class"=>"input_box","checked"=>$check,"style"=>"width:18px; font-size: 15px;"));?>Remember Me
                     </div>
                  </td>          
              <tr>
                <td align="center" valign="middle" >
					<div>
					<input class="Submit" name="submit" value="Login" type="submit"/>
					</div>
					</td>
              </tr>
              <tr>
                <td colspan="3" align="center" valign="middle">
                    <a href="<?php echo Yii::app()->createUrl('site/Forgotpassword',array())?>" style="vertical-align: top; font: bolder !important;text-decoration: none;cursor: pointer;color:#3AA2F0;">FORGOT PASSWORD?</a>                
                </td>
              </tr>
              <!--<tr><td colspan="2" style="padding-left:7%; font-size: 14px;">Check Your Email to Confirm Registration ( also check spam folder )</td></tr>-->
             </tbody></table>
        <?php $this->endWidget(); ?>
        
     </div>
     </div>
    <div class="main_right"></div>
  </div>

<div id="fb-root"></div>
<script type="text/javascript">
$( document ).ready(function() {
$('.facebook').click(function(){
   fb_login_js();
});
(function() {
     var e = document.createElement('script');
     e.async = true;
     e.src = 'https://connect.facebook.net/en_US/all.js';
     document.getElementById('fb-root').appendChild(e);
    }());
    window.fbAsyncInit = function(){
       FB.init({
         appId      : <?php echo Yii::app()->params["facebookApiKey"] ; ?>, // App ID
         channelURL : '', // Channel File, not required so leave empty
         status     : true, // check login status
         cookie     : true, // enable cookies to allow the server to access the session
         oauth      : true, // enable OAuth 2.0
         xfbml      : false  // parse XFBML
       });
    }; 
// logs the user in the application and facebook
function fb_login_js(){
    FB.getLoginStatus(function(r){
            if(r.status === 'connected'){
                window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("site/fblogin");?>';
            }else{
                FB.login(function(response){
                        if(response.authResponse){
                        //if (response.perms)
                            window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("site/fblogin");?>';
                        }else{
                            // user is not logged in
                            alert('You are not allowed to connect using Facebook');
                        }
                    },
                    {scope:'email'}
                );// which data to access from user profile
            }
        });
 }
});
</script>