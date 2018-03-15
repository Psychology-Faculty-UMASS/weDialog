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

#lean_overlay {
    position: fixed;
    z-index: 100;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    background: #241151;
    opacity: 1!important;
    display: block;
}
</style>
<?php if(Yii::app()->user->hasFlash('success_msg')){  ?>

<div id="lean_overlay" style="display: block"></div>

<div id="signup" style="display: block; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 200px; font-size: 15px; font-family: Arial">

    <div style="background-color: RGB(63,72,204); min-height: 20px;"></div>
    
    <div style="padding:20px;">
        Thank you! To complete your registration please click the link in the EMAIL we sent you.
        <br/>
        <br/>
        If you do not see a Wedialog Email, please also look in your SPAM or JUNK Email folder
    </div>
    
    <div style="width: 10%; margin: 0px auto; margin-bottom: 40px;">
        <button id="signup-confirm-button" style="cursor:pointer; padding: 7px 15px 7px 15px; color:black; background-color: RGB(195,195,195); border-radius: 0px;">OK</button>
    </div>

</div>
<?php } ?>


  <div class="main">
    <div class="main_mid2 login-box" align:"center">
      <div>
        <div class="input_box">
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
              	  <td colspan="3" align="middle"><table width="100%" border="0" cellpadding="4" cellspacing="0">
   
   
                    <div>
                        <span style="font-size: 18px;">Please register below, or login with Facebook</span>
                    </div>
				</td>
			
				<tr>	
                    <td align="center" valign="middle" margin-top"10px">
                        <span style="font-size: 18px;">Already registered? Then please <a href="<?php echo Yii::app()->createUrl('site/LoginUser')?>" style="text-decoration: none;color:#3AA2F0;">LOGIN</a></span>
<!--                        <a href="javascript:void(0);" class="twitter"><img src="<?php echo Yii::app()->baseUrl;?>/images/twitter.jpg" style="vertical-align:middle; margin:0px;"/></a> -->
				</td>
				</tr>
				<tr>
                    <td align="center" valign="middle">
					<div>
                        <a href="javascript:void(0);" class="facebook"><img src="<?php echo Yii::app()->baseUrl;?>/images/facebook.jpg" style="vertical-align:middle; margin:10px;"/></a>
                    </div>
                </td>
              </tr>
            </table>
            </td>
              	  </tr> 	
              	<tr>
                <td align="center" valign="middle">
                    <?php echo $form->textField($UserModel,'username',array("class"=>"input_box", "placeholder"=>Username));?>
                    <?php echo $form->error($UserModel,'username',array("class"=>"uservalidate"));?>
                </td>
  
              </tr>
              <tr>
                <td align="center" valign="middle">
                    <?php echo $form->passwordField($UserModel,'password',array("class"=>"input_box", "placeholder"=>Password));?>
                    <?php echo $form->error($UserModel,'password',array("class"=>"uservalidate"));?>
                </td>
              </tr>
                <tr>
                <td align="center" valign="middle">
                    <?php echo $form->textField($UserModel,"email",array("class"=>"input_box", "placeholder"=>Email));?>
                    <?php echo $form->error($UserModel,'email',array("class"=>"uservalidate"));?>
                </td>
              </tr>
              <tr>
                <td align="center" valign="middle"><input class="Submit" name="submit" value="REGISTER" type="submit" style="margin-top:10px;"></td>
              </tr>
              <?php /*<tr><td colspan="3" style="padding-left:13px;font-size: 13px;">NOTE: Check your EMAIL to confirm registration (also check SPAM or JUNK folder)</td></tr>*/?>
             </tbody></table>
       <?php $this->endWidget(); ?>
     </div>
    </div>
          <div class="main_mid2 login-box" style="background-color: transparent; width: 550px; text-align: center;">
              <p>After you click REGISTER, we will send you an Email. Please click on link
              in that Email to complete your registration</p>
              <p>NOTE: If you don't see Email, please check in your Spam or Junk Email folder</p>
          </div>
    <div class="main_right">
    </div>
  </div>

<div id="fb-root"></div>


<script type="text/javascript">
$( document ).ready(function() {
    
$("#signup-confirm-button").click(function(){
    $("#lean_overlay").css("display","none");
    $("#signup").css("display","none");
});
    
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

                