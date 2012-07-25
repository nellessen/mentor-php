<?php

/**
 * This is the model class for table "goal".
 *
 * The followings are the available columns in table 'goal':
 * @property integer $id
 * @property integer $userId
 * @property string $mentor1_email
 * @property string $mentor1_name
 * @property string $mentor2_email
 * @property string $mentor2_name
 * @property string $mentor3_email
 * @property string $mentor3_name
 * @property string $description
 * @property integer $active
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property User $user
 * 
 * The followings are available as virtual attributes:
 * @property Activity $currentActivity
 * @property string $activityDescription
 * @property int $progress
 * @property int $success
 * 
 * @todo We need to change status attribute when when every activity has been
 * reported or in past.
 */
class Goal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goal the static model class
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
		return 'goal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, description, active', 'required'),
			array('userId, active', 'numerical', 'integerOnly'=>true),
			array('mentor1_email, mentor1_name, mentor2_email, mentor2_name, mentor3_email, mentor3_name', 'length', 'max'=>128),
			array('description', 'length', 'max'=>256),
			array('mentor1_email, mentor2_email, mentor3_email', 'email'),
		  // Filters.
	    array('mentor1_email, mentor2_email, mentor3_email', 'filter', 'filter'=>'strtolower'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, mentor1_email, mentor1_name, mentor2_email, mentor2_name, mentor3_email, mentor3_name, description, active, created', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Sets the created attribute to NOW for new models.
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
	  if ($this->isNewRecord)
	    $this->created = new CDbExpression('NOW()');
	  return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'activities' => array(self::HAS_MANY, 'Activity', 'goalId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
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
			'mentor1_email' => 'Mentor1 Email',
			'mentor1_name' => 'Mentor1 Name',
			'mentor2_email' => 'Mentor2 Email',
			'mentor2_name' => 'Mentor2 Name',
			'mentor3_email' => 'Mentor3 Email',
			'mentor3_name' => 'Mentor3 Name',
			'description' => 'Description',
			'active' => 'Active',
			'created' => 'Created',
		  'activityDescription' => 'Activity'
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
		$criteria->compare('mentor1_email',$this->mentor1_email,true);
		$criteria->compare('mentor1_name',$this->mentor1_name,true);
		$criteria->compare('mentor2_email',$this->mentor2_email,true);
		$criteria->compare('mentor2_name',$this->mentor2_name,true);
		$criteria->compare('mentor3_email',$this->mentor3_email,true);
		$criteria->compare('mentor3_name',$this->mentor3_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Getter for the virtual attribute $currentActivity. It returns the
	 * related activity where day is the current day. If there is more than one
	 * activity for this day, it returns FALSE. If 
	 *
	 * @return Activity The related activity of the current day, NULL if not
	 * exist and FALSE if not unique.
	 */
	public function getCurrentActivity()
	{
	  $currentActivity = NULL;
	  foreach ($this->activities as $activity) {
	    if ($activity->day == date('Y-m-d')) {
	      if (!empty($currentActivity)) return FALSE;
	      else $currentActivity = $activity;
	    }
	  }
	  return $currentActivity;
	}
	
	/**
	 * Getter for the virtual attribute $activityDescription. It returns the
	 * description attribute of one related activity or NULL if there is none.
	 *
	 * @return string The description of one related activity.
	 */
	public function getActivityDescription()
	{
	  return !empty($this->activities) ? $this->activities[0]->description : NULL;
	}
	
	/**
	 * Getter for the virtual attribute $progress. This returns a percentage
	 * indicating the progress of this goal.
	 *
	 * @return integer A number between 0 and 100.
	 */
	public function getProgress()
	{
	  $val = 0;
	  foreach ($this->activities as $activity){
	    $val += (int)($activity->valuatedStatus == 'upcoming');
	  }
	  return empty($this->activities) ? 0 : round(100*(1-$val/count($this->activities)));
	}
	
	/**
	 * Getter for the virtual attribute $success. This returns a percentage
	 * indicating the success of this goal.
	 *
	 * @return integer A number between 0 and 100.
	 */
	public function getSuccess()
	{
	  $pos = 0;
	  foreach ($this->activities as $activity){
	    $pos += (int)($activity->valuatedStatus == 'completed');
	  }
	  $neg = 0;
	  foreach ($this->activities as $activity){
	    $neg += (int)($activity->valuatedStatus == 'missed');
	  }
	  return empty($pos) ? 0 : round(100 * $pos / ($pos + $neg));
	}
	
	/**
	 * Cleans up this model:
	 * - Sets active to 1/0 depending on wether there is a current Activity.
	 */
	public function cleanUp()
	{
	  $currentActivity = $this->currentActivity;
	  $active = (int)!empty($currentActivity);
	  if ($this->active != $active) {
	    $this->active = $active;
	    $this->save();
	  }
	}
	
}