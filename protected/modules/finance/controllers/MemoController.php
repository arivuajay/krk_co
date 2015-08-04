<?php

class MemoController extends Controller
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
				'actions'=>array('credit','debit','past','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionCredit()
	{
	    $model = new Memo();
	    if(isset($_POST['Memo'])):
		$model->attributes = $_POST['Memo'];
		$model->memo_scenario = "sales_order";
		if($model->validate()):
		    $model->save(false);
		    Yii::app()->user->setFlash('success','Credit Memo Successfully Completed.');
		    $this->redirect(array("/finance/invoice/accountsummary"));
		endif;
	    endif;
	    $this->render('credit',compact('model'));
	}
	
	public function actionDebit()
	{
	    $model = new Memo();
	    if(isset($_POST['Memo'])):
		$model->attributes = $_POST['Memo'];
		$model->memo_scenario = "po_order";
		if($model->validate()):
		    $model->save(false);
		    Yii::app()->user->setFlash('success','Debit Memo Successfully Completed.');
		    $this->redirect(array("/finance/invoice/accountsummary"));
		endif;
	    endif;
	    $this->render('debit',compact('model'));
	}
	
	public function actionPast($mode="credit")
	{
	    $model = Memo::model()->active()->$mode()->findAll();
	    if(Yii::app()->request->isAjaxRequest):
		foreach ($model as $key => $invoice) :
			$action = CHtml::link('<i class="cus-icon-zoom"></i>',array('/finance/memo/view','id'=>$invoice->memo_id),array('title'=>'View','rel'=>'tooltip'));
			$output[$key][0] = $key+1;
			$output[$key][1] = CHtml::link(MEMO_PREFIX.$invoice->memo_id,array('/finance/memo/view','id'=>$invoice->memo_id));
			$output[$key][2] = ucwords($invoice->cli_name);
			$output[$key][3] = $invoice->rel_id;
			$output[$key][4] = Myclass::GetSiteSetting('AMOUNT_FORMAT')." ".$invoice->amount;
			$output[$key][5] = $invoice->pay_mode;
			$output[$key][6] = date(FORMAT_DATE,strtotime($invoice->pay_date));
			$output[$key][7] = $action;
		endforeach;
		$array['aaData'] = $output;
		echo json_encode($array);
		Yii::app()->end();
	    endif;
	    $this->render('past',compact('model'));
	}
	
	public function actionView($id)
	{
	    $model = Memo::model()->findByPk($id);
	    $this->render('view',compact('model'));
	}
}