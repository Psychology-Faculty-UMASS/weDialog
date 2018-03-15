<?php

/**
 * This is the model class for table "all_posts_flags".
 *
 * The followings are the available columns in table 'all_posts_flags':
 * @property integer $id
 * @property integer $user_id
 * @property integer $all_posts_id
 * @property integer $commented_by
 * @property integer $flag_reason_id
 * @property string $flag_type
 * @property integer $block_user
 * @property integer $hide_post
 * @property integer $adminprocess
 * @property integer $flag_status
 * @property string $created_date
 */
class AllPostsFlags extends CActiveRecord
{
	public $author_status;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AllPostsFlags the static model class
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
		return 'all_posts_flags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('all_posts_id, commented_by, flag_reason_id, flag_type', 'required'),
			array('user_id, all_posts_id, commented_by, flag_reason_id, block_user, hide_post, adminprocess, flag_status', 'numerical', 'integerOnly'=>true),
			array('flag_type', 'length', 'max'=>5),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('post_type,main_id,user_id,created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('author_status, post_type,main_id,id, user_id, all_posts_id, commented_by, flag_reason_id, flag_type, block_user, hide_post, adminprocess, flag_status, created_date', 'safe', 'on'=>'search'),
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
            'flag_to_post_relation'=>array(self::BELONGS_TO,'AllPosts','all_posts_id'),
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
			'user_id' => 'User',
			'all_posts_id' => 'All Posts',
            'main_id'=>'main_id',
            'post_type'=>'Post Type',
			'commented_by' => 'Commented By',
			'flag_reason_id' => 'Flag Reason',
			'flag_type' => 'Flag Type',
			'block_user' => 'Block User',
			'hide_post' => 'Hide Post',
			'adminprocess' => 'Adminprocess',
			'flag_status' => 'Status',
			'created_date' => 'Created Date',
            'author_status'=>'Author Status',
            
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
		$criteria->compare('user_id',$this->user_id);
		//$criteria->compare('all_posts_id',$this->all_posts_id);
        $criteria->compare("flag_to_post_relation.comment",$this->all_posts_id,true);
        $criteria->compare('main_id',$this->main_id);
        $criteria->compare('post_type',$this->post_type);
		$criteria->compare('flag_to_post_relation.user_id',$this->commented_by);
		$criteria->compare('flag_reason_id',$this->flag_reason_id);
		$criteria->compare('flag_type',$this->flag_type,true);
		$criteria->compare('block_user',$this->block_user);
		$criteria->compare('hide_post',$this->hide_post);
		$criteria->compare('adminprocess',$this->adminprocess);
		$criteria->compare('flag_status',$this->flag_status);
		$criteria->compare('t.created_date',$this->created_date,true);

        $criteria->compare("relation_commented_by.status",$this->author_status);
        $criteria->with = array('relation_commented_by','flag_to_post_relation');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array("defaultOrder"=>"t.created_date DESC")
		));
	}
}