<?php

class InvoiceController extends Controller {

    protected $sess_name = 'inv_added_products';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addProduct', 'invAddedProducts', 'editInvPrduct', 'deleteInvPrduct', 'preview', 'report', 'vendorreport', 'companyreport','upload'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id, $partial = false) {
        $model = $this->loadModel($id);
        if ($partial)
            $this->renderPartial('view', compact('model'));
        else
            $this->render('view', compact('model'));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $posession = 'new';

        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            TempSession::model()->byMe()->deleteAll("session_name = '{$this->sess_name}' AND session_key = '{$posession}'");
            Yii::app()->user->setFlash('success', 'Reset Completed');
            $this->redirect(array('/site/invoice/create'));
        }

        $model = new Invoice;
        $detail_model = new InvoiceItems('add_product');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Invoice'])) {
            $model->attributes = $_POST['Invoice'];
            $rand = $_SESSION['invoice_rand'];
            $temp= $_SESSION['invoice_files'][$rand];
            if(!empty($temp)){
                $model->inv_file = $_SESSION['invoice_files'][$rand];
            }  else {
                $model->inv_file='';
            }
            if (isset($_POST['action']) && ($_POST['action'] == 'save_inv')) {
                $this->tempSave($posession, $model->attributes, $_POST['OrderDetails']);
                $notes = "Invoice Saved successfully.";
                $redir = array('create');
            } else if (isset($_POST['action']) && ($_POST['action'] == 'submit_inv')) {
                $rand = $_SESSION['invoice_rand'];
                $temp= $_SESSION['invoice_files'][$rand];
                $model->inv_file = !empty($temp) ? $_SESSION['invoice_files'][$rand] : '';
                 

                $pkg = $_SESSION['invoice_pkg'];
                $temp= $_SESSION['invoice_files'][$pkg];
                $model->pkg_list_file = !empty($temp) ? $_SESSION['invoice_files'][$pkg] : '';
                
                if ($model->validate()) {
//                    $model->setUploadDirectory(UPLOAD_DIR);
//                    $model->uploadFile();
                    $model->save(false);
                    $this->deleteFiles();
                    $this->itemSave($posession, $model->attributes, $_POST['OrderDetails']);
                    $notes = "Created Invoice successfully.";
                    $redir = array('index');
                }
            }
            if (isset($redir)) {
                Myclass::addAuditTrail($notes, "user");
                Yii::app()->user->setFlash('success', $notes);
                $this->redirect($redir);
            }
        } else if ($tmp_data = TempSession::model()->byMe()->find("session_name = '{$this->sess_name}' AND session_key = '{$posession}'")) {
            $model->attributes = $tmp_data->session_data['Invoice'];
            $inv_products = $tmp_data->session_data['InvoiceItems'];
        } else {
            $_SESSION['invoice_pkg'] = Myclass::getRandomString(6);
            $_SESSION['invoice_rand'] = Myclass::getRandomString(6);
            foreach ($model->invoiceItems as $item)
                $inv_products[] = CJSON::encode($item->attributes);
        }

        $this->render('create', compact('model', 'detail_model', 'inv_products'));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $detail_model = new InvoiceItems('add_product');
        $posession = "inv_{$model->invoice_id}";

        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            TempSession::model()->byMe()->deleteAll("session_name = '$this->sess_name' AND session_key = '{$posession}'");
            Yii::app()->user->setFlash('success', 'Reset Completed');
            $this->redirect(array('/site/invoice/update', 'id' => $model->invoice_id));
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Invoice'])) {
            
            
            $model->attributes = $_POST['Invoice'];
            if (isset($_POST['action']) && ($_POST['action'] == 'save_inv')) {
                $this->tempSave($posession, $model->attributes, $_POST['OrderDetails']);
                $notes = "Invoice Saved successfully.";
                $redir = array('update', 'id' => $id);
            } else if (isset($_POST['action']) && ($_POST['action'] == 'submit_inv')) {
                $rand = $_SESSION['invoice_rand'];
                $temp= $_SESSION['invoice_files'][$rand];
                $model->inv_file = !empty($temp) ? $_SESSION['invoice_files'][$rand] : '';
                 

                $pkg = $_SESSION['invoice_pkg'];
                $temp= $_SESSION['invoice_files'][$pkg];
                $model->pkg_list_file = !empty($temp) ? $_SESSION['invoice_files'][$pkg] : '';
                
                if ($model->validate()) {
                    
//                    $model->setUploadDirectory(UPLOAD_DIR);
//                    $model->uploadFile();
                    $model->save(false);
                    $this->deleteFiles();
                    InvoiceItems::model()->deleteAll("inv_id = '{$model->invoice_id}'");
                    $this->itemSave($posession, $model->attributes, $_POST['OrderDetails']);
                    $notes = "Updated Invoice successfully.";
                    $redir = array('index');
                }
            }
            Myclass::addAuditTrail($notes, "user");
            Yii::app()->user->setFlash('success', $notes);
            $this->redirect($redir);
        } else if ($tmp_data = TempSession::model()->byMe()->find("session_name = '$this->sess_name' AND session_key = '{$posession}'")) {
            $model->attributes = $tmp_data->session_data['Invoice'];
            $inv_products = $tmp_data->session_data['InvoiceItems'];
        } else {
            $_SESSION['invoice_pkg'] = Myclass::getRandomString(6);
            $_SESSION['invoice_rand'] = Myclass::getRandomString(6);
            foreach ($model->invoiceItems as $item)
                $inv_products[] = CJSON::encode($item->attributes);
        }

        $this->render('update', compact('model', 'detail_model', 'inv_products'));
    }

    protected function tempSave($posession, $po, $orderdetail) {
        TempSession::model()->byMe()->deleteAll("session_name = '{$this->sess_name}' AND session_key = '{$posession}'");
        $temp_array = array('Invoice' => $po, 'InvoiceItems' => $orderdetail);
        $tmp_sess = new TempSession();
        $tmp_sess->session_name = $this->sess_name;
        $tmp_sess->session_key = $posession;
        $tmp_sess->session_data = CJSON::encode($temp_array);
        $tmp_sess->save();
    }

    protected function itemSave($posession, $po, $orderdetail) {
        foreach ($orderdetail as $item) {
            $detail_model = new InvoiceItems('save');
            $detail_model->attributes = CJSON::decode($item);
            $detail_model->inv_id = $po['invoice_id'];
            $detail_model->save(false);
        }
        TempSession::model()->byMe()->deleteAll("session_name = '{$this->sess_name}' AND session_key = '{$posession}'");

        Invoice::updateInvoiceAmount($po['invoice_id']);
        return true;
    }

    public function actionAddProduct($posession) {
        $detail_model = new InvoiceItems('add_product');
        $this->performAjaxValidation($detail_model);
        if (isset($_POST['InvoiceItems'])) {
            $key = rand();
            $row = $this->bindAddedRow($_POST['InvoiceItems'], $key);
            echo CJSON::encode(array('key_no' => $key, 'mdlData' => $_POST['InvoiceItems'], 'bindData' => $row));
        }

        Yii::app()->end();
    }

    protected function bindAddedRow($product, $key) {
        $item_price = $product['inv_det_cotton_qty'] * $product['inv_det_price'];
        $row = '';
        $row .= '<tr data-session-key="' . $key . '" class="alert alert-danger">';
        $row .= '<td>' . ProductFamily::model()->findByPk($product['inv_det_prod_fmly_id'])->pro_family_name . '</td>';
        $row .= '<td>' . Product::model()->findByPk($product['inv_det_product_id'])->pro_name . '</td>';
        $row .= '<td>' . ProductVariety::model()->findByPk($product['inv_det_variety_id'])->variety_name . '</td>';
        $row .= '<td>' . implode(",", CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['inv_det_grade'])), 'grade_id', 'grade_long_name')) . '</td>';
        $row .= '<td>' . implode(",", CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['inv_det_size'])), 'size_id', 'size_name')) . '</td>';
        $row .= '<td>' . $product['inv_det_net_weight'] . '</td>';
        $row .= '<td>' . $product['inv_det_gross_weight'] . '</td>';
        $row .= '<td>' . $product['inv_det_currency'] . '</td>';
        $row .= '<td>' . $product['inv_det_cotton_qty'] . '</td>';
        $row .= '<td>' . $product['inv_det_ctnr_no'] . '</td>';
        $row .= '<td>' . $product['inv_det_price'] . '</td>';
        $row .= '<td>' . $item_price . '</td>';
        $row .= '<td valign="middle">';
        $row .= CHtml::link('<i class="glyphicon glyphicon-trash"></i>', "javascript:void(0);", array('class' => 'delete_prod', 'data-uid' => "$key"));
        $row .= '</td></tr>';

        return $row;
    }

//    public function actionEditInvPrduct($posession, $key) {
//        $session = Yii::app()->session;
//        $detail_model = new InvoiceItems('add_product');
//        $detail_model->attributes = $_SESSION['inv_added_products'][$posession][$key];
//        $cs = Yii::app()->clientScript;
//        $cs->reset();
//        $cs->scriptMap = array(
//            'jquery.js' => false,
//            'jquery.min.js' => false,
//        );
//
//        $this->renderPartial('_product_form', compact('detail_model'), false, true);
//
//        Yii::app()->end();
//    }

    public function actionDeleteInvPrduct($posession, $key) {
        TempSession::model()->byMe()->deleteByPk($key, "session_name = '$this->sess_name' AND session_key = '{$posession}'");
        $this->forward('invAddedProducts');
        Yii::app()->end();
    }

//    public function actionInvAddedProducts($posession) {
//        $inv_products = $_SESSION['inv_added_products'][$posession];
//        $this->renderPartial('_inv_added_products', compact('inv_products'), false, true);
//        Yii::app()->end();
//    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        try {
            $model = $this->loadModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Invoice successfully.", "user");
        } catch (CDbException $e) {
            if ($e->errorInfo[1] == 1451) {
                throw new CHttpException(400, Yii::t('err', 'Relation Restriction Error.'));
            } else {
                throw $e;
            }
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Invoice Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Invoice();
        $model->unsetAttributes();
        if (isset($_REQUEST['Invoice']) && !empty($_REQUEST['Invoice'])) {
            $model->attributes = $_GET['Invoice'];
        }

        $this->render('index', compact('model'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Invoice('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Invoice']))
            $model->attributes = $_GET['Invoice'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Invoice the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Invoice::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Invoice $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'invoice-form' || $_POST['ajax'] === 'invoice-items-form')) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPreview() {
        $company = $vendor = $liner = array();
        if ($_GET['comp_id'] && !empty($_GET['comp_id'])) {
            $company = Company::model()->findByPk($_GET['comp_id']);
        }
        if ($_GET['vendor_id'] && !empty($_GET['vendor_id'])) {
            $vendor = Vendor::model()->findByPk($_GET['vendor_id']);
        }
        if ($_GET['liner_id'] && !empty($_GET['liner_id'])) {
            $liner = Liner::model()->findByPk($_GET['liner_id']);
        }
        if ($_GET['lbldate'] && !empty($_GET['lbldate'])) {
            $lbldate = $_GET['lbldate'];
        }
        if ($_GET['posession'] && !empty($_GET['posession'])) {
            if (!$tmp_data = TempSession::model()->byMe()->find("session_name = '$this->sess_name' AND session_key = '{$_GET['posession']}'")) {
                if ((substr($_GET['posession'], 0, 3) == "inv_") && ($inv_id = substr($_GET['posession'], 3))) {
                    $model = Invoice::model()->findByPk($inv_id);
                    foreach ($model->invoiceItems as $item)
                        $inv_products[] = CJSON::encode($item->attributes);
                }
            } else {
                $inv_products = $tmp_data->session_data['InvoiceItems'];
            }
        }
        $this->renderPartial('_preview', compact('company', 'vendor', 'liner', 'lbldate', 'inv_products'));
    }

    public function actionReport() {
        $this->render('report');
    }

    public function actionVendorreport() {
        $this->render('vendorreport');
    }

    public function actionCompanyreport() {
        $this->render('companyreport');
    }
    
    public function actionUpload() {
        if($_POST["upload_type"] == 1 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 1)){
            $rand = $_SESSION['invoice_rand'];
        }else if($_POST["upload_type"] == 2 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 2)){
            $rand = $_SESSION['invoice_pkg'];
        }
        
        Yii::import("xupload.models.XUploadForm");
        $path = realpath(Yii::app()->getBasePath() . "/../".UPLOAD_DIR."/invoice") . '/';
       $publicPath = Yii::app()->getBaseUrl() . "/".UPLOAD_DIR."/invoice" . '/';
        $folderpath=Yii::getPathOfAlias('webroot'). "/".UPLOAD_DIR."/invoice" . '/';
        if (!is_dir($folderpath)) {
            mkdir($folderpath, 0777, true);
        }
        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"] [0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        $_SESSION['invoice_files_delete'][$rand][] = $file;
//                        unlink($file);
                    }
                }
                
                $key = array_search('/invoice/'.@$_GET["file"], @$_SESSION['invoice_files'][$rand]);
                unset($_SESSION['invoice_files'][$rand][$key]);
                echo json_encode(array(true, 'file' => $_GET["file"], 'file2' => $file));
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                $fname = $model->name;
                $fn = explode('.', $fname);
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime()) . '_' . $fn[0];
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate()) {
                    
                    
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    
                    chmod($path . $filename, 0777);
                    $_SESSION['invoice_files'][$rand][] = '/invoice/' . $filename;
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "thumbnail_url" => $publicPath . $filename,
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename,
                                "upload_type" => $_POST["upload_type"],
                            )),
                            "delete_type" => "POST",
                            "rand" => $rand,
                            "img_name" => $fname,
                    )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                    )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger:: LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    protected function deleteFiles() {
        $rand = $_SESSION['invoice_rand'];
        $pkg = $_SESSION['invoice_pkg'];
        foreach ($_SESSION['invoice_files_delete'][$rand] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        foreach ($_SESSION['invoice_files_delete'][$pkg] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        session_unset($_SESSION['invoice_files_delete']);
    }

}
