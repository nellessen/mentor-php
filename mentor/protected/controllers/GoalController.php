<?php

class GoalController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 *
	 * @todo We are assuming user with id 1 to be the admin.
	 * @todo Workflow should only be allowed if no goal active!
	 */
	public function accessRules()
	{
	  return array(
	      array('allow',  // allow any action for user with id 1.
	          'actions'=>array('index','view','create','workflow','update', 'admin','delete'),
	          'users'=>array('@'),
	          'expression'=>'$user->id == 1',
	      ),
	      array('allow',  // Allow users to report on their goals.
	          'actions'=>array('report'),
	          'users'=>array('@'),
	          'expression'=>'Goal::model()->findByAttributes(array("active"=>1, "userId"=>$user->id, "id" => (int)Yii::app()->getRequest()->getQuery("id")))',
	      ),
	      array('allow',  // Allow authenticated users to create news goals using the workflow.
	          'actions'=>array('workflow'),
	          'users'=>array('@'),
	          'expression'=>'!Goal::model()->findByAttributes(array("active"=>1, "userId"=>$user->id))',
	      ),
	      array('deny',  // deny all users
	          'users'=>array('*'),
	      ),
	  );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Goal;
		
		// Associate goal with current user.
		$model->userId = Yii::app()->user->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Goal']))
		{
			$model->attributes=$_POST['Goal'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Goal']))
		{
			$model->attributes=$_POST['Goal'];
			// Make sure the userid was not manipulated. We only allow users to update
			// their own goals.
			if ($model->userId != Yii::app()->user->id)
			  throw new CHttpException(404,'You can only update your own goals.');
			// Save the model.
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  // Create a data provider.
		$dataProvider=new CActiveDataProvider('Goal', array(
    'criteria'=>array(
        // Limit query to models associated with the current user.
        'condition'=>'userId=' . Yii::app()->user->id,
        'order'=>'created DESC',
    )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Goal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Goal']))
			$model->attributes=$_GET['Goal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * A workflow for creating goals with activities.
	 * @param integer $step workflow step
	 * @param integer $goal goal id set in first step
	 * @todo: Save everything in the last step.
	 */
	public function actionWorkflow($step = 1, $goal = 0)
	{
	  // First step: Set goal (description).
	  if ($step == 1)
	  {
  		$model=empty($goal) ? new Goal : $model=$this->loadModel((int)$goal);
  		
  		// Associate goal with current user and set defaults.
  		$model->userId = Yii::app()->user->id;
  		$model->active = 0;
  
  		// Uncomment the following line if AJAX validation is needed
  		// $this->performAjaxValidation($model);
  
  		if(isset($_POST['Goal']))
  		{
  			$model->attributes=$_POST['Goal'];
  			if($model->save())
  				$this->redirect(array('workflow','step'=>2,'goal'=>$model->id));
  		}
  
  		// Render view.
  		$this->render('create',array(
  			'model'=>$model,
  		));
	  }
	  
	  // Seccond step: Set activity.
	  elseif ($step == 2)
	  {
	    // Load goal created in first step.
	    $goalModel = Goal::model()->findByPk($goal);
  		$model=new Activity;
  		
  		// Associate goal with current user and goal created in step1.
  		$model->userId = Yii::app()->user->id;
  		$model->goalId = $goalModel->id;
  		// Set default values.
  		$model->day = date ('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+0, date("Y")));
  
  		// Uncomment the following line if AJAX validation is needed
  		// $this->performAjaxValidation($model);
  		
      // @todo: Must make sure only one set of activities exist for a goal. Delete old ones first?
  
  		if(isset($_POST['Activity']))
  		{
  			$model->attributes=$_POST['Activity'];
  			// Validate input.
  			if ($model->validate()) {
  			  // Create 10 models for the next 10 days and safe them.
    			for ($i=0;$i<10;$i++) {
    			  $models[$i] = clone $model;
    			  $models[$i]->day = date ('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+$i, date("Y")));
    			  if(!$models[$i]->save())
			        throw new CHttpException(409,'There was problem creating the activities. Try again later!');
    			}
    			// Redirect if everything was fine.
      		$this->redirect(array('workflow','step'=>3,'goal'=>$goal));
  			}
  		}
  
  		// Render view.
  		$this->render('createActivity',array(
  			'model'=>$model,
  		  // Provide created goal in this step.
  		  'goal'=>$goalModel,
  		));
	  }
	  
	  // Third step: Choose mentors.
	  elseif($step == 3)
	  {
  		$model=$this->loadModel((int)$goal);
  		if (empty($model) or $model->userId != Yii::app()->user->id)
			  throw new CHttpException(400,'You cannot proceed with this workflow!');
  		
  		// Uncomment the following line if AJAX validation is needed
  		// $this->performAjaxValidation($model);
  		
  		if(isset($_POST['Goal']))
  		{
  		  $model->attributes=$_POST['Goal'];
  		  if($model->save())
  		    $this->redirect(array('workflow','step'=>4,'goal'=>$model->id));
  		}
  		
  		// Render view.
  		$this->render('createMentors',array(
  		    'model'=>$model,
  		));
  		
	  }
	  // Fourth step: Finish!
	  elseif($step == 4)
	  {
  		$model=$this->loadModel((int)$goal);
  		if (empty($model) or $model->userId != Yii::app()->user->id)
			  throw new CHttpException(400,'You cannot proceed with this workflow!');
  		
  		// Render view.
  		$this->render('finish',array(
  		    'model'=>$model,
  		));
	  }
	  // Fourth step: Activate, mail and redirect!
	  elseif($step == 5)
	  {
  		$model=$this->loadModel((int)$goal);
  		if (empty($model) or $model->userId != Yii::app()->user->id)
			  throw new CHttpException(400,'You cannot proceed with this workflow!');
	    
  		// Set goal active.
  		$model->active = 1;
		  if($model->save())
		    $this->redirect(array('site/index','goal'=>$model->id));
		  else
        throw new CHttpException(409,'There was problem creating the activities. Try again later!');
	  }
	}
	
	/**
	 * An action for reporting activities for a certain goal.
	 * @param integer $id The goal id to report for.
	 * @param string $status Status report for the current day.
	 * @todo: Reporting should only be possible once.
	 */
	public function ActionReport($id, $status = NULL)
	{
	  $model=$this->loadModel((int)$id);
	  if (empty($model) or $model->userId != Yii::app()->user->id)
	    throw new CHttpException(400,'You cannot report on this goal!');
	  
	  // Prepare active goals.
	  if ($model->active)
	  {
  	  // Get todays activity.
  	  $currentActivity = $model->currentActivity;
  	  // Save report
  	  if (!$currentActivity && $status)
        throw new CHttpException(409,'There is no current activity for this goal. Try again later!');
  	  elseif ($status) {
  	    $currentActivity->status = $status;
  	    $currentActivity->save();
  	  }
  	  // Set a status message if no current activity available.
  	  Yii::app()->user->setFlash('warning', 'Your cannot report on this goal any more.');
	  }
	  // Prepare inactive goals.
	  else
	  {
	    $currentActivity = NULL;
  	  // Set a status message if no current activity available.
  	  Yii::app()->user->setFlash('warning', 'This goal is inactive.');
	  }
		// Render view.
		$this->render('report',array(
		    'model'=>$model,
		    'currentActivity' => $currentActivity,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Goal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='goal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
