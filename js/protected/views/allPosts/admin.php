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
                <?php
                if($this->data["group_id"]=="1"){ ?>
                    <span>
                        <a href="javascript:void(0)" onclick="javascript:delete_records();" title="Delete selected Post(s)">
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
 	'id'=>'user-comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>2,
    'columns'=>array(
        array(
                'class'=>'CCheckBoxColumn',
                'id'=>'id',
                'filterHtmlOptions'=>array('style'=>'width: 2%;'),
             ),
            array(
                'name'=>'post_type',
                'value'=>'Yii::app()->params["PostType"][$data->post_type]',
                'filter'=>Yii::app()->params['PostType'],
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),
    		'comment',
            array(
                'name'=>'red_flag',
                'value'=>'count($data->post_to_red_flag_relation)',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),
            array(
                'name'=>'red_flag_avg',
                'value'=>'(count($data->post_to_red_flag_relation) * 100/(myhelpers::getAgreeDisagreeavg($data->id)))',
                //'value'=>'myhelpers::getAgreeDisagreeavg($data->id)',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),            
            
            array(
                'name'=>'block_flag',
                'value'=>'count($data->post_to_block_flag_relation)',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),             
            array(
                'name'=>'green_flag',
                'value'=>'count($data->post_to_green_flag_relation)',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),
            array(
                'header'=>'Agree',
                'name'=>'like',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),
            array(
                'header'=>'Disagree',
                'name'=>'dislike',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),             
            array(
                'header'=>'Author',
                'name'=>'user_id',
                'value'=>'$data->user_comment->username',
                'filter'=>CHtml::listData(Users::model()->findAll(array('order'=>'id ASC')), 'id', 'username'),
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ), 
            array(
                'header'=>'Date',
                'name'=>'created_date',
                'value'=>'date("m-d-Y",strtotime($data->created_date))',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),              
            /*array(
                'name'=>'hide_post',
                'value'=>'count($data->post_to_hide_flag_relation)',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),*/
            array(
                'name'=>'status',
                'value'=>'Yii::app()->params["viewStatus"][$data->status]',
                'filter' => Yii::app()->params['viewStatus'],
                'htmlOptions'=>array('style'=>'width: 5%;'),
            ), 
            array(
                'header' => 'Action',
                'template'=>'{update}',
                'class'=>'CButtonColumn',
                'visible'=>$this->data["group_id"]=="1",
            ),
	),
)); ?>

<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('AllPosts/manageallposts'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>