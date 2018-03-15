<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $login_username
 * @property string $login_password
 * @property string $email
 */
class Admin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login_username, login_password, email', 'required'),
			array('email', 'email'),
			array('login_username, login_password, email,login_check, ip_address_check', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login_username, login_password, email,login_check, ip_address_check', 'safe', 'on'=>'search'),
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
			'login_username' => 'Login Username',
			'login_password' => 'Login Password',
			'email' => 'Email',
                        'login_check'=>'Login Check',
                        'ip_address_check'=>'Check IP address'
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
		$criteria->compare('login_username',$this->login_username,true);
		$criteria->compare('login_password',$this->login_password,true);
		$criteria->compare('email',$this->email,true);
                $criteria->compare('login_check',$this->login_check,true);
                $criteria->compare('ip_address_check',$this->login_check,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function logout(){
		echo "in logout";exit;
	}

	 protected function beforeSave()
    {
        if(parent::beforeSave()){
            $this->login_password = md5($this->login_password);   
        }
        return true;
    }
}