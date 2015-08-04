<?php
class ShipController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	
	public function init()
	{
	    $this->renderPartial('//layouts/_production_mod_left_menu');
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
	    $sales = Salesorder::model()->so_active()->not_deleted()->packreleased()->byshipme()->latest()->findAll();
	    $this->render('index',compact('sales'));
	}
	
	public function actionView($id)
	{
    	    $so = Salesorder::model()->findByPk($id);
	    $save_pack = CHtml::listData(Pack::model()->findAll('salesord_id ='.$so->so_id), 'product_id', 'pack_qty');
	    if($so->quote_id > 0):
		$quoteproducts = QuoteProduct::model()->findAll('quote_id ='.$so->quote_id);
	    else:
		$quoteproducts = SoProducts::model()->with(array('orderdetail'=>array("condition"=>"orderdetail.so_id={$id}")))->findAll();
	    endif;
	    $model = new Ship();
	    
	    if(isset($_POST['save_release'])):
		
		$model->attributes = $_POST['Ship'];
		$model->ship_mode = $_POST['ship_mode'];
		$model->ship_status = $_POST['ship_status'];
		
		$model->scenario = 'save';
//		if($model->validate()):
		    Ship::model()->deleteAll('salesord_id ='.$id);
		    
		    foreach($model->pack_qty as $prod_id=>$pack_qty):
			$mod = new Ship();
			$mod->salesord_id=$id;
			$mod->prod_id=$prod_id;
			$mod->pack_qty=$pack_qty;
			$mod->ship_mode=$model->ship_mode[$prod_id];
			$mod->carrier_name=$model->carrier_name[$prod_id];
			$mod->crd_date=$model->crd_date[$prod_id];
			$mod->srd_date=$model->srd_date[$prod_id];
			$mod->clrd_date=$model->clrd_date[$prod_id];
			$mod->tracking_ref=$model->tracking_ref[$prod_id];
			$mod->port_discharge=$model->port_discharge[$prod_id];
			$mod->port_receive=$model->port_receive[$prod_id];
			$mod->bl_no=$model->bl_no[$prod_id];
			$mod->ship_status=$model->ship_status[$prod_id];
			$mod->save(false);
		    endforeach;
		    Yii::app()->user->setFlash('success','Record saved successfully');
		    $this->refresh();
//		endif;
	    endif;
	    
	     if(isset($_POST['ship_release']) || isset($_POST['force_proceed'])):
		
		$model->attributes = $_POST['Ship'];
		$model->ship_mode = $_POST['ship_mode'];
		$model->ship_status = $_POST['ship_status'];
		$model->force_proceed = $_POST['force_proceed'];
		
		$model->scenario = 'release';
		
		if($model->validate()):
		    Ship::model()->deleteAll('salesord_id ='.$id);
		    
		    foreach($model->pack_qty as $prod_id=>$pack_qty):
			$mod = new Ship();
			$mod->salesord_id=$id;
			$mod->prod_id=$prod_id;
			$mod->pack_qty=$pack_qty;
			$mod->ship_mode=$model->ship_mode[$prod_id];
			$mod->carrier_name=$model->carrier_name[$prod_id];
			$mod->crd_date=$model->crd_date[$prod_id];
			$mod->srd_date=$model->srd_date[$prod_id];
			$mod->clrd_date=$model->clrd_date[$prod_id];
			$mod->tracking_ref=$model->tracking_ref[$prod_id];
			$mod->port_discharge=$model->port_discharge[$prod_id];
			$mod->port_receive=$model->port_receive[$prod_id];
			$mod->bl_no=$model->bl_no[$prod_id];
			$mod->ship_status=$model->ship_status[$prod_id];
			$mod->save(false);
		    endforeach;
		    $so->so_status = '4';
		    $so->ship_created_date = new CDbExpression('NOW()');
		    $so->save(false);
		    
		    Yii::app()->user->setFlash('success',Yii::t('production','Shipment Process Completed'));
		    $this->redirect(array('/production/ship/view','id'=>$id));
		endif;
	    endif;
	    
	    $this->render('view',compact('model','save_pack','quoteproducts','so','save_ship'));
	}
}
