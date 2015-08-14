<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 * @property integer $invoice_id
 * @property integer $vendor_id
 * @property integer $company_id
 * @property integer $po_id
 * @property string $permit_no
 * @property string $bol_no
 * @property string $inv_no
 * @property string $vessel_name
 * @property string $inv_date
 * @property string $inv_file
 * @property string $pkg_list_file
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property PurchaseOrder $po
 * @property Vendor $vendor
 * @property InvoiceItems[] $invoiceItems
 */
class Invoice extends CActiveRecord {

    const FILE_SIZE = 10;

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => "$alias.status = '1'"),
        );
    }

    public function behaviors() {
        return array(
            'NUploadFile' => array(
                'class' => 'ext.nuploadfile.NUploadFile',
                'fileField' => array('inv_file', 'pkg_list_file'),
            )
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{invoice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vendor_id, company_id, po_id, permit_no, bol_no, inv_no, created_at, created_by', 'required'),
            array('vendor_id, company_id, po_id, status, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('permit_no, bol_no, inv_no, vessel_name', 'length', 'max' => 100),
            array('inv_file, pkg_list_file', 'file', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * self::FILE_SIZE, 'tooLarge' => 'File should be smaller than ' . self::FILE_SIZE . 'MB'),
            array('inv_date, modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('invoice_id, vendor_id, company_id, po_id, permit_no, bol_no, inv_no, vessel_name, inv_date, inv_file, pkg_list_file, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'po' => array(self::BELONGS_TO, 'PurchaseOrder', 'po_id'),
            'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
            'invoiceItems' => array(self::HAS_MANY, 'InvoiceItems', 'inv_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'invoice_id' => 'Invoice',
            'vendor_id' => 'Vendor',
            'company_id' => 'Company',
            'po_id' => 'PO Number',
            'permit_no' => 'Permit No',
            'bol_no' => 'Bill of Lading No',
            'inv_no' => 'Invoice No',
            'vessel_name' => 'Vessel Name',
            'inv_date' => 'Invoice Date',
            'inv_file' => 'Upload Invoice',
            'pkg_list_file' => 'Upload Packing List',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('vendor_id', $this->vendor_id);
        $criteria->compare('company_id', $this->company_id);
        $criteria->compare('po_id', $this->po_id);
        $criteria->compare('permit_no', $this->permit_no, true);
        $criteria->compare('bol_no', $this->bol_no, true);
        $criteria->compare('inv_no', $this->inv_no, true);
        $criteria->compare('vessel_name', $this->vessel_name, true);
        $criteria->compare('inv_date', $this->inv_date, true);
        $criteria->compare('inv_file', $this->inv_file, true);
        $criteria->compare('pkg_list_file', $this->pkg_list_file, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('modified_at', $this->modified_at, true);
        $criteria->compare('modified_by', $this->modified_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => PAGE_SIZE,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invoice the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function dataProvider() {
        return new CActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => PAGE_SIZE,
            )
        ));
    }

    protected function beforeValidate() {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
            $this->created_by = Yii::app()->user->id;
        } else {
            $this->modified_at = new CDbExpression('NOW()');
            $this->modified_by = Yii::app()->user->id;
        }
        $this->inv_date = date('Y-m-d', strtotime($this->inv_date));

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->inv_date = date(PHP_USER_DATE_FORMAT, strtotime($this->inv_date));

        return parent::afterFind();
    }

}
