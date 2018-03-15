<div class="group_permission_list">
<?php
if(isset($permissions) && count($permissions) > 0){
$m_id=0;
$div_cnt=0;
foreach($permissions as $permission){
    $flag=false;
    if(isset($group_permissions) && count($group_permissions) > 0){
        foreach($group_permissions as $group_permission){
            if($permission['id']==$group_permission['module_action_id']){
                $flag=true;
            }
        }
    }
    if($m_id!=$permission['module_id']){
        $m_id_last =$m_id;
        $m_id =$permission['module_id'];
        $cnt=0;
?>
<?php if($m_id_last!=0){?>
</ul>
<?php } ?>
<?php if($div_cnt==4){$div_cnt=1; ?>
</div>
<?php }else{$div_cnt++;}?>
<?php if($div_cnt==1){?>
<div class="list_group">
<?php } ?>
<p><strong><?php echo $permission['name'];?></strong></p>
<ul>
<?php }else{ $cnt++; } ?>
<li><input type="checkbox" name="permission[]" id="permission_<?php echo $permission['id'];?>" value="<?php echo$permission['id'];?>" <?php if($flag){echo "checked=checked";}?>/>&nbsp;<label><?php echo $permission['action'];?></label></li>
<?php } ?>
<?php } ?>
</div>