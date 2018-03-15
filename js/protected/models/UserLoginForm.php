<?php
/**
 * UserLoginForm class.
 * UserLoginForm is the data structure for keeping user login form data. 
 */
class UserLoginForm extends CFormModel
{
	public $email;
	public $password;
    public $remember_me;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, password', 'required'),
			
			// password needs to be authenticated
			//array('password', 'authenticate'),
			
			// email should be a valid email address.
			array('email','email','message'=>'Please Enter Valid Email.'),
			
	        // Length validations for email and password fields.
			array('email','length','max'=>512),
			array('password','length','min'=>4,'max'=>12),
			
			array('email, password,remember_me', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
			'password'=>'Password',
    	);
	}
		
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	
	/**
	 * Logs in the user using the given username and password in the model.
	 */	
    		
}