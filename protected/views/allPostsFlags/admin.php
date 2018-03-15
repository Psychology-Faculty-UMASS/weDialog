<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/admin_manage_add.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/admin.css" rel="stylesheet" type="text/css" />
<?php
$this->breadcrumbs=array(
	'Posts Flags',
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
                    <?php
                    if($this->data["group_id"]=="1"){ ?>
                        <span>
                            <a href="javascript:void(0)" style="text-decoration: none" onclick="javascript:delete_records();" title="Delete selected Flag(s)">
                                <img src="<?php  echo Yii::app()->request->baseUrl;?>/images/delete-new-icon.png" width="23" height="23" />
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
             ),
 /*           array(
                'name'=>'post_type',
                'value'=>'Yii::app()->params["PostType"][$data->post_type]',
                'filter'=>Yii::app()->params['PostType'],
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ), */
                     

            array(
                'header'=>'Post',
                'type'  => 'raw',
                'name'=>'all_posts_id',
                'value'=>function($data){
                        if($data->post_type == 1)
                        {
                             return CHtml::link($data->flag_to_post_relation->comment,Yii::app()->createUrl("Topics/viewtopic",array("topic_id"=>$data->flag_to_post_relation->main_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; text-decoration: none;"));
                        }
                        else if($data->post_type == 2)
                        {
                             return CHtml::link($data->flag_to_post_relation->comment,Yii::app()->createUrl("TypeTags/viewrule",array("tag_id"=>$data->flag_to_post_relation->main_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; text-decoration: none;"));
                        }
                        else if($data->post_type == 3)
                        {
                             return CHtml::link($data->flag_to_post_relation->comment,Yii::app()->createUrl("team/viewteam",array("id"=>$data->flag_to_post_relation->main_id )), array("target"=>"_blank","style"=>"color: #065A95;font-size: 14px; text-decoration: none;"));
                        }
                 }, 
            	//'filter' =>array('1'=>'YES','0'=>'NO'),
            ),            
              
            array(
                'header'=>'Author',
                'name'=>'commented_by',
//                'value'=>'$data->relation_commented_by->username',
                'value'=>'myhelpers::getAuthor($data->all_posts_id)',
                'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'username'),
                'filterHtmlOptions'=>array('style'=>'width: 10%;'),
            ),
			 array(
                'header'=>'Flag Type',
                'name'=>'flag_type',
                'value'=>'$data->flag_type',
                'filter' =>array('Green'=>'Green','Red'=>'Red'),
                'filterHtmlOptions'=>array('style'=>'width:7%;'),
            ),   
    	    array(
                'header'=>'Reason',
                'name'=>'flag_reason_id',
                'value'=>'$data->relation_flag_reason_id->reason',
                'filterHtmlOptions'=>array('style'=>'width: 10%;'),
            ),
            array(
                'header'=>'Flagger',
                'name'=>'user_id',
                'value'=>'$data->relation_user->username',
                'filter' => CHtml::listData(Users::model()->findAll(), 'id', 'username'),
                'filterHtmlOptions'=>array('style'=>'width: 10%;'),
            ),                  
            array(
                'header'=>'Date',
                'name'=>'created_date',
                'value'=>'date("m-d-Y",strtotime($data->created_date))',
                'filter'=>'',
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),
            array(
                'header'=>'Hide Post',
                'name'=>'hide_post',
                'value'=>'$data->hide_post ? YES : NO ',
               	'filter' =>array('1'=>'YES','0'=>'NO'),
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),             
            array(
                'header'=>'Remove Flag',
                'name'=>'flag_status',
                //'value'=>'Yii::app()->params["viewStatus"][$data->flag_status]',
                //'filter' => Yii::app()->params['viewStatus'],
                'value'=>'$data->flag_status ? NO : YES ',
               	'filter' =>array('1'=>'YES','0'=>'NO'),
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),
            ),  
            array(
                'header'=>'Block Author',
                'name'=>'author_status',
                'value'=>'$data->relation_commented_by->status',
                'filter' => Yii::app()->params['viewIsStatus'],
                'filterHtmlOptions'=>array('style'=>'width: 5%;'),                
            ),                                              
	),
)); ?>

<form name="checked_items" method="POST" action="<?php echo Yii::app()->createUrl('AllPostsFlags/manageallpostsflags'); ?>">
	<input type="hidden" id="selected_ids" name="selected_ids" value="" />
	<input type="hidden" id="action_type" name="action_type" value="" />
</form>

<script>
//var options = $('select option');
//var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
//arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
//options.each(function(i, o) {
//  o.value = arr[i].v;
//  $(o).text(arr[i].t);
//});

//, attr, order

var sortSelect = function (select, attr, order) {
    if(attr === 'text'){
        if(order === 'asc'){
            $(select).html($(select).children('option').sort(function (x, y) {
                return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
            }));
            $(select).get(0).selectedIndex = 0;
            e.preventDefault();
        }// end asc
        if(order === 'desc'){
            $(select).html($(select).children('option').sort(function (y, x) {
                return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
            }));
            $(select).get(0).selectedIndex = 0;
            e.preventDefault();
        }// end desc
    }

};

//, attr, order
$(document).ready(function () {

    $('#btnSort').click(function (e) {

        sortSelect('#ddlList', 'text', 'asc');

    }); // event listener click
    
    $("select").each(function() {
     $(this).html($(this).children('option').sort(function (x, y) {
//         $(this).text();
                return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
            }));
            $(this).val('');
        });

});
</script>