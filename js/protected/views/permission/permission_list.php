<script type="text/javascript">
 
function selectAll(){
    
}
function checkAll(obj) {
  var cbs = document.getElementsByTagName('input');
  var flag=true;
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
        if(cbs[i].checked){
            flag=false;
            cbs[i].checked = false;
        }else{
            cbs[i].checked = true;
        }
    }
  }
  if(flag){
    obj.value="Uncheck All";
  }else{
    obj.value="Check All";
  }
}
function getPermissionList(obj){
    if(obj && obj.value >0){
        document.getElementById('select_all').style.display='block';
        getResponse(obj.value);
    }
}
function getResponse(group_id){ 
 
    $.ajax({
        type: "POST",
        url: '<?php echo Yii::app()->request->baseUrl;?>/permission/getGroupPermissionList',
        data: { group_id:group_id}
    }).done(function( response ) {
        $("#permission_list").html(response);
    });
   
}
</script>
<div class="mid-cont">
<?php  $this->renderPartial('/partials/_flash_msgs',$this->data); ?>
<form method="POST" name="permission_list_form" id="permission_list_form" action="<?php echo $this->createUrl('permission/saveGroupPermissions'); ?>">
<?php 
if(isset($groups) && count($groups) > 0){?>
<label><strong>Groups:</strong></label>
<select name="group" id="group" onchange="getPermissionList(this);">
<option value="0">Select Group</option>
<?php foreach($groups as $key=>$val){?>
<option value="<?php echo $val; ?>"><?php echo $key; ?></option>
<?php } ?>
</select>
<input type="button" id="select_all" name="select_all" value="Check All" align="right" style="float: right;display: none;" onclick="checkAll(this);" />
<input type="submit" name="submit" value="Save" align="right" style="float: right;;" />
<?php } ?>

<div id="permission_list"></div>
<div style="clear:both"></div>
</form>

</div>