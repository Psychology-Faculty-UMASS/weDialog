<?php
class PermissionController extends Controller
{
    
    public function actionIndex(){
        $this->layout = 'column2';
        $this->render('permission_list',$this->data);
    }
    
    public function actionGetGroupPermissionList(){
         $criteria= new CDbCriteria;
         $criteria->order='t.created_at DESC';
         $command=Yii::app()->db->createCommand($sql);
         $this->data['permissions'] = Yii::app()->db->createCommand()
                                ->select('ma.*,m.name as name')
                                ->from('module_actions ma')
                                ->join('modules m','ma.module_id=m.id')
                                ->order('m.id')
                                ->queryAll();
          if(isset($_POST['group_id']) && $_POST['group_id'] > 0){
                $this->data['group_permissions'] = Yii::app()->db->createCommand()
                        ->select('gma.*')
                        ->from('groups_module_actions gma')
                        ->join('module_actions ma','gma.module_action_id=ma.id')
                        ->where('group_id='.$_POST['group_id'])
                        ->queryAll();
          }else{
                $this->data['group_permissions'] = array();  
          }
          $this->renderPartial('_group_list',$this->data);
    }
    
    public function actionSaveGroupPermissions(){
        
        if(isset($_POST['group']) && $_POST['group']>0){
            GroupsModuleActions::model()->deleteAll(array('condition'=>'group_id='.$_POST['group']));
            $sql = "INSERT INTO groups_module_actions(group_id,module_action_id) VALUES ";
            $val = null;
            if(isset($_POST['permission']) && count($_POST['permission']) > 0){
                foreach($_POST['permission'] as $permission){
                    $val.="(".$_POST['group'].",".$permission."),";
                }
            }
            $val=TRIM($val,',');
            if($val!=''){
                $sql.=$val;
                $command=Yii::app()->db->createCommand($sql);
                $flag = $command->query();
            }
             
            Yii::app()->user->setFlash('success_msg', "Permissions have been saved successfully.");
            $this->redirect(array('permission/index'),false);
        }else{
            Yii::app()->user->setFlash('failure_msg', "Some Problem occured at the Server. Kindly try after sometime.");
            $this->redirect(array('permission/index'),false);
        }
    }
}
?>