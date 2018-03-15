<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/chosen.css" media="all" />

<?php
/* @var $this UsersController */
/* @var $model Users */
$this->breadcrumbs=array(
	//'Users'=>array('index'),
	'Manage Admin',
);
?>

    <div class="admin_login_form_titel" style="width:98%">
        <table width="100%">
            <tr>
                <td>Manage Admin</td>
                <td></td>
                <td style="float: right;">
                    <span>
                        <a href="javascript:void(0);" style="text-decoration: none"  title="To assign admin roll click here" onclick="showhide();">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/plus.png" width="25" height="25" />
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" onclick="javascript:delete_records();" title=" Assign member roll">
                            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
                        </a>
                    </span>
                    
                </td>
            </tr>
        </table>
    </div>
    <?php $this->renderPartial('/partials/_flash_msgs'); ?>
    <div>
        <div id="make_admin_div">
          <form method="POST" action="<?php echo yii::app()->createUrl('Users/viewAdminList');?>" onsubmit="return validation();">
            <span>Assign admin roll</span>
            <br />
            <br />
            <select name="select_user" id="select_user" data-placeholder="Choose a User..." class="chosen-select" style="width:350px;" tabindex="2">
            <option value="">Select User</option>
            <?php
                foreach($model_new as $model_new){ ?>
                <option value="<?php echo $model_new->id?>"><?php echo $model_new->username?></option>
                <?php
                }
            ?>
            </select>
            <br />
            <span id="error_selecr_user" style="display: none;color: red;" >Please Select User.</span>
             <br />
            <input type="submit" name="submit" value="Make Admin" />
              <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/chosen.jquery.js"></script>
              <script type="text/javascript">
                var config = {
                  '.chosen-select'           : {},
                  '.chosen-select-deselect'  : {allow_single_deselect:true},
                  '.chosen-select-no-single' : {disable_search_threshold:10},
                  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                  '.chosen-select-width'     : {width:"95%"}
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
              </script>
              
           </form> 
            
        </div> 
    </div> 
    <div class="admin_login_form_box_details">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'users-grid',
                'htmlOptions'=>array('style'=>'padding: 0px'),
                'dataProvider'=>$model->searchadmin(),
                'filter'=>$model,
                'selectableRows'=>2,
                'columns'=>array(
                    array(
                            'class'=>'CCheckBoxColumn',
                            'id'=>'id',
                         ),         
                    'username',
                    'email',           
                    array(
                        'name'=>'status',
                        'value'=>'$data->status',
                        'filter' => Yii::app()->params['viewIsStatus'],
                    ),/*
                    array(
                        'header' => 'Action',
                        'template'=>'{update}', 
                        'class'=>'CButtonColumn',
                    ),*/
                ),
            )); ?>
    </div>
<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('Users/removeAdmin'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>

<script>
function showhide(){
     $('#make_admin_div').toggle();
}
function validation(){
     var temp=$("#select_user").val();
     $("#error_selecr_user").hide();
     if(temp==""){
        $("#error_selecr_user").show();
        return false;
     }
}
$(document).ready(function(){
     $('#make_admin_div').hide();
})
</script>