<?php

/**
 * This is the model class for table "dialogs".
 *
 * The followings are the available columns in table 'dialogs':
 * @property integer $id
 * @property integer $user_id
 * @property string $dialog_title
 * @property string $dialog_description
 * @property string $status
 * @property string $created_date
 */
class Dialogs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dialogs the static model class
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
		return 'dialogs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, dialog_title, status, created_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('dialog_title', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
                        array('hide', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, dialog_title, dialog_description, status, created_date, hide', 'safe', 'on'=>'search'),
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
                'dialogs_username'=>array(self::BELONGS_TO,'Users','user_id'),
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Dialog ID',
			'user_id' => 'Created By',
			'dialog_title' => 'Dialog Name',
			'dialog_description' => 'Dialog Description',
			'status' => 'Status',
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
		$criteria->compare('dialog_title',$this->dialog_title,true);
		$criteria->compare('dialog_description',$this->dialog_description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);

                  $sort = new CSort();
        $sort->defaultOrder='created_date DESC'; 
       

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' =>$sort,
		));
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}