<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
  /**
   * @var integer The unique user id.
   */
  private $_id;
  /**
   * @var string The unique user email to use for authentication.
   */
  public $email;
  
  
  /**
   * Constructor.
   * @param string $email user email
   * @param string $password password
   */
  public function __construct($email,$password)
  {
    $this->email=$email;
    $this->password=$password;
  }
  
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// Load user from database.
		$record = User::model()->findByAttributes(array('email' => $this->email));
	  
		// Validate login information.
		if($record === NULL) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($record->password !== md5(Yii::app()->params['salt'] . $this->password)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else { // Successful
			$this->errorCode=self::ERROR_NONE;
			$this->_id = $record->id;
			// Set persistent vars for this session.
			$this->setState('title', $record->title);
		}
		return !$this->errorCode;
	}
	
	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link _id}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->_id;
	}
}