<?php

/**
 * Site controller
 */
class DefaultController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * @array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('login', 'screens', 'index', 'error', 'requestpasswordreset', 'resetpassword',
                    'getGradeByProduct',
                    'getProductbyFamily',
                    'getSizeByProduct',
                    'getVarietybyProductId',
                    'getInvoiceByPo',
                    'getInvoiceDetail',
                    'getfamilycode',
                    'getgradecode',
                    'getlinercode',
                    'getproductcode',
                    'getsizecode',
                    'getvarietycode',
                    'getvendorcode',
                    'getvarietycode',
                    'getPOSByClient',
                    'getPOInfo',
                    'getVendorInfo',
                    'getLinerInfo',
                    'downloadFile',
                    'getPermitByClient',
                    'getPODetails',
                    'getInvoiceByBol',
                    'getContainerByInvoice',
                    'getExpSubTypeByType',
                    'report',
                    'poreport',
                ),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('logout', 'index', 'profile'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        $this->layout = '//layouts/login';

        if (!Yii::app()->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm();

        if (isset($_POST['sign_in'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()):
                Myclass::addAuditTrail("{$model->username} logged-in successfully.", "user");
                $this->goHome();
            endif;
        }

        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Myclass::addAuditTrail(Yii::app()->user->name . " logged-out successfully.", "user");
        unset($_SESSION['po_added_products']);
        Yii::app()->user->logout();
        $this->redirect(array('/site/default/login'));
    }

    public function actionRequestPasswordReset() {
        $this->layout = '//layouts/login';
        $model = new Passwordresetform();
        $this->performAjaxValidation($model);
        if (isset($_POST['Passwordresetform'])) {
            $model->attributes = $_POST['Passwordresetform'];
            if ($model->validate()):
                if ($model->sendEmail()) {
                    Yii::app()->user->setFlash('success', 'Check your email for further instructions.');
                    $this->redirect(array('/site/default/login'));
                } else {
                    Yii::app()->user->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                }
            endif;
        }

        $this->render('requestPasswordResetToken', array(
            'model' => $model,
        ));
    }

    public function actionResetPassword($token) {
        $this->layout = '//layouts/login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        $this->performAjaxValidation($model);

        if (isset($_POST['ResetPasswordForm'])) {
            $model->attributes = $_POST['ResetPasswordForm'];
            if ($model->validate() && $model->resetPassword()):
                Yii::app()->user->setFlash('success', 'New password was saved.');
                $this->redirect(array('/site/default/login'));
            endif;
        }

        $this->render('resetPassword', array(
            'model' => $model,
        ));
    }

    public function actionProfile() {
        $id = Yii::app()->user->id;
        $model = User::model()->findByPk($id);
        $model->setScenario('update');

        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()):
                $model->save(false);
                Myclass::addAuditTrail("Updated a {$model->username} successfully.", "user");
                Yii::app()->user->setFlash('success', 'Profile updated successfully');
                $this->refresh();
            endif;
        }
        $this->render('profile', compact('model'));
    }

    public function actionError() {
        if (Yii::app()->user->isGuest) {
            $this->layout = '//layouts/login';
        }
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
                Yii::app()->end();
            } else {
                $name = Yii::app()->errorHandler->error['code'] . ' Error';
                $message = Yii::app()->errorHandler->error['message'];
                $this->render('error', compact('error', 'name', 'message'));
            }
        }
    }

    public function actionScreens($path) {
        if ($path) {
            $this->render('screens', compact('path'));
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && ($_POST['ajax'] === 'request-pass' || $_POST['ajax'] === 'profile-form')) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetProductbyFamily($id, $pro_id = '') {
        $products = Product::model()->active()->findAll("pro_family_id = '$id'");

        $data = CHtml::listData($products, 'product_id', 'pro_name');

        echo "<option value=''>Select Products</option>";
        foreach ($data as $value => $name) {
            $htmlOpt = array();
            $htmlOpt['value'] = $value;
            if (!empty($pro_id) && $pro_id == $value)
                $htmlOpt['selected'] = 'selected';

            echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
        }
    }

    public function actionGetVarietybyProductId($id, $pro_id = '') {
        $products = ProductVariety::model()->active()->findAll("product_id = '$id'");

        $data = CHtml::listData($products, 'variety_id', 'variety_name');

        echo "<option value=''>Select Variety</option>";
        foreach ($data as $value => $name) {
            $htmlOpt = array();
            $htmlOpt['value'] = $value;
            if (!empty($pro_id) && $pro_id == $value)
                $htmlOpt['selected'] = 'selected';

            echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
        }
    }

    public function actionGetGradeByProduct($id, $pro_id = '') {
        $products = ProductGrade::model()->active()->findAll("product_id = '$id'");

        $data = CHtml::listData($products, 'grade_id', 'grade_long_name');

        foreach ($data as $value => $name) {
            $htmlOpt = array();
            $htmlOpt['value'] = $value;
            if (!empty($pro_id) && $pro_id == $value)
                $htmlOpt['selected'] = 'selected';

            echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
        }
    }

    public function actionGetSizeByProduct($id, $pro_id = '') {
        $products = ProductSize::model()->active()->findAll("product_id = '$id'");

        $data = CHtml::listData($products, 'size_id', 'size_name');

        foreach ($data as $value => $name) {
            $htmlOpt = array();
            $htmlOpt['value'] = $value;
            if (!empty($pro_id) && $pro_id == $value)
                $htmlOpt['selected'] = 'selected';

            echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
        }
    }

    public function actionGetInvoiceByPo($id, $sel = '') {
        $invoices = Invoice::model()->active()->findAll("po_id = '$id'");

        $data = CHtml::listData($invoices, 'invoice_id', 'inv_no');

        echo "<option value=''>Select Invoice</option>";
        foreach ($data as $value => $name) {
            $htmlOpt = array();
            $htmlOpt['value'] = $value;
            if (!empty($sel) && $sel == $value)
                $htmlOpt['selected'] = 'selected';

            echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
        }
    }

    public function actionGetInvoiceDetail($id) {
        $invoices = Invoice::model()->active()->findByPk($id);
        $result = $options = array();

        if ($invoices) {
            $options = array();
            $criteria = new CDbCriteria();
            $criteria->select = array('*', 'SUM(inv_det_cotton_qty) as CntrQty');
            $criteria->condition = "inv_id = '{$id}'";
            $criteria->group = 'inv_det_ctnr_no';

            $invoiceItems = InvoiceItems::model()->findAll($criteria);

            $total_inv_amount = 0;
            $totQty = 0;
            foreach ($invoiceItems as $item):
                $options[] = "{$item->inv_det_ctnr_no} - {$item->CntrQty}";
                $total_inv_amount += $item->invoiceamount;
                $totQty += $item->CntrQty;
            endforeach;

            $result['bol_no'] = $invoices->bol_no;
            $result['total_inv_amount'] = $total_inv_amount;
            $result['containers'] = implode("<br />", $options);
            $result['tot_qty'] = $totQty;
        }

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionGetvarietycode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = ProductVariety::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo ProductVariety::model()->checkVariety_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetfamilycode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = ProductFamily::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo ProductFamily::model()->checkFamily_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetgradecode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = ProductGrade::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo ProductGrade::model()->checkGrade_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetlinercode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = Liner::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo Liner::model()->checkLiner_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetproductcode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = Product::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo Product::model()->checkProduct_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetsizecode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = ProductSize::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo ProductSize::model()->checkSize_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetvendorcode() {
        $curdb = explode('=', Yii::app()->db->connectionString);
        $table_name = Vendor::model()->tableSchema->name;
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$curdb[2]}' AND TABLE_NAME = '{$table_name}'";

        $command = Yii::app()->db->createCommand($sql);
        $rowCount = $command->execute();
        if ($rowCount) {
            $result = $command->queryRow();
            echo Vendor::model()->checkVendor_code($result['AUTO_INCREMENT']);
        }
        Yii::app()->end();
    }

    public function actionGetPOSByClient($term, $vendor = '', $company = '') {
        $criteria = new CDbCriteria();
        $criteria->select = array('po_id', 'purchase_order_code', 'po_date');

        $criteria->compare('purchase_order_code', $term, true);
        if ($vendor)
            $criteria->compare('po_vendor_id', $vendor);
        if ($company)
            $criteria->compare('po_company_id', $company);

        $results = PurchaseOrder::model()->findAll($criteria);

        echo CJSON::encode($results);
        Yii::app()->end();
    }

    public function actionGetPermitByClient($term, $vendor = '', $company = '') {
        $criteria = new CDbCriteria();
        $criteria->select = array('permit_id', 'permit_no');

        $criteria->compare('permit_no', $term, true);
        if ($vendor)
            $criteria->compare('vendor_id', $vendor);
        if ($company)
            $criteria->compare('company_id', $company);

        $results = Permit::model()->findAll($criteria);

        echo CJSON::encode($results);
        Yii::app()->end();
    }

    public function actionGetPOInfo($id) {
        $result = PurchaseOrder::model()->findByPk($id);
        $this->renderPartial('_po_info', compact('result'));
        Yii::app()->end();
    }

    public function actionGetVendorInfo($id) {
        $result = Vendor::model()->findByPk($id);
        $this->renderPartial('_vendor_info', compact('result'));
        Yii::app()->end();
    }

    public function actionGetLinerInfo($id) {
        $result = Liner::model()->findByPk($id);
        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionDownloadFile($file) {
        $file = base64_decode($file);
        return Yii::app()->getRequest()->sendFile(basename($file), @file_get_contents(Yii::app()->getBasePath() . DS . '..' . $file));
    }

    public function actionGetPODetails() {
        if (isset($_POST['po_id'])) {
            $model = PurchaseOrder::model()->findByPk($_POST['po_id']);
            $this->renderPartial('_po_details', compact('model'));
        }
        Yii::app()->end();
    }

    public function actionGetInvoiceByBol($selected = '') {
        $bol = $_GET['id'];
        if (!empty($bol)) {
            $invoices = Invoice::model()->findAll("bol_no = '$bol'");
            $data = CHtml::listData($invoices, 'inv_no', 'inv_no');
            foreach ($data as $value => $name) {
                $htmlOpt = array();
                $htmlOpt['value'] = $value;
                if (!empty($selected) && $selected == $value)
                    $htmlOpt['selected'] = 'selected';
                echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
            }
        }
    }

    public function actionGetContainerByInvoice($selected = '') {
        $inv_id = $_GET['id'];
        if (!empty($inv_id)) {
            $data = array();
            $criteria = new CDbCriteria();
            $criteria->select = 'inv_det_ctnr_no';
            $criteria->group = 'inv_det_ctnr_no';
            $criteria->with = array('inv');
            $criteria->condition = "inv.inv_no = $inv_id";
            $cont_nos = InvoiceItems::model()->findAll($criteria);
            foreach ($cont_nos as $key => $cont_no) {
                $data[$cont_no->inv_det_ctnr_no] = $cont_no->inv_det_ctnr_no;
            }
            foreach ($data as $value => $name) {
                $htmlOpt = array();
                $htmlOpt['value'] = $value;
                if (!empty($selected) && $selected == $value)
                    $htmlOpt['selected'] = 'selected';

                echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
            }
        }
    }

    public function actionGetExpSubTypeByType($selected = '') {
        $exp_type_id = $_GET['id'];
        if (!empty($exp_type_id)) {
            $data = array();
            $sub_types = ExpenseSubtype::model()->findAllByAttributes(array('exp_type_id' => $exp_type_id));
            foreach ($sub_types as $key => $sub_type) {
                $data[$sub_type->exp_subtype_id] = $sub_type->exp_subtype_name;
            }
            echo "<option value=''>Select Sub Type</option>";
            foreach ($data as $value => $name) {
                $htmlOpt = array();
                $htmlOpt['value'] = $value;
                if (!empty($selected) && $selected == $value)
                    $htmlOpt['selected'] = 'selected';

                echo CHtml::tag('option', $htmlOpt, CHtml::encode($name), true);
            }
        }
    }

    public function actionReport($xml){
        $reportico = Yii::app()->getModule('reportico');
	$engine = $reportico->getReporticoEngine();
	$reportico->engine->initial_execute_mode = "PREPARE";
	$reportico->engine->initial_report = "$xml.xml";
	$reportico->engine->access_mode = "ONEREPORT";
	$reportico->engine->initial_project = "KRK";
	$reportico->engine->clear_reportico_session = true;
	$reportico->generate();

    }
    
    public function actionPoreport(){
        $this->render('poreport');
    }
}
