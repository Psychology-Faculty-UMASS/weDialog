<html>
<head>
  <meta http-equiv="refresh" content="0; url=http://wedialog.net/topics/TopicsList?dialog_id=36" />
</head>
<?php
/* @var $this DialogsController */
/* @var $models Dialogs */
?>
<style>
    .dialog_list_ul{
        font-family: Verdana;
        font-size: 22px;
        color: #3C1B85;
        list-style-type: none;
    }
    
    .dialog_list_ul hr{
        width: 508px;
        margin-left: -50px;
    }
    
    .dialog_list_ul li:hover{
        cursor: pointer;
    }
    
    .dialog_list_ul li{
        background: url('<?php echo Yii::app()->baseUrl;?>/images/bullet.png') no-repeat 0px 2px;
        padding-left: 34px;
        margin-left: -25px;
    }
</style>
<div style="clear:both"></div>
<div class="main">
    <div class="main_left">
        <?php $this->renderPartial('_left_panel'); ?>
    </div>
    <div class="main_mid new-width-t-r-t">
        <div class="dialogs">
            <div class="dialog_head">
                Dialogs

                    <?php if(Yii::app()->session['group_id']==1 || Yii::app()->session['group_id']==3){ ?> 
 
                    <a href="<?php echo Yii::app()->baseUrl;?>/dialogs/Createnewdialog" class="newdialog"><img src="<?php echo Yii::app()->baseUrl;?>/images/new-dialog.png"></a>
                <?php } ?>
            </div>
        </div>
        <div style="width:98%;display: block;padding-left: 10px;">
            <?php if(count($models)>0): ?>
                <ul class="dialog_list_ul">
                    <?php foreach($models as $model): ?>
                        <?php if($model->hide!=1): ?>
                        <li class="dialog-item" data-id="<?php echo $model->id; ?>" data-name="<?php echo $model->dialog_title; ?>" data-created-by="<?php echo $model->user_id; ?>"><?php echo $model->dialog_title; ?></li>
                        <hr/>
                        <?php elseif(Yii::app()->session['group_id']==1 || Yii::app()->session['group_id']==3): ?>
                        <li style="color:#999999" class="dialog-item" data-id="<?php echo $model->id; ?>" data-name="<?php echo $model->dialog_title; ?>" data-created-by="<?php echo $model->user_id; ?>"><?php echo $model->dialog_title; ?></li>
                        <hr/>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>There is not an active Dialog</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".dialog-item").click(function(){
            var id = $(this).attr("data-id");
            var createdBy = $(this).attr("data-created-by");
            var name = $(this).attr("data-name");
            $.ajax({
                type: "POST",
                url: '<?php echo Yii::app()->createUrl('dialogs/MakeDefaultDialog'); ?>',
                data: {id: id, name: name, createdBy: createdBy},
                success: function(data){
                    if(data=="ok") {
                        window.location.href = "<?php echo Yii::app()->createUrl('topics/TopicsList'); ?>?dialog_id="+id; 
                    }
                }
            });
        });
    });
</script>