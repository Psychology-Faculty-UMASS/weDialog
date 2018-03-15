<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />
<?php
$this->breadcrumbs=array(
	'Rule Comments'=>array('admin'),
	'Manage',
);
?>
<div class="admin_login_form_titel" style="width:98%">
    <table width="100%">
        <tr>
            <td>Manage Comment of Rule <?php //echo $model->topic_id;?></td>
            <td></td>
            <td style="float: right;"> 
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
                <span>
                    <a href="javascript:void(0)" onclick="javascript:delete_records();" title="Delete selected records">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
                    </a>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php $this->renderPartial('/partials/_flash_msgs'); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rule-comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>2,
    'columns'=>array(
        array(
                'class'=>'CCheckBoxColumn',
                'id'=>'id',              
             ),
        array(
            'header'=>'Comment By',
            'name'=>'user_id',
            'value'=>'$data->user_comment->username',
            'filter'=>CHtml::listData(Users::model()->findAll(array('order'=>'id ASC')), 'id', 'username'),
            'htmlOptions'=>array('style'=>'width: 10%;'),
        ),
        array(
            'type'=>'raw',
            'name'=>'comment',
            'htmlOptions'=>array('style'=>'width: 55%;'),
        ),
        array(
            //'header'=>'Green Count',
            'name'=>'green_flag',
            'value'=>'count($data->type_tags_green_comment)',
            'filter'=>'',
            'sortable'=>true,
            'htmlOptions'=>array('style'=>'width: 12%;text-align:center;'),
        ),
        array(
            'name'=>'red_flag',
            'value'=>'count($data->type_tags_red_comment)',
            'filter'=>'',
            'sortable'=>true,
            'htmlOptions'=>array('style'=>'width: 12%;text-align:center;'),
        ),
        array(
            'name'=>'status',
            'value'=>'Yii::app()->params["viewStatus"][$data->status]',
            'filter' => Yii::app()->params['viewStatus'],
            'htmlOptions'=>array('style'=>'width: 6%;'),
        ),                
	),
)); ?>

<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('TypeTagsComment/managetypetagscomment'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>