<?php

/**
 * This is the model class for table "category_groups".
 *
 * The followings are the available columns in table 'category_groups':
 * @property integer $id
 * @property string $category
 * @property string $groups
 * @property integer $total
 * @property string $created_by
 * @property string $date
 * @property string $status
 */
class CategoryGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoryGroups the static model class
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
		return 'category_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, groups, created_by', 'required'),
			array('total', 'numerical', 'integerOnly'=>true),
			array('category, groups, created_by', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, groups, total, created_by, date, status, dialog_id', 'safe', 'on'=>'search'),
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
			'category' => 'Category',
			'groups' => 'Groups',
			'total' => 'Total',
			'created_by' => 'Created By',
			'date' => 'Date',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('groups',$this->groups,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status,true);
                $criteria->compare('dialog_id',$this->dialog_id,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}