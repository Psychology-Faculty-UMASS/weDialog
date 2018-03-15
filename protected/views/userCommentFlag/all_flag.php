<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />
<?php
$this->breadcrumbs=array(
	'Flags',
);

?>
<div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage Flags</td>
                <td></td>
                <td style="float: right;">
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:active_records();" title="Active selected Flags">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/active.png" width="25" height="25" />
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:inactive_records();" title="Inactive selected Flags">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/inactive.png" width="23" height="23" />
                        </a>
                    </span>
        			<span>
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:hide_post();" title="Hide Post">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/hide comment.png" width="23" height="23" />
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:block_Users();" title="Block User">
                            <img src="<?php  echo Yii::app()->request->baseUrl;?>/images/hideuser.png" width="23" height="23" />
                        </a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
<?php $this->renderPartial('/partials/_flash_msgs'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-comment-flag-grid',
	'dataProvider'=>$model->searchallflag(),
	'filter'=>$model,
	'selectableRows'=>2,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'id',
            'value'=>function($data){
                    if(isset($data->user_comment_id))
                    {
                         return "Topic_".$data->id;
                    }
                    else if(isset($data->type_tags_comment_id))
                    {
                        return "Rule_".$data->id;
                    }
                    else if(isset($data->team_comment_id))
                    {
                        return "Team_".$data->id;
                    }
             },             
		),
        
	    array(
            'header'=>'Flag Type',
            'name'=>'flag_type',
        ),        
	    array(
            'header'=>'Reasons',
            'name'=>'flag_reason_id',
            'value'=>'$data->relation_flag_reason_id->reason',
        ),
        array(
            'header'=>'Block',
            'name'=>'block_user',
            'value'=>'$data->block_user ? YES : NO ',
           	'filter' =>array('1'=>'YES','0'=>'NO'),
        ),  
        array(
            'header'=>'Post',
            'name'=>'user_comment_id',
            //'value' => 'CHtml::link($data->relation_user_comment_id->comment,Yii::app()->createUrl("Topics/viewtopic",array("topic_id"=>$data->relation_user_comment_id->topic_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;"))',
            'value'=>function($data){
                    if(isset($data->user_comment_id))
                    {
                         return CHtml::link($data->relation_user_comment_id->comment,Yii::app()->createUrl("Topics/viewtopic",array("topic_id"=>$data->relation_user_comment_id->topic_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;"));
                    }
                    else if(isset($data->type_tags_comment_id))
                    {
                         return CHtml::link($data->relation_type_tags_comment_id->comment,Yii::app()->createUrl("TypeTags/viewrule",array("tag_id"=>$data->relation_type_tags_comment_id->type_tag_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;"));
                    }
                    else if(isset($data->team_comment_id))
                    {
                         return CHtml::link($data->relation_team_comment_id->comment,Yii::app()->createUrl("team/viewteam",array("id"=>$data->relation_team_comment_id->team_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; font-weight: bold; text-decoration: none;"));
                    }
             },            
            'type'  => 'raw',
        ),        
        array(
            'header'=>'Author',
            'name'=>'commented_by',
            'value'=>'$data->relation_commented_by->username',
            //'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'username'),
        ),        
        array(
            'header'=>'Flagger',
            'name'=>'user_id',
            'value'=>'$data->relation_user->username',
        ),
        array(
            'header'=>'Date',
            'name'=>'created_date',
            'filter'=>false,
        ),        
        array(
            'header'=>'Hide Post',
            'name'=>'hide_post',
            'value'=>'$data->hide_post ? YES : NO ',
           	'filter' =>array('1'=>'YES','0'=>'NO'),
        ),
        array(
            'header'=>'Author Status',
            'name'=>'author_status',
            'value'=>'$data->relation_commented_by->status',
            'filter' => Yii::app()->params['viewIsStatus'],
        ),        
        
        array(
            'header'=>'Flag Status',
            'name'=>'flag_status',
            'value'=>'$data->flag_status ? YES : NO ',
           	'filter' =>array('1'=>'YES','0'=>'NO'),
        ),                
        /*array(
            'name'=>'adminprocess',
            'value'=>'$data->adminprocess ? DONE : "NOT DONE" ',
           	'filter' =>array('1'=>'DONE','0'=>'NOT DONE'),
         
        ),*/

	
		
	),
)); ?>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('allpostsflags/manageallflag'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />

</form>