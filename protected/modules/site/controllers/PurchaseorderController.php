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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addProduct', 'poAddedProducts', 'editPoPrduct', 'deletePoPrduct'),
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
        $model = new PurchaseOrder;
        $detail_model = new PurchaseOrderDetails('add_product');

        $session = Yii::app()->session;
        $po_products = $session['po_added_products'];

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];
            if ($model->validate()) {
                $model->save(false);
                foreach ($po_products as $product) {
                    $detail_model = new PurchaseOrderDetails('save');
                    $detail_model->attributes = $product;
                    $detail_model->po_id = $model->po_id;
                    $detail_model->save(false);
                }

                unset($_SESSION['po_added_products']);
                Myclass::addAuditTrail("Created PurchaseOrder successfully.", "user");
                Yii::app()->user->setFlash('success', 'PurchaseOrder Created Successfully!!!');
                $this->redirect(array('index'));
            }
        }

        $this->render('create', compact('model', 'detail_model'));
    }

    public function actionAddProduct() {
        $detail_model = new PurchaseOrderDetails('add_product');

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($detail_model);
        if (isset($_POST['PurchaseOrderDetails'])) {
            $detail_model->attributes = $_POST['PurchaseOrderDetails'];
            $session = Yii::app()->session;
            if (!isset($session['po_added_products']) || count($session['po_added_products']) == 0) {
                $session['po_added_products'] = array(rand() => $detail_model->attributes);
            } else {
                $myarr = $session['po_added_products'];
                $myarr[rand()] = $detail_model->attributes;
                $session['po_added_products'] = $myarr;
            }
        }
        Yii::app()->end();
    }

    public function actionEditPoPrduct($id) {
        $session = Yii::app()->session;
        $detail_model = new PurchaseOrderDetails('add_product');
        $detail_model->attributes = $session['po_added_products'][$id];
        $cs = Yii::app()->clientScript;
        $cs->reset();
        $cs->scriptMap = array(
            'jquery.js' => false,
            'jquery.min.js' => false,
        );

        $this->renderPartial('_product_form', compact('detail_model'), false, true);

        Yii::app()->end();
    }

    public function actionDeletePoPrduct($id) {
        $key = (int) $id;
        unset($_SESSION['po_added_products'][$key]);
        $this->forward('poAddedProducts');
        Yii::app()->end();
    }

    public function actionPoAddedProducts() {
        $session = Yii::app()->session;
        $po_products = $session['po_added_products'];
        $this->renderPartial('_po_added_products', compact('po_products'), false, true);
        Yii::app()->end();
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

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];
            if ($model->save()) {
                Myclass::addAuditTrail("Updated PurchaseOrder successfully.", "user");
                Yii::app()->user->setFlash('success', 'PurchaseOrder Updated Successfully!!!');
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
        $this->render('index', compact('model'));
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

}
