<?php

/**
 * This is the model class for table "type_tags_comment_flag".
 *
 * The followings are the available columns in table 'type_tags_comment_flag':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_tags_comment_id
 * @property integer $commented_by
 * @property integer $flag_reason_id
 * @property string $flag_type
 * @property integer $block_user
 * @property integer $hide_post
 * @property integer $adminprocess
 * @property string $created_date
 */
class TypeTagsCommentFlag extends CActiveRecord
{
    public $author_status;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TypeTagsCommentFlag the static model class
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
		return 'type_tags_comment_flag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_tags_comment_id, commented_by, flag_reason_id, flag_type', 'required'),
			array('user_id, type_tags_comment_id, commented_by, flag_reason_id, block_user, hide_post, adminprocess', 'numerical', 'integerOnly'=>true),
			array('flag_type', 'length', 'max'=>5),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('flag_status,user_id, created_date','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,author_status,flag_status, user_id, type_tags_comment_id, commented_by, flag_reason_id, flag_type, block_user, hide_post, adminprocess, created_date', 'safe', 'on'=>'search'),
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
            'relation_type_tags_comment_id'=>array(self::BELONGS_TO,'TypeTagsComment','type_tags_comment_id'),
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
			'type_tags_comment_id' => 'Rule Comment',
			'commented_by' => 'Commented By',
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		//$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('type_tags_comment_id',$this->type_tags_comment_id);
		//$criteria->compare('commented_by',$this->commented_by);
		//$criteria->compare('flag_reason_id',$this->flag_reason_id);
		$criteria->compare('t.flag_type',$this->flag_type,true);
		$criteria->compare('block_user',$this->block_user);
		$criteria->compare('hide_post',$this->hide_post);
		$criteria->compare('adminprocess',$this->adminprocess);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('flag_status',$this->flag_status);
        $criteria->compare("relation_commented_by.status",$this->author_status); 
        $criteria->with = array('relation_user','relation_type_tags_comment_id','relation_flag_reason_id','relation_commented_by');
		$criteria->compare("relation_user.username",$this->user_id,true);
        $criteria->compare("relation_type_tags_comment_id.comment",$this->type_tags_comment_id,true);
        $criteria->compare("relation_commented_by.username",$this->commented_by,true);
        $criteria->compare("relation_flag_reason_id.reason",$this->flag_reason_id,true);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 'sort'=>array( 'defaultOrder'=>'t.id DESC', ),
		));
	}
}