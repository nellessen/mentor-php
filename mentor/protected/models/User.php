<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $gender
 * @property string $password
 *
 * The followings are the available model relations:
 * @property Goal[] $goals
 * 
 * The following attributes are available as virtual attributes:
 * @property string $title
 * @property string $admin
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className
 * @property Goal[] $goals1
 * @property Goal[] $goals2
 * @property Goal[] $goals3 active record class name.
	 * @return User the static model class
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
		return 'user';
	}
	
	/**
	 * Getter for the virtual attribute $title. It will be on of the following:
	 * - firstname lastname
	 * - firstname
	 * - lastname
	 * - email
	 */
	public function getTitle(){
	  if (empty($this->firstname) && empty($this->lastname))
	    return $this->email;
	  elseif (empty($this->firstname)) return $this->lastname;
	  elseif (empty($this->lastname)) return $this->firstname;
	  else return $this->firstname . ' ' . $this->lastname;
	}
	
	/**
	 * Getter for the virtual attribute $admin. Will be true for user 1 or
	 * false.
	 *
	 * @todo: Should be removed when we implemented a admin application.
	 */
	public function isAdmin(){
	  return $this->id == 1;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  // db constraints.
			array('email, password', 'required'),
			array('email, firstname, lastname, password', 'length', 'max'=>128),
			array('gender', 'in', 'range'=>array('male','female'),'allowEmpty'=>TRUE),
		  // Additional constraints.
			array('password', 'length', 'min'=>8),
      array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, firstname, lastname, gender', 'safe', 'on'=>'search'),
		  // Filters.
	    array('email, gender', 'filter', 'filter'=>'strtolower'),
	    // Make sure email is unique.
      array('email', 'unique'),
		);
	}
	
	/**
	 * Hashes the password using md5 and a configured salt if value has changed.
	 *
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
	  // Check if password was changed. If not, do not hash it again.
	  $record = User::model()->findByAttributes(array(
      'id' => $this->id,
      'password' => $this->password,
	  ));
	  if(!$record)
	    $this->password = md5(Yii::app()->params['salt'] . $this->password);
	  return TRUE;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'goals' => array(self::HAS_MANY, 'Goal', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'gender' => 'Gender',
			'password' => 'Password',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('gender',$this->gender,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}