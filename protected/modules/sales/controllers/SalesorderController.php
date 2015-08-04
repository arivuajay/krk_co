<?php

class SalesorderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        public function init()
	{
	    $this->renderPartial('//layouts/_sales_mod_left_menu');
	    //$this->defaultAction = 'salesorder/create';
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
				'actions'=>array('admin','delete','index','view','create','update','viewsodetail','getcompanydetails','assignSo','Soview','deleteso','assignsomod','searchproduct'),
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
	public function actionView()
	{
	    if(Yii::app()->user->getState('role') == 'admin'):
		$so = Salesorder::model()->so_active()->not_deleted()->findAll();
	    else:
		$so = Salesorder::model()->not_deleted()->my()->findAll();
	    endif;

	    $model = new Salesorder();
	    $this->render('view_so',compact('so','model'));
	}



        //SO view in detail

        public function actionViewsodetail($id){

	    $soCdetail=Salesorder::model()->findByPk($id);    
            $soOdetail=Orderdetail::model()->find('so_id=:sid',array('sid'=>$id));
            $soPdetail = SoProducts::model()->findAll('od_id=:oid',array('oid'=>$soOdetail->od_id));
            $soMdetail = SalesOrderMilestone::model()->findAll('so_id=:sid',array('sid'=>$id));
	    $invoices = Invoice::model()->invoice()->paid()->findAll("inv_so_id = '$id'");

            $this->render('viewsodetail',compact('soCdetail','soOdetail','soPdetail','soMdetail','invoices'));
        }
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
//	public function actionCreate($active_tab = 'tab1')
//	{
//                
//		$smodel=new Salesorder;
//                unset (Yii::app()->session['quote_id']);//Unset when coming from
//                if(isset($_REQUEST['id'])){
//                    
//                     $quote_id = $_REQUEST['id'];
//                    #Get all value from qyote table based on quote id
//                    //
////                     $posts=Quote::model()->with('company','quoteApproves','quoteProducts','companyContact')->findAll('quote_id:=param_qid',array('param_qid'=>$quote_id));
////                   print"<pre>";
////                   print_r($posts);exit;
////                    $smodel->quote_id = $quote_id;
////                    $smodel->customer_id = $posts[0]['company_id'];
////                    //$posts[0]['created_by'];
////                    $smodel->quote_approved = $posts[0]['approved_by'];
////                    $smodel->quote_created = $posts[0]['created_date'];
////                    $smodel->customer = $posts[0]['company']['name'];
////                    $smodel->phone = $posts[0]['company']['office_phone'];
////                    $smodel->reference_quote_id = $posts[0]['quote_id'];
////                    $smodel->primary_contact = $posts[0]['companyContact']['primary_contact'];
////                    $smodel->bill_address = $posts[0]['company']['billing_address'];
////                    $smodel->bill_city = $posts[0]['company']['billing_city'];
////                    $smodel->bill_state = $posts[0]['company']['billing_state'];
////                    $smodel->same_as_shipping = $posts[0]['company']['same_shipping'];
////                    $smodel->ship_address = $posts[0]['company']['shipping_address'];
////                    $smodel->ship_city = $posts[0]['company']['shipping_city'];
////                    $smodel->ship_state = $posts[0]['company']['shipping_state'];
//
//		     
//		    $posts=Quote::model()->findByPk($quote_id);
////                   print"<pre>";
////                   print_r($posts);exit;
//                    $smodel->quote_id = $quote_id;
//                    $smodel->customer_id = $posts->company_id;
//                    //$posts[0]['created_by'];
//                    
//                    $approved_by = Myclass::getApprovedBy($posts->approved_by);
//                    
//                    $smodel->quote_approved = $approved_by;
//                    $smodel->quote_created = $posts->created_date;
//                    $smodel->customer = $posts->company->name;
//                    $smodel->phone = $posts->company->office_phone;
//                    $smodel->reference_quote_id = $posts->quote_id;
//		    $primary_cnt = Myclass::GetCompanyPrimarycontact($posts->company_id);
//                    $smodel->primary_contact = $primary_cnt->email;
//                    $smodel->bill_address = $posts->company->billing_address;
//                    $smodel->bill_city = $posts->company->billing_city;
//                    $smodel->bill_state = $posts->company->billing_state;
//                    $smodel->same_as_shipping = $posts->company->same_shipping;
//                    $smodel->ship_address = $posts->company->shipping_address;
//                    $smodel->ship_city = $posts->company->shipping_city;
//                    $smodel->ship_state = $posts->company->shipping_state;		     
//		     
//                    Yii::app()->session['quote_id'] = $quote_id;//Setting quote id into session
//                }
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//                    $company = array();
//                    $company = Myclass::GetCompanies();
//
////                    foreach($as as $a){
////                    $company[] = $a->company_id;
////                    }
//
//		if(isset($_POST['Salesorder']))
//		{
//			$active_tab = 'tab1';
//			$smodel->attributes=$_POST['Salesorder'];
////			$smodel->created_by =   Yii::app()->user->id;
//			
////			echo '<pre>';print_r($smodel); exit;
//			if($smodel->save())
//                        {
//
//                                  //$session=new CHttpSession;
//                                  //$session->destroy();
//                                  //$session->open();
////                                  $session['quote_id']=
//                                    $so_id = Yii::app()->db->getLastInsertID();
//                                    Yii::app()->session['so_id'] = $so_id;//Setting quote id into session
//                                    //echo Yii::app()->session['quote_id']; // Prints "value"
//                                 // echo $session['quote_id'];
//				 $active_tab = 'tab2';
//                                 Yii::app()->user->setFlash('success','Customer Information Created Successfully<br>');
//				//$this->redirect(array('view','id'=>$smodel->so_id));
//                        }
//		}
//
//
//		$omodel=new Orderdetail;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//                 if(isset($_REQUEST['id'])){
//
//                    $quote_id = $_REQUEST['id'];
//                    //$OrderDetails=QuoteProduct::model()->findAll('quote_id=:qui',array('qui'=>$quote_id));
//                    
//                    $QuoteProduct=QuoteProduct::model()->with('product')->findAll('quote_id=:qui',array('qui'=>$quote_id));
//
//                 }else{
//
//                        $QuoteProduct = Orderdetail::model()->findAll('so_id=:sid',array('sid'=>Yii::app()->session['so_id']));
//                 }
//                 
//		if(isset($_POST['Orderdetail']))
//		{
//		    $active_tab = 'tab2';
//                     
//                      $QuoteProducts = $_POST['QuoteProduct'];
//                      
//			$omodel->attributes=$_POST['Orderdetail'];
//
//                        
//                        
//                        
//			if($omodel->save()){
//
//
//                            
//                                 $od_id = Yii::app()->db->getLastInsertID();
//
//
//			foreach($QuoteProducts as $pp)
//			{
//                         $SOProducts = new SoProducts();
//                         $SOProducts->od_id = $od_id;
//                         $SOProducts->product_name = $pp['product'];
//                         $SOProducts->quantity = $pp['quantity'];
//                         $SOProducts->quote_price = $pp['quote_price'];
//                         $SOProducts->order_value = $pp['order_value'];
//                         $SOProducts->save(false);
//                         unset ($SOProducts);
//			}
//                     
//				//$this->redirect(array('view','id'=>$omodel->so_id));
//		//}
//                      $active_tab = 'tab3';
//                     Yii::app()->user->setFlash('success','Order Detail Created Successfully<br>');
//                        }
//                }
//
//                $imodel=new SalesOrderMilestone;
//                $invoice = SalesOrderMilestone::model()->findAll('so_id=:sid',array('sid'=>Yii::app()->session['so_id']));
//
//                //$quote_id = '';
//                //$quote_id = Yii::app()->session['so_id'];
//                
//                
//                if(isset(Yii::app()->session['so_id'])){
//                    $salesValue = Salesorder::model()->findAll('so_id=:qid',array('qid'=>Yii::app()->session['so_id']));
//                    $orderValue = Orderdetail::model()->findAll('so_id=:qid',array('qid'=>Yii::app()->session['so_id']));
//                }else{
//                    $orderValue = Orderdetail::model()->findAll();
//                    
//                }
//
//
//               
//                if(isset($_POST['IFORM'])){
//		    $active_tab = 'tab3';
//                    $imodel->attributes=$_POST['Invoice'];
//                    $Invoice = $_POST['Invoice'];
//		    $so_id = $_POST['so_id'];
//		    if(!empty($Invoice)):
//			
//		    $total_amt = 0;
//		    $invoices_rec = array();
//		    $error = false;
//
//		    foreach($Invoice as $key=>$record):
//			if($record['milestone_amt'] != '' || $record['milestone_date'] != '' || $record['milestone_amt'] != ''):
//			    $total_amt += $record['milestone_amt'];
//			    $invoices_rec[] =  $record['raise_invoice'];
//			else:
//			    Yii::app()->user->setFlash('error','Enter Milestone details');
//			    $error = true;	
//			    break;
//			endif;    
//		    endforeach;
////		    echo $total_amt;
//		    if($total_amt != $orderValue[0]['total_order_value']):
//			Yii::app()->user->setFlash('error','Milestone Amount Not Equal to Total Amount');
//			$error = true;
//		    endif;
//		    
//		    if(count(array_unique($invoices_rec))<count($invoices_rec)):
//			Yii::app()->user->setFlash('error','Should not given the same Milestone');
//			$error = true;
//		    endif;
//		    
//		    if(!$error):
//			foreach($Invoice as $inv):    
//				$SOInv = new SalesOrderMilestone();
//				$SOInv->milestone_amt = $inv['milestone_amt'];;
//				$SOInv->milestone_date = $inv['milestone_date'];
//				$SOInv->raise_invoice = $inv['raise_invoice'];
//				$SOInv->so_id = $_POST['so_id'];
//				$SOInv->save(false);
//				unset ($SOInv);
//			endforeach;
//			$admin_id = 1;
//
//			//Notofication Insert
//			Myclass::InsertNotification(4, $so_id, Yii::app()->user->id, $admin_id);
//			Yii::app()->user->setFlash('success','Invoice Information Created Successfully<br>');
//		    endif;
//		else:
//		   Yii::app()->user->setFlash('error','Enter Milestone details');
//		endif;
//
////            if(empty ($_POST['Invoice'][0][milestone_amt]) || empty($_POST['Invoice'][0][milestone_date]) || empty($_POST['Invoice'][0][raise_invoice])){
////
////                        Yii::app()->user->setFlash('error','Enter MIlestone details');
////
////               
////                }else{
//////			    unset(Yii::app()->session['so_id']);
////                    
////                         
////               }
//	        
//
////                $this->redirect(array('view'));
//                }
////                if(empty ($_POST['Invoice'])){
////
////
////		    
////
////                }
//
////		if(empty($invoice))
////		{
////		    for($i=0;$i<2;$i++) { $invoice[$i] = new SalesOrderMilestone(); }
////		}
//		
//		$this->render('create',array(
//			'smodel'=>$smodel,
//			'omodel'=>$omodel,
//			'imodel'=>$imodel,
//			'QuoteProduct'=>$QuoteProduct,
//			'invoice'=>$invoice,
//			'orderValue'=>$orderValue,
//			'salesValue'=>$salesValue,
//                        'active_tab'=>$active_tab,
//                        'company'=>$company,
//		));
//	}

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

		if(isset($_POST['Salesorder']))
		{
			$model->attributes=$_POST['Salesorder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->so_id));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Salesorder');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Salesorder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Salesorder']))
			$model->attributes=$_GET['Salesorder'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


        /*
         * Assign SO
         */

        public function actionAssignSo(){

//
           
        $assignInfo = $_POST['Salesorder']['assigned'];

           foreach($assignInfo as $key => $value){ break; }
        
         //Getting the Production User

           $productionUser = UserRole::model()->findAll('user_role_id =:rid',array('rid'=>$value));//role production = 2
           $productionUsername = $productionUser[0]->user->user_name;
          
           

           $productionUserid = $productionUser[0]->user->user_id;

           //Updating with the assigned value
           $connection=Yii::app()->db;
           $sql="UPDATE tbl_salesorder SET assigned = {$productionUserid} WHERE so_id = {$key}";
           $connection->createCommand($sql)->execute();

           

           $ff = 'Assigned to '.$productionUsername;
           echo $ff.'||'.$key;


           //Notofication Insert
           Myclass::InsertNotification(5, $key, Yii::app()->user->id, $productionUserid);

           $productionUserProfile = UserProfile::model()->findAll('user_id =:uid',array('uid'=>$productionUserid));//role production = 2

           
           $useremail = $productionUserProfile[0][email_address];
           
           


            $soCdetail=Salesorder::model()->findAll('so_id=:sid',array('sid'=>$key));
            $soOdetail=Orderdetail::model()->findAll('so_id=:sid',array('sid'=>$key));
            $od_id = $soOdetail[0][od_id];
            $soPdetail = SoProducts::model()->findAll('od_id=:oid',array('oid'=>$od_id));
//            print"<pre>";
//            print_r($soPdetail);exit;
            $soMdetail=SalesOrderMilestone::model()->findAll('so_id=:sid',array('sid'=>$key));

            if($soCdetail[0][same_as_shipping] == 0)
                {
                $bill_address =  $soCdetail[0][ship_address];
                $bill_city =  $soCdetail[0][ship_city];
                $bill_state =  $soCdetail[0][ship_state];

                }else{

                $bill_address =  $soCdetail[0][bill_address];
                $bill_city =  $soCdetail[0][bill_city];
                $bill_state =  $soCdetail[0][bill_state];

                }

                $productinfo = '';
                
                foreach($soPdetail as $sop){

$productinfo .= '
<tr>
<td>PRODUCT NAME</td>
<td>'.$sop->product_name.'</td>
<td>QUANTITY</td>
<td>'.$sop->quantity.'</td>
<td>QUOTE PRICE</td>
<td>'.$sop->quote_price.'</td>
<td>ORDER VALUE</td>
<td>'.$sop->order_value.'</td>
</tr>
';


                }


                $milestoneInfo = '';

                foreach($soMdetail as $som){
$raiseInvoice = Myclass::getraiseInvoice($som->raise_invoice);
$milestoneInfo .= '
<tr>
<td>MILESTONE ID</td>
<td>'.$som->milestone_id.'</td>
<td>MILESTONE AMOUNT</td>
<td>'.$som->milestone_amt.'</td>
<td>MILESTONE DATE</td>
<td>'.$som->milestone_date.'</td>
<td>RAISE INVOICE</td>
<td>'.$raiseInvoice.'</td>
</tr>
';


                }


           $mail = new Sendmail;

                    $trans_array = array(
                            "{SOID}" => $soCdetail[0][so_id],
                            "{CUSTOMERID}" => $soCdetail[0][customer_id],
                            "{CUSTOMERNAME}" => $soCdetail[0][customer],
                            "{PRIMARYCONTACT}" => $soCdetail[0][primary_contact],
                            "{REFERENCEQUOTE}" => $soCdetail[0][reference_quote_id],
                            "{PHONE}" => $soCdetail[0][phone],
                            "{SHIPADDRESS}" => $soCdetail[0][ship_address],
                            "{SHIPCITY}" => $soCdetail[0][ship_city],
                            "{SHIPSTATE}" => $soCdetail[0][ship_state],
                            "{BILLADDRESS}" => $bill_address,
                            "{BILLCITY}" => $bill_city,
                            "{BILLSTATE}" => $bill_state,
                            "{ORDERDATE}" => $soOdetail[0][order_date],
                            "{SHIPMENTDATE}" => $soOdetail[0][shipment_date],
                            "{PRODUCTINFO}" => $productinfo,
                            "{TAX}" => $soOdetail[0][tax],
                            "{TOTALORDERVALUE}" => $soOdetail[0][total_order_value],
                            "{MILESTONEINFO}" => $milestoneInfo,
                            );


           $message= $mail->getMessage('salesorder',$trans_array);

                       

                    //$mail->send($email,'Sales Order Report',$message);
           
           
           

           
        }

	
	public function actionAssignsomod(){

	   $assignInfo = $_POST['Salesorder']['assigned'];
	   $request = $_POST['Salesorder'];
//	$request comes Array (  [pack_assigned] => Array([14] => 29))
	   $column = key($_POST['Salesorder']);
	   $so_id  = key($_POST['Salesorder'][$column]);
	   $value  = $_POST['Salesorder'][$column][$so_id];
	   
	   //Getting the Production User
           $productionUser = UserRole::model()->findAll('user_role_id =:rid',array('rid'=>$value));//role production = 2
           $productionUsername = $productionUser[0]->user->fullname;
           $assigned_to = $productionUser[0]->user->user_id;

	   


	   $so_model = Salesorder::model()->findByPk($so_id);
	   $so_model->$column = $assigned_to;
	   if($so_model->so_status == 0) $so_model->so_status = 1;
	   $so_model->save(false);
	   
	   switch ($so_model->so_status):
	       case '1': $notify_type = 5; break;
	       case '2': $notify_type = 7; break;
	       case '3': $notify_type = 9; break;		   
	   endswitch;
	   
           Myclass::InsertNotification($notify_type, $so_id, Yii::app()->user->id, $assigned_to);

           $ff = 'Assigned to '.$productionUsername;
           echo $ff.'||'.$so_model->so_id;

        }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Salesorder::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='salesorder-form')
		{
                    
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



        //view all SO

        public function actiondeleteso()
	{
            $delete_id = $_REQUEST['id'];
            Salesorder::model()->updateByPk($delete_id, array('is_deleted' => '1'));
//	    $so = Salesorder::model()->find('so_id =:sid',array('sid'=>$delete_id));
//            $so->is_deleted = 1;
//            $so->save(false);

            Yii::app()->user->setFlash('success','SO Deleted Successfully<br>');
	    $this->redirect(array('salesorder/view'));
	}

        public function actionSearchproduct($prod_id,$quantity)
	{
//	    $product = Product::model()->findByPk($prod_id);
            $product = Myclass::getprice_via_qty($prod_id,$quantity);
	    echo CJSON::encode($product);
	    Yii::app()->end();
	}


        public function actionSoview() {
            $so = Salesorder::model()->findAll('so_status=:param_s',array('param_s'=>5));
	    $model = new Salesorder();
	    $this->render('Soview',compact('so','model'));
        }



        public function actionGetcompanydetails()
	{
	    $customer_id = $_POST['Salesorder']['customer_id'];  
	    $companyDetail = Company::model()->findByPk($customer_id);

	    echo CJSON::encode($companyDetail);
	    Yii::app ()->end();
        }
	
        public function actionCreate($quoteid = null,$soid = null,$active_tab = 'tab1')
	{
	if($quoteid):
	    $quote_records = Quote::model()->findByPk($quoteid);
	endif;
	

	if(isset($soid)): //From SO
	    $somodel     = Salesorder::model()->findByPk($soid);
	    $somodel->scenario =  'insert';
	    $soordmodel     = Orderdetail::model()->find("so_id = {$soid}");
	    $soprodmodel    = SoProducts::model()->findAll("so_id = {$soid}");
		$quote_records  = Quote::model()->findByPk($somodel->quote_id);
	    $somilemodel    = SalesOrderMilestone::model()->findAll("so_id = {$soid}");
	    if(empty($somilemodel)):
		$count_invoice = RaiseInvoice::model()->count("scenario = 'salesorder'");
		for($i=0; $i < $count_invoice;$i++) $somilemodel[$i] = new SalesOrderMilestone;
	    endif;
	else:
	    $somodel     = new Salesorder('insert');
	endif;
	
	if(isset($_POST['SO_CUST_INFO'])): //isset customer info
	    $somodel->attributes = $_POST['Salesorder'];
	    if($somodel->same_as_shipping):
		$somodel->bill_address	= $somodel->ship_address;
		$somodel->bill_city	= $somodel->ship_city;
		$somodel->bill_state	= $somodel->ship_state;
	    endif;
	    
	    if($somodel->validate()):
		$somodel->save(false);

		if($quoteid):
		    $this->from_quote_create_so($somodel->so_id,$quoteid);
		else:
		    $this->from_direct_create_so($somodel->so_id);
		endif;
		
		Yii::app()->user->setFlash('success','SO Customer Info Saved Successfully');
		$this->redirect(array('create','soid'=>$somodel->so_id,'active_tab'=>'tab2'));
	    endif;
	endif;
	
	if(isset($_POST['SO_ORD_INFO_NEXT']) || isset($_POST['SO_ORD_INFO'])):
	    
	    $active_tab = 'tab2';
	    $soordmodel->attributes	= $_POST['Orderdetail'];
	    $soprod_values		= $_POST['SoProducts'];

	    $valid = $soordmodel->validate();
//	    $valid = $soprodmodel[0]->valid_so_product_list($soprod_values) && $valid;

	    if($valid):
		$soordmodel->save(false);
		$this->insert_so_products($somodel->so_id,$soordmodel->od_id,$soprod_values);
		Yii::app()->user->setFlash('success','SO Order Details Saved Successfully');
		
		if(isset($_POST['SO_ORD_INFO_NEXT'])) $active_tab = 'tab3';
		
		$this->redirect(array('create','soid'=>$somodel->so_id,'active_tab'=>$active_tab));
	    
	    else:
//		echo CHtml::errorSummary(array($soordmodel,$soprodmodel[0]),''); exit;
	    endif;	
	endif;
	
	if(isset($_POST['SO_MILE_INFO_BOOK']) || isset($_POST['SO_MILE_INFO_SAVE']) ):
	    
	    $active_tab = 'tab3';
	    $valid = true;
	    $somile_values		= $_POST['SalesOrderMilestone'];
	    $errormilemodel = new SalesOrderMilestone();
	    $valid = $errormilemodel->valid_so_mile($somile_values,$soordmodel->total_order_value,$errormilemodel);

	    if(!$errormilemodel->hasErrors()):
		$this->insert_so_milestone($somodel->so_id,$somile_values);
		
		if(isset($_POST['SO_MILE_INFO_BOOK'])):
		    $admin_id = 1;
		    //Notofication Insert
		    $somodel->so_status = 1;
		    $somodel->so_created_date = new CDbExpression('NOW()');
		    $somodel->save(false);
		    Myclass::InsertNotification(4, $somodel->so_id, Yii::app()->user->id, $admin_id);
		    
		    Yii::app()->user->setFlash('success','SO Created Successfully');
		    $this->redirect(array('/sales/salesorder/viewsodetail','id'=>$somodel->so_id));
		else:
		    Yii::app()->user->setFlash('success','SO Milestone Details Saved Successfully');
		    $this->redirect(array('create','soid'=>$somodel->so_id,'active_tab'=>$active_tab));
		endif;
	    endif;	    
	endif;
	$this->data = compact('quote_records','somodel','soprodmodel','errormilemodel','somilemodel','soordmodel','active_tab','soid');
	
	$this->render('create_1');
    }
    
    public function from_quote_create_so($soid,$quoteid)
    {
	$soordmodel  = new Orderdetail();  
	$soordmodel->so_id = $soid;
	$soordmodel->save(false);
	$quote_products = QuoteProduct::model()->findAll("quote_id = {$quoteid}");
	$total_value = 0;

	foreach($quote_products as $product):
	    $so_prodmodel = new SoProducts();
	    $so_prodmodel->so_id = $soid;
	    $so_prodmodel->od_id = $soordmodel->od_id;
	    $so_prodmodel->product_id = $product->product_id;
	    $so_prodmodel->quantity = $product->quantity;
	    $so_prodmodel->quote_price = $product->quote_price;
	    $total_value += $product->quantity * $product->quote_price;
	    $so_prodmodel->order_value = $product->quantity * $product->quote_price;
	    $so_prodmodel->save(false);
	endforeach;
	$tax = Myclass::GetSiteSetting('TAX_VALUE'); 
	$tax_amt = $total_value * $tax / 100;
	$total_order_value = $total_value + $tax_amt;
	Orderdetail::model()->updateByPk($soordmodel->od_id, array('line_total'=>$total_value,'tax'=>$tax_amt,'total_order_value'=>$total_order_value));
    }
    
    public function from_direct_create_so($soid)
    {
	$soordmodel = Orderdetail::model()->find("so_id = {$soid}");
	if(empty($soordmodel)) $soordmodel  = new Orderdetail();  
	
	$soordmodel->so_id = $soid;
	$soordmodel->save(false);
	$total_value = 0;

	for($i=0; $i<=2;$i++):
	    $so_prodmodel = new SoProducts();
	    $so_prodmodel->so_id = $soid;
	    $so_prodmodel->od_id = $soordmodel->od_id;
	    $so_prodmodel->save(false);
	endfor;
    }
    
    public function insert_so_products($soid,$ordid,$products)
    {
	SoProducts::model()->deleteAll("so_id = {$soid}");
	$count_prod = count($products['product_id']);

	for($i = 0; $i < $count_prod; $i++):
	    if(!empty($products['product_id'][$i]) && !empty($products['quantity'][$i]) && !empty($products['quote_price'][$i]) && !empty($products['order_value'][$i])):
		$so_prodmodel = new SoProducts();
		$so_prodmodel->so_id = $soid;
		$so_prodmodel->od_id = $ordid;
		$so_prodmodel->product_id	= $products['product_id'][$i];
		$so_prodmodel->quantity	= $products['quantity'][$i];
		$so_prodmodel->quote_price	= $products['quote_price'][$i];
		$so_prodmodel->order_value	= $products['order_value'][$i];
		$so_prodmodel->save(false);
	    endif;
	endfor;
    }
    
    public function insert_so_milestone($soid,$miles)
    {
	SalesOrderMilestone::model()->deleteAll("so_id = {$soid}");
	$count_mile = count($miles['milestone_amt']);

	for($i = 0; $i < $count_mile; $i++):    
	    if(!empty($miles['milestone_amt'][$i]) && !empty($miles['milestone_date'][$i]) && !empty($miles['raise_invoice'][$i])):
		$so_milemodel = new SalesOrderMilestone();
		$so_milemodel->so_id	    = $soid;
		$so_milemodel->milestone_amt    = $miles['milestone_amt'][$i];
		$so_milemodel->milestone_date   = $miles['milestone_date'][$i];
		$so_milemodel->raise_invoice    = $miles['raise_invoice'][$i];
		$so_milemodel->save(false);
	    endif;
	endfor;
    }
    
    
}



