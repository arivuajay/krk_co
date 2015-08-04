<?php

class ProductController extends Controller
{

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
	
	public function init()
	{
	    $this->renderPartial('//layouts/_product_mod_left_menu');
	}
	
	public function actions()
	{
	return array(
	    'upload'=>array(
		'class'=>'xupload.actions.XUploadAction',
		'path' =>Yii::app() -> getBasePath() . "/..".PRO_IMAGE_PATH,
		'publicPath' => Yii::app() -> getBaseUrl() . PRO_IMAGE_PATH,
	    ),
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
				'actions'=>array('create','update','test','Addtoitem','view','deleteproduct','loadSubcategory','itemvalue','addimage','productactions'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
                                'actions'=>array('deleteproduct'),
				'users'=>array('?'),
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
		$product = Product::model()->active()->not_deleted()->findAll();
	    else:
		$product = Product::model()->active()->findAll();
	    endif;
            
	    $this->render('view_product',compact('product'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($prodid = null,$active_tab = 'tab1')
	{
	    if($prodid):
		Yii::import( "xupload.models.XUploadForm" );

		$model	    = Product::model()->findByPk($prodid);
		$cModel     = ProductCategory::model()->find("product_id = {$prodid}");
                $ppModel    = ProductPrice::model()->findAll("prod_id =  {$prodid}");
                $bmodel     = ProductBom::model()->find("product_id = {$prodid}");
		$avail_images = ProductImages::model()->active()->findAll("prod_id = {$prodid}");
		$image_model = new XUploadForm;
	    else:
		$model      = new Product();		
                $cModel     = new ProductCategory();
		for($i=0; $i < 3;$i++) $ppModel[$i] = new ProductPrice();
	    endif;

            if(empty($smodel)):
                $smodel     = new ProductProcurement();
            endif;
            if(empty($bmodel)):
                $bmodel     = new ProductBom();
            endif;
	    
            if(empty($ppModel)):
                for($i=0; $i < 3;$i++) $ppModel[$i] = new ProductPrice();
            endif;
	    
                $iModel     = new Items();

                
                
            //Product Information goes here
            if(isset($_POST['PRODUCT_FORM']))
            {
                
                if(!is_numeric($_POST['ProductCategory']['category_id'])):
                
                $this->insert_new_product_category($_POST['ProductCategory']['category_id']);
                $category_id = Yii::app()->db->getLastInsertID();
                $_POST['ProductCategory']['category_id'] = $category_id;
                endif;

                $model->attributes          =   $_POST['Product'];
		$model->selcategory         =   $_POST['ProductCategory']['category_id'];
                $cModel->attributes         =   $_POST['ProductCategory'];
                $prod_price		    =	$_POST['ProductPrice'];
//		var_dump($model->attributes); exit;
		$range_id    = $prod_price['price_range_id'];
		$range_price = $prod_price['range_price'];
		
		$range_id_ret = (in_array('', $range_id)) ? false : true;
		$range_price_ret =  (in_array('', $range_price)) ? false : true;
		
                $valid = $model->validate();
                $valid = $cModel->validate() && $valid;

                
		
		
                foreach($prod_price as $i=>$price)
                {
                if(isset($price['price_range_id'])):
		    $ppModel[$i]->attributes = $price;
		    $valid=$ppModel[$i]->validate() && $valid;
                endif;
                }
		
		if(!$range_id_ret || !$range_price_ret):
		    $model->addError('product_id', 'Product Price range & Amount cannot be empty');
                endif;


                if($valid){
		    $model->save(false);
		    $product_id = $model->product_id;

		    $cModel->product_id     = $product_id;
		    $cModel->sub_category_id     = $_POST['subcategorylist'];
		    if(isset ($category_id) && is_int($category_id)){

		    $cModel->category_id  = $category_id;

                }
                $cModel->save(false);

//                var_dump($range_id,$range_price);exit;
                //Inserting price value for the product
		ProductPrice::model()->deleteAll("prod_id = '$prodid'");
                foreach($range_id as $i=>$range)
                {
		    $price_ran_model = new ProductPrice();
		    $price_ran_model->price_range_id    =   $range;
		    $price_ran_model->prod_id		=   $model->product_id;
		    $price_ran_model->range_price	=   $range_price[$i];
		    $price_ran_model->save(false);
                }
                Yii::app()->user->setFlash('success','Product Created Successfully');
                //$active_tab = 'tab2';
                $this->redirect(array('create','prodid'=>$product_id,'active_tab'=>'tab2'));
                }

            }

            //Inventory Information goes here

            if(isset($_POST['PRODUCT_PROCUREMENT']))
            {
                $admin_id = 1;
                $smodel->attributes     = $_POST['ProductProcurement'];
                $smodel->prod_id	= $prodid;
//		var_dump($smodel->attributes); exit;
                if($smodel->validate())
                {
                $smodel->save(false);
                //Notofication Insert
                Myclass::InsertNotification(10, $smodel->ppid, Yii::app()->user->id, $admin_id);
                Yii::app()->user->setFlash('success','Procurement request made successfully');

                $productClassType = Myclass::getProductClass($prodid);
                if($productClassType == 2):
                $active_tab = 'tab3';
                else:
                $this->redirect(array('view'));
                endif;
                }
		else
		{
		    Yii::app()->user->setFlash('error',"Procurement Request Quantity & EDD cannot be blank");
		    $this->redirect(array('/products/product/create','prodid'=>$prodid,'active_tab'=>'tab2'));
		}
            }

            //Bom Settings

            if(isset ($_POST['item']))

            {
            
//                $bmodel->attributes     = $_POST['ProductBom'];
//
//
//                $images = CUploadedFile::getInstancesByName('files');
//
//                print"<pre>";
//                print_r($images);exit;
                //Unset the values of checkbox which set into session in BOM Setting form
                unset($_SESSION['add_item']);
                $bomSetting = $_POST['item'];
                $manufacture_unit = $_POST['ProductBom']['unit_manufacture'];
                ProductBom::model()->deleteAll("product_id = {$prodid}");
                foreach ($bomSetting as $key => $value) {
                $bModel = new ProductBom();
                $bModel->product_id = $prodid;
                $bModel->item_id = $key;
                $bModel->item_value = $value;
                $bModel->unit_manufacture = $manufacture_unit;
                $bModel->save(false);
                unset ($bModel);

                }

                Yii::app()->user->setFlash('success','BOM Setting Created Successfully');
                $this->redirect(array('view'));

            }
                $Itemmodel = new Items('search');
                $Itemmodel->unsetAttributes();

                if(isset($_GET['Items'])):
                $Itemmodel->attributes = $_GET['Items'];
                endif;
                
                //to get the last 10 procurement.
                 if($prodid) {
                 	$productinfo = PoOrdProducts::model()->findAll("product_id=:product_id",array(":product_id"=>$prodid));
                 }
                 

                //TO get the alphapager in the BOM form
                $this->data = compact('model','smodel','image_model','cModel','ppModel','active_tab','prodid','Itemmodel','bmodel','productinfo','avail_images');
//                var_dump($smodel); exit;

                $this->render('create');
                
	}
	
	public function actionTest()
	{
	    $model = new Items('search');
	    $model->unsetAttributes();
	    if(isset($_GET['Items'])):
		$model->attributes = $_GET['Items'];
	    endif;
	    
	    $this->render('test',compact('model'));
	}


        public function insert_new_product_category($category)
    {

	    $new_cat = new Category();
	    $new_cat->name = $category;
	    $new_cat->created_by = Yii::app()->user->id;
	    $new_cat->save(false);

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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->product_id));
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


        //Delete products here

        public function actionDeleteproduct($prodid = '')
        {

            
            Product::model()->updateByPk($prodid, array('is_deleted' => '1'));
            Yii::app()->user->setFlash('success','Product Deleted Successfully<br>');
	    $this->redirect(array('product/view'));
            
            
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

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
		$model=Product::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


        public function actionAddtoitem()
	{
	   // $session=  Yii::app()->session['add_item'];
//            $_SESSION['add_item'] = '';
            
	    if(Yii::app()->request->isAjaxRequest):
		$item_id = $_REQUEST['item_id'];
		$task  = @$_REQUEST['task'];
		$item_value = @$_REQUEST['item_value'];

                $itemidArray = explode("_",$item_id);
                $item_id = $itemidArray[1];

	    switch($task):
		case "add":
                    $_SESSION['add_item'][$item_id] = $item_id;
		    break;
		case "remove":
		    unset($_SESSION['add_item'][$item_id]);
                   
		    break;
	    endswitch;

            //echo $_SESSION['add_item'][$item_id];exit;
//            $items = array();
//            $items[0][task] = $task;
//            $items[0][item_value] = $item_value;
//            $items[0][item_id] = $item_id;
         
            
            
	    if(!empty($_SESSION['add_item'])):
               // $itemArray = Myclass::ItemList($_SESSION['add_item']);
                
             	echo CJSON::encode(Myclass::ItemList($_SESSION['add_item']));
	    endif;

	    Yii::app()->end();
	    endif;
	}


        public function actionLoadSubcategory(){

        $category_id = $_POST['ProductCategory']['category_id'];
        $data = Myclass::GetProductSubCategory($category_id);
                  
        $data=CHtml::listData($data,'category_id','name');

            echo CHtml::tag('option',
                           array('value'=>''),CHtml::encode('Select Sub Category'),true);
            foreach($data as $value=>$name)
            {
                
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
                
            }
      
        
        }


        //get Item Name
        public function actionItemvalue(){

            $itemid = $_POST['itemid'];
           echo  Myclass::GetItemValue($itemid);
        }


        //View complete detail page for products

        public function actionProductdetail($pid){

            $productDetail = Product::model()->findByPk($pid);
            $productPrice = $productDetail->productPrice;
            $procurement = $productDetail->procurement;
            $productCategories = $productDetail->productCategories;
            $productBom = ProductBom::model()->findAll("product_id = {$pid}");
	    $avail_images = ProductImages::model()->active()->findAll("prod_id = {$pid}");
	    $this->render('view_pro_detail',compact('avail_images','productDetail','productPrice','procurement','productCategories','productBom'));
                
            
        }
	
    public function actionAddimage() {

	Yii::import( "xupload.models.XUploadForm" );
	//Here we define the paths where the files will be stored temporarily
	$path = realpath( Yii::app( )->getBasePath( )."/../images/product_images/" )."/";
	$publicPath = Yii::app( )->getBaseUrl( )."/images/product_images/";

	//This is for IE which doens't handle 'Content-type: application/json' correctly
	header( 'Vary: Accept' );
	if( isset( $_SERVER['HTTP_ACCEPT'] ) 
	    && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
	    header( 'Content-type: application/json' );
	} else {
	    header( 'Content-type: text/plain' );
	}

	//Here we check if we are deleting and uploaded file
	if( isset( $_GET["_method"] ) ) {
	    if( $_GET["_method"] == "delete" ) {
		if( $_GET["file"][0] !== '.' ) {
		    $file = $path.$_GET["file"];
		    if( is_file( $file ) ) {
			unlink( $file );
		    }
		}
		echo json_encode( true );
	    }
	} else {
	    $model = new XUploadForm;
	    $model->file = CUploadedFile::getInstance( $model, 'file' );
	    //We check that the file was successfully uploaded
	    if( $model->file !== null ) {
		//Grab some data
		$model->mime_type = $model->file->getType( );
		$model->size = $model->file->getSize( );
		$model->name = $model->file->getName( );
		//(optional) Generate a random name for our file
		$filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
		$filename .= ".".$model->file->getExtensionName( );
		if( $model->validate( ) ) {
		    //Move our file to our temporary dir
		    $model->file->saveAs( $path.$filename );
		    chmod( $path.$filename, 0777 );
		    //here you can also generate the image versions you need 
		    //using something like PHPThumb
		    Yii::import("ext.EPhpThumb.EPhpThumb");
		    $thumb=new EPhpThumb();
		    $thumb->init(); //this is needed

		    //chain functions
		    $thumb->create($path.$filename)->adaptiveResize(144,192)->save($path."large/".$filename);
		    $thumb->create($path.$filename)->adaptiveResize(71,71)->save($path.$filename);

			$prod_image = new ProductImages;
			$prod_image->prod_id = $_REQUEST['prodid'];
			$prod_image->prod_image = $filename;
			$prod_image->save(false);
		    //We do so, using the json structure defined in
		    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
		    echo json_encode( array( array(
			    "name" => $model->name,
			    "type" => $model->mime_type,
			    "size" => $model->size,
			    "url" => $publicPath."large/".$filename,
			    "thumbnail_url" => $publicPath.$filename,
			    "delete_url" => $this->createUrl( "upload", array(
				"_method" => "delete",
				"file" => $filename
			    ) ),
			    "delete_type" => "POST"
			) ) );
		} else {
		    //If the upload failed for some reason we log some data and let the widget know
		    echo json_encode( array( 
			array( "error" => $model->getErrors( 'file' ),
		    ) ) );
		    Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
			CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
		    );
		}
	    } else {
		throw new CHttpException( 500, "Could not upload file" );
	    }
	}
    }
    
    public function actionProductactions()
    {
	$action = $_REQUEST['action']; 
	$id = $_REQUEST['id'];
	$prod_id = $_REQUEST['prodid'];

	switch($action):
	    case "updatestatus": 
		    $status = ($_REQUEST['status'] == "1") ? "0" : "1";
		    ProductImages::model()->updateByPk($id, array("is_active"=>$status)) ;
		    break;
	    case "remove": 
		    ProductImages::model()->updateByPk($id, array("is_deleted"=>"1"));
		    break;
	    case "primary_set": 
		    ProductImages::model()->updateAll(array("is_primary"=>"0"),"prod_id = {$prod_id}");
		    ProductImages::model()->updateByPk($id,array("is_primary"=>"1","is_active"=>"1"));
		    break;	
	endswitch;
	
	$this->redirect(array('/products/product/create','prodid'=>$prod_id,'active_tab'=>'tab4'));
    }
	

}
