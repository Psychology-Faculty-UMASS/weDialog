<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />

<?php
$this->breadcrumbs=array(
	'Manage Questions',
);
?>
    <div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage Questions</td>
                <td></td>
                <td style="float: right;">
                    <span>
                        <a href="<?php echo Yii::app()->createUrl('CategoryGroups/create'); ?>" style="text-decoration: none"  title="New create record">
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
                    'category',
            		'groups',
            		'total',
            		'created_by',
                        'dialog_id',
            		'date',                  
                    array(
                        'name'=>'status',
                        'value'=>'$data->status',
                        'filter' => Yii::app()->params['viewIsStatus'],
                    ),
                    array(
                        'header' => 'Action',
                        'template'=>'{view}{update}{delete}',
                        'class'=>'CButtonColumn',
                        'buttons'=>array(
                            'view'=>array(
                            
                            ),
                            'update'=>array(
                                    'visible'=>$this->data["group_id"]=="1"? "true":"false",
                            ),
                            'delete'=>array(
                                    'visible'=>$this->data["group_id"]=="1"? "true":"false",
                            ),
                        ),
                    ),
                ),
            )); ?>
    </div>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('CategoryGroups/manage'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>