<?php

/**
 * This is the model class for table "category_tags".
 *
 * The followings are the available columns in table 'category_tags':
 * @property integer $id
 * @property string $cat_tag
 * @property string $cat_tag_description
 * @property integer $user_id
 * @property string $created_date
 */
class CategoryTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoryTags the static model class
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
		return 'category_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_tag ', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('cat_tag', 'length', 'max'=>255),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
			array('cat_tag_description,user_id, created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,status,cat_tag, cat_tag_description, user_id, created_date, dialog_id', 'safe', 'on'=>'search'),
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
                    'categoryTags_username'=>array(self::BELONGS_TO,'Users','user_id'),
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
			'cat_tag' => 'Tag',
			'cat_tag_description' => 'Tag Description',
			'user_id' => 'User',
			'created_date' => 'Date',
                        'status'=>'Status',
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
		$criteria->compare('cat_tag',$this->cat_tag,true);
		$criteria->compare('cat_tag_description',$this->cat_tag_description,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_date',$this->created_date,true);
                $criteria->compare('status',$this->status,true);
                $criteria->compare('dialog_id',$this->dialog_id,true);
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
    
	public function validationOk()
	{
		if ( $this->validate() && $this->isCatTagUnique()) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isCatTagUnique()
	{
		if ( CategoryTags::model()->exists('cat_tag = :cat_tag',array(':cat_tag'=>$this->cat_tag)) ) {
			$this->addError('cat_tag','This category tag is already exists.');
			return false;
		} else {
			return true;
		}
	}    
    
}