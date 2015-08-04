<?php

class SampleController extends Controller {

    public function init() {
	$this->renderPartial('//layouts/_sales_mod_left_menu');
	//$this->defaultAction = 'salesorder/create';
    }

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
	return array(
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create','approve' ,'view', 'viewdetail', 'notifyreturn','returnsample'),
		'users' => array('@'),
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
	    ),
	);
    }

    public function actionCreate() {
	for ($i = 0; $i < 3; $i++):
	    $prodmodel[$i] = new SamplerProduct();
	endfor;

	$error_model = new SamplerProduct();
	$sample = new Sampler();
	
	if (isset($_POST['SamplerProduct'])):
	    $prodmodel = $this->getItemsToUpdate($_POST['SamplerProduct']);
	    $valid = true;
	    if (!empty($prodmodel)):
		$arr = array();
		foreach ($prodmodel as $mod):
		    if (!in_array($mod->prod_id, $arr)):
			$arr[$mod->prod_scenario . "_" . $mod->prod_id] = $mod->prod_id;
		    else:
			$valid = false;
			$error_model->addError("prod_id", "Products cannot be dublicate");
			break;
		    endif;
		endforeach;
	    else:
		for ($i = 0; $i < 3; $i++):
		    $prodmodel[$i] = new SamplerProduct();
		endfor;
		$valid = false;
		$error_model->addError("prod_id", "Add products");
	    endif;
	    if(isset($_POST['Sampler'])):
		$sample->attributes = $_POST['Sampler'];
		if(!$sample->validate()):
		    $valid = false;
		endif;
	    endif;
	    if ($valid):
		$sample->save(false);
		foreach ($prodmodel as $i => $product) {
		    $product->sam_id = $sample->sample_id;
		    $product->save(false);
		}
		$reportingmail = CHtml::listData(Myclass::MyReporters(Yii::app()->user->id), 'reportingUser.user_role_id', 'reportingUser.user.userProfiles.email_address');
		    
		    if(!empty($reportingmail) && is_array($reportingmail)):
			foreach($reportingmail as $key=>$email):
			    $uprofile = Myclass::GetUserProfile('',$email);
//			    //Notofication Insert
			    $admin_id = "1";
			    Myclass::InsertNotification('15',$sample->sample_id,$sample->buyer_id,$admin_id);
			endforeach;
		    else:
			$sample->sample_status = "1";
			$sample->approved_by = Yii::app()->user->id;
			$sample->save(false);
		    endif;
		
		Yii::app()->user->setFlash("success", "Sample Successfully Created.");
		$this->redirect(array('/sales/sample/view'));
	    endif;
	endif;

	$this->render('create', compact('prodmodel', 'error_model','sample'));
    }

    public function actionView() {
	$mode = (Yii::app()->user->getState('role') == 'admin') ? "all" : "my";
	$model = Sampler::model()->active()->$mode()->findAll();

	$this->render("view", compact('model'));
    }

    public function actionViewdetail($id) {
	$model = Sampler::model()->findByPk($id);
	$model->scenario = 'approve';
	if(isset($_POST['Sampler'])):
	    $model->attributes = $_POST['Sampler'];
	    if($model->validate()):
		$model->sample_status = "1";
		$model->approved_by   = Yii::app()->user->id;
		$model->save(false);
		Myclass::InsertNotification('16',$model->sample_id,Yii::app()->user->id,$model->buyer_id);
		Yii::app()->user->setFlash('success','Sample Approved Successfully');
		$this->redirect(array('/sales/sample/viewdetail','id'=>$model->sample_id));
	    endif;
	endif;
	$this->render("viewdetail", compact('model'));
    }
    
    public function actionApprove($id) {
	$model = Sampler::model()->findByPk($id);
	$model->sample_status = "1";
	$model->approved_by   = Yii::app()->user->id;
	$model->save(false);
	Myclass::InsertNotification('16',$model->sample_id,Yii::app()->user->id,$model->buyer_id);
	Yii::app()->user->setFlash('success','Sample Approved Successfully');
	$this->redirect(array('/sales/sample/viewdetail','id'=>$model->sample_id));
    }
    
    public function actionNotifyreturn($id) {
	$model = Sampler::model()->findByPk($id);
	$status = (Yii::app()->user->getState('role') == 'admin')  ? "3" : "2";
	$model->sample_status = $status;
	$model->save(false);
	$admin_id = "1";
	Myclass::InsertNotification('17',$model->sample_id,$model->buyer_id,$admin_id);
	Yii::app()->user->setFlash('success','Sample return notification successfully sent');
	$this->redirect(array('/sales/sample/view'));
    }
    
    public function actionReturnsample($id) {
	$model = Sampler::model()->findByPk($id);
	$model->sample_status = "3";
	$model->save(false);
	Myclass::InsertNotification('18',$model->sample_id,Yii::app()->user->id,$model->buyer_id);
	Yii::app()->user->setFlash('success','Updated Successfully');
	$this->redirect(array('/sales/sample/viewdetail','id'=>$model->sample_id));
    }
    

    public function getItemsToUpdate($products) {
	$items = array();
	$qty = $products['qty'];
	$products = $products['prod_id'];

	foreach ($products as $key => $product):
	    if ($qty[$key] > 0):
		$arr = explode("_", $product);
		$prod['prod_id'] = $arr[1];
		$prod['prod_scenario'] = $arr[0];
		$prod['qty'] = $qty[$key];

		$items[$key] = new SamplerProduct;
		$items[$key]->attributes = $prod;
	    endif;
	endforeach;
	return $items;
    }

}