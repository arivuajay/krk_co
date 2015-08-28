<?php

class InvoiceController extends Controller {
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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addProduct', 'invAddedProducts', 'editInvPrduct', 'deleteInvPrduct','preview'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->render('view', compact('model'));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $posession = Yii::app()->user->getState('guid');

        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            unset($_SESSION['inv_added_products'][$posession]);
            $this->redirect(array('/site/invoice/create'));
        }

        $model = new Invoice;
        $detail_model = new InvoiceItems('add_product');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Invoice'])) {
            $model->attributes = $_POST['Invoice'];
            if ($model->validate()) {
                $model->setUploadDirectory(UPLOAD_DIR);
                $model->uploadFile();
                $model->save(false);
                $inv_products = $_SESSION['inv_added_products'][$posession];
                foreach ($inv_products as $product) {
                    $detail_model = new InvoiceItems('save');
                    $detail_model->attributes = $product;
                    $detail_model->inv_id = $model->invoice_id;
                    $detail_model->save(false);
                }

                unset($_SESSION['inv_added_products'][$posession]);
                Myclass::addAuditTrail("Created Invoice successfully.", "user");
                Yii::app()->user->setFlash('success', 'Invoice Created Successfully!!!');
                $this->redirect(array('index'));
            }
        }

        $this->render('create', compact('model', 'detail_model'));
    }

    public function actionAddProduct($posession) {
        $detail_model = new InvoiceItems('add_product');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($detail_model);
        if (isset($_POST['InvoiceItems'])) {
            $detail_model->attributes = $_POST['InvoiceItems'];
            $_SESSION['inv_added_products'][$posession][rand()] = $detail_model->attributes;
        }
        Yii::app()->end();
    }

    public function actionEditInvPrduct($posession, $key) {
        $session = Yii::app()->session;
        $detail_model = new InvoiceItems('add_product');
        $detail_model->attributes = $_SESSION['inv_added_products'][$posession][$key];
        $cs = Yii::app()->clientScript;
        $cs->reset();
        $cs->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );

        $this->renderPartial('_product_form', compact('detail_model'), false, true);

        Yii::app()->end();
    }

    public function actionDeleteInvPrduct($posession, $key) {
        $key = (int) $key;
        unset($_SESSION['inv_added_products'][$posession][$key]);
        $this->forward('invAddedProducts');
        Yii::app()->end();
    }

    public function actionInvAddedProducts($posession) {
        $inv_products = $_SESSION['inv_added_products'][$posession];
        $this->renderPartial('_inv_added_products', compact('inv_products'), false, true);
        Yii::app()->end();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $detail_model = new InvoiceItems('add_product');
        $posession = "inv_{$model->po_id}";

        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            unset($_SESSION['inv_added_products'][$posession]);
            $this->redirect(array('/site/invoice/update', 'id' => $model->invoice_id));
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Invoice'])) {
            $model->attributes = $_POST['Invoice'];
            if ($model->validate()) {
                $model->setUploadDirectory(UPLOAD_DIR);
                $model->uploadFile();
                $model->save(false);
                InvoiceItems::model()->deleteAll("inv_id = '{$model->invoice_id}'");
                $inv_products = $_SESSION['inv_added_products'][$posession];
                foreach ($inv_products as $product) {
                    $detail_model = new InvoiceItems('save');
                    $detail_model->attributes = $product;
                    $detail_model->inv_id = $model->invoice_id;
                    $detail_model->save(false);
                }

                unset($_SESSION['inv_added_products'][$posession]);
                Myclass::addAuditTrail("Updated Invoice successfully.", "user");
                Yii::app()->user->setFlash('success', 'Invoice Updated Successfully!!!');
                $this->redirect(array('index'));
            }
        } elseif (empty($_SESSION['inv_added_products'][$posession])) {
            $_SESSION['inv_added_products'][$posession] = InvoiceItems::model()->findAll("inv_id = '{$model->invoice_id}'");
        }

        $this->render('update', compact('model', 'detail_model'));
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
            Myclass::addAuditTrail("Deleted Invoice successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
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
        if (isset($_REQUEST['Invoice']) && !empty($_REQUEST['Invoice'])) {
            $model->unsetAttributes();
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
        $this->renderPartial('_preview', compact('company', 'vendor', 'liner', 'lbldate'));
    }

}
