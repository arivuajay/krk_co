<?php

class SourcemessageController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('@'),
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
		$model=new LangSourcemessage;
		$msgmodel=new LangMessage;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LangSourcemessage']))
		{
			$model->attributes=$_POST['LangSourcemessage'];
			$msgmodel->attributes=$_POST['LangMessage'];

			$valid = $model->validate();
			$valid = $msgmodel->validate() && $valid;
			if($valid):
			    $model->save();
			    $msgmodel->id = $model->id;
			    $msgmodel->language = Yii::app()->language;
			    $msgmodel->save();
//			    $this->redirect(array('view','id'=>$model->id));
			    $this->redirect(array('create'));
			endif;
		}
		
		$this->render('create',array('model'=>$model,'msgmodel'=>$msgmodel));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$msgmodel= LangMessage::model()->find("id={$id} AND language='en'");

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LangSourcemessage']))
		{
			$model->attributes=$_POST['LangSourcemessage'];
			$msgmodel->attributes=$_POST['LangMessage'];

			$valid = $model->validate();
			$valid = $msgmodel->validate() && $valid;
			if($valid):
			    $model->save(false);
			    $msgmodel->id = $model->id;
			    $msgmodel->language = Yii::app()->language;
			    $msgmodel->save(false);
			    $this->redirect(array('view','id'=>$model->id));
			endif;
			
		}  
		$this->render('update',array('model'=>$model,'msgmodel'=>$msgmodel));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('LangSourcemessage');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LangSourcemessage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LangSourcemessage']))
			$model->attributes=$_GET['LangSourcemessage'];

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
		$model=LangSourcemessage::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Sourcemessage-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
