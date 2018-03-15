<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />
<?php
$this->breadcrumbs=array(
	'Posts',
);
?>
<div class="admin_login_form_titel" style="width:98%">
    <table width="100%">
        <tr>
            <td>Manage Posts <?php //echo $model->topic_id;?></td>
            <td></td>
            <td style="float: right;"> 
                <span>
                    <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:active_records();" title="Active selected Post(s)">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/images/active.png" width="25" height="25" />
                    </a>
                </span>
                <span>
                    <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:inactive_records();" title="Inactive selected Post(s)">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/images/inactive.png" width="23" height="23" />
                    </a>
                </span>
                <span>
                    <a href="javascript:void(0)" onclick="javascript:delete_records();" title="Delete selected Post(s)">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
                    </a>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php $this->renderPartial('/partials/_flash_msgs'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
 	'id'=>'user-comment-grid',
	'dataProvider'=>$model->searchallposts(),
	'filter'=>$model,
	'selectableRows'=>2,
    'columns'=>array(
        array(
                'class'=>'CCheckBoxColumn',
                'id'=>'id',
                'value'=>function($data){
                        if(isset($data->topic_id))
                        {
                             return "Topic_".$data->id;
                        }
                        else if(isset($data->type_tag_id))
                        {
                            return "Rule_".$data->id;
                        }
                        else if(isset($data->team_id))
                        {
                            return "Team_".$data->id;
                        }
                 },
                 'htmlOptions'=>array('style'=>'width: 2%;'),        
             ),
        array(
            'type'=>'html',
            'header'=>'Posts',
            'name'=>'comment',
            //'value'=>'$data->comment',
            'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return $data->comment;
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return $data->comment;
                    }
                    else if(isset($data->team_id) && $data->team_id > 0)
                    {
                        return $data->comment;
                    }
             },            
            'htmlOptions'=>array('style'=>'width: 50%;'),
        ), 
        array(
            'header'=>'Red Flag',
            'name'=>'red_flag',
            //'value'=>'count($data->user_red_comment)',
            'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return count($data->user_red_comment);
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return count($data->type_tags_red_comment);
                    }
                    else if(isset($data->team_id) && $data->team_id > 0)
                    {
                        return count($data->team_red_comment);
                    }
             },            
            
            'filter'=>'',
            'sortable'=>true,
            'htmlOptions'=>array('style'=>'width: 6%;text-align:center;'),
        ),
        array(
            'header'=>'Block Flag',
            'name'=>'block_flag',
            //'value'=>'count($data->user_block_comment)',
            'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return count($data->user_block_comment);
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return count($data->type_tags_green_comment);
                    }
                    else if(isset($data->team_id) && $data->team_id > 0)
                    {
                        return count($data->team_block_comment);
                    }
             },            
            'filter'=>'',
            'sortable'=>true,
            'htmlOptions'=>array('style'=>'text-align:center;width: 7%;'),
        ),
        array(
            'header'=>'Green Flag',
            'name'=>'green_flag',
            //'value'=>'count($data->user_green_comment)',
            'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return count($data->user_green_comment);
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return count($data->type_tags_block_comment);
                    }
                    else if(isset($data->team_id) && $data->team_id > 0)
                    {
                        return count($data->team_green_comment);
                    }
             },            
            'filter'=>'',
            'sortable'=>true,
            'htmlOptions'=>array('style'=>'width: 7%;text-align:center;'),
        ),        
                            
        array(
            'header'=>'Author',
            'name'=>'user_id',
            'value'=>'$data->user_comment->username',
            /*'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return $data->user_comment->username;
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return $data->user_comment->username;
                    }else
                    {
                        return $data->user_comment->username;
                    }
             },*/            
            
            
            'filter'=>CHtml::listData(Users::model()->findAll(array('order'=>'id ASC')), 'id', 'username'),
            'htmlOptions'=>array('style'=>'width: 10%;'),
        ),

        array(
            'header'=>'Date',
            'name'=>'created_date',
            'value'=>'date("m-d-Y",strtotime($data->created_date))',
            'filter'=>'',
            'htmlOptions'=>array('style'=>'width: 6%;'),
        ),
        array(
            'header'=>'Hide Post',
            'name'=>'hide_post',
            'value'=>function($data){
                    if(isset($data->topic_id) && $data->topic_id > 0)
                    {
                         return count($data->user_hide_comment);
                    }
                    else if(isset($data->type_tag_id) && $data->type_tag_id > 0)
                    {
                        return count($data->type_tags_hide_comment);
                    }
                    else if(isset($data->team_id) && $data->team_id > 0)
                    {
                        return count($data->team_hide_comment);
                    }
             },            
           	'filter'=>'',
            'htmlOptions'=>array('style'=>'text-align:center;width: 6%;'),
        ),

        array(
            'name'=>'status',
            'value'=>'Yii::app()->params["viewStatus"][$data->status]',
            'filter' => Yii::app()->params['viewStatus'],
            'htmlOptions'=>array('style'=>'width: 6%;'),
        ),                
	),
)); ?>

<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('UserComment/manageallposts'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>