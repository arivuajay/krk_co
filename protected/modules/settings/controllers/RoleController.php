<?php

class RoleController extends Controller
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
//			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','changestatus','view','create','update','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Role('insert');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			$model->is_active = 1 ;
			$model->ip_address = CHttpRequest::getUserHostAddress();
			//$model->created_by = (!empty(Yii::app()->user->id)) ? Yii::app()->user->id : 0;
			
			if($model->save()):
			    Yii::app()->user->setFlash('success','Role Created Successfully');
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

		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			if($model->save()):
			    Yii::app()->user->setFlash('success',Yii::t('settings','Role Updated.'));	
			    $this->redirect(array('index'));			    
			endif;
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
//		$this->loadModel($id)->delete();
		Role::model()->updateByPk($id, array('is_deleted'=>'1'));
		Yii::app()->user->setFlash('success','Role deleted Successfully');
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $roles = Role::model()->not_deleted()->findAll();
	    $this->render('index',compact('roles'));
	}
	
	public function actionChangestatus($id)
	{
		$model= Role::model()->findByPk($id);
		$model->is_active=($model->is_active)?0:1;
		$model->save(false);
		Yii::app()->user->setFlash('success',Yii::t('settings','ROLE_STAUS_UPDATED'));		
		$this->redirect(array('index'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Role::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='role-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
