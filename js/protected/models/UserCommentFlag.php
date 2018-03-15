<?php

/**
 * This is the model class for table "user_comment_flag".
 *
 * The followings are the available columns in table 'user_comment_flag':
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_comment_id
 * @property integer $flag_reason_id
 * @property string $flag_type
 * @property integer $block_user
 * @property integer $hide_post
 * @property integer $adminprocess
 * @property string $created_date
 */
class UserCommentFlag extends CActiveRecord
{
	
    public $author_status;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserCommentFlag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_comment_flag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_comment_id,commented_by, flag_reason_id, flag_type', 'required'),
			array('user_id, user_comment_id, flag_reason_id, block_user, hide_post, adminprocess', 'numerical', 'integerOnly'=>true),
			array('flag_type', 'length', 'max'=>5),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('flag_status,user_id, created_date','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,author_status, flag_status, commented_by ,user_id, user_comment_id, flag_reason_id, flag_type, block_user, hide_post, adminprocess, created_date', 'safe', 'on'=>'search'),
			array('id,author_status, flag_status, commented_by ,user_id, user_comment_id, flag_reason_id, flag_type, block_user, hide_post, adminprocess, created_date', 'safe', 'on'=>'searchallflag'),
		
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'relation_user'=>array(self::BELONGS_TO,'Users','user_id'),
            'relation_commented_by'=>array(self::BELONGS_TO,'Users','commented_by'),
            
            'relation_user_comment_id'=>array(self::BELONGS_TO,'UserComment','user_comment_id'),
            'relation_flag_reason_id'=>array(self::BELONGS_TO,'FlagReason','flag_reason_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Flag User',
			'user_comment_id' => 'User Comment',
            'commented_by' =>'Comment By',
			'flag_reason_id' => 'Flag Reason',
			'flag_type' => 'Flag',
			'block_user' => 'Block User',
			'hide_post' => 'Hide Post',
			'adminprocess' => 'Admin Process',
			'created_date' => 'Created Date',
            'flag_status' =>'Active Flag',
            
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchallflag()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('t.flag_type',$this->flag_type,true);
		$criteria->compare('block_user',$this->block_user);
		$criteria->compare('hide_post',$this->hide_post);
		$criteria->compare('adminprocess',$this->adminprocess);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('flag_status',$this->flag_status); 
		$criteria->compare("relation_commented_by.status",$this->author_status);
		$criteria->compare("relation_user.username",$this->user_id,true);
        $criteria->compare("relation_user_comment_id.comment",$this->user_comment_id,true);
        $criteria->compare("relation_commented_by.username",$this->commented_by);
        $criteria->compare("relation_flag_reason_id.reason",$this->flag_reason_id,true);
        $criteria->with = array('relation_user','relation_user_comment_id','relation_flag_reason_id','relation_commented_by');
        
		$topic_flags =  new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>false,
            //'sort'=>array( 'defaultOrder'=>'t.id DESC', ),
		));
        
        
 		$rulecriteria=new CDbCriteria;
		$rulecriteria->compare('id',$this->id);
		$rulecriteria->compare('t.flag_type',$this->flag_type,true);
		$rulecriteria->compare('block_user',$this->block_user);
		$rulecriteria->compare('hide_post',$this->hide_post);
		$rulecriteria->compare('adminprocess',$this->adminprocess);
		$rulecriteria->compare('created_date',$this->created_date,true);
        $rulecriteria->compare('flag_status',$this->flag_status); 
		$rulecriteria->compare("relation_commented_by.status",$this->author_status);
		$rulecriteria->compare("relation_user.username",$this->user_id,true);
        $rulecriteria->compare("relation_type_tags_comment_id.comment",$this->user_comment_id,true);
        $rulecriteria->compare("relation_commented_by.username",$this->commented_by);
        $rulecriteria->compare("relation_flag_reason_id.reason",$this->flag_reason_id,true);
        $rulecriteria->with = array('relation_user','relation_type_tags_comment_id','relation_flag_reason_id','relation_commented_by');
        
		$rule_flags =  new CActiveDataProvider('TypeTagsCommentFlag', array(
			'criteria'=>$rulecriteria,
            'pagination'=>false,
            //'sort'=>array( 'defaultOrder'=>'t.id DESC', ),
		));       
        
 		$teamcriteria=new CDbCriteria;
		$teamcriteria->compare('id',$this->id);
		$teamcriteria->compare('t.flag_type',$this->flag_type,true);
		$teamcriteria->compare('block_user',$this->block_user);
		$teamcriteria->compare('hide_post',$this->hide_post);
		$teamcriteria->compare('adminprocess',$this->adminprocess);
		$teamcriteria->compare('created_date',$this->created_date,true);
        $teamcriteria->compare('flag_status',$this->flag_status); 
		$teamcriteria->compare("relation_commented_by.status",$this->author_status);
		$teamcriteria->compare("relation_user.username",$this->user_id,true);
        $teamcriteria->compare("relation_team_comment_id.comment",$this->user_comment_id,true);
        $teamcriteria->compare("relation_commented_by.username",$this->commented_by);
        $teamcriteria->compare("relation_flag_reason_id.reason",$this->flag_reason_id,true);
        $teamcriteria->with = array('relation_user','relation_team_comment_id','relation_flag_reason_id','relation_commented_by');
        
		$team_flags =  new CActiveDataProvider('TeamCommentFlag', array(
			'criteria'=>$teamcriteria,
            'pagination'=>false,
            //'sort'=>array( 'defaultOrder'=>'t.id DESC', ),
		));       
        
        $records = array();
        for ($i = 0; $i < $topic_flags->totalItemCount; $i++) {
            $data = $topic_flags->data[$i];
            array_push($records, $data);
        }
        for ($i = 0; $i < $rule_flags->totalItemCount; $i++) {
            $data = $rule_flags->data[$i];
            array_push($records, $data);
        }
        
        for ($i = 0; $i < $team_flags->totalItemCount; $i++) {
            $data = $team_flags->data[$i];
            array_push($records, $data);
        }        
        
        return new CArrayDataProvider($records,
                array(
                    //'sort' =>$sort,
                    'pagination'=>array('pageSize'=>40),
                )
        );        
        
	}
    
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		//$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('user_comment_id',$this->user_comment_id);
		//$criteria->compare('flag_reason_id',$this->flag_reason_id);
		$criteria->compare('t.flag_type',$this->flag_type,true);
		$criteria->compare('block_user',$this->block_user);
		$criteria->compare('hide_post',$this->hide_post);
		$criteria->compare('adminprocess',$this->adminprocess);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('flag_status',$this->flag_status); 
		$criteria->compare("relation_commented_by.status",$this->author_status);
		$criteria->compare("relation_user.username",$this->user_id,true);
        $criteria->compare("relation_user_comment_id.comment",$this->user_comment_id,true);
        $criteria->compare("relation_commented_by.username",$this->commented_by);
        $criteria->compare("relation_flag_reason_id.reason",$this->flag_reason_id,true);
        $criteria->with = array('relation_user','relation_user_comment_id','relation_flag_reason_id','relation_commented_by');
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 'sort'=>array( 'defaultOrder'=>'t.id DESC', ),
		));
	}        
    
    
}