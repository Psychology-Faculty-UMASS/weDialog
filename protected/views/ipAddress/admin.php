<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />

<?php
/* @var $this TopicsController */
/* @var $model Topics */

$this->breadcrumbs=array(
	'Manage IpAddress',
);

$this->menu=array(
	array('label'=>'List IpAddress', 'url'=>array('index')),
	array('label'=>'Create IPAddress', 'url'=>array('create')),
);
?>
   <div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage IpAddress</td>
                <td></td>
                <td style="float: right;"> 
                    <!--<span> 
                        <a href="<?php echo Yii::app()->createUrl('Ipaddress/admin'); ?>" style="text-decoration: none"  title="New create record">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/plus.png" width="25" height="25" />
                        </a>
                    </span>-->
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
                    <!--<span>
                        <a href="javascript:void(0)" onclick="javascript:delete_records();" title="Delete selected records">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
                        </a>
                    </span>-->
                </td>
            </tr>
        </table>
    </div>
   <?php $this->renderPartial('/partials/_flash_msgs'); ?>
   <div class="admin_login_form_box_details">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'ipaddress-grid',
            'htmlOptions'=>array('style'=>'padding: 0px'),
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'selectableRows'=>2,
            'columns'=>array(
                array(
                        'class'=>'CCheckBoxColumn',
                        'id'=>'id',              
                     ),
                
                'ip_address',
                'created_date',
                 array(
                        'name'=>'status',
                        'value'=>'$data->status',
                        'filter' => Yii::app()->params['viewIsStatus'],
                    ),
              /*  array(
                'header'=>'Action',
        		'class'=>'CButtonColumn',
                'template'=>'',
        		//'template'=>'{update}{viewcoments}',
        		/* 'buttons'=>array(                
                   'viewcoments'=>array(
                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/comment.png',                        
    					'url'=>'Yii::app()->createUrl("UserComment/managetopiccomment", array("id" => $data->id))',
                        'label'=>'View Coments',
        			),        
        		),
      	     ),*/			
            ),
        )); ?>
   </div>


<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('IpAddress/manage'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />

</form>