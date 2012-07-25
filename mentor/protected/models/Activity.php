<?php

/**
 * This is the model class for table "activity".
 *
 * The followings are the available columns in table 'activity':
 * @property integer $id
 * @property integer $userId
 * @property integer $goalId
 * @property string $description
 * @property string $day
 * @property string $status
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Goal $goal
 * 
 * The followings are available as virtual attributes:
 * @property string $dayName
 * @property string $valuadedStatus
 */
class Activity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activity the static model class
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
		return 'activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, goalId, description, day', 'required'),
			array('userId, goalId', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>256),
			array('status',  'in', 'range'=>array('completed', 'missed', 'unreported')),
	    array('day', 'date', 'format'=>'yyyy-M-d'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, goalId, description, day, status', 'safe', 'on'=>'search'),
		  // Default value for status.
	    array('status', 'default', 'value'=>'unreported'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'goal' => array(self::BELONGS_TO, 'Goal', 'goalId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'goalId' => 'Goal',
			'description' => 'Description',
			'day' => 'Day',
			'status' => 'Status',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('goalId',$this->goalId);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Getter function for the virtual attribute $dayName. It returns the day
	 * string representation of $day attribute. The format character used is
	 * "D", see http://php.net/manual/en/function.date.php.
	 * 
	 * @param string $format The format of used by date() to format the day.
	 * "D" by default.
	 * 
	 * @return Returns the day string representation of $day attribute or FALSE
	 * if day not set or not valid date format.
	 * 
	 * @see http://php.net/manual/en/function.date.php
	 */
	public function getDayName($format = "D")
	{
	  $time = strtotime($this->day);
	  return $time ? date($format, $time) : FALSE;
	}
	
	/**
	 * Getter function for the virtual attribute $valuatedStatus. Depending on the
	 * current time it returns the following values:
	 * - completed: If activity is in the past (including today) and has status
	 *   completed
	 * - missed: If activity is in the past (including today) and has status
	 *   missed or unreported
	 * - upcoming: If activity is in the future exluding today.
	 * 
	 * @return string One of the following values: completed, missed, upcoming
	 * 
	 * @see http://php.net/manual/en/function.date.php
	 * 
	 * @todo Test it!
	 */
	public function getValuatedStatus()
	{
	  $time = time();
	  // Return upcoming if avtivity is tomorrow or later.
	  if ($time<=strtotime(date('d.m.Y 00:00', strtotime($this->day)))) return 'upcoming';
	  // Return completed/missed if status is completed/missed.
	  if ($this->status == 'completed') return 'completed';
	  if ($this->status == 'missed') return 'missed';
	  // Return upcoming if activity is today and has status unreported
	  if ($time<=strtotime(date('d.m.Y 23:59', strtotime($this->day)))) return 'upcoming';
	  // Return missed if activity is in the past and has status unreported.
	  else return 'missed';
	}
	
}