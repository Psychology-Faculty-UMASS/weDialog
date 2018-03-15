<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $details
 * @property string $created_at
 * @property string $updated_at
 */
class Groups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groups the static model class
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
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slug, name, details', 'required'),
			array('slug', 'length', 'max'=>100),
			array('name', 'length', 'max'=>512),
			array('created_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('updated_at','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
			array('updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slug, name, details, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'slug' => 'Slug',
			'name' => 'Name',
			'details' => 'Details',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
	public static function getAllGroups()
	{
		return CHtml::listData(Groups::model()->findAll(array('order'=>'id')),'id','name');
	}
	
	/**
	 * Returns Group Id from the given slug-field. 
	 */
    public static function getGroupId($slug_value)
	{
		$groupsModel = Groups::model()->findByAttributes(array('slug'=>$slug_value));
		return $groupsModel->id;
	}
    
    
    
}