<?php

class CategoryController extends Controller
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
		$rootCategories = Myclass::getParentCategory();
		$subCategories  = Category::model()->findAll("parent_id=:parent_id",array("parent_id"=>$id));
		$model			= $this->loadModel($id);
		$data 			= compact('model','subCategories','rootCategories');
		$this->render('view',$data);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$pid = 0;
		
		if(isset($_GET['pid'])) {
			$pid = $_GET['pid'];
		}
                if(isset($_POST['Category'])){
		$parent_id = $_POST['Category']['parent_id'];
		$name = $_POST['Category']['name'];

                $checkCategory = Category::model()->findAll('parent_id =:parent_id AND name =:name',array(':parent_id'=>$parent_id,':name'=>$name));
                if(!empty ($checkCategory) && isset ($checkCategory)){

//                    Yii::app()->user->setFlash('error',Yii::t('default','CREATED',array('{info}'=>$name)));
                    Yii::app()->user->setFlash('error',Yii::t('default',$name .' Allready Exist',array('{info}'=>$name)));
                    $this->redirect(array('/products/category/index'));
                }
                
                }
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save()) {
				
				if(empty($_POST['Category']['parent_id'])) {
					$string = "Category";
				} else {
					$string = "Sub-category";
				}
				
				Yii::app()->user->setFlash('success',Yii::t('default','CREATED',array('{info}'=>$string)));
				$this->redirect(array('/products/category/index','pid'=>$model->parent_id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'pid'=>$pid,
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->save()) {
				if(empty($_POST['Category']['parent_id'])) {
					$string = "Category";
				} else {
					$string = "Sub-category";
				}
				
				Yii::app()->user->setFlash('success',Yii::t('default','UPDATED_SUCCESSFULLY',array('{info}'=>$string)));
				$this->redirect(array('/products/category/index','pid'=>$model->parent_id));
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
	public function actionCategorydelete($id)
	{		
		//$this->loadModel($id)->delete();
//		$model = $this->loadModel($id);
//		$model->is_deleted = "1";
//		$model->save(false);
		Category::model()->updateByPk($id, array('is_deleted'=>'1'));
		
		Yii::app()->user->setFlash('success',Yii::t('default','DELETED'));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		$this->redirect(array('/products/category/index'));
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
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/products/category/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($pid=0)
	{
		$categoryModel = Category::model()->active()->parent('0')->findall(); // Parent
		$subcategoryModel = Category::model()->active()->parent($pid)->findall(); //Sub Cat
		
                $selectedCategory = Category::model()->findAll('category_id =:category_id',array(':category_id'=>$pid));
                
                //$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',  compact('categoryModel','subcategoryModel','selectedCategory'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
		$model->attributes=$_GET['Category'];

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
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 *
	 * Change the category status i.e active to inactive and vice versa
	 * @param int $id
	 */
	public function actionChangestatus($id)
	{
		$model= Category::model()->findByPk($id);
		$model->is_active=($model->is_active)?0:1;
		$model->save(false);		
		Yii::app()->user->setFlash('success',Yii::t('default','STATUS_CHANGED'));
		$this->redirect(Yii::app()->request->getUrlReferrer());
	}
}
