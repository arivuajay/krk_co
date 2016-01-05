<?php

class ExpenseController extends Controller {
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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'upload'),
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
            $mPDF1->Output("Expense_view_{$id}.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            $this->render('view', $compact);
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Expense;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Expense'])) {
            $model->attributes = $_POST['Expense'];
            $rand = $_SESSION['expense_rand'];
            $model->exp_file = $_SESSION['expense_files'][$rand];
            if ($model->save()) {
                $this->deleteFiles();
                Myclass::addAuditTrail("Created Expense successfully.", "user");
                Yii::app()->user->setFlash('success', 'Expense Created Successfully!!!');
                $this->redirect(array('index'));
            }
        } else {
            $_SESSION['expense_rand'] = Myclass::getRandomString(6);
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

        if (isset($_POST['Expense'])) {
            $model->attributes = $_POST['Expense'];
            $rand = $_SESSION['expense_rand'];
            $model->exp_file = $_SESSION['expense_files'][$rand];
            if ($model->save()) {
                $this->deleteFiles();
                Myclass::addAuditTrail("Updated Expense successfully.", "user");
                Yii::app()->user->setFlash('success', 'Expense Updated Successfully!!!');
                $this->redirect(array('index'));
            }
        } else {
            $_SESSION['expense_rand'] = Myclass::getRandomString(6);
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
            Myclass::addAuditTrail("Deleted Expense successfully.", "user");
        } catch (CDbException $e) {
            if ($e->errorInfo[1] == 1451) {
                throw new CHttpException(400, Yii::t('err', 'Relation Restriction Error.'));
            } else {
                throw $e;
            }
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Expense Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $search = false;

        $model = new Expense();
        $searchModel = new Expense('search');
        $searchModel->unsetAttributes();  // clear any default values
        if (isset($_GET['Expense'])) {
            $search = true;
            $searchModel->attributes = $_GET['Expense'];
            $searchModel->search();
        }

        $this->render('index', compact('searchModel', 'search', 'model'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Expense('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Expense']))
            $model->attributes = $_GET['Expense'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Expense the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Expense::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Expense $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expense-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUpload() {
        $rand = $_SESSION['expense_rand'];
        Yii::import("xupload.models.XUploadForm");
        $path = realpath(Yii::app()->getBasePath() . "/../".UPLOAD_DIR."/expense") . '/';
        $publicPath = Yii::app()->getBaseUrl() . "/".UPLOAD_DIR."/expense" . '/';
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
                        $_SESSION['expense_files_delete'][$rand][] = $file;
//                        unlink($file);
                    }
                }
                $key = array_search('/expense/'.@$_GET["file"], @$_SESSION['expense_files'][$rand]);
                unset($_SESSION['expense_files'][$rand][$key]);
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
                    $_SESSION['expense_files'][$rand][] = '/expense/' . $filename;
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
        $rand = $_SESSION['expense_rand'];
        foreach ($_SESSION['expense_files_delete'][$rand] as $file) {
            if (is_file($file)) {
            unlink($file);
            }
        }
        session_unset($_SESSION['expense_files_delete']);
    }
}
