<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Users::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
            $this->setSession($user);
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
    
    public static function setSession(&$user){
        if($user->status){
            Yii::app()->session['user_id'] = $user->id;
            Yii::app()->session['email'] = $user->email;
            Yii::app()->session['group_id'] = $user->group_id;
            Yii::app()->session['username'] = $user->username;
            //Yii::app()->session['lname'] = $user->lname;
            //Yii::app()->session['twitter_id'] = $user->twitter_id;
            return true;
        }else{
            return false;
        }
    }    
    
}