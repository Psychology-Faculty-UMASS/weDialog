<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />

<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	//'Users'=>array('index'),
	'User Manage',
);
?>

    <div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage Users</td>
                <td></td>
                <td style="float: right;">
                    <span>
                        <a href="<?php echo Yii::app()->createUrl('users/create'); ?>" style="text-decoration: none"  title="New create record">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/plus.png" width="25" height="25" />
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:active_records();" title="Active selected records">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/active.png" width="25" height="25" />
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:inactive_records();" title="Inactive selected records">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/inactive.png" width="23" height="23" />
                        </a>
                    </span>
                    <?php 
                    if($this->data["group_id"]=="1"){ ?>
                        <span>
                            <a href="javascript:void(0)" onclick="javascript:delete_records();" title="Delete selected records">
                                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
                            </a>
                        </span>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <?php $this->renderPartial('/partials/_flash_msgs'); ?>
                
    <div class="admin_login_form_box_details">
            <?php 
            //echo '<pre>';
            //print_r($model->search());exit;
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'users-grid',
                'htmlOptions'=>array('style'=>'padding: 0px'),
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'selectableRows'=>2,
                'columns'=>array(
                    array(
                            'class'=>'CCheckBoxColumn',
                            'id'=>'id',
                         ),         
                    'username',
                    /*array(            
                        'name'=>'password',
                        'header'=>'Password',
                        'value'=>'$data->password',
                    ),*/
                    array(
                        'name'=>'posts',
                        'value'=>'count($data->user_all_post_relation)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'red_flag',
                        'value'=>'count($data->user_all_post_red_flag_relation)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'red_flag_avg',
                        'value'=>'round((count($data->user_all_post_red_flag_relation) * 100/count($data->user_all_post_relation)), 2)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'block_flag',
                        'value'=>'count($data->user_all_post_block_flag_relation)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'block_flag_avg',
                        'value'=>'round((count($data->user_all_post_block_flag_relation) * 100/count($data->user_all_post_relation)), 2)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'green_flag',
                        'value'=>'count($data->user_all_post_green_flag_relation)',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'agree',
                        'value'=>'myhelpers::getAgreeCount($data->id,"Agree")',
                        'filter'=>'',
                    ),
                    array(
                        'name'=>'disagree',
                        'value'=>'myhelpers::getAgreeCount($data->id,"Disagree")',
                        'filter'=>'',
                    ),                    
                    array(
                        'name'=>'green_flag_avg',
                        'value'=>'round((count($data->user_all_post_green_flag_relation) * 100/count($data->user_all_post_relation)), 2)',
                        'filter'=>'',
                    ),
                    'email',
                    array(            
                        'name'=>'facebook_id',
                        'header'=>'Facebook Id',
                        'value'=>'$data->facebook_id',
                    ),
                    array(            
                        'name'=>'twitter_id',
                        'header'=>'Twitter Id',
                        'value'=>'$data->twitter_id',
                    ),                    
                    array(
                        'name'=>'status',
                        'value'=>'$data->status',
                        'filter' => Yii::app()->params['viewIsStatus'],
                    ),
                    /*
                    'user_description',
                    'facebook_link',
                    'twitter_link',
                    'website_link',
                    'created_date',
                    */
 /*
   //============start:add for extra LINK IN ACTION PART======================//
                      array(
                            'header'=>'Action',
                            'class'=>'CButtonColumn',
                            'template'=>'{delete}{viewmap}',
                            'buttons'=>array(             
                                       'delete'=>array(
                                                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete-new-icon.png',                       
                                                         'url'=>'Yii::app()->createUrl("location/singledeletelocation", array("id" => $data->id))',
                                                         'label'=>'Delete location'
                                                      ),
                                        'viewmap'=>array( 
                                                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/map.png',                       
                                                        'url'=>'Yii::app()->createUrl("general/viewmaplocation", array("id" => $data->id))',
                                                        'label'=>'View Map',
                                                        'options' => array(
                                                                           'target' => "_blank",                     
                                                                          ),
                                                        ),
                                        ), 
                     ),
   //============end for extra LINK IN ACTION PART======================//
  */
                    array(
                        'header' => 'Action',
                        'template'=>'{update}',
                        /*'buttons'=>array(
                            'update'=>array(
                                    'visible'=>$this->data["group_id"]=="1"? "true":"false",
                            ),
                        ),*/
                        'class'=>'CButtonColumn',
                        'visible'=>$this->data["group_id"]=="1",
                    ),
                ),
            )); ?>
    </div>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('users/manage_users'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>