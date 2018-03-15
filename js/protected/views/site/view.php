<script language="javascript" type="text/javascript">

$(document).ready(function(){

	$('.twitter').click(function(){
	            location.href="<?php echo Yii::app()->createUrl('site/index?oauth_provider=twitter');?>";
	});
  
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
	font-size: 12px;
	/*font-weight: bold;*/
	font-family:Arial, Helvetica, sans-serif;
	padding:0px 0px;
}
.form_lable_normal {
	color: #125D90;
	font-size: 12px;
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
  <div class="main">
    <div class="main_mid2 login-box">
      <div class="topics">
        <div class="topic_head">Register </div>
      </div>
      <div>
        <div class="input_box" style="padding-left:7px!important;font-size: 13px;">
            <?php $this->renderPartial('/partials/_flash_msgs'); ?>
        </div>
    </div>
     <div class="login">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'user-form',
                        //'action'=>Yii::app()->createUrl('site/InsertUser'),
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
              	  <td colspan="2" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
              <?php /*
                <td width="48%" align="left" valign="middle" style="padding-left: 1%;"><p style="font-size: 13px;">Please register, or use social networks to log-in</p>
                     <p style="font-size: 13px;">Already registered? Then please <a href="<?php echo Yii::app()->createUrl('')?>" style="text-decoration: none;color:#3AA2F0;">login</a> </p>
                </td>
                */?>
                <td colspan="2" align="right" valign="middle">
                    <div>
                        <span style="float:left;padding-left: 10px;">Please register, or use social networks to log-in</span>
                        <a href="javascript:void(0);" class="facebook"><img src="<?php echo Yii::app()->baseUrl;?>/images/facebook.jpg" style="vertical-align:middle; margin:0px;"/></a>
                    </div>
                    <div style="padding-top: 5px;">
                        <span style="float:left;padding-left: 10px;">Already registered? Then please <a href="<?php echo Yii::app()->createUrl('')?>" style="text-decoration: none;color:#3AA2F0;">login</a></span>
                        <a href="javascript:void(0);" class="twitter"><img src="<?php echo Yii::app()->baseUrl;?>/images/twitter.jpg" style="vertical-align:middle; margin:0px;"/></a>
                    </div>
                </td>
              </tr>
            </table>
            </td>
              	  </tr> 	
              	<tr>
                <td align="right" width="21%"><span class="star">*</span>User Name</td>
                <td width="79%">
                    <?php echo $form->textField($UserModel,'username',array("class"=>"input_box"));?>
                    <?php echo $form->error($UserModel,'username',array("class"=>"uservalidate"));?>
                </td>
              </tr>
              <tr>
                <td align="right"><span class="star">*</span>Password</td>
                <td>
                    <?php echo $form->passwordField($UserModel,'password',array("class"=>"input_box"));?>
                    <?php echo $form->error($UserModel,'password',array("class"=>"uservalidate"));?>
                </td>
              </tr>
                <tr>
                <td align="right"><span class="star">*</span>Email</td>
                <td>
                    <?php echo $form->textField($UserModel,"email",array("class"=>"input_box"));?>
                    <?php echo $form->error($UserModel,'email',array("class"=>"uservalidate"));?>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input class="Submit" name="submit" value="Sign Up" type="submit" style="margin-top:0px;"></td>
              </tr>
              <tr><td colspan="2" style="padding-left:13px;">Please check your email to confirm registration (also check spam folder)</td></tr>
             </tbody></table>
       <?php $this->endWidget(); ?>
     </div>
    </div>
    <div class="main_right">
    </div>
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

                