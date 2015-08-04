<?php

class PoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','past','manualpo','create','delete','assigntopocart','makepoprice','approve','createpo','viewpodetail'),
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
	    $model = $this->loadModel($id);
	    $this->render('view',compact('model'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($poid = null,$venid = null,$msg = null)
	{
	    if(isset($msg)):
		Yii::app()->user->setFlash('info',$msg);
	    endif;
	    if($poid):
		$model = $this->loadModel($poid);
	    else:
		$model = new Po('create');		
	    endif;
	    
	    if($venid):
		$vendor_products = VendorProducts::model()->active()->findAll("ven_id = $venid");
		$model->po_ven_id = $venid;
	    else:
		unset($_SESSION['po_cart'][$venid]);
	    endif;
	    
	    if(isset($_POST['Po']))
	    {
		$model->scenario = "set";
		$model->attributes = $_POST['Po'];
		if($model->validate()):
		    $_SESSION['po_cart'][$venid] = $_POST['po_product'];
		    $this->redirect(array('/procurement/po/makepoprice','venid'=>$venid));
		endif;
	    }

	    $this->render('create',compact('model','vendor_products','venid'));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->updateAll(array('is_deleted' => '1'));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionPast()
	{
	    $model = Po::model()->po_active()->my()->findAll();
	    $this->render('past_po',compact('model'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Po::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='po-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAssigntopocart()
	{
	    if(Yii::app()->request->isAjaxRequest):
		$type =  @$_REQUEST['type'];
		$prod_id = $type."_".$_REQUEST['prod_id'];
		$task  = @$_REQUEST['task'];
		$quantity = @$_REQUEST['quantity'];
		$venid = @$_REQUEST['venid'];
		$qty = @$_REQUEST['qty'];
		

	    switch($task):
		case "add":
			$_SESSION['po_cart'][$venid][$prod_id] = 1;
		    break;
		case "update":
			$_SESSION['po_cart'][$venid][$prod_id] = $qty;
		    break;
		case "remove":
		    unset($_SESSION['po_cart'][$venid][$prod_id]);
		    break;
	    endswitch;
	    if(!empty($_SESSION['po_cart'][$venid])):
		echo CJSON::encode(Myclass::PoProductList($_SESSION['po_cart'][$venid]));
	    endif;
	    
	    Yii::app()->end();
	    endif;	    
	}
	
	public function actionMakepoprice($venid)
	{
	    $data = Myclass::PoProductList($_SESSION['po_cart'][$venid]);
	    
	    $model = $this->getItemsToUpdate($data);
	    $po = new Po('create');

	    if(isset($_POST['PoProducts'])):
//		var_dump($_POST['PoProducts']); exit;
		$po->attributes = $_POST['Po'];
		$po->po_ven_id = $venid;

		$valid = $po->validate();

		$model = $this->getItemsToUpdate($_POST['PoProducts']);
//		var_dump($model); exit;
		foreach($model as $i=>$poprod)
		{
		    if(isset($_POST['PoProducts'][$i]))
		    {
		    $poprod->attributes = $_POST['PoProducts'][$i];
		    $valid = $poprod->validate() && $valid;
		    }
		}
//		exit;
		if($valid):
		    $po->save(false);
		    foreach($model as $i=>$poprod)
		    {
			if(isset($_POST['PoProducts'][$i])):
			    $poprod->attributes = $_POST['PoProducts'][$i];
			    $arr = explode("_",$poprod->prod_id);
			    $poprod->prod_scenario = $arr[0];
			    $poprod->prod_id = $arr[1];
			    $poprod->po_id	= $po->po_id;
			    $poprod->save(false);
			endif;			
		    }
		    
		    unset($_SESSION['po_cart']);

		    //Register Mail    
		    $reportingmail = CHtml::listData(Myclass::MyReporters(Yii::app()->user->id), 'reportingUser.user_role_id', 'reportingUser.user.userProfiles.email_address');
		    
		    if(!empty($reportingmail) && is_array($reportingmail)):
			foreach($reportingmail as $key=>$email):
			    $uprofile = Myclass::GetUserProfile('',$email);
			    $create_user_profile = Myclass::GetUserProfile(Yii::app()->user->id);
			    $mail = new Sendmail();
			    $subject = "Created New PO Request";
			    $po_url = Yii::app()->createAbsoluteUrl('/site/login',array('return'=>'-home-default-updates'));
			    
			    $trans_array = array(
				    '{PO_ID}'=>$po->po_id,
				    '{PO_DETAIL_URL}'=>$po_url,
				    '{CREATED_BY}'=>  ucwords($create_user_profile->first_name." ".$create_user_profile->last_name)
				    );
			    $message= $mail->getMessage('poapprove',$trans_array);
			    $mail->send($email,$subject,$message);
			    
			    //Notofication Insert
			    Myclass::InsertNotification(11, $po->po_id, Yii::app()->user->id, $uprofile->user_id);
			endforeach;
		    else:
			$po->po_status = "1";
			$po->po_approved_by = Yii::app()->user->id;
			$po->save(false);
		    endif;
			
		    Yii::app()->user->setFlash('success','PO Successfully Created');
		    $this->redirect(array('/procurement/po/past'));
		endif;
	    endif;
	    
	    $this->render('make_po_price',compact('model','po','venid'));
	}
	
	public function getItemsToUpdate($po_products)
	{
	   
	    $items = array();
	    foreach($po_products as $key=>$product):
		$arr = explode("_", $product['prod_id']);
		$product['prod_id'] = $arr[1];
		$product['prod_scenario'] = $arr[0];

		$items[$key]= new PoProducts;
		$items[$key]->attributes = $product;
	    endforeach;
	    return $items;
	}
	
	public function getReceiptsToUpdate($od_id,$po_receipts)
	{
	    $items = array();
	    foreach($po_receipts as $key=>$receipt):
		$arr = explode("_", $receipt['product_id']);
		$receipt['product_id'] = $arr[1];
		$receipt['prod_scenario'] = $arr[0];

		$items[$key]= new PoOrdReceipts;
		$items[$key]->po_ord_id = $od_id;
		$items[$key]->attributes = $receipt;
	    endforeach;
	    return $items;
	}
	
	public function actionApprove($id)
	{
	    $po = $this->loadModel($id);
	    $po->po_status = 1;
	    $po->po_approved_by = Yii::app()->user->id;
	    $po->save(false);
	    
	    //Approve Mail    
	    $uprofile = Myclass::GetUserProfile($po->po_created_by);
	    $approve_user_profile = Myclass::GetUserProfile(Yii::app()->user->id);
	    $approve_by_name = ucwords($approve_user_profile->first_name." ".$approve_user_profile->last_name);

	    $mail = new Sendmail();
	    $subject = "PO #{$po->po_id} Approved By {$approve_by_name}";
	    $po_url = Yii::app()->createAbsoluteUrl('/site/login',array('return'=>'-home-default-updates'));

	    $trans_array = array(
	    '{PO_ID}'=>$po->po_id,
	    '{PO_DETAIL_URL}'=>$po_url,
	    '{CONFIRMD_BY}'=>$approve_by_name
	    );
	    $message= $mail->getMessage('poconfirmed',$trans_array);
	    $mail->send($uprofile->email_address,$subject,$message);

	    //Notofication Insert
	    Myclass::InsertNotification(12, $po->po_id, Yii::app()->user->id, $uprofile->user_id);

	    Yii::app()->user->setFlash('success',  "PO Approved");
	    $this->redirect(array('/procurement/po/view','id'=>$po->po_id));
	}
	
	public function actionCreatepo($id = null,$poid = null,$acttab = 'tab1')
	{
	if($id):
	    $po_req_records = Po::model()->findByPk($id);
	endif;
	

	if(isset($poid)): //From PO
	    $pomodel	    = PoOrder::model()->findByPk($poid);
	    $poprodmodel    = PoOrdProducts::model()->findAll("po_ord_id = {$poid}");
	    $pomilemodel    = PoOrderMilestone::model()->findAll("po_ord_id = {$poid}");
	    $poreceiptmodel = PoOrdReceipts::model()->findAll("po_ord_id = {$poid}");
	    $invoices	    = Invoice::model()->payments()->paid()->findAll("inv_so_id = '$poid'");
	    
	    if(empty($pomilemodel)):
		$count_invoice = RaiseInvoice::model()->count("scenario = 'invoice'");
		for($i=0; $i < $count_invoice;$i++) $pomilemodel[$i] = new PoOrderMilestone;
	    endif;
	else:
	    $pomodel     = new PoOrder('insert');
	endif;
	
	if(isset($_POST['PO_CUST_INFO'])): //isset customer info
	    $pomodel->attributes = $_POST['PoOrder'];
	    if($pomodel->same_as_shipping):
		$pomodel->bill_address	= $pomodel->ship_address;
		$pomodel->bill_city	= $pomodel->ship_city;
		$pomodel->bill_state	= $pomodel->ship_state;
	    endif;
	    
	    if($pomodel->validate()):
		$pomodel->save(false);

		if($id):
		    $this->from_request_create_po($pomodel->po_ord_id,$id);
		else:
//		    $this->from_direct_create_so($pomodel->po_ord_id);
		endif;
		
		Yii::app()->user->setFlash('success','PO Summary Saved Successfully');
		$this->redirect(array('createpo','poid'=>$pomodel->po_ord_id,'acttab'=>'tab2'));
	    endif;
	endif;
	
	if(isset($_POST['PO_ORD_INFO_NEXT']) || isset($_POST['PO_ORD_INFO'])):
	    
	    $acttab = 'tab2';
	    $pomodel->scenario = "order";
	    $pomodel->attributes	= $_POST['PoOrder'];

	    $valid = $pomodel->validate();
	    
//	    $valid = $poprodmodel[0]->valid_so_product_list($soprod_values) && $valid;

	    if($valid):
		$pomodel->save(false);
//		$this->insert_so_products($pomodel->po_ord_id,$soordmodel->od_id,$soprod_values);
		Yii::app()->user->setFlash('success','PO Order Details Saved Successfully');
		
		if(isset($_POST['PO_ORD_INFO_NEXT'])) $acttab = 'tab3';
		
		$this->redirect(array('createpo','poid'=>$pomodel->po_ord_id,'acttab'=>$acttab));
	    
	    else:
//		echo CHtml::errorSummary(array($pomodel),''); exit;
	    endif;	
	endif;
	
	if(isset($_POST['PO_MILE_INFO_BOOK']) || isset($_POST['PO_MILE_INFO_SAVE']) ):
	    
	    $acttab = 'tab3';
	    $valid = true;
	    $pomile_values		= $_POST['PoOrderMilestone'];

	    $valid = $pomilemodel[0]->valid_po_mile($pomile_values,$pomodel->po_ord_total_order);
//	    var_dump($pomilemodel);
	    
	    if($valid):
		$this->insert_po_milestone($pomodel->po_ord_id,$pomile_values);
		
		if(isset($_POST['PO_MILE_INFO_BOOK'])):
		    $admin_id = 1;
		    $acttab   = 'tab4';
		    PoOrdReceipts::model()->deleteAll("po_ord_id = {$pomodel->po_ord_id}");
		    Myclass::AddMilestone($pomodel->po_ord_id,CHtml::listdata(PoOrdProducts::model()->findAll("po_ord_id = {$pomodel->po_ord_id}"),'idwithscenario','quantity'));
		    Yii::app()->user->setFlash('success','PO Created Successfully');
		    $pomodel->po_ord_status = "1";
		    $pomodel->po_ord_created_date = new CDbExpression('NOW()');
		    $pomodel->save(false);
//		    $this->redirect(array('/procurement/po//viewpodetail','id'=>$pomodel->po_ord_id));
		    $this->redirect(array('createpo','poid'=>$pomodel->po_ord_id,'acttab'=>$acttab));
		else:
		    Yii::app()->user->setFlash('success','PO Milestone Details Saved Successfully');
		    $this->redirect(array('createpo','poid'=>$pomodel->po_ord_id,'acttab'=>$acttab));
		endif;
	    else:
//		echo CHtml::errorSummary(array($pomilemodel[0]),''); exit;    
	    endif;	    
	endif;
	
	if(isset($_POST['PO_RELEASE']) || ($_POST['SAVE_RELEASE']) ):
		$poreceiptpost = $_POST['PoOrdReceipts'];
		$poreceiptmodel = $this->getReceiptsToUpdate($pomodel->po_ord_id,$poreceiptpost);
		$valid = true;
		foreach($poreceiptmodel as $i=>$receipt)
		{
		    if(isset($_POST['PoOrdReceipts'][$i]))
		    $receipt->attributes = $_POST['PoProducts'][$i];
		    $valid = $receipt->validate() && $valid;
		}

		if($valid):
		    foreach($poreceiptmodel as $i=>$receipt)
		    {
			if(isset($_POST['PoOrdReceipts'][$i])):
			    $arr = explode("_",$_POST['PoOrdReceipts'][$i]['product_id']);
			    $_POST['PoOrdReceipts'][$i]['product_id'] = $arr[1];
			    $_POST['PoOrdReceipts'][$i]['prod_scenario'] = $arr[0];
			    $receipt_array = $_POST['PoOrdReceipts'][$i];
			    
			    $receipt = PoOrdReceipts::model()->find("po_ord_id = '{$pomodel->po_ord_id}' AND prod_scenario = '{$receipt_array['prod_scenario']}' AND product_id = '{$receipt_array['product_id']}'");
                            
			    $receipt->attributes = $receipt_array;
//                            echo '<pre>';var_dump($receipt);
			    $receipt->save(false);
			    if(isset($_POST['PO_RELEASE']) && $receipt->po_receipt_status != '3'){ //For Client Reject
				if($receipt->prod_scenario == 'product'){
				    Product::model()->updateCounters(array('available_quantity'=>$receipt->quantity),array('condition' => "product_id = '$receipt->product_id'"));
				}
				elseif($receipt->prod_scenario == 'item'){
				    Items::model()->updateCounters(array('available_quantity'=>$receipt->quantity),array('condition' => "item_id = '$receipt->product_id'"));
				}
			    }
			endif;			
		    }
		     exit;
		    if(isset($_POST['PO_RELEASE'])):
			//Notofication Insert
			$pomodel->po_ord_status = "2";
			$pomodel->save(false);
			Myclass::InsertNotification(13, $pomodel->po_ord_id, Yii::app()->user->id, $admin_id);
			Yii::app()->user->setFlash('success','PO Successfully Completed');
			$this->redirect(array('/procurement/po/viewpodetail','id'=>$pomodel->po_ord_id));
                    else:
                        $this->redirect(array('/procurement/po/createpo','poid'=>$pomodel->po_ord_id,'acttab'=>'tab4'));
		    endif;
		endif;
	endif;

	$this->data = compact('po_req_records','pomodel','poprodmodel','pomilemodel','poreceiptmodel','acttab','poid','receipt','invoices');
	
	$this->render('create_po');
    }
    
    public function from_request_create_po($poid,$reqid)
    {
	$quote_products = PoProducts::model()->findAll("po_id = {$reqid}");
	$total_value = 0;
	foreach($quote_products as $product):
	    $so_prodmodel = new PoOrdProducts();
	    $so_prodmodel->po_ord_id = $poid;
	    $so_prodmodel->product_id = $product->prod_id;
	    $so_prodmodel->quantity = $product->quantity;
	    $so_prodmodel->prod_scenario = $product->prod_scenario;
	    $so_prodmodel->vendor_unit_price = $product->vendor_unit_price;
	    $so_prodmodel->item_value =	$product->item_value;
	    $so_prodmodel->discounts = $product->discounts;
	    $so_prodmodel->netcost = $product->net_cost;
	    
	    $total_value += $so_prodmodel->netcost;
	    $so_prodmodel->save(false);
	endforeach;

	if(Myclass::GetSiteSetting('TAX_VALUE','setting_status')):
	    $tax = Myclass::GetSiteSetting('TAX_VALUE'); 
	    $tax_amt = $total_value * $tax / 100;
	else:
	    $tax_amt = "0";
	endif;    
//	echo $total_value,$tax_amt; exit;
	$total_order_value = $total_value + $tax_amt;
	PoOrder::model()->updateByPk($poid, array('po_ord_line_total'=>$total_value,'po_ord_tax'=>$tax_amt,'po_ord_total_order'=>$total_order_value));
    }
    
//    public function from_direct_create_so($soid)
//    {
//	$soordmodel = Orderdetail::model()->find("po_ord_id = {$soid}");
//	if(empty($soordmodel)) $soordmodel  = new Orderdetail();  
//	
//	$soordmodel->po_ord_id = $soid;
//	$soordmodel->save(false);
//	$total_value = 0;
//
//	for($i=0; $i<=2;$i++):
//	    $so_prodmodel = new SoProducts();
//	    $so_prodmodel->po_ord_id = $soid;
//	    $so_prodmodel->od_id = $soordmodel->od_id;
//	    $so_prodmodel->save(false);
//	endfor;
//    }
//    
//    public function insert_so_products($soid,$ordid,$products)
//    {
//	SoProducts::model()->deleteAll("po_ord_id = {$soid}");
//	$count_prod = count($products['product_id']);
//
//	for($i = 0; $i < $count_prod; $i++):
//	    if(!empty($products['product_id'][$i]) && !empty($products['quantity'][$i]) && !empty($products['quote_price'][$i]) && !empty($products['order_value'][$i])):
//		$so_prodmodel = new SoProducts();
//		$so_prodmodel->po_ord_id = $soid;
//		$so_prodmodel->od_id = $ordid;
//		$so_prodmodel->product_id	= $products['product_id'][$i];
//		$so_prodmodel->quantity	= $products['quantity'][$i];
//		$so_prodmodel->quote_price	= $products['quote_price'][$i];
//		$so_prodmodel->order_value	= $products['order_value'][$i];
//		$so_prodmodel->save(false);
//	    endif;
//	endfor;
//    }
//    
    public function insert_po_milestone($poid,$miles)
    {
	PoOrderMilestone::model()->deleteAll("po_ord_id = {$poid}");
	$count_mile = count($miles['milestone_amt']);

	for($i = 0; $i < $count_mile; $i++):    
	    if(!empty($miles['milestone_amt'][$i]) && !empty($miles['milestone_date'][$i])):
		$so_milemodel = new PoOrderMilestone();
		$so_milemodel->po_ord_id	    = $poid;
		$so_milemodel->milestone_amt    = $miles['milestone_amt'][$i];
		$so_milemodel->milestone_date   = $miles['milestone_date'][$i];
		$so_milemodel->raise_invoice    = $miles['raise_invoice'][$i];
		$so_milemodel->save(false);
	    endif;
	endfor;
    }
    
     public function actionViewpodetail($id){

	    $summary = PoOrder::model()->findByPk($id);    
            $product = PoOrdProducts::model()->findAll("po_ord_id = $summary->po_ord_id");	    
            $milestones = PoOrderMilestone::model()->findAll("po_ord_id = $summary->po_ord_id");
            $receipts = PoOrdReceipts::model()->findAll("po_ord_id = $summary->po_ord_id");
	    $invoices = Invoice::model()->payments()->paid()->findAll("inv_so_id = '$id'");
	    
	    $this->data = compact('summary','product','milestones','receipts','invoices');
            $this->render('viewpodetail');
        }
	public function actionManualpo()
	{
	    $model = new ManualPo("update_man_po_payment");
            
//            $mpomodel = new ManualPoProducts();
            for ($i = 0; $i < 3; $i++):
                $mpomodel[$i] = new ManualPoProducts();
            endfor;

	    if(isset($_POST['ManualPo'])):
		$model->attributes = $_POST['ManualPo'];
		if($model->validate()):
		    $model->save(false);
		    $this->addManualPoProducts($_POST['ManualPoProducts'],$model->pay_id);
		    Yii::app()->user->setFlash('success','Manual PO"s Created Successfully');
		    $this->redirect(array('/finance/invoice/induepayments',"mode"=>"manual"));
		endif;
	    endif;
	    $this->render('manual_po',compact('model','mpomodel'));  
	}
	
	public function addManualPoProducts($products,$id)
	{
	    foreach($products['product_name'] as $key => $product_name):
		if(!empty($product_name) && !empty($products['quantity'][$key]) && !empty($products['price'][$key])):
		    $model = new ManualPoProducts();
		    $model->manual_po_id    = $id;
		    $model->product_name    = $product_name;
		    $model->quantity	    = $products['quantity'][$key];
		    $model->price	    = $products['price'][$key];
		    $model->save(false);
		endif;
	    endforeach;
	    return true;
	}

}
