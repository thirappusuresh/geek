<?php

class SiteController extends Controller
{
	
	public $layout='//layouts/main';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model = new Createjob;
		
		$jobs = Jobs::model()->findAll(array('select'=>'*',
					'condition'=>'status=1 ORDER BY created_on'));
		
		if(isset($_POST['Createjob']))
		{
			$model->attributes=$_POST['Createjob'];
				
			if($model->validate()) {
				$this->redirect(array('/jobs/create','headline'=>$model->headline));
			}
		}
		$this->render('index', array('jobs'=>$jobs, 'model'=>$model));
	}
	
	public function actionSearchengine() {
		$model = new Createjob;
		$jobs = Jobs::model()->findAll(array('select'=>'*',
				'condition'=>'status=1 ORDER BY created_on'));
		if(isset($_POST['Searchengine'])) {
			$search='%'.$_POST['Searchengine']['searchtext'].'%';
			$jobs=Jobs::model()->findAll(array('select'=>'*',
					'condition'=>'status=1 AND (headline LIKE :search OR type LIKE :search OR category LIKE :search OR location LIKE :search OR job_description LIKE :search OR job_perks_description LIKE :search OR name LIKE :search OR url LIKE :search OR how_to_apply LIKE :search OR email LIKE :search) ORDER BY created_on',
					'params'=>array(':search'=>$search)));
		}
		$this->render('index', array('jobs'=>$jobs, 'model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('/geek/site/index');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}