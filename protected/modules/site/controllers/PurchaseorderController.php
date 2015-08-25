<?php

class PurchaseorderController extends Controller {
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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addProduct', 'poAddedProducts', 'editPoPrduct', 'deletePoPrduct', 'preview', 'report', 'sendvendor'),
                'users' => array('@'),
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
        $this->render('view', compact('model'));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            unset($_SESSION['po_added_products']);
            $this->redirect(array('/site/purchaseorder/create'));
        }

        $model = new PurchaseOrder;
        $detail_model = new PurchaseOrderDetails('add_product');

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];
            if ($model->validate()) {
                $model->save(false);
                $posession = Yii::app()->user->getState('guid');
                $po_products = $_SESSION['po_added_products'][$posession];
                foreach ($po_products as $product) {
                    $detail_model = new PurchaseOrderDetails('save');
                    $detail_model->attributes = $product;
                    $detail_model->po_id = $model->po_id;
                    $detail_model->save(false);
                }

                unset($_SESSION['po_added_products'][$posession]);
                Myclass::addAuditTrail("Created PurchaseOrder successfully.", "user");
                Yii::app()->user->setFlash('success', 'PurchaseOrder Created Successfully!!!');
                $this->redirect(array('index'));
            }
        }

        $this->render('create', compact('model', 'detail_model'));
    }

    public function actionAddProduct($posession) {
        $detail_model = new PurchaseOrderDetails('add_product');

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($detail_model);
        if (isset($_POST['PurchaseOrderDetails'])) {
            $detail_model->attributes = $_POST['PurchaseOrderDetails'];
            $_SESSION['po_added_products'][$posession][rand()] = $detail_model->attributes;
        }
        Yii::app()->end();
    }

    public function actionEditPoPrduct($posession, $key) {
        $session = Yii::app()->session;
        $detail_model = new PurchaseOrderDetails('add_product');
        $detail_model->attributes = $session['po_added_products'][$posession][$key];
        $cs = Yii::app()->clientScript;
        $cs->reset();
        $cs->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );

        $this->renderPartial('_product_form', compact('detail_model'), false, true);

        Yii::app()->end();
    }

    public function actionDeletePoPrduct($posession, $key) {
        $key = (int) $key;
        unset($_SESSION['po_added_products'][$posession][$key]);
        $this->forward('poAddedProducts');
        Yii::app()->end();
    }

    public function actionPoAddedProducts($posession) {
        $po_products = $_SESSION['po_added_products'][$posession];
        $this->renderPartial('_po_added_products', compact('posession', 'po_products'), false, true);
        Yii::app()->end();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $detail_model = new PurchaseOrderDetails('add_product');
        $posession = "po_{$model->po_id}";
        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            unset($_SESSION['po_added_products'][$posession]);
            $this->redirect(array('/site/purchaseorder/update', 'id' => $model->po_id));
        }

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];
            if ($model->validate()) {
                $model->save(false);
                PurchaseOrderDetails::model()->deleteAll("po_id = '{$model->po_id}'");
                $po_products = $_SESSION['po_added_products'][$posession];
                foreach ($po_products as $product) {
                    $detail_model = new PurchaseOrderDetails('save');
                    $detail_model->attributes = $product;
                    $detail_model->po_id = $model->po_id;
                    $detail_model->save(false);
                }

                unset($_SESSION['po_added_products'][$posession]);
                Myclass::addAuditTrail("Updated PurchaseOrder successfully.", "user");
                Yii::app()->user->setFlash('success', 'PurchaseOrder Updated Successfully!!!');
                $this->redirect(array('index'));
            }
        } elseif (empty($_SESSION['po_added_products'][$posession])) {
            $_SESSION['po_added_products'][$posession] = PurchaseOrderDetails::model()->findAll("po_id = '{$model->po_id}'");
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
            Myclass::addAuditTrail("Deleted PurchaseOrder successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'PurchaseOrder Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new PurchaseOrder();
        if (isset($_REQUEST['PurchaseOrder']) && !empty($_REQUEST['PurchaseOrder'])) {
            $model->unsetAttributes();
            $model->attributes = $_GET['PurchaseOrder'];
        }

        $this->render('index', compact('model'));
    }

    public function actionReport() {
        $model = new PurchaseOrder();
        if (isset($_REQUEST['PurchaseOrder']) && !empty($_REQUEST['PurchaseOrder'])) {
            $model->unsetAttributes();
            $model->attributes = $_GET['PurchaseOrder'];
        }

        $this->render('report', compact('model'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PurchaseOrder('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PurchaseOrder']))
            $model->attributes = $_GET['PurchaseOrder'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PurchaseOrder the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PurchaseOrder::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PurchaseOrder $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'purchase-order-form' || $_POST['ajax'] === 'purchase-order-details-form')) {
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

    public function actionSendvendor($id) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $model = $this->loadModel($id);
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = $this->pdfStyles();
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->renderPartial('view', compact('model'), true));
        $content_PDF = $mPDF1->Output("Purchase_order_{$model->purchase_order_code}.pdf", EYiiPdf::OUTPUT_TO_STRING);

        $body = "A PO Quote sent to you...";
        $mailer = new JPhpMailer;
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->SMTPAuth = SMTPAUTH;
        $mailer->SMTPSecure = SMTPSECURE;
        $mailer->Host = SMTPHOST;
        $mailer->Port = SMTPPORT;
        $mailer->Username = SMTPUSERNAME;
        $mailer->Password = SMTPPASS;
        $mailer->From = NOREPLYMAIL;
        $mailer->FromName = Yii::app()->name;
        $mailer->AddAddress($model->poVendor->vendor_email);
        $mailer->AddStringAttachment($content_PDF, "Purchase_order_{$model->purchase_order_code}.pdf");
        $mailer->Subject = Yii::app()->name."-Purchase order #{$model->purchase_order_code}";
        $mailer->MsgHTML($body);

        try {
            $mailer->Send();
            $model->setAttribute('sent_vendor' , 1);
            $model->save(false);
            Yii::app()->user->setFlash('success', 'PurchaseOrder sent to vendor successfully!!!');
            $this->redirect(array('index'));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
