<?php

/**
 * This is the model class for table "topic_question_answer".
 *
 * The followings are the available columns in table 'topic_question_answer':
 * @property integer $id
 * @property integer $user_id
 * @property integer $topic_id
 * @property integer $post_id
 * @property string $question1
 * @property string $answer1
 * @property string $question2
 * @property string $answer2
 * @property string $question3
 * @property string $answer3
 * @property string $college
 * @property string $created_date
 */
class TopicQuestionAnswer extends CActiveRecord
{	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TopicQuestionAnswer the static model class
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
		return 'topic_question_answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, topic_id, post_id, question1, answer1, question2, answer2, question3, answer3', 'required'),
			array('user_id, topic_id, post_id','numerical', 'integerOnly'=>true),
			array('question1, question2, question3,ip_address', 'length', 'max'=>255),
			array('type','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id,ip_address,topic_id, post_id, question1, answer1, question2, answer2, question3, answer3,type,created_date', 'safe', 'on'=>'search'),
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
            'ip_address'=>'Ip Address',
			'topic_id' => 'Topic',
			'post_id' => 'Post',
			'question1' => 'Question1',
			'answer1' => 'Answer1',
			'question2' => 'Question2',
			'answer2' => 'Answer2',
			'question3' => 'Question3',
			'answer3' => 'Answer3',
			'college' => 'College',
            'type'=>'Type',
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
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('question1',$this->question1,true);
		$criteria->compare('answer1',$this->answer1,true);
		$criteria->compare('question2',$this->question2,true);
		$criteria->compare('answer2',$this->answer2,true);
		$criteria->compare('college',$this->college,true);
		$criteria->compare('question3',$this->question3,true);
		$criteria->compare('answer3',$this->answer3,true);
        $criteria->compare('type',$this->type,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}