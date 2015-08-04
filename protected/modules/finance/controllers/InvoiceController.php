<?php

class InvoiceController extends Controller
{
	public function init()
	{
	    $this->renderPartial('//layouts/_finance_mod_left_menu');
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
				'actions'=>array('index','view','past','changemode','paid','delete','manualpo','modal_send_invoice','modal_update_po_payments','modal_update_man_po_payments','modal_update_payments','accountsummary','induepayments','pastpayments','manualpoview','printinvoice','printquote','printso'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	    $new_invoice = Invoice::model()->invoice()->active()->new()->findAll();
	    $this->render('index',compact('new_invoice'));
	}
	public function actionPast()
	{
	    $new_invoice = Invoice::model()->invoice()->active()->past()->findAll();

	    $this->render('past',compact('new_invoice'));
	}
	
	public function actionInduepayments($mode = null)
	{
	    if(isset($mode) && ($mode == "manual")):
		$new_invoice = ManualPo::model()->active()->new()->findAll();
	    else:
		$new_invoice = Invoice::model()->payments()->indue()->active()->findAll();
	    endif;
	    $this->render('induepayments',compact('new_invoice','mode'));
	}
	
	public function actionChangemode($view,$val)
	{
	    if(Yii::app()->request->isAjaxRequest):	
		$output = array();
		if($val == '0'):
		    $new_invoice =  ($view == 'active') ? Invoice::model()->payments()->indue()->active()->findAll() : Invoice::model()->payments()->active()->paid()->findAll();		
		
		    foreach ($new_invoice as $key => $invoice) :
			if($invoice->inv_scenario == "salesorder"):
			    $cust_name = $invoice->invSo->company->name;
			    $inv_state = Myclass::getRaiseInvoice($invoice->invMilestone->raise_invoice);
			    $ord_link  = CHtml::link(SO_PREFIX.$invoice->invSo->so_id,array('/sales/salesorder/viewsodetail','id'=>$invoice->invSo->so_id),array('target'=>'_blank'));
			    $pre = INVOICE_PREFIX;
			elseif($invoice->inv_scenario == "poorder"):
			    $cust_name = $invoice->invPO->vendor->ven_name;
			    $inv_state = Myclass::getRaiseInvoice($invoice->invPOMilestone->raise_invoice,true);
			    $ord_link  = CHtml::link(PO_PREFIX.$invoice->invPO->po_ord_id,array('/procurement/po/viewpodetail','id'=>$invoice->invPO->po_ord_id),array('target'=>'_blank'));
			    $pre = PAYMENT_PREFIX;
			endif; 
			
			if($view == 'active'):
			    $action = CHtml::ajaxLink('Update Payment', Yii::app()->createUrl('/finance/invoice/modal_update_po_payments',array('id'=>$invoice->inv_id)), 
				    array('success'=>'function(r){$("#modal_update_payments").html(r).modal("toggle"); return false;}'), 
				    array('title'=>'Read More','rel'=>'tooltip'));
			else:	
			    $action = CHtml::link('<i class="cus-icon-zoom"></i>',array('/finance/invoice/view','id'=>$invoice->inv_id),array('title'=>'View','rel'=>'tooltip'));
			endif;

			    $output[$key][0] = $key+1;
			    $output[$key][1] = CHtml::link($pre.$invoice->inv_id,array('/finance/invoice/view','id'=>$invoice->inv_id));    
			    $output[$key][2] = ucwords($cust_name);
			    $output[$key][3] = date(FORMAT_DATE,strtotime($invoice->inv_due_date));
			    $output[$key][4] = $inv_state;
			    $output[$key][5] = $ord_link;
			    $output[$key][6] = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->inv_payment;
			    $output[$key][7] = $action;
		    endforeach;
		else: //Manual PO
		    
		    $new_invoice =  ($view == 'active') ? ManualPo::model()->active()->new()->findAll() : ManualPo::model()->active()->past()->findAll();		

		    foreach ($new_invoice as $key => $invoice) :
			if($view == 'active'):
			    $action = CHtml::ajaxLink('Upadate Payment', Yii::app()->createUrl('/finance/invoice/modal_update_man_po_payments',array('id'=>$invoice->pay_id)), 
				    array('success'=>'function(r){$("#modal_update_payments").html(r).modal("toggle"); return false;}'), 
				    array('title'=>'Read More','rel'=>'tooltip'));
			else:	
			    $action = CHtml::link('<i class="cus-icon-zoom"></i>',array('/finance/invoice/manualpoview','id'=>$invoice->pay_id),array('title'=>'View','rel'=>'tooltip'));
			endif;
			
			    $output[$key][0] = $key+1;
			    $output[$key][1] = CHtml::link(MANUAL_PREFIX.$invoice->pay_id,array('/finance/invoice/manualpoview','id'=>$invoice->pay_id));
			    $output[$key][2] = ucwords($invoice->pay_vendor);
			    $output[$key][3] = date(FORMAT_DATE,strtotime($invoice->pay_date));
			    $output[$key][4] = Myclass::t('Null');
			    $output[$key][5] = $invoice->pay_description;
			    $output[$key][6] = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->pay_amt;
			    $output[$key][7] = $action;
		    endforeach;

		endif;
		$array['aaData'] = $output;
		echo json_encode($array);
		Yii::app()->end();
	    endif;
	    
	}
	
	public function actionPastpayments($mode=null)
	{
	    if(isset($mode) && ($mode == "manual")):
		$new_invoice = ManualPo::model()->active()->past()->findAll();
	    else:
		$new_invoice = Invoice::model()->payments()->active()->paid()->findAll();
	    endif;

	    $this->render('pastpayments',compact('new_invoice','mode'));
	}
	
	public function actionPaid()
	{
	    $new_invoice = Invoice::model()->invoice()->active()->paid()->findAll();

	    $this->render('paid',compact('new_invoice'));
	}
	
	public function actionAccountsummary()
	{
	    $pay_invoices = Invoice::model()->active()->paid()->findAll();
	    $man_invoices = ManualPo::model()->active()->past()->findAll();
	    $memo_invoices = Memo::model()->findAll();
	    
	    $invoices = array_merge($pay_invoices,$man_invoices,$memo_invoices);
//	    var_dump($invoices); exit;
	    $this->render('accountsummary',compact('invoices'));
	}
	public function actionView($id)
	{
	    $invoice = $this->loadModel($id);
	    $this->render('view',compact('invoice'));
	}
	
	public function actionManualpoview($id)
	{
	    $invoice = ManualPo::model()->findByPk($id);
	    $this->render('manual_view',compact('invoice'));
	}

	public function actionModal_send_invoice($id)
	{
//	    if(Yii::app()->request->isAjaxRequest):
		$send_invoice = $this->loadModel($id);
		$send_invoice->scenario = 'send_invoice';
		$recipient = new InvoiceRecipient();
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($recipient);
			Yii::app()->end();
		}
		
		if(isset($_POST['Invoice'])):		    
		    $send_invoice->attributes = $_POST['Invoice'];
		    $send_invoice->inv_status = '1';
		    $send_invoice->past_inv_date = new CDbExpression('NOW()');;
		    $send_invoice->save(false);
		    $recipient_values = $_POST['InvoiceRecipient']['recipient_id'];
		    foreach ($recipient_values as $recipient):
			$recipient = new InvoiceRecipient();
			$recipient->inv_id = $send_invoice->inv_id;
			$recipient->recipient_id = $recipient;
			$recipient->save(false);
		    endforeach;
		    Yii::app()->user->setFlash('success','Invoice Successfully Sent');
		    $this->redirect(array('/finance/invoice/index'));
		endif;
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
		
		$this->renderPartial('_modal_send_invoice',compact('send_invoice','recipient'),false,true); 
		exit;
//	    endif;
	}
	public function actionModal_update_payments($id)
	{
//	    if(Yii::app()->request->isAjaxRequest):
		$past_invoice = $this->loadModel($id);
		$past_invoice->scenario = 'update_payment';

		if(isset($_POST['ajax']) && $_POST['ajax']==='update-payment')
		{
			echo CActiveForm::validate($past_invoice);
			Yii::app()->end(true);
		}

		if(isset($_POST['Invoice'])):	
		    $past_invoice->attributes = $_POST['Invoice'];
		    $past_invoice->inv_status = '2';
		    $past_invoice->paid_inv_date = new CDbExpression('NOW()');;
		    $past_invoice->save(false);
//		    Salesorder::model()->updateByPk($past_invoice->inv_so_id, array('so_status'=>'5'));
		    
		    Yii::app()->user->setFlash('success','Update Payment Successfully');
		    $this->redirect(array('/finance/invoice/past'));
		endif;
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
		
		$this->renderPartial('_modal_update_payments',compact('past_invoice'),false,true); 
		exit;
//	    endif;
	}

	public function actionModal_update_po_payments($id)
	{
//	    if(Yii::app()->request->isAjaxRequest):
		$past_invoice = $this->loadModel($id);
		$past_invoice->scenario = 'update_po_payment';

		if(isset($_POST['ajax']) && $_POST['ajax']==='update-po-payment')
		{
			echo CActiveForm::validate($past_invoice);
			Yii::app()->end(true);
		}

		if(isset($_POST['Invoice'])):	
		    $past_invoice->attributes = $_POST['Invoice'];
		    $past_invoice->past_pay_ref=CUploadedFile::getInstance($past_invoice,'past_pay_ref');
		   
		    $past_invoice->inv_status = '2';
		    $past_invoice->paid_inv_date = new CDbExpression('NOW()');;
		    $past_invoice->save();
		    
		    $past_invoice->past_pay_ref->saveAs(DOWNLOAD_PATH.$past_invoice->inv_id.'_'.$past_invoice->past_pay_ref);
//		    Salesorder::model()->updateByPk($past_invoice->inv_so_id, array('so_status'=>'5'));
		    
		    Yii::app()->user->setFlash('success','Update Payment Successfully');
		    $this->redirect(array('/finance/invoice/induepayments'));
		endif;
		
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
		
		$this->renderPartial('_modal_update_po_payments',compact('past_invoice'),false,true); 
		exit;
//	    endif;
	}
	
	public function actionModal_update_man_po_payments($id)
	{
		$past_invoice = ManualPo::model()->findByPk($id);
		$past_invoice->scenario = 'update_man_popup_po_payment';

		if(isset($_POST['ajax']) && $_POST['ajax']==='update-man-po-payment')
		{
			echo CActiveForm::validate($invoice);
			Yii::app()->end(true);
		}

		if(isset($_POST['ManualPo'])):	
		    $past_invoice->attributes = $_POST['ManualPo'];

		    $past_invoice->pay_status = '2';
		    $past_invoice->paid_inv_date = new CDbExpression('NOW()');
		    $past_invoice->past_pay_ref=CUploadedFile::getInstance($past_invoice,'past_pay_ref');
		   
		    $past_invoice->save();
		    $past_invoice->past_pay_ref->saveAs(DOWNLOAD_PATH.$past_invoice->pay_id.'_'.$past_invoice->past_pay_ref);
		    
		    Yii::app()->user->setFlash('success','Update Payment Successfully');
		    $this->redirect(array('/finance/invoice/induepayments','mode'=>'manual'));
		endif;
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
		
//		var_dump($past_invoice); exit;
		
		$this->renderPartial('_modal_update_man_po_payments',compact('past_invoice'),false,true); 
		exit;
//	    endif;
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionManualpo()
	{
	    $model = new ManualPo("update_man_po_payment");
	    if(isset($_POST['ManualPo'])):
		$model->attributes = $_POST['ManualPo'];
		if($model->validate()):
		    $model->save(false);
		    Yii::app()->user->setFlash('success','Manual PO"s Created Successfully');
		    $this->redirect(array('induepayments',"mode"=>"manual"));
		endif;
	    endif;
	    $this->render('manual_po',compact('model'));  
	}
        
        public function actionPrintinvoice($id)
        {
            $invoicemodel = Invoice::model()->invoice()->findByPk($id);

	    if($invoicemodel===null)
                throw new CHttpException(404,'The requested page does not exist.');          
            //$this->render('printinvoice',  compact("invoice"));

            # You can easily override default constructor's params
            $mPDF1 = Yii::app()->ePdf->mpdf();

            # render (full page)
            $mPDF1->WriteHTML($this->renderPartial('getpdf', array('model'=>$invoicemodel), true));

            # Outputs ready PDF
            $mPDF1->Output("Invoice_{$id}.pdf",EYiiPdf::OUTPUT_TO_DOWNLOAD);
        }
	
	public function actionPrintquote($id)
        {
            $model = Quote::model()->findByPk($id);

	    if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');          
            //$this->render('printinvoice',  compact("invoice"));
//	    echo $this->renderPartial('getquotepdf', array('model'=>$model), true);
//	    exit;
            # You can easily override default constructor's params
            $mPDF1 = Yii::app()->ePdf->mpdf();

            # render (full page)
            $mPDF1->WriteHTML($this->renderPartial('getquotepdf', array('model'=>$model), true));

            # Outputs ready PDF
            $mPDF1->Output("Quote_{$id}.pdf",EYiiPdf::OUTPUT_TO_DOWNLOAD);
        }
	
	public function actionPrintso($id)
        {
            $model = Salesorder::model()->findByPk($id);

	    if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');          
            //$this->render('printinvoice',  compact("invoice"));
//	    echo $this->renderPartial('getsopdf', array('model'=>$model), true);
//	    exit;
            # You can easily override default constructor's params
            $mPDF1 = Yii::app()->ePdf->mpdf();

            # render (full page)
            $mPDF1->WriteHTML($this->renderPartial('getsopdf', array('model'=>$model), true));

            # Outputs ready PDF
            $mPDF1->Output("Salesorder_{$id}.pdf",EYiiPdf::OUTPUT_TO_DOWNLOAD);
        }
}
