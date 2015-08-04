<?php

class QuoteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public function init()
	{
	    $this->renderPartial('//layouts/_sales_mod_left_menu');
	    $this->defaultAction = 'create';
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('view','decline','delete','create','update','modal_product_view','addtoquote','editquote','updatequoteprice','makequoteprice','myquotes','edit','approve'),
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
	public function actionView($id,$ret=null)
	{
	    $model = $this->loadModel($id);
	    $this->render('view',compact('model','ret'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(!isset($_SESSION['add_quote'])) $_SESSION['add_quote'] = array();
		$model = new Quote('create');
		$products =  Product::model()->active()->findAll();
		if(!empty($_SESSION['add_quote'])):
		    $quote_prod = CJSON::encode(Myclass::QuoteProductList($_SESSION['add_quote']));
		endif;
		if(isset($_SESSION['customer_id'])) $model->company_id = $_SESSION['customer_id'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Quote']))
		{
			$model->attributes=$_POST['Quote'];
			if($model->validate()):
			    $_SESSION['customer_id'] = $_POST['Quote']['company_id']; 
			    $_SESSION['add_quote'] = $_POST['quote_product'];
			    $this->redirect(array('makequoteprice'));
			endif;
		}

		$this->render('create',compact('model','products','quote_prod'));
	}
	
	public function actionEditquote($id)
	{
		$model = Quote::model()->findByPk($id);
		$model->scenario = 'create';
		
		$products =  Product::model()->active()->findAll();
		if(!empty($_SESSION['add_quote'])):
		    $quote_prod = CJSON::encode(Myclass::QuoteProductList($_SESSION['add_quote']));
		endif;
		if(isset($_SESSION['customer_id'])) $model->company_id = $_SESSION['customer_id'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Quote']))
		{
			$model->attributes=$_POST['Quote'];
			if($model->validate()):
			    $_SESSION['customer_id'] = $_POST['Quote']['company_id']; 
			    $_SESSION['add_quote'] = $_POST['quote_product'];
			    $this->redirect(array('/sales/quote/edit','id'=>$id));
			endif;
		}

		$this->render('create',compact('model','products','quote_prod'));
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

		if(isset($_POST['Quote']))
		{
			$model->attributes=$_POST['Quote'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->quote_id));
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
	     //Soft Delete
		Quote::model()->updateByPk($id, array('is_deleted' => '1'));
		Updates::model()->updateAll(array('notify_deleted'=>1),'notify_type IN(1,2,3) AND notify_update_id = '.$id);
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('myquotes'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $this->pageTitle = Yii::t('sales', 'CREATE_QUOTES');
	    $this->breadcrumbs=array(
		    'Sales'=>array('/sales/default/viewcompanies'),
		    'Create',
	    );
		$model=new Quote;
		//$model=new ;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Quote']))
		{
			$model->attributes=$_POST['Quote'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->quote_id));
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Quote('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Quote']))
			$model->attributes=$_GET['Quote'];

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
		$model=Quote::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='quote-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionModal_product_view($id)
	{
	    if(Yii::app()->request->isAjaxRequest):
		$data = Product::model()->findByPk($id);
		$this->renderPartial('_modal_product_view',compact('data')); 
		Yii::app()->end();
	    endif;
	}
	
	public function actionAddtoquote()
	{
	    $session=  Yii::app()->session['add_quote'];

	    if(Yii::app()->request->isAjaxRequest):
		$prod_id = $_REQUEST['prod_id'];
		$task  = @$_REQUEST['task'];
		$qty = @$_REQUEST['qty'];

	    switch($task):
		case "add":
			$_SESSION['add_quote'][$prod_id] = 1;
		    break;
		case "update":
			$_SESSION['add_quote'][$prod_id] = $qty;
		    break;
		case "remove":
		    unset($_SESSION['add_quote'][$prod_id]);
		    break;
	    endswitch;
	    if(!empty($_SESSION['add_quote'])):
		echo CJSON::encode(Myclass::QuoteProductList($_SESSION['add_quote']));
	    endif;
	    
	    Yii::app()->end();
	    endif;	    
	}
	
	public function actionMakequoteprice()
	{
	    $data = Myclass::QuoteProductList($_SESSION['add_quote']);
	    
	    $model = new QuoteProduct('insert');
	    $quote = new Quote('make');
	    
	    if(isset($_POST['QuoteProduct'])):
		$model->attributes = $_POST['QuoteProduct'];
		$quote->attributes = $_POST['Quote'];
		$quote->company_id = $_SESSION['customer_id'];

		$valid = $model->validate();
		$valid = $valid && $quote->validate();

		if($valid):
		    $quote->save();
		    $quantity	= $model['quantity'];
		    $price		= $model['quote_price'];
		    $remarks	= $model['remarks'];
		    
		    foreach($quantity as $key => $qty):
			$new_mod 				= new QuoteProduct('insert');
			$new_mod->quote_id 		= $quote->quote_id;
			$new_mod->product_id 	= $key;
			$new_mod->quantity 		= $qty;
			$new_mod->quote_price 	= $price[$key];
			$new_mod->remarks 		= $remarks[$key];
			$new_mod->save(false);
		    endforeach;
		    
		    //Register Mail    
		    $reportingmail = CHtml::listData(Myclass::MyReporters(Yii::app()->user->id), 'reportingUser.user_role_id', 'reportingUser.user.userProfiles.email_address');

		    if(!empty($reportingmail) && is_array($reportingmail)):
			foreach($reportingmail as $key=>$email):
			    $uprofile = Myclass::GetUserProfile('',$email);
			    $create_user_profile = Myclass::GetUserProfile(Yii::app()->user->id);
			    $mail = new Sendmail();
			    $subject = Yii::t( 'sales', 'QUOTE_APPROVE_MAIL_SUBJECT');
			    $quote_url = Yii::app()->createAbsoluteUrl('/site/login',array('return'=>'-home-default-updates'));
			    
			    $trans_array = array(
				    '{QUOTE_ID}'=>$quote->quote_id,
				    '{QUOTE_DETAIL_URL}'=>$quote_url,
				    '{CREATED_BY}'=>  ucwords($create_user_profile->first_name." ".$create_user_profile->last_name)
				    );
			    $message= $mail->getMessage('quoteapprove',$trans_array);
			    $mail->send($email,$subject,$message);
			    
			    //Notofication Insert
			    Myclass::InsertNotification(1, $quote->quote_id, Yii::app()->user->id, $uprofile->user_id);
			    
			endforeach;
		    else:
			$quote->status = "1";
			$quote->approved_by = Yii::app()->user->id;
			$quote->save(false);
		    endif;
			
		    Yii::app()->user->setFlash('success',  Yii::t('sales','QUOTE_CREATED_SUCCESS'));
		    $this->redirect('myquotes');
		endif;
	    endif;
	    
	    $this->render('make_quote_price',compact('data','model','quote'));
	}
	
	
	public function actionEdit($id,$ret=null)
	{
	    $products = QuoteProduct::model()->findAll('quote_id ='.$id);
	    
	    $_SESSION['add_quote'] = CHtml::listData($products,'product_id', 'quantity');

	    $data = Myclass::QuoteProductList($_SESSION['add_quote']);
	    
	    $model = new QuoteProduct('insert');
	    $quote = Quote::model()->findByPk($id);
	    $quote->scenario = 'make';
	    
	    if(isset($_POST['QuoteProduct'])):
		$model->attributes = $_POST['QuoteProduct'];
		$quote->attributes = $_POST['Quote'];
		$quote->company_id = $quote->company_id;
		
		$valid = $model->validate();
		$valid = $valid && $quote->validate();

		if($valid):
		    if($quote->created_by != Yii::app()->user->id): // For Update Admin
			$quote->updated_by = Yii::app()->user->id;
		    endif;
		    
		    $quote->save();
		    
		    $quantity	= $model['quantity'];
		    $price	= $model['quote_price'];
		    $remarks	= $model['remarks'];
		    QuoteProduct::model()->deleteAll('quote_id='.$quote->quote_id);
		    foreach ( $quantity as $key => $qty):
			$new_mod = new QuoteProduct('insert');
			$new_mod->quote_id = $quote->quote_id;
			$new_mod->product_id = $key;
			$new_mod->quantity = $qty;
			$new_mod->quote_price = $price[$key];
			$new_mod->remarks = $remarks[$key];
			$new_mod->save(false);
		    endforeach;
		    
		    if($quote->created_by != Yii::app()->user->id): // For Update Admin
			$uprofile = Myclass::GetUserProfile($quote->created_by);
		    else:	
			$uprofile = Myclass::GetUserProfile($quote->updated_by);
		    endif;
		    
			$update_user_profile = Myclass::GetUserProfile(Yii::app()->user->id);
			$updated_by_name = ucwords($update_user_profile->first_name." ".$update_user_profile->last_name);
		    
			//Reportiing Mail
			$mail = new Sendmail();
			$subject = Yii::t( 'sales', 'QUOTE_MODIFY_MAIL_SUBJECT',array('{QUOTE_ID}'=>$quote->quote_id,'{UPDATE_BY_NAME}'=>$updated_by_name));
			$quote_url = Yii::app()->createAbsoluteUrl('/site/login',array('return'=>'-home-default-updates'));

			$trans_array = array(
				'{QUOTE_ID}'=>$quote->quote_id,
				'{QUOTE_DETAIL_URL}'=>$quote_url,
				'{UPDATED_BY}'=> $updated_by_name
				);
			$message= $mail->getMessage('quoteupdated',$trans_array);
			$mail->send($uprofile->email_address,$subject,$message);

			//Notofication Insert
			Myclass::InsertNotification(2, $quote->quote_id, Yii::app()->user->id, $uprofile->user_id);
		   
			
		    Yii::app()->user->setFlash('success',  Yii::t('sales','QUOTE_UPDATED_SUCCESS'));
		    if(isset($ret) && $ret == 'cmpy')
			$this->redirect(array('/sales/default/companyquote','id'=>$quote->company_id));
		    else
			$this->redirect(array('/sales/quote/view','id'=>$quote->quote_id));
		endif;
	    endif;
	    
	    $this->render('make_quote_price',compact('data','model','quote','products','ret'));
	}
	
	public function actionApprove($id)
	{
	    $quote = Quote::model()->findByPk($id);
	    $quote->status = 1;
	    $quote->approved_by = Yii::app()->user->id;
	    $quote->save(false);
	    
	    //Approve Mail    
	    $uprofile = Myclass::GetUserProfile($quote->created_by);
	    $approve_user_profile = Myclass::GetUserProfile(Yii::app()->user->id);
	    $approve_by_name = ucwords($approve_user_profile->first_name." ".$approve_user_profile->last_name);

	    $mail = new Sendmail();
	    $subject = Yii::t( 'sales', 'QUOTE_CONFIRMED_MAIL_SUBJECT',array('{APPROVE_BY}'=>$approve_by_name,'{QUOTE_ID}'=>$quote->quote_id));
	    $quote_url = Yii::app()->createAbsoluteUrl('/site/login',array('return'=>'-home-default-updates'));

	    $trans_array = array(
	    '{QUOTE_ID}'=>$quote->quote_id,
	    '{QUOTE_DETAIL_URL}'=>$quote_url,
	    '{CONFIRMD_BY}'=>$approve_by_name
	    );
	    $message= $mail->getMessage('quoteconfirmed',$trans_array);
	    $mail->send($uprofile->email_address,$subject,$message);

	    //Notofication Insert
	    Myclass::InsertNotification(3, $quote->quote_id, Yii::app()->user->id, $uprofile->user_id);

	    Yii::app()->user->setFlash('success',  Yii::t('sales','QUOTE_APPROVED'));
	    $this->redirect(array('/sales/quote/view','id'=>$quote->quote_id));
	}

        public function actionDecline($id)
	{
	    $quote = Quote::model()->findByPk($id);
	    $quote->status = '2';
            $quote->updated_by = Yii::app()->user->id;
	    $quote->save(false);

	    //Notofication Insert
	    Myclass::InsertNotification('19', $quote->quote_id, Yii::app()->user->id, $quote->created_by);

	    Yii::app()->user->setFlash('success', 'Quote Declined');
	    $this->redirect(array('/sales/quote/view','id'=>$quote->quote_id));
	}
	
	public function actionMyquotes()
	{
	    $_SESSION['add_quote'] = array(); //Unset quote session
	    if(Yii::app()->user->getState('role') == "admin"):
		$myquotes = Quote::model()->findAll();
	    else:
		$logged_user_id = Yii::app()->user->id;
		$myquotes = Quote::model()->active()->findAll("created_by = {$logged_user_id}");
	    endif;
	    
	    $this->render('myquotes', compact('myquotes'));
	}
}
