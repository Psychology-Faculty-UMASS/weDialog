    <table style="width:98%;margin: 0;padding: 0;"  id="postamessage" >
        <tr>
            <td id="postamessagetd" style="padding-left: 5px; height: 30px;font-size: 14px;color: #999999;cursor: pointer;border: solid 1px #D5D5D5;"> Write new message : </td>
        </tr>
    </table>
  
  <table class="content_box form_lable" style="width:100%;height: 16px; vertical-align: top;">
        <tr>
            <td>
                <table style="width:99%; vertical-align: top;">
                    <tr>
                        <td> 
						<?php
						    $form = $this->beginWidget('CActiveForm', array('id'=>'user-comment-form',
						                									'enableAjaxValidation'=>false,
						                								    'enableClientValidation'=>true,
						                								    'clientOptions'=>array(
						                														'validateOnSubmit'=>true,
						                											        ),
						                                                     'htmlOptions'=>array(
																								'enctype'=>'multipart/form-data',
						                                                                    ),                                                                                                                                        
						                								)
						                				);
						?>
							<table style="width:100%; vertical-align: top; display:none" id="showmessage">
								<tr>
									<td>
										<textarea id="post_comment_area" name="post_comment_area" style="width:600px; height:250px;"></textarea>
									</td>
								</tr>
								<tr style="display:none">
									<td>
										<textarea id="comment" name="comment" style="width:600px; height:250px;"></textarea>

									</td>
								</tr>
								<tr>
									<td>
										<input value="Post" class="type" style="float: right;" type="submit"/>
									</td>
								</tr>
							</table>
							<?php $this->endWidget();?>
                        </td>
                    </tr>
                </table>
           </td>
       </tr>
</table>