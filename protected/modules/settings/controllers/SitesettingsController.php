<?php

class SitesettingsController extends Controller
{
	/**
	 * @return array action filters
	 */
    
	public function init()
	{
	    $this->renderPartial('//layouts/_settings_mod_left_menu');
	}
	
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','updatestatus'),
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
		$model=new Sitesettings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sitesettings']))
		{
			$model->attributes=$_POST['Sitesettings'];
			if($model->save()):
			    Yii::app()->user->setFlash('success','Settings Created Successfully');
			    $this->redirect(array('index'));
			endif;
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

		if(isset($_POST['Sitesettings']))
		{
			$model->attributes=$_POST['Sitesettings'];
			if($model->save()):
			    Yii::app()->user->setFlash('success','Updated Successfully');
			    $this->redirect(array('index'));
			endif;
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdatestatus($id)
	{
		$model=$this->loadModel($id);
		$model->setting_status = abs($model->setting_status - 1);
		$model->save();
		Yii::app()->user->setFlash('success','Status Updated Successfully');
		$this->redirect(array('/settings/sitesettings/index'));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $settings = Sitesettings::model()->findAll();
	    $this->render('index',compact('settings'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sitesettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sitesettings']))
			$model->attributes=$_GET['Sitesettings'];

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
		$model=Sitesettings::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sitesettings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
