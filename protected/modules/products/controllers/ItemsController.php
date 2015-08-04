<?php

class ItemsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function init()
	{
		$this->renderPartial('//layouts/_product_mod_left_menu');
	}

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
		/*array('allow',  // allow all users to perform 'index' and 'view' actions
		 'actions'=>array('index','view'),
		 'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
			'actions'=>array('create','update'),
			'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
			'actions'=>array('admin','delete'),
			'users'=>array('admin'),
			),
			array('deny',  // deny all users
			'users'=>array('*'),
			),*/
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
		$model=new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
			if($model->save()) {
				Yii::app()->user->setFlash('success',Yii::t('default','CREATED',array('{info}'=>"Items")));
				$this->redirect(array('index'));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
			if($model->save()) {
				Yii::app()->user->setFlash('success',Yii::t('default','UPDATED_SUCCESSFULLY',array('{info}'=>"Items")));
				$this->redirect(array('index'));
			}
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionItemsdelete($id)
	{
		//$this->loadModel($id)->delete();
		$model= Items::model()->findByPk($id);
		$model->is_deleted=1;
		$model->save(false);

		Yii::app()->user->setFlash('success',Yii::t('default','DELETED'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$itemsModel = Items::model()->not_deleted()->findAll();

                $this->render('index',array(
			'itemsModel'=>$itemsModel,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
		$model->attributes=$_GET['Items'];

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
		$model=Items::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 *
	 * Change the item status i.e active to inactive and vice versa
	 * @param int $id
	 */
	public function actionChangestatus($id)
	{
		$model= Items::model()->findByPk($id);
		$model->is_active=($model->is_active)?0:1;
		$model->save(false);
		Yii::app()->user->setFlash('success',Yii::t('default','STATUS_CHANGED'));
		$this->redirect(Yii::app()->request->getUrlReferrer());
	}

	public function actionPlaceprocurement($id) {

		$model			= $this->loadModel($id);
		$identification = 2;
		$smodel 		= new ProductProcurement();
		$smodel			= $smodel->find("prod_id=:prod_id AND identification = :identification",array(":prod_id"=>$id,":identification"=>$identification));
		
		if(empty($smodel)) {
			$smodel 	= new ProductProcurement();	
		}

		if(isset($_POST['PRODUCT_PROCUREMENT'])) 
		 {
		 	$smodel->attributes 		= $_POST['ProductProcurement'];
		 	$smodel->prod_id			= $id;
		 	$smodel->identification		= $identification;
	
		 	if($smodel->validate())
		 	{
			    $admin_id = "1";
		 		$smodel->save(false);
		 		//Notofication Insert
		 		Myclass::InsertNotification(10, $smodel->ppid, Yii::app()->user->id, $admin_id);
		 		Yii::app()->user->setFlash('success','Procurement request made successfully');
		 	}
		 }

		$this->render('itemprocurement',array(
			'smodel'=>$smodel,
			'model'=>$model,
		));

	}
}
