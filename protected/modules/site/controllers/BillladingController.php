<?php

class BillladingController extends Controller {
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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'report', 'upload'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
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
            $mPDF1->Output("BillLading_view_{$id}.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            $this->render('view', $compact);
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BillLading;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['BillLading'])) {
            $model->attributes = $_POST['BillLading'];
            $bl_no = $_POST['BillLading']['bl_number'];
            $invoices = Invoice::model()->active()->findAll("bol_no = '$bl_no'");
            if ($model->validate()) {
                $rand = $_SESSION['billlading_rand'];
                $temp = $_SESSION['billlading_files'][$rand];
                $files = !empty($temp) ? $_SESSION['billlading_files'][$rand] : '';

                foreach ($invoices as $key => $invoice) {
                    $new_bol_model = new BillLading;
                    $new_bol_model->attributes = $_POST['BillLading'];
                    
                    $inv = Myclass::GetInvoiceDetail1($invoice->invoice_id);
                    $new_bol_model->bl_invoice_id = $invoice->invoice_id;
                    $new_bol_model->bl_container_count = $inv['tot_qty'];

                    if ($key == 0) {
                        $new_bol_model->bl_documents = $files;
                    } else {
                        $fileArr = array();
                        foreach ($files as $file) {
                            $exp = explode('/', $file);
                            $fName = $exp[2];
                            $VName = substr($fName, 33);
                            $new_fname = md5(Yii::app()->user->id . microtime()) . '_' . $VName;
                            $source = Yii::getPathOfAlias('webroot').'/'.UPLOAD_DIR.$file;
                            $dest = Yii::getPathOfAlias('webroot').'/'.UPLOAD_DIR.'/billlading/'.$new_fname;
                            copy($source,$dest);
                            $fileArr[] = '/billlading/'.$new_fname;
                        }
                        $new_bol_model->bl_documents = $fileArr;
                    }
                    
                    $new_bol_model->save(false);
                    $this->deleteFiles();
                }
                Myclass::addAuditTrail("Created BillLading successfully.", "user");
                Yii::app()->user->setFlash('success', 'BillLading Created Successfully!!!');
                $this->redirect(array('index'));
            }
        } else {
            $_SESSION['billlading_rand'] = Myclass::getRandomString(6);
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

        if (isset($_POST['BillLading'])) {
            $model->attributes = $_POST['BillLading'];
            $rand = $_SESSION['billlading_rand'];
            $model->bl_documents = $_SESSION['billlading_files'][$rand];

            if ($model->validate()) {
                $model->save(false);
                $this->deleteFiles();
                Myclass::addAuditTrail("Updated BillLading successfully.", "user");
                Yii::app()->user->setFlash('success', 'BillLading Updated Successfully!!!');
                $this->redirect(array('index'));
            }
        } else {
            $_SESSION['billlading_rand'] = Myclass::getRandomString(6);
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
            Myclass::addAuditTrail("Deleted BillLading successfully.", "user");
        } catch (CDbException $e) {
            if ($e->errorInfo[1] == 1451) {
                throw new CHttpException(400, Yii::t('err', 'Relation Restriction Error.'));
            } else {
                throw $e;
            }
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'BillLading Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $search = false;

        $model = new BillLading();
        $searchModel = new BillLading('search');
        $searchModel->unsetAttributes();  // clear any default values
        if (isset($_GET['BillLading'])) {
            $search = true;
            $searchModel->attributes = $_GET['BillLading'];
            $searchModel->search();
        }

        $this->render('index', compact('searchModel', 'search', 'model'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new BillLading('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BillLading']))
            $model->attributes = $_GET['BillLading'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return BillLading the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = BillLading::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BillLading $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bill-lading-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReport() {
        $this->render('report');
    }

    public function actionUpload() {
        $rand = $_SESSION['billlading_rand'];
        Yii::import("xupload.models.XUploadForm");
        $path = realpath(Yii::app()->getBasePath() . "/../" . UPLOAD_DIR . "/billlading") . '/';
        $publicPath = Yii::app()->getBaseUrl() . "/" . UPLOAD_DIR . "/billlading" . '/';
        $folderpath = Yii::getPathOfAlias('webroot') . "/" . UPLOAD_DIR . "/billlading" . '/';
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
                        $_SESSION['billlading_files_delete'][$rand][] = $file;
//                        unlink($file);
                    }
                }
                $key = array_search('/billlading/' . @$_GET["file"], @$_SESSION['billlading_files'][$rand]);
                unset($_SESSION['billlading_files'][$rand][$key]);
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
                    $_SESSION['billlading_files'][$rand][] = '/billlading/' . $filename;
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "thumbnail_url" => $publicPath . $filename,
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename
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
        $rand = $_SESSION['billlading_rand'];
        foreach ($_SESSION['billlading_files_delete'][$rand] as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        session_unset($_SESSION['billlading_files_delete']);
    }

}
