<?php

class JobsController extends Controller
{
	public $layout='//layouts/main';
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

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
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','sendemail','verify','withdraw'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('upload_image'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionUpload_image() {
		$jid = decrypt($_GET['id']);
		if(empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
			$post_max_size = ini_get('post_max_size');
			//echo "<p style=\"color: red;\">Files are larger than {$post_max_size}.</p>";
			Yii::app()->user->setFlash('info',"Files are larger than {$post_max_size}.");	
		}
		else if(isset($_FILES['images'])){
			for($i = 0; $i < count($_FILES['images']['name']); $i++){
				$imageData = @getimagesize($_FILES['images']['tmp_name'][$i]);
				if($_FILES['images']['size'][$i] >= 1080000) {
					Yii::app()->user->setFlash('info',"File '".$_FILES['images']['name'][$i]."' size is more than 1MB, make sure the image size is less than 1MB");
					//echo "<p style=\"color: red;\">File '".$_FILES['images']['name'][$i]."' size is more than 1MB, make sure the image size is less than 1MB</p>";
				} else if($imageData === FALSE || !($imageData[2] == IMAGETYPE_GIF || $imageData[2] == IMAGETYPE_JPEG || $imageData[2] == IMAGETYPE_PNG)) {
					Yii::app()->user->setFlash('info',"File '".$_FILES['images']['name'][$i]."' is not an image");
					//echo "<p style=\"color: red;\">File '".$_FILES['images']['name'][$i]."' is not an image</p>";
				} else {			
					if(move_uploaded_file($_FILES['images']['tmp_name'][$i],Yii::app()->params['base_location'].Yii::app()->params['upload_location'].'upload/'.$jid.'_'.$_FILES['images']['name'][$i])) {
						$model=new Images;
						$model->jid = $jid;
						$model->image = $jid.'_'.$_FILES['images']['name'][$i];
						$model->uploaded_on = date('Y-m-d H:i:s', time());;
						$model->save();
					}
					else {
						echo "Error while uploading!";
					}
				}	
			}
		}
		$this->redirect(array('/jobs/view/id/'.$_GET['id']));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel(decrypt($id));
		if($model->status == 0) 
			Yii::app()->user->setFlash('info','This is a preview. It is only visible to you. You may <a href="/geek/jobs/update/id/'.encrypt($model->jid).'">edit again</a> or confirm this listing.<BR><a class="btn btn-small" href="/geek/jobs/sendemail/id/'.encrypt($model->jid).'">This looks good, confirm it</a>');
						
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionWithdraw($id) {
		$model = $this->loadModel(decrypt($id));
		$jid = $model->jid;
		$connection = Yii::app()->db;
		$sql="DELETE FROM tbl_jobs WHERE jid = :jid";
		$command=$connection->createCommand($sql);
		// replace the placeholder ":name" with the actual username value
		$command->bindParam(":jid",$jid,PDO::PARAM_STR);
		$command->execute();

		Yii::app()->user->setFlash('info','Your job listing has been withdrawn and is no longer available');
		$this->redirect('/geek/site/index');
	}
	
	public function actionVerify($id) {
		$model = $this->loadModel(decrypt($id));
		$model->status = 1;
		if($model->save()) {
			Yii::app()->user->setFlash('info','Congratulations! Your job listing has been published and tweeted');
			$this->render('view',array(
					'model'=>$model,
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Jobs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Jobs']))
		{
			$model->attributes=$_POST['Jobs'];
			$model->status = 0;
			$model->created_on = date('Y-m-d H:i:s', time());
			$model->logo = CUploadedFile::getInstance($model,'logo');
			if($model->logo == true) {
				$filename = $model->logo->getName($model,'logo');
				if($model->logo->saveAs(Yii::app()->params['base_location'].Yii::app()->params['upload_location'].'upload/'.$filename)) {
					$model->logo = $filename;
				}
			}
			if($model->save()) {
				Yii::app()->user->setFlash('info','This is a preview. It is only visible to you. You may <a href="/geek/jobs/update/id/'.encrypt($model->jid).'">edit again</a> or confirm this listing.');
				$this->redirect(array('/jobs/view/id/'.encrypt($model->jid)));
			}
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
		$model=$this->loadModel(decrypt($id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Jobs']))
		{	
			$logo = $model->logo;
			$model->attributes=$_POST['Jobs'];
			
			$model->logo = CUploadedFile::getInstance($model,'logo');
			if($model->logo == true) {
				$filename = $model->logo->getName($model,'logo');
				if($model->logo->saveAs(Yii::app()->params['base_location'].Yii::app()->params['upload_location'].'upload/'.$filename)) {
					$model->logo = $filename;
				}
			}
			else {
				$model->logo = $logo;
			}
			if($model->save()) {
				if($model->status==1) Yii::app()->user->setFlash('info','Successfully saved the changes!');
				else	
					Yii::app()->user->setFlash('info','This is a preview. It is only visible to you. You may <a href="/geek/jobs/update/id/'.encrypt($model->jid).'">edit again</a> or confirm this listing.<BR><a class="btn btn-small" href="/geek/jobs/sendemail/id/'.encrypt($model->jid).'">This looks good, confirm it</a>');
				$this->redirect(array('/jobs/view/id/'.encrypt($model->jid)));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionSendemail($id) {
		$model=$this->loadModel(decrypt($id));
		Yii::import('ext.yii-mail.YiiMailMessage');
		$link = 'http://'.Yii::app()->params['domain'].''.Yii::app()->params['root'].'/jobs/verify/id/'.$id;
		$withdraw = 'http://'.Yii::app()->params['domain'].''.Yii::app()->params['root'].'/jobs/withdraw/id/'.$id;
		$edit = 'http://'.Yii::app()->params['domain'].''.Yii::app()->params['root'].'/jobs/update/id/'.$id;
		$message = new YiiMailMessage;
		$message->setBody(
				'Hello,<br />This is a confirmation email for the job you listed at the HasGeek Job Board.<br />'.$model->headline.'<br /><a href="'.$link.'">Click here to confirm your email address and publish the job</a>
				<br /><br />Save this email for the next 30 days while the listing is active. Use these links if you need to edit the listing, or if the position has been filled and you wish to withdraw it:
				<br /><br /><a href="'.$edit.'">Edit job listing</a>
				<br /><br /><a href="'.$withdraw.'">Withdraw job listing</a>
				<br /><br />The HasGeek Job Board is a service of HasGeek. Write to us at info@hasgeek.com if you have suggestions or questions on this service.
				<br />If you did not list a job, you may safely ignore this email and the listing will be automatically removed.', 'text/html'
		);
		$message->subject = 'Confirmation of your job listing at the HasGeek Job Board';
		$message->addTo($model->email);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
		$this->render('laststep');
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
		$dataProvider=new CActiveDataProvider('Jobs');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Jobs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Jobs']))
			$model->attributes=$_GET['Jobs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Jobs::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='jobs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
