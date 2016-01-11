<?php

class PaymentController extends Controller {
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

    public function behaviors() {
        return array(
            'exportableGrid' => array(
                'class' => 'application.components.ExportableGridBehavior',
                'filename' => "Payment_" . time() . ".csv",
//                'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
        ));
    }
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'admin', 'delete', 'report','upload'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'actions' => array('update'),
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);

        $export = isset($_REQUEST['export']) && $_REQUEST['export'] == 'PDF';
        $compact = compact('model', 'export');
        if ($export) {
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $stylesheet = $this->pdfStyles();
            $mPDF1->WriteHTML($stylesheet, 1);
            $mPDF1->WriteHTML($this->renderPartial('view', $compact, true));
            $mPDF1->Output("Payment_view_{$id}.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            $this->render('view', $compact);
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Payment;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Payment'])) {
            
            $model->attributes = $_POST['Payment'];
            
            $shift = $_SESSION['shift_advise_rand'];
            $temp= $_SESSION['payment_files'][$shift];
            $model->pay_shift_advise = !empty($temp) ? $_SESSION['payment_files'][$shift] : '';
            
            
            $debit = $_SESSION['debit_advise_rand'];
            $temp1= $_SESSION['payment_files'][$debit];
            $model->pay_debit_advise = !empty($temp1) ? $_SESSION['payment_files'][$debit] : '';
//            
//                echo '<pre>';
//            print_r($model->attributes);
//            exit;    
            $other = $_SESSION['other_doc_rand'];
            $temp2= $_SESSION['payment_files'][$other];
            $model->pay_other_doc = !empty($temp2) ? $_SESSION['payment_files'][$other] : '';
            
            $deal = $_SESSION['deal_id_copy_rand'];
            $temp3= $_SESSION['payment_files'][$deal];
            $model->pay_deal_id_copy = !empty($temp3) ? $_SESSION['payment_files'][$deal] : '';
            
            if ($model->validate()) {
//                $model->setUploadDirectory(UPLOAD_DIR);
//                $model->uploadFile();

                $model->save(false);
                $this->deleteFiles();
                Myclass::addAuditTrail("Created Payment successfully.", "user");
                Yii::app()->user->setFlash('success', 'Payment Created Successfully!!!');
                $this->redirect(array('index'));
            }
        }else {
            $_SESSION['shift_advise_rand'] = Myclass::getRandomString(6);
            $_SESSION['debit_advise_rand'] = Myclass::getRandomString(6);
            $_SESSION['other_doc_rand'] = Myclass::getRandomString(6);
            $_SESSION['deal_id_copy_rand'] = Myclass::getRandomString(6);
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Payment'])) {
            $model->attributes = $_POST['Payment'];
            if ($model->validate()) {
                $model->setUploadDirectory(UPLOAD_DIR);
                $model->uploadFile();
                $model->save(false);
                Myclass::addAuditTrail("Updated Payment successfully.", "user");
                Yii::app()->user->setFlash('success', 'Payment Updated Successfully!!!');
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        try {
            $model = $this->loadModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Payment successfully.", "user");
        } catch (CDbException $e) {
                        if ($e->errorInfo[1] == 1451) {
                throw new CHttpException(400, Yii::t('err', 'Relation Restriction Error.'));
            } else {
                throw $e;
            }

        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Payment Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Payment();
        if (isset($_REQUEST['Payment']) && !empty($_REQUEST['Payment'])) {
            $model->unsetAttributes();
            $model->attributes = $_GET['Payment'];
        }
        
        $export = isset($_REQUEST['export']) && $_REQUEST['export'] == 'PDF';
        $compact = compact('model', 'export');
        if ($export) {
//            $model->page_size = false;
//            $mPDF1 = Yii::app()->ePdf->mpdf();
//            $stylesheet = $this->pdfStyles();
//            $mPDF1->WriteHTML($stylesheet, 1);
//            $mPDF1->WriteHTML($this->renderPartial('_grid', $compact, true));
//            $mPDF1->Output("Payments.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            if ($this->isExportRequest()) {
//                $model->unsetAttributes();
//                $this->exportCSV(array('Payment:'), null, false);
//                $this->exportCSV($model->dataProvider(), array('vendorname', 'paymenttype', 'pay_date', 'pay_amount', 'ponumber', 'invoicenumber'));
            }
            $this->render('index', $compact);
        }
    }

    public function actionReport() {
        $model = new Payment();
        if (isset($_REQUEST['Payment']) && !empty($_REQUEST['Payment'])) {
            $model->unsetAttributes();
            $model->attributes = $_GET['Payment'];
        }
        
        $export = isset($_REQUEST['export']) && $_REQUEST['export'] == 'PDF';
        $compact = compact('model', 'export');
        if ($export) {
            $model->page_size = false;
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $stylesheet = $this->pdfStyles();
            $mPDF1->WriteHTML($stylesheet, 1);
            $mPDF1->WriteHTML($this->renderPartial('_grid', $compact, true));
            $mPDF1->Output("Payments.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            if ($this->isExportRequest()) {
//                $model->unsetAttributes();
                $this->exportCSV(array('Payment:'), null, false);
                $this->exportCSV($model->dataProvider(), array('vendorname', 'paymenttype', 'pay_date', 'pay_amount', 'ponumber', 'invoicenumber'));
            }
            $this->render('report', $compact);
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Payment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Payment']))
            $model->attributes = $_GET['Payment'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Payment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Payment $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'payment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionUpload() {        
        if($_POST["upload_type"] == 1 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 1)){
            $rand = $_SESSION['shift_advise_rand'];
        }else if($_POST["upload_type"] == 2 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 2)){
            $rand = $_SESSION['debit_advise_rand'];
        }
        else if($_POST["upload_type"] == 3 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 3)){
            $rand = $_SESSION['other_doc_rand'];
        }else if($_POST["upload_type"] == 4 || (isset($_GET['upload_type']) && $_GET['upload_type'] == 4)){
            $rand = $_SESSION['deal_id_copy_rand'];
        }
        Yii::import("xupload.models.XUploadForm");
        $path = realpath(Yii::app()->getBasePath() . "/../".UPLOAD_DIR."/payment") . '/';
        $publicPath = Yii::app()->getBaseUrl() . "/".UPLOAD_DIR."/payment" . '/';
        $folderpath=Yii::getPathOfAlias('webroot'). "/".UPLOAD_DIR."/payment" . '/';
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
                        $_SESSION['payment_files_delete'][$rand][] = $file;
//                        unlink($file);
                    }
                }
                
                $key = array_search('/payment/'.@$_GET["file"], @$_SESSION['payment_files'][$rand]);
                unset($_SESSION['payment_files'][$rand][$key]);
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
                    $_SESSION['payment_files'][$rand][] = '/payment/' . $filename;
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
        $shift = $_SESSION['shift_advise_rand'];
        $debit = $_SESSION['debit_advise_rand'];
        $other = $_SESSION['other_doc_rand'];
        $deal = $_SESSION['deal_id_copy_rand'];

        foreach ($_SESSION['payment_files_delete'][$shift] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        foreach ($_SESSION['payment_files_delete'][$debit] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        foreach ($_SESSION['payment_files_delete'][$other] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        foreach ($_SESSION['payment_files_delete'][$deal] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        session_unset($_SESSION['payment_files_delete']);
    }

}
