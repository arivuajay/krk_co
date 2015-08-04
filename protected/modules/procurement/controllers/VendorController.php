<?php
class VendorController extends Controller
{
	public function init()
	{
	    $this->renderPartial('//layouts/_procurement_mod_left_menu');
	}
	/**
	 * @return array action filters
	 */
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','create','view','delete','delcontact','assigntoproduct'),
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
	public function actionCreate($venid = null,$contid=null,$acttab="tab1")
	{
	    if($venid): 
		$model = $this->loadModel($venid); 
		$avail_contact = VendorContact::model()->findAll("ven_id = $venid");
		$products = Product::model()->active()->findAll();
		$items	  = Items::model()->active()->findAll();

//		if(!empty($_SESSION['vendor_product'])):
//		    $vendor_products_array = $_SESSION['vendor_product'];
//		    $vendor_products = CJSON::encode(Myclass::AssignProductList($vendor_products_array));
//		else:
		    $vendor_products_array = CHtml::listData(VendorProducts::model()->findAll("ven_id = $venid"),"idwithscenario","ven_prod_price");
		    if(!empty($vendor_products_array)):
			$_SESSION['vendor_product'] = $vendor_products_array;
			$vendor_products = CJSON::encode(Myclass::AssignProductList($vendor_products_array));
		    endif;
//		endif;
	    else:
		$model = new Vendor;
	    endif;	    
	    if($contid): $contact = VendorContact::model()->findByPk($contid); $acttab = "tab2";
	    else:	$contact = new VendorContact; endif;

	    if(isset($_POST['Vendor']))
	    {
		    $model->attributes=$_POST['Vendor'];

		    if($model->validate()):
			if ($model->same_shipping)
			{  
			$model->ship_addr   = $model->bill_addr;
			$model->ship_city   = $model->bill_city;
			$model->ship_state  = $model->bill_state;
			}
			$model->save(false);
			Yii::app()->user->setFlash('success','Vendor Information Created Successfully');
			$this->redirect(array('create','venid'=>$model->ven_id));
		    endif;
	    }
	    
	    if(isset($_POST['VendorContact']))
	    {
		    $contact->attributes = $_POST['VendorContact'];
		    $contact->ven_id	 = $venid;
		    if(!empty($contact->off_phone)) $contact->off_phone = implode("-",$contact->off_phone);
		    if(!empty($contact->mobile))    $contact->mobile	= implode("-",$contact->mobile);
		    
		    if($contact->validate()):
			$contact->save(false);
			Yii::app()->user->setFlash('success','Vendor Contact Information Created Successfully');
			$this->redirect(array('create','venid'=>$model->ven_id,'acttab'=>'tab2'));
		    endif;
	    }
	    
	    if(isset($_POST['VendorProducts']))
	    {
		$items = $_POST['VendorProducts'];
		VendorProducts::model()->deleteAll("ven_id = $venid");
		foreach($items as $i=>$item)
		{
		    if(!empty($item['ven_prod_price']) && !empty($item['ven_prod_id'])):
			$assign			=   new VendorProducts;
			$assign->ven_id		=   $venid;
			$arr = explode("_",$item['ven_prod_id']);
			$assign->prod_scenario	=   $arr[0];
			$assign->ven_prod_id	=   $arr[1];
			$assign->ven_prod_price	=   $item['ven_prod_price'];
			$assign->save(false);
		    endif;
		}
		unset($_SESSION['vendor_product']);
		Yii::app()->user->setFlash('success','Vendor Product Information Created Successfully');
		$this->redirect(array('create','venid'=>$model->ven_id,'acttab'=>'tab3'));
	    }
		
	    $this->data = compact('model','acttab','avail_contact','contact','products','items','vendor_products','vendor_products_array');
	    $this->render('vendor_form',$this->data);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = Vendor::model()->findByPk($id);
		$model->is_deleted = "1";
		$model->save(false);
		Yii::app()->user->setFlash('success','Vendor Info Successfully Deleted');
		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $lists = Vendor::model()->active()->findAll();
	    $this->render('index',compact('lists'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Vendor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vendor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDelcontact($contid,$venid)
	{
	    VendorContact::model()->deleteByPk($contid);
	    Yii::app()->user->setFlash('success','Contact Deleted Successfully');
	    $this->redirect(array('create','venid'=>$venid,'acttab'=>'tab2'));
	}
	
	public function actionAssigntoproduct()
	{
	    if(Yii::app()->request->isAjaxRequest):
		$type =  @$_REQUEST['type'];
		$prod_id = $type."_".$_REQUEST['prod_id'];
		$task  = @$_REQUEST['task'];
		$assign_price =  $_REQUEST['assign_price'];

	    switch($task):
		case "add":
			$_SESSION['vendor_product'][$prod_id] = $assign_price;
		    break;
		case "remove":
		    unset($_SESSION['vendor_product'][$prod_id]);
		    break;
	    endswitch;
		echo CJSON::encode(Myclass::AssignProductList($_SESSION['vendor_product']));
		Yii::app()->end();
	    endif;	    
	}
}