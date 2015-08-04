<?php
class PickController extends Controller
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
				'actions'=>array('index','view','delete','modal_inventory_product'),
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
	    $sales = Salesorder::model()->so_active()->not_deleted()->approved()->byme()->latest()->findAll();
	    $this->render('index',compact('sales'));
	}
	
	public function actionView($id,$force_proceed = false)
	{
    	    $so = Salesorder::model()->findByPk($id);
	    $save_pick = array_values(CHtml::listData(Pick::model()->findAll("salesord_id = {$id}"), 'pick_id', 'pick_qty'));
//	    var_dump($save_pick);
	    $quoteproducts = SoProducts::model()->findAll("so_id={$id}");
	    
	    $model = new Pick();
	    
	    if(isset($_POST['save_pick'])):
		$model->scenario = 'save';
		$model->attributes = $_POST['Pick'];

		if($model->validate()):
		    Pick::model()->deleteAll('salesord_id ='.$id);
		    foreach($model->pick_qty as $key=>$pick):
			$prod_id = key($pick);
			$pick_qty = $pick[$prod_id];
			$mod = new Pick();
			$mod->salesord_id = $id;
			$mod->product_id = $prod_id;
			$mod->actual_qty = $model->actual_qty[$prod_id];
			$mod->pick_qty = $pick_qty;
			$mod->product_class = $model->product_class[$prod_id];;
			$mod->save(false);
		    endforeach;
		    Yii::app()->user->setFlash('success','Record saved successfully');
		    $this->refresh();
		endif;
	    endif;
	    
	     if(isset($_POST['pick_release']) || isset($_POST['force_proceed'])):
		$model->scenario = 'release';
		$model->attributes = $_POST['Pick'];
		$model->force_proceed = $_POST['force_proceed'];

		if($model->validate()):
		    Pick::model()->deleteAll('salesord_id ='.$id);
		    foreach($model->pick_qty as $key=>$pick):
			$prod_id = key($pick);
			$pick_qty = $pick[$prod_id];
			$mod = new Pick();
			$mod->salesord_id = $id;
			$mod->product_id = $prod_id;
			$mod->actual_qty = $model->actual_qty[$prod_id];
			$mod->pick_qty = $pick_qty;
			$mod->product_class = $model->product_class[$prod_id];;
			$mod->save(false);
			Myclass::UpdateProduct(array($prod_id=>"-$pick_qty"),$mod->product_class); //For Decrease
		    endforeach;
		    $so->so_status = "2";
		    $so->pick_created_date = new CDbExpression('NOW()');
		    $so->save(false);
		    Myclass::InsertNotification(6, $id, Yii::app()->user->id, 1);
		    
		    Yii::app()->user->setFlash('success','SO successfully pick released.');
		    
		    $this->redirect(array('/sales/salesorder/viewsodetail','id'=>$id));
		endif;
	    endif;
	    
	    $this->render('view',compact('model','save_pick','quoteproducts','so'));
	}
	
	public function actionDelete($id)
	{
	     //Soft Delete
	     Salesorder::model()->updateByPk($id, array('is_deleted' => '1'));
	     $this->redirect(array('index'));
	}
	
	public function actionModal_inventory_product($id,$soid)
	{
		$data = Product::model()->findByPk($id);
		$model = new ProductProcurement();
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventory-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ProductProcurement'])):
		    $admin_id = 1;
		    $model->attributes = $_POST['ProductProcurement'];
		    $model->prod_id	= $id;
		    $model->save(false);
		    Myclass::InsertNotification(10, $model->ppid, Yii::app()->user->id, $admin_id);
		    Yii::app()->user->setFlash('success','Procurement Request Successfully Sent');
		    $this->redirect(array('/production/pick/view','id'=>$soid));
		endif;
		
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
		Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
		
		$this->renderPartial('_modal_inventory_view',compact('data','model','soid'),false,true); 
		exit;
	}
	
}
