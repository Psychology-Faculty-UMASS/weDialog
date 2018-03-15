<?php

/**
 * This is the model class for table "team".
 *
 * The followings are the available columns in table 'team':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $members
 * @property integer $posts
 * @property string $created_date
 */
class Team extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Team the static model class
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
		return 'team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('name','unique'),
			array('members, posts', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('status,user_id, description, created_date','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,user_id,status, name, description, members, posts, created_date, dialog_id', 'safe', 'on'=>'search'),
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
            'team_to_member_relation'=>array(self::HAS_MANY,'TeamMember','team_id'),
            'team_to_member_relation'=>array(self::HAS_MANY,'TeamComment','team_id'),
		    'team_to_user_relation'=>array(self::BELONGS_TO,'Users','user_id'),
            'all_posts_relation'=>array(self::HAS_MANY,'AllPosts','main_id','condition'=>'post_type=3 AND status=1','order'=>'created_date DESC'),
                'dialog_id'=>array(self::BELONGS_TO,'Dialogs','dialog_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'user_id' =>'User',
			'name' => 'Name',
			'description' => 'Description',
			'members' => 'Members',
			'posts' => 'Posts',
                        'status' => 'Status',
			'created_date' => 'Created Date',
                        'dialog_id' => 'Dialog ID'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('members',$this->members);
		$criteria->compare('posts',$this->posts);
        $criteria->compare('status',$this->status,true);        
		$criteria->compare('created_date',$this->created_date,true);
                $criteria->compare('dialog_id',$this->dialog_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}