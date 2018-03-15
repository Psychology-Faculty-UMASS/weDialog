<?php

/**
 * This is the model class for table "topic_questions".
 *
 * The followings are the available columns in table 'topic_questions':
 * @property integer $id
 * @property integer $topic_id
 * @property integer $user_id
 * @property string $question1
 * @property string $option1
 * @property string $question2
 * @property string $option2
 * @property string $question3
 * @property string $option3
 * @property integer $status
 * @property string $date_created
 */
class TopicQuestions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TopicQuestions the static model class
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
		return 'topic_questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('topic_id, user_id, question1, option1, question2, option2, question3, option3', 'required'),
			array('topic_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('question1, question2, question3', 'length', 'max'=>255),
			array('post_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic_id, user_id, question1, option1, question2, option2, question3, option3, status, date_created', 'safe', 'on'=>'search'),
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
            'topicquestion_to_user_relation'=>array(self::BELONGS_TO,'Users','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'topic_id' => 'Topic',
			'user_id' => 'User',
			'question1' => 'Question1',
			'option1' => 'Option1',
			'question2' => 'Question2',
			'option2' => 'Option2',
			'question3' => 'Question3',
			'option3' => 'Option3',
			'status' => 'Status',
			'date_created' => 'Date Created',
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('question1',$this->question1,true);
		$criteria->compare('option1',$this->option1,true);
		$criteria->compare('question2',$this->question2,true);
		$criteria->compare('option2',$this->option2,true);
		$criteria->compare('question3',$this->question3,true);
		$criteria->compare('option3',$this->option3,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}