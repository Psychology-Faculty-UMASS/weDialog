<?php

/**
 * This is the model class for table "comment_reply".
 *
 * The followings are the available columns in table 'comment_reply':
 * @property integer $id
 * @property integer $comment_id
 * @property integer $topic_id
 * @property integer $user_id
 * @property string $reply
 * @property string $created_date
 */
class CommentReply extends CActiveRecord
{
	
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommentReply the static model class
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
		return 'comment_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_id, user_id, reply', 'required'), 
			array('comment_id, user_id', 'numerical', 'integerOnly'=>true),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('created_date,topic_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comment_id, user_id, reply, created_date', 'safe', 'on'=>'search'),
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
        'reply_comment'=>array(self::BELONGS_TO,'UserComment','comment_id'),
        'reply_user'=>array(self::BELONGS_TO,'Users','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'comment_id' => 'Comment',
			'user_id' => 'User',
			'reply' => 'Reply',
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
		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('reply',$this->reply,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}