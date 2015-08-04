<?php
class PackController extends Controller
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $sales = Salesorder::model()->so_active()->not_deleted()->pickreleased()->bypackme()->latest()->findAll();
	    $this->render('index',compact('sales'));
	}
	public function actionView($id)
	{
    	    $so = Salesorder::model()->findByPk($id);

	    $quoteproducts = SoProducts::model()->with(array('orderdetail'=>array("condition"=>"orderdetail.so_id={$id}")))->findAll();

	    $model = new Pack();
	    
	    if(isset($_POST['save_pack'])):
		$model->attributes = $_POST['Pack'];
		$model->scenario = 'save';
		if($model->validate()):
		    Pack::model()->deleteAll('salesord_id ='.$id);
		    foreach($model->pack_qty as $prod_id=>$pack_qty):
			$mod = new Pack();
			$mod->salesord_id = $id;
			$mod->product_id = $prod_id;
			$mod->actual_qty = $model->actual_qty[$prod_id];
			$mod->pack_qty = $pack_qty;
			$mod->box_id = $model->box_id[$prod_id];
			$mod->remarks = $model->remarks[$prod_id];
			$mod->save(false);
		    endforeach;
		    Yii::app()->user->setFlash('success','Record saved successfully');
		    $this->refresh();
		endif;
	    endif;
	    
	     if(isset($_POST['pack_release']) || isset($_POST['force_proceed'])):
		$model->scenario = 'release';
		$model->attributes = $_POST['Pack'];
		$model->force_proceed = $_POST['force_proceed'];

		if($model->validate()):
		    Pack::model()->deleteAll('salesord_id ='.$id);
		    foreach($model->pack_qty as $prod_id=>$pack_qty):
			$mod = new Pack();
			$mod->salesord_id = $id;
			$mod->product_id = $prod_id;
			$mod->actual_qty = $model->actual_qty[$prod_id];
			$mod->pack_qty = $pack_qty;
			$mod->box_id = $model->box_id[$prod_id];
			$mod->remarks = $model->remarks[$prod_id];
			$mod->save(false);
		    endforeach;
		    $so->so_status = "3";
		    $so->pack_created_date = new CDbExpression('NOW()');
		    $so->save(false);
		    
		    Myclass::InsertNotification(8, $id, Yii::app()->user->id, 1);
		    Yii::app()->user->setFlash('success','SO successfully pack released.');
		    $this->redirect(array('/sales/salesorder/viewsodetail','id'=>$id));
		endif;
	    endif;
	    
	    $this->render('view',compact('model','save_pack','quoteproducts','so'));
	}
}
