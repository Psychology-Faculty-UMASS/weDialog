<?php

/**
 * This is the model class for table "type_tags".
 *
 * The followings are the available columns in table 'type_tags':
 * @property integer $id
 * @property string $type_tag
 * @property string $type_tag_description
 * @property integer $user_id
 * @property string $created_date
 */
class TypeTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TypeTags the static model class
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
		return 'type_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_tag', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('type_tag', 'length', 'max'=>255),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
				array('status,type_tag_description,user_id, created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,status, type_tag, type_tag_description, order_no ,user_id, created_date, dialog_id', 'safe', 'on'=>'search'),
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
                    'typeTags_username'=>array(self::BELONGS_TO,'Users','user_id'),
                    'tag_type_like_user_relation'=>array(self::HAS_MANY,'TagTypeLikeUser','type_tags_id'),
                    'tag_type_to_comment_relation'=>array(self::HAS_MANY,'TypeTagsComment','type_tag_id','order'=>'id DESC'),
                    'all_posts_relation'=>array(self::HAS_MANY,'AllPosts','main_id','condition'=>'post_type=2 AND status=1','order'=>'created_date DESC'),
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
			'type_tag' => 'Type Tag',
			'type_tag_description' => 'Type Tag Description',
            'order_no'=>'Order',
			'user_id' => 'User',
            'status'=>'Status',
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
		$criteria->compare('type_tag',$this->type_tag,true);
		$criteria->compare('type_tag_description',$this->type_tag_description,true);
        $criteria->compare('order_no',$this->order_no,true);
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
                $criteria->compare('dialog_id',$this->dialog_id,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
	public function validationOk()
	{
		if ( $this->validate() && $this->isTypeTagUnique()) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isTypeTagUnique()
	{
		if ( TypeTags::model()->exists('type_tag = :type_tag',array(':type_tag'=>$this->type_tag)) ) {
			$this->addError('type_tag','This Rules tag is already exists.');
			return false;
		} else {
			return true;
		}
	}    
}