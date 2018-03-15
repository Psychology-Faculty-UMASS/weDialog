<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />

<?php
/* @var $this CategoryTagsController */
/* @var $model CategoryTags */

$this->breadcrumbs=array(
	'Manage Category Tags',
);

$this->menu=array(
	array('label'=>'List CategoryTags', 'url'=>array('index')),
	array('label'=>'Create CategoryTags', 'url'=>array('create')),
);

?>


<div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage Topics</td>
                <td></td>
                <td style="float: right;">
                    <span>
                        <a href="<?php echo Yii::app()->createUrl('categoryTags/create'); ?>" style="text-decoration: none"  title="New create record">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/plus.png" width="25" height="25" />
                        </a>
                     </span>
                     <!--
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
                -->
                    <?php 
                    if($this->data["group_id"]=="1"){ ?>
                        <span>
                            <a onclick="javascript:delete_records();" title="Delete selected records">
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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-tags-grid',
	'htmlOptions'=>array('style'=>'padding: 0px'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>2,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'id',
		),
		'cat_tag',
		'cat_tag_description',
		array(
                'header'=>'Created by',
				'name' => 'user_id',
				'value'=>'$data->categoryTags_username->username',
				'filter' => CHtml::listData(Users::model()->findAll(array('order'=>'id ASC')), 'id', 'username'),
		),
                'dialog_id',
		'created_date',
        /*
        array(
                'name'=>'status',
                'value'=>'$data->status',
                'filter' => Yii::app()->params['viewIsStatus'],
        ),
        */
		array(
			'header' => 'Action',
            'template'=>'{update}', 
            'class'=>'CButtonColumn',
            'visible'=>$this->data["group_id"]=="1",
		),
	),
)); ?>
</div>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('categoryTags/Manage_cattags'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />

</form>
