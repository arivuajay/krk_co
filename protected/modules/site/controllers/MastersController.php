<?php

class MastersController extends Controller {

    public function behaviors() {
        return array(
            'exportableGrid' => array(
                'class' => 'application.components.ExportableGridBehavior',
                'filename' => "Master_" . time() . ".csv",
//                'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
        ));
    }
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index',
                    'company_save',
                    'permit_save',
                    'family_save',
                    'product_save',
                    'variety_save',
                    'size_save',
                    'grade_save',
                    'vendor_save',
                    'liner_save',
                    'company_delete',
                    'permit_delete',
                    'family_delete',
                    'product_delete',
                    'variety_delete',
                    'size_delete',
                    'grade_delete',
                    'vendor_delete',
                    'liner_delete',
                    'vendor_view',
                    'terms',
                ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex($tab = null) {
        $comp_model = new Company();
        $perm_model = new Permit();
        $pro_family_model = new ProductFamily();
        $product_model = new Product();
        $variety_model = new ProductVariety();
        $size_model = new ProductSize();
        $grade_model = new ProductGrade();
        $vendor_model = new Vendor();
        $liner_model = new Liner();

        if ($this->isExportRequest()) {
            $vendor_model->unsetAttributes();
            $this->exportCSV(array('Vendors:'), null, false);
            $this->exportCSV($vendor_model->search(), array('vendor_code', 'vendortype', 'vendor_name', 'vendor_address', 'vendor_city', 'vendor_country', 'vendor_contact_person', 'vendor_mobile_no', 'vendor_office_no', 'vendor_email', 'vendor_website', 'vendor_trade_mark', 'vendor_remarks'));
        }
        
        $this->render('index', compact('tab', 'comp_model', 'perm_model', 'pro_family_model', 'product_model', 'variety_model', 'size_model', 'grade_model', 'vendor_model', 'liner_model'));
        
    }

    public function actionCompany_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $comp_model = new Company;
            $new = true;
        } else {
            $comp_model = $this->loadCompanyModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performCompanyAjaxValidation($comp_model);

        if (isset($_POST['Company'])) {
            $comp_model->attributes = $_POST['Company'];
            if ($comp_model->save()) {
                $note = ($new) ? "Created Company successfully." : "Updated Company successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index'));
            }
        }

        echo $this->renderPartial('_company_form', compact('comp_model'), true, true);
        Yii::app()->end();
    }

    public function actionCompany_delete($id) {
        try {
            $model = $this->loadCompanyModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Company successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Company Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadCompanyModel($id) {
        $model = Company::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performCompanyAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPermit_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $perm_model = new Permit;
            $new = true;
        } else {
            $perm_model = $this->loadPermitModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performPermitAjaxValidation($perm_model);

        if (isset($_POST['Permit'])) {
            $perm_model->attributes = $_POST['Permit'];
            if ($perm_model->validate()) {
                $perm_model->setUploadDirectory(UPLOAD_DIR);
                $perm_model->uploadFile();
                $perm_model->save(false);
                $note = ($new) ? "Created Permit successfully." : "Updated Permit successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'permit'));
            }
        }

        $cs = Yii::app()->clientScript;
        $cs->reset();
        $cs->scriptMap = array(
            'bootstrap-datepicker.js' => false,
        );

        echo $this->renderPartial('_permit_form', compact('perm_model'), true, true);
        Yii::app()->end();
    }

    public function actionPermit_delete($id) {
        try {
            $model = $this->loadPermitModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Permit successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Permit Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadPermitModel($id) {
        $model = Permit::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performPermitAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permit-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFamily_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $pro_family_model = new ProductFamily;
            $new = true;
        } else {
            $pro_family_model = $this->loadFamilyModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performFamilyAjaxValidation($pro_family_model);

        if (isset($_POST['ProductFamily'])) {
            $pro_family_model->attributes = $_POST['ProductFamily'];
            if ($pro_family_model->save()) {
                $note = ($new) ? "Created Product Family successfully." : "Updated Product Family successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'pro_family'));
            }
        }

        echo $this->renderPartial('_product_family_form', compact('pro_family_model'), true, true);
        Yii::app()->end();
    }

    public function actionFamily_delete($id) {
        try {
            $model = $this->loadFamilyModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Product Family successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Product Family Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadFamilyModel($id) {
        $model = ProductFamily::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performFamilyAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'family-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionProduct_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $product_model = new Product;
            $new = true;
        } else {
            $product_model = $this->loadProductModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performProductAjaxValidation($product_model);

        if (isset($_POST['Product'])) {
            $product_model->attributes = $_POST['Product'];
            if ($product_model->save()) {
                $note = ($new) ? "Created Product Family successfully." : "Updated Product Family successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'product'));
            }
        }

        echo $this->renderPartial('_product_form', compact('product_model'), true, true);
        Yii::app()->end();
    }

    public function actionProduct_delete($id) {
        try {
            $model = $this->loadProductModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Product successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Product Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadProductModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performProductAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'family-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionVariety_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $variety_model = new ProductVariety;
            $new = true;
        } else {
            $variety_model = $this->loadVarietyModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performVarietyAjaxValidation($variety_model);

        if (isset($_POST['ProductVariety'])) {
            $variety_model->attributes = $_POST['ProductVariety'];
            if ($variety_model->save()) {
                $note = ($new) ? "Created Product Variety Family successfully." : "Updated Product Variety Family successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'variety'));
            }
        }

        echo $this->renderPartial('_product_form', compact('variety_model'), true, true);
        Yii::app()->end();
    }

    public function actionVariety_delete($id) {
        try {
            $model = $this->loadVarietyModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Product Variety successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Product Variety Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadVarietyModel($id) {
        $model = ProductVariety::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performVarietyAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-variety-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSize_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $size_model = new ProductSize;
            $new = true;
        } else {
            $size_model = $this->loadSizeModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performSizeAjaxValidation($size_model);

        if (isset($_POST['ProductSize'])) {
            $size_model->attributes = $_POST['ProductSize'];
            if ($size_model->save()) {
                $note = ($new) ? "Created Product Size Family successfully." : "Updated Product Size Family successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'size'));
            }
        }

        echo $this->renderPartial('_size_form', compact('size_model'), true, true);
        Yii::app()->end();
    }

    public function actionSize_delete($id) {
        try {
            $model = $this->loadSizeModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Product Size successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Product Size Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadSizeModel($id) {
        $model = ProductSize::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performSizeAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-size-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGrade_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $grade_model = new ProductGrade;
            $new = true;
        } else {
            $grade_model = $this->loadGradeModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performGradeAjaxValidation($grade_model);

        if (isset($_POST['ProductGrade'])) {
            $grade_model->attributes = $_POST['ProductGrade'];
            if ($grade_model->save()) {
                $note = ($new) ? "Created Product Grade Family successfully." : "Updated Product Grade Family successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index', 'tab' => 'grade'));
            }
        }
        echo $this->renderPartial('_grade_form', compact('grade_model'), true, true);
        Yii::app()->end();
    }

    public function actionGrade_delete($id) {
        try {
            $model = $this->loadGradeModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Product Grade successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Product Grade Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadGradeModel($id) {
        $model = ProductGrade::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performGradeAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-grade-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionVendor_view($id) {
        $model = Vendor::model()->findByPk($id);

        $export = isset($_REQUEST['export']) && $_REQUEST['export'] == 'PDF';
        $compact = compact('model', 'export');
        if ($export) {
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $stylesheet = $this->pdfStyles();
            $mPDF1->WriteHTML($stylesheet, 1);
            $mPDF1->WriteHTML($this->renderPartial('view', $compact, true));
            $mPDF1->Output("Liner_view_{$id}.pdf", EYiiPdf::OUTPUT_TO_DOWNLOAD);
        } else {
            $this->render('vendor_view', $compact);
        }
    }

//    ========================================================================

    public function actionVendor_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $vendor_model = new Vendor;
            $new = true;
        } else {
            $vendor_model = $this->loadVendorModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performVendorAjaxValidation($vendor_model);

        if (isset($_POST['Vendor'])) {
            $vendor_model->attributes = $_POST['Vendor'];
            if ($vendor_model->validate()) {
                $vendor_model->save(false);
                $note = ($new) ? "Created Vendor successfully." : "Updated Vendor successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index'));
            }
        }

        echo $this->renderPartial('_vendor_form', compact('vendor_model'), true, true);
        Yii::app()->end();
    }

    public function actionVendor_delete($id) {
        try {
            $model = $this->loadVendorModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Vendor successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Vendor Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadVendorModel($id) {
        $model = Vendor::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performVendorAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vendor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLiner_save($id = null) {
        $new = false;
        if (is_null($id)) {
            $liner_model = new Liner;
            $new = true;
        } else {
            $liner_model = $this->loadLinerModel($id);
        }

        // Uncomment the following line if AJAX validation is needed
        $this->performLinerAjaxValidation($liner_model);

        if (isset($_POST['Liner'])) {
            $liner_model->attributes = $_POST['Liner'];
            if ($liner_model->save()) {
                $note = ($new) ? "Created Liner successfully." : "Updated Liner successfully.";
                Myclass::addAuditTrail($note, "user");
                Yii::app()->user->setFlash('success', $note);
                $this->redirect(array('index'));
            }
        }

        echo $this->renderPartial('_liner_form', compact('liner_model'), true, true);
        Yii::app()->end();
    }

    public function actionLiner_delete($id) {
        try {
            $model = $this->loadLinerModel($id);
            $model->delete();
            Myclass::addAuditTrail("Deleted Liner successfully.", "user");
        } catch (CDbException $e) {
            throw new CHttpException(404, $e->getMessage());
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            Yii::app()->user->setFlash('success', 'Liner Deleted Successfully!!!');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadLinerModel($id) {
        $model = Liner::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Company $model the model to be validated
     */
    protected function performLinerAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'liner-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionTerms() {
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $vendor = Vendor::model()->findByPk($_GET['id']);
            $this->renderPartial('_terms', compact('vendor'));
        }else{
            Yii::app()->end();
        }
    }
}
