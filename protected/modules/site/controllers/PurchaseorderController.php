<?php

class PurchaseorderController extends Controller {

    protected $sess_name = 'po_added_products';

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public function behaviors() {
        return array(
            'exportableGrid' => array(
                'class' => 'application.components.ExportableGridBehavior',
                'filename' => "Purchaseorder_" . time() . ".csv",
//                'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
        ));
    }

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
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'addProduct', 'poAddedProducts', 'editPoPrduct', 'deletePoPrduct', 'preview', 'report', 'sendvendor', 'changestatus'),
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
        $posession = 'new';

        if (isset($_REQUEST['open']) && ($_REQUEST['open'] == 'fresh')) {
            TempSession::model()->byMe()->deleteAll("session_name = 'po_added_products' AND session_key = '{$posession}'");
            $this->redirect(array('/site/purchaseorder/create'));
        }

        $model = new PurchaseOrder;
        $detail_model = new PurchaseOrderDetails('add_product');

        $this->performAjaxValidation($model);

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];

            if (isset($_POST['action']) && ($_POST['action'] == 'save_po')) {
                $this->tempSave($posession, $model->attributes, $_POST['OrderDetails']);
                $notes = "PurchaseOrder Saved successfully.";
                $redir = array('create');
            } else if (isset($_POST['action']) && ($_POST['action'] == 'submit_po')) {
                if ($model->validate()) {
                    $model->save(false);
                    $this->itemSave($posession, $model->attributes, $_POST['OrderDetails']);
                    $notes = "Created PurchaseOrder successfully.";
                    $redir = array('index');
                }
            }
            Myclass::addAuditTrail($notes, "user");
            Yii::app()->user->setFlash('success', $notes);
            $this->redirect($redir);
        } else if ($tmp_data = TempSession::model()->byMe()->find("session_name = '$this->sess_name' AND session_key = '{$posession}'")) {
            $model->attributes = $tmp_data->session_data['PurchaseOrder'];
            $po_products = $tmp_data->session_data['PurchaseOrderDetails'];
        }

        $this->render('create', compact('model', 'detail_model', 'po_products'));
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
            TempSession::model()->byMe()->deleteAll("session_name = '$this->sess_name' AND session_key = '{$posession}'");
            $this->redirect(array('/site/purchaseorder/update', 'id' => $model->po_id));
        }

        $this->performAjaxValidation($model);

        if (isset($_POST['PurchaseOrder'])) {
            $model->attributes = $_POST['PurchaseOrder'];

            if (isset($_POST['action']) && ($_POST['action'] == 'save_po')) {
                $this->tempSave($posession, $model->attributes, $_POST['OrderDetails']);
                $notes = "Purchase Order Saved successfully.";
                $redir = array('update', 'id' => $id);
            } else if (isset($_POST['action']) && ($_POST['action'] == 'submit_po')) {
                if ($model->validate()) {
                    $model->save(false);
                    PurchaseOrderDetails::model()->deleteAll("po_id = '{$model->po_id}'");
                    $this->itemSave($posession, $model->attributes, $_POST['OrderDetails']);
                    $notes = "Updated PurchaseOrder successfully.";
                    $redir = array('index');
                }
            }
            Myclass::addAuditTrail($notes, "user");
            Yii::app()->user->setFlash('success', $notes);
            $this->redirect($redir);
        } else if ($tmp_data = TempSession::model()->byMe()->find("session_name = '$this->sess_name' AND session_key = '{$posession}'")) {
            $model->attributes = $tmp_data->session_data['PurchaseOrder'];
            $po_products = $tmp_data->session_data['PurchaseOrderDetails'];
        } else {
            foreach ($model->purchaseOrderDetails as $item)
                $po_products[] = CJSON::encode($item->attributes);
        }

        $this->render('update', compact('model', 'detail_model', 'po_products'));
    }

    protected function tempSave($posession, $po, $orderdetail) {
        TempSession::model()->byMe()->deleteAll("session_name = '$this->sess_name' AND session_key = '{$posession}'");
        $temp_array = array('PurchaseOrder' => $po, 'PurchaseOrderDetails' => $orderdetail);
        $tmp_sess = new TempSession();
        $tmp_sess->session_name = $this->sess_name;
        $tmp_sess->session_key = $posession;
        $tmp_sess->session_data = CJSON::encode($temp_array);
        $tmp_sess->save();
    }

    protected function itemSave($posession, $po, $orderdetail) {
        foreach ($orderdetail as $item) {
            $detail_model = new PurchaseOrderDetails('save');
            $detail_model->attributes = CJSON::decode($item);
            $detail_model->po_id = $po['po_id'];
            $detail_model->save(false);
        }
        TempSession::model()->byMe()->deleteAll("session_name = '$this->sess_name' AND session_key = '{$posession}'");

        return true;
    }

    public function actionAddProduct($posession) {
        $detail_model = new PurchaseOrderDetails('add_product');
        $this->performAjaxValidation($detail_model);
        if (isset($_POST['PurchaseOrderDetails'])) {
            $key = rand();
            $row = $this->bindAddedRow($_POST['PurchaseOrderDetails'], $key);
            echo CJSON::encode(array('key_no' => $key, 'mdlData' => $_POST['PurchaseOrderDetails'], 'bindData' => $row));
        }

        Yii::app()->end();
    }

    protected function bindAddedRow($product, $key) {
        $item_price = $product['po_det_cotton_qty'] * $product['po_det_price'];
        $row = '';
        $row .= '<tr data-session-key="' . $key . '" class="alert alert-danger">';
        $row .= '<td>' . ProductFamily::model()->findByPk($product['po_det_prod_fmly_id'])->pro_family_name . '</td>';
        $row .= '<td>' . Product::model()->findByPk($product['po_det_product_id'])->pro_name . '</td>';
        $row .= '<td>' . ProductVariety::model()->findByPk($product['po_det_variety_id'])->variety_name . '</td>';
        $row .= '<td>' . implode(",", CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $product['po_det_grade'])), 'grade_id', 'grade_long_name')) . '</td>';
        $row .= '<td>' . implode(",", CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $product['po_det_size'])), 'size_id', 'size_name')) . '</td>';
        $row .= '<td>' . $product['po_det_net_weight'] . '</td>';
        $row .= '<td>' . $product['po_det_currency'] . '</td>';
        $row .= '<td>' . $product['po_det_cotton_qty'] . '</td>';
        $row .= '<td>' . $product['po_det_container_qty'] . '</td>';
        $row .= '<td>' . $product['po_det_price'] . '</td>';
        $row .= '<td>' . $item_price . '</td>';
        $row .= '<td valign="middle">';
//        $row .= CHtml::link('<i class="glyphicon glyphicon-pencil"></i>', "javascript:void(0);", array('class' => 'edit_prod', 'data-uid' => "$key"));
//        $row .= '&nbsp;&nbsp;';
        $row .= CHtml::link('<i class="glyphicon glyphicon-trash"></i>', "javascript:void(0);", array('class' => 'delete_prod', 'data-uid' => "$key"));
        $row .= '</td></tr>';

        return $row;
    }

//    public function actionEditPoPrduct($posession, $key) {
//        if (substr($posession, 0, 3) == "po_")
//            $model = PurchaseOrder::model()->findByPk(substr($posession, 3));
//        else
//            $model = new PurchaseOrder;
//
//        $detail_model = new PurchaseOrderDetails('add_product');
//        $detail_model->attributes = TempSession::model()->byMe()->findByPk($key, "session_name = '$this->sess_name' AND session_key = '{$posession}'")->session_data;
//        $cs = Yii::app()->clientScript;
//        $cs->reset();
//        $cs->scriptMap = array(
//            'jquery.js' => false,
//            'jquery.min.js' => false
//        );
//
//        $this->renderPartial('_product_form', compact('model', 'detail_model', 'posession'), false, true);
//
//        Yii::app()->end();
//    }

    public function actionDeletePoPrduct($posession, $key) {
        TempSession::model()->byMe()->deleteByPk($key, "session_name = '$this->sess_name' AND session_key = '{$posession}'");
        $this->forward('poAddedProducts');
        Yii::app()->end();
    }

//    public function actionPoAddedProducts($posession) {
//        $po_products = TempSession::model()->byMe()->findAll("session_name = '$this->sess_name' AND session_key = '{$posession}'");
//        $this->renderPartial('_po_added_products', compact('posession', 'po_products'), false, true);
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
            Myclass::addAuditTrail("Deleted PurchaseOrder successfully.", "user");
        } catch (CDbException $e) {
                        if ($e->errorInfo[1] == 1451) {
                throw new CHttpException(400, Yii::t('err', 'Relation Restriction Error.'));
            } else {
                throw $e;
            }

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
        $detail_model = new PurchaseOrderDetails();
        $f_from_date = $f_to_date = $f_vendor = $f_po = $_status = '';
        
        if (isset($_REQUEST['PurchaseOrderDetails']) && !empty($_REQUEST['PurchaseOrderDetails'])) {
            $detail_model->unsetAttributes();
            $detail_model->attributes = $_GET['PurchaseOrderDetails'];
            $f_from_date = $_GET['PurchaseOrderDetails']['f_from_date'];
            $f_to_date = $_GET['PurchaseOrderDetails']['f_to_date'];
            $f_vendor = Vendor::model()->findByPk($_GET['PurchaseOrderDetails']['f_po_vendor_id'])->vendor_name;
            $f_po = $_GET['PurchaseOrderDetails']['f_purchase_order_code'];
        }

        $export = isset($_REQUEST['export']) && $_REQUEST['export'] == 'PDF';
        $compact = compact('model', 'export', 'detail_model');
        if ($export) {
            $model->page_size = false;
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $stylesheet = $this->pdfStyles();
            $mPDF1->WriteHTML($stylesheet, 1);
            $mPDF1->WriteHTML($this->renderPartial('_grid', $compact, true));
            $mPDF1->Output("PurchaseOrder.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            if ($this->isExportRequest()) {
                $this->exportCSV(array('PO Report:', '', 'Filter', 'From Date', $f_from_date, 'To Date', $f_to_date, 'Vendor', $f_vendor, 'PO No', $f_po, 'Status', $f_po), null, false);
                $this->exportCSV(array(''), null, false);
                $this->exportCSV(array(''), null, false);
                $this->exportCSV(array(''), null, false);
                $this->exportCSV(array(SITENAME, '', '', 'PURCHASE ORDER REPORT'), null, false);
                $this->exportCSV($detail_model->dataProvider(), array('vendorname', 'purchasecode', 'purchasedate', 'postatus', 'createdbyname', 'familyname', 'productname', 'varietyname', 'sizenames', 'gradenames', 'po_det_cotton_qty', 'po_det_price', 'po_det_container_qty', 'po_det_net_weight', 'totalamount'));
            }
            $this->render('report', $compact);
        }
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
        if ($_GET['posession'] && !empty($_GET['posession'])) {
            if (!$tmp_data = TempSession::model()->byMe()->find("session_name = '$this->sess_name' AND session_key = '{$_GET['posession']}'")) {
                if ((substr($_GET['posession'], 0, 3) == "po_") && ($po_id = substr($_GET['posession'], 3))) {
                    $model = PurchaseOrder::model()->findByPk($po_id);
                    foreach ($model->purchaseOrderDetails as $item)
                        $po_products[] = CJSON::encode($item->attributes);
                }
            } else {
                $po_products = $tmp_data->session_data['PurchaseOrderDetails'];
            }
        }

        $this->renderPartial('_preview', compact('company', 'vendor', 'liner', 'lbldate', 'po_products'));
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
        $mailer->Subject = Yii::app()->name . "-Purchase order #{$model->purchase_order_code}";
        $mailer->MsgHTML($body);

        try {
            $mailer->Send();
            $model->setAttribute('sent_vendor', 1);
            $model->save(false);
            Yii::app()->user->setFlash('success', 'PurchaseOrder sent to vendor successfully!!!');
            $this->redirect(array('index'));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actionChangestatus() {
        if(isset($_POST)){
            $model = PurchaseOrder::model()->findByPk($_POST['po_id']);
            $save = $model->saveAttributes(array('status' => $_POST['status']));
            $newsts = PurchaseOrder::StatusList($_POST['status']);
            if($save)
                echo "Purchase Order: '{$model->purchase_order_code}' Status Changed to '{$newsts}' Successfully";
            else
                echo 'Failed to change the Status. Try again later !!!';
            Yii::app()->end();
        }
    }
}
