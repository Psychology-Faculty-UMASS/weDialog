 <?php echo $this->renderPartial('../emailTemplates/email_header'); ?>
  		<tr>
    		<td>
				<h1 style="margin:0px; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#CE5301; ">
				<?php echo "Hi ".$userLoginModel->fname.' '.$userLoginModel->lname.',';?>
				</h1> 
			</td> 
  		</tr>
		
  		<tr style="background:#fff; margin:10px 10px 0 10px; padding:10px; float:left;  border-radius: 5px 5px 5px 5px; border:1px solid #CCC; width:460px;">
    		<td>
       			<p style="margin:0px; padding:0px 0 20px 10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">
				We received a request to reset your password.
				If you didn't make this request, simply ignore this email.
				</p>
				
        		<h2 style="margin:0px; padding:0 10px; text-align:center; width:100% ">
					<a target="_blank" href="<?php echo $this->createAbsoluteUrl('/userLogin/resetPassword/token/'.$userLoginModel->token);?>">
						 Click Here
					</a>
				</h2>
                
                <p style="margin:0px; padding:0px 0 20px 10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;"><b>OR Copy & Paste Below URL to your browser :</b><br />
				<u><?php echo $this->createAbsoluteUrl('/userLogin/resetPassword/token/'.$userLoginModel->token);?>
                </u>
                </p>
				
         		<p style="margin:0px; padding:10px 0 0px 10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333;">Thanks,</p>
				
         		 
    		</td>
  		</tr>
 
 <?php echo $this->renderPartial('../emailTemplates/email_footer'); ?>  		