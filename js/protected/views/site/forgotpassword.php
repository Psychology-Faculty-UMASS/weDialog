<style type="text/css">
.uservalidate{
    color: red;
    font-weight: lighter;
}
</style>




  <div class="main">
    <div class="main_mid2">
      <div class="topics">
        <div class="topic_head">Forgot Password? </div>
      </div>
      
     <div class="login">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
        				'id'=>'user-forgotpassword-form',
                        'action'=>Yii::app()->createUrl('site/Forgotpassword'),
        				'enableAjaxValidation'=>false,
        			    'enableClientValidation'=>true,
        			    'clientOptions'=>array(
        					'validateOnSubmit'=>true,
        		        ),
        			)
        		);
            ?>
            <table id="login_detail" border="0" cellpadding="4" cellspacing="0" width="100%">
              
                <tr>
                    <td class="input_box" style="padding-left:7px!important ">
                        <?php $this->renderPartial('/partials/_flash_msgs'); ?>
                    </td>
                </tr>              
              	<tr>
                <td align="right" width="21%"><span class="star">*</span>Email Address : </td>
                <td width="79%">
                    <?php echo $form->textField($UserForgotPasswordModel,"email",array("style"=>"width:65%","class"=>"input_box","value"=>$email));?>
                    <?php echo $form->error($UserForgotPasswordModel,'email',array("class"=>"uservalidate"));?>
                </td>
              </tr>
             
              <tr>
                <td>&nbsp;</td>
                <td><input class="Submit" name="submit" value="Submit" type="submit" style="margin-top: 0;"/></td>
              </tr>
              <tr><td>&nbsp;</td><td>Please check your email for password (also check spam folder)</td></tr>
              
             </table>
       <?php $this->endWidget(); ?>
     </div>
    </div>
    <div class="main_right">
    </div>
  </div>

         