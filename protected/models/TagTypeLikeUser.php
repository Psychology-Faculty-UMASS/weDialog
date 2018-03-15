<?php

/**
 * This is the model class for table "tag_type_like_user".
 *
 * The followings are the available columns in table 'tag_type_like_user':
 * @property integer $id
 * @property integer $type_tags_id
 * @property integer $user_id
 * @property integer $like
 * @property integer $dislike
 * @property string $created_date
 */
class TagTypeLikeUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TagTypeLikeUser the static model class
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
		return 'tag_type_like_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_tags_id, user_id, created_date', 'required'),
			array('type_tags_id, user_id, like, dislike', 'numerical', 'integerOnly'=>true),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_tags_id, user_id, like, dislike, created_date', 'safe', 'on'=>'search'),
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
            'tag_type_relation'=>array(self::BELONGS_TO,'TypeTags','type_tags_id'),
            'like_user_relation'=>array(self::BELONGS_TO,'Users','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_tags_id' => 'Type Tags',
			'user_id' => 'User',
			'like' => 'Like',
			'dislike' => 'Dislike',
			'created_date' => 'Created Date',
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
		$criteria->compare('type_tags_id',$this->type_tags_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('like',$this->like);
		$criteria->compare('dislike',$this->dislike);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}