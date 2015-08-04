<?php

class DefaultController extends Controller
{
	public function init()
	{
	    $this->renderPartial('//layouts/_sales_mod_left_menu');
	    $this->defaultAction = 'viewcompanies';
	}
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createcompany','updatecompany','addcontact','updatecontact','viewcompanies','delcompany','delcontact','companyquote','companyso','companyinv'),
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
	public function actionCreatecompany()
	{
	    $this->pageTitle = Yii::t('sales', 'CREATE_COMPANY_TITLE');
	    $this->breadcrumbs=array(
		    'Company'=>array('index'),
		    'Create',
	    );

	    $model=new Company();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
			if($model->validate()):
			    if ($model->same_shipping)
			    {  
				$model->shipping_address   = $model->billing_address;
				$model->shipping_city   = $model->billing_city;
				$model->shipping_state  = $model->billing_state;
			    }
			    $model->save();
			    Yii::app()->user->setFlash('success',Yii::t( 'sales', 'COMPANY_CREATED',array('{company_name}'=>$model->name)));
			    $this->redirect(array('updatecompany','id'=>$model->company_id));
			endif;
		}

		$this->render('create_company',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdatecompany($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
			if($model->validate()):
			    if ($model->same_shipping)
			    {  
				$model->shipping_address   = $model->billing_address;
				$model->shipping_city   = $model->billing_city;
				$model->shipping_state  = $model->billing_state;
			    }
			    $model->save();
			    Yii::app()->user->setFlash('success',Yii::t( 'sales', 'COMPANY_UPDATED',array('{company_name}'=>$model->name)));
			    $this->redirect(array('updatecompany','id'=>$model->company_id));			    
			endif;
			
		}

		$this->render('update_company',array('model'=>$model));
	}
	
	public function actionAddcontact($id)
	{
		$model=$this->loadModel($id);
		$contact = new CompanyContact;
		$avail_contact = CompanyContact::model()->findAll('company_id='.$model->company_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CompanyContact']))
		{
                    
			$contact->attributes=$_POST['CompanyContact'];
			$off_phone = $_POST['CompanyContact']['office_phone'];
			$mobile	   = $_POST['CompanyContact']['mobile'];
			$email      = $_POST['CompanyContact']['email'];
                        
                        
			if($contact->validate()):
			    $contact->company_id = $model->company_id;
			    if(!empty($off_phone)){
                                $contact->office_phone = @implode('-',$off_phone);
                                 if (preg_match("/[A-Za-z]/i", $contact->office_phone)){

                                Yii::app()->user->setFlash('error',Yii::t( 'Office Phone Is Invalid', 'Office Phone Is Invalid'));
                                $this->redirect(array('addcontact','id'=>$model->company_id));
                                }
                            }
			    if(!empty($mobile)){
                                $contact->mobile = @implode('-',$mobile);
                                if(preg_match("/[A-Za-z]/i", $contact->mobile)){
                                Yii::app()->user->setFlash('error',Yii::t( 'Mobile Is Invalid', 'Mobile Is Invalid'));
                                $this->redirect(array('addcontact','id'=>$model->company_id));
                            }

                            }
                            //$office_phone = $contact->office_phone;
                            //$mobile = $contact->mobile;
                           
                            
                           
                            if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
                           Yii::app()->user->setFlash('error',Yii::t( 'Email Is Invalid', 'Email Is Invalid'));
			  
                            //$this->redirect(array('/sales/default/add_contact'));
                            $this->redirect(array('addcontact','id'=>$model->company_id));			    
                        }

			    $contact->save();
			    Yii::app()->user->setFlash('success',Yii::t( 'sales', 'CONTACT_ADDED'));
			    $this->redirect(array('addcontact','id'=>$model->company_id));			    
			    
			endif;
		}

		$this->render('add_contact',compact('model','contact','avail_contact'));
	}
	
	public function actionUpdatecontact($id)
	{
		$contact = CompanyContact::model()->findByPk($id);
		$model=$this->loadModel($contact->company_id);
		$avail_contact = CompanyContact::model()->findAll('company_id='.$model->company_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CompanyContact']))
		{
			$contact->attributes=$_POST['CompanyContact'];
			$off_phone = $_POST['CompanyContact']['office_phone'];
			$mobile	   = $_POST['CompanyContact']['mobile'];
                        $email      = $_POST['CompanyContact']['email'];
                      
                        
			if($contact->validate()):
			    $contact->company_id = $model->company_id;
			    if(!empty($off_phone))    $contact->office_phone = @implode('-',$off_phone);
			    if(!empty($mobile))	  $contact->mobile = @implode('-',$mobile);	  

                              if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
                           Yii::app()->user->setFlash('error', 'Email Is Invalid');

                            //$this->redirect(array('/sales/default/add_contact'));
                            $this->redirect(array('addcontact','id'=>$model->company_id));
                        }
			    $contact->save();
			    Yii::app()->user->setFlash('success',Yii::t( 'sales', 'CONTACT_UPDATED'));
			    $this->redirect(array('addcontact','id'=>$model->company_id));			    
			    
			endif;
		}

		$this->render('update_contact',compact('model','contact','avail_contact'));
	}

	
	public function actionDelcompany($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('viewcompanies'));
	}
	
	public function actionDelcontact($id,$return)
	{
            
		CompanyContact::model()->deleteByPk($id);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
                        Yii::app()->user->setFlash('success','Contact Deleted Successfully');
			$this->redirect(array('addcontact','id'=>$return));
	}

	/**
	 * Lists all models.
	 */
	public function actionViewCompanies()
	{
	    $companies = Company::model()->findAll();
	    $this->render('view_companies',compact('companies'));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionCompanyquote($id)
	{
	    $model= $this->loadModel($id);
	    $cmpyquotes = Quote::model()->findAll("company_id = {$id}");
	    
	    $this->render('company_quote', compact('cmpyquotes','model'));
	}
	
	public function actionCompanyso($id)
	{
	    $model= $this->loadModel($id);
	    $cmpyso = Salesorder::model()->findAll("customer_id = {$id}");
	    
	    $this->render('company_so', compact('cmpyso','model'));
	}
	
	public function actionCompanyinv($id)
	{
	    $model= $this->loadModel($id);
	    $cmpyinv = Invoice::model()->invoice()->with(array(
		    'invSo'=>array("select"=>false,"condition"=>"invSo.customer_id = {$id}","order"=>"inv_id DESC")
		    ))->findAll();

	    $this->render('company_inv', compact('cmpyinv','model'));
	}
	
}
