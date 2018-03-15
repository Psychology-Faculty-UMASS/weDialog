<?php

/**
 * This is the model class for table "topics".
 *
 * The followings are the available columns in table 'topics':
 * @property integer $id
 * @property integer $user_id
 * @property string $topic_title
 * @property string $topic_description
 * @property string $category_tags
 * @property string $type_tags
 * @property string $created_date
 * @property string $status
 */
class Topics extends CActiveRecord
{
    public $count_topics;
    public $lasttime;
    public $Lastdatetime;
    public $Totalcommentscount;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topics the static model class
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
		return 'topics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, topic_title, topic_description', 'required'),
            array('user_id, topic_title ', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
                        array('pin_to_top', 'numerical'),
			array('topic_title', 'length', 'max'=>255),
			array('category_tags', 'length', 'max'=>255),
            array('type_tags', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
            array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, topic_title, topic_description, created_date, status, dialog_id', 'safe', 'on'=>'search'),
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
            'topics_username'=>array(self::BELONGS_TO,'Users','user_id'),
            'all_posts_relation'=>array(self::HAS_MANY,'AllPosts','main_id','condition'=>'post_type=1 AND status=1','order'=>'created_date DESC'),
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
			'user_id' => 'User',
			'topic_title' => 'Topic Title',
			'topic_description' => 'Topic Description',
            'category_tags' => 'Category Tags',
            'type_tags' => 'Rules',
			'created_date' => 'Created Date',
			'status' => 'Status',
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
		$criteria->compare('topic_title',$this->topic_title,true);
		$criteria->compare('topic_description',$this->topic_description,true);
        $criteria->compare('category_tags',$this->category_tags,true);
        $criteria->compare('type_tags',$this->type_tags,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status);
                $criteria->compare('dialog_id',$this->dialog_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}