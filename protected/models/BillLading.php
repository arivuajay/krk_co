<?php

/**
 * This is the model class for table "{{bill_lading}}".
 *
 * The followings are the available columns in table '{{bill_lading}}':
 * @property integer $bl_id
 * @property integer $bl_company_id
 * @property integer $bl_vendor_id
 * @property integer $bl_po_id
 * @property integer $bl_invoice_id
 * @property string $bl_number
 * @property string $bl_issue_date
 * @property string $bl_issue_place
 * @property string $bl_load_port
 * @property string $bl_discharge_port
 * @property string $bl_vessal_name
 * @property string $bl_shipped_date
 * @property string $bl_container_number
 * @property integer $bl_liner_id
 * @property integer $bl_container_count
 * @property integer $bl_free_days
 * @property string $bl_frieght_paid
 * @property string $bl_documents
 * @property string $status
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Company $blCompany
 * @property Invoice $blInvoice
 * @property Liner $blLiner
 * @property PurchaseOrder $blPo
 * @property Vendor $blVendor
 */
class BillLading extends CActiveRecord {

    const FILE_SIZE = 5;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{bill_lading}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bl_company_id, bl_vendor_id, bl_po_id, bl_invoice_id, bl_number', 'required'),
            array('bl_company_id, bl_vendor_id, bl_po_id, bl_invoice_id, bl_liner_id, bl_container_count, bl_free_days, modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('bl_number, bl_issue_place, bl_load_port, bl_discharge_port, bl_vessal_name, bl_container_number', 'length', 'max' => 100),
            array('bl_frieght_paid, status', 'length', 'max' => 1),
            array('bl_documents', 'file', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * self::FILE_SIZE, 'tooLarge' => 'File should be smaller than ' . self::FILE_SIZE . 'MB'),
            array('bl_issue_date, bl_shipped_date, bl_documents, created_at, created_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('bl_id, bl_company_id, bl_vendor_id, bl_po_id, bl_invoice_id, bl_number, bl_issue_date, bl_issue_place, bl_load_port, bl_discharge_port, bl_vessal_name, bl_shipped_date, bl_container_number, bl_liner_id, bl_container_count, bl_free_days, bl_frieght_paid, bl_documents, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'blCompany' => array(self::BELONGS_TO, 'Company', 'bl_company_id'),
            'blInvoice' => array(self::BELONGS_TO, 'Invoice', 'bl_invoice_id'),
            'blLiner' => array(self::BELONGS_TO, 'Liner', 'bl_liner_id'),
            'blPo' => array(self::BELONGS_TO, 'PurchaseOrder', 'bl_po_id'),
            'blVendor' => array(self::BELONGS_TO, 'Vendor', 'bl_vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'bl_id' => 'Bl',
            'bl_company_id' => 'Company',
            'bl_vendor_id' => 'Vendor',
            'bl_po_id' => 'PO Number',
            'bl_invoice_id' => 'Invoice No',
            'bl_number' => 'Bill of Lading No',
            'bl_issue_date' => 'Date of BL Issued',
            'bl_issue_place' => 'Place of BL Issued',
            'bl_load_port' => 'Port of Loading',
            'bl_discharge_port' => 'Port of Discharge',
            'bl_vessal_name' => 'Vessal Name',
            'bl_shipped_date' => 'Shipped On',
            'bl_container_number' => 'Container No',
            'bl_liner_id' => 'Liner',
            'bl_container_count' => 'No of CTN',
            'bl_free_days' => 'No of Free Days',
            'bl_frieght_paid' => 'Is Frieght Paid',
            'bl_documents' => 'Upload BL',
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

        $criteria->compare('bl_id', $this->bl_id);
        $criteria->compare('bl_company_id', $this->bl_company_id);
        $criteria->compare('bl_vendor_id', $this->bl_vendor_id);
        $criteria->compare('bl_po_id', $this->bl_po_id);
        $criteria->compare('bl_invoice_id', $this->bl_invoice_id);
        $criteria->compare('bl_number', $this->bl_number, true);
        $criteria->compare('bl_issue_date', $this->bl_issue_date, true);
        $criteria->compare('bl_issue_place', $this->bl_issue_place, true);
        $criteria->compare('bl_load_port', $this->bl_load_port, true);
        $criteria->compare('bl_discharge_port', $this->bl_discharge_port, true);
        $criteria->compare('bl_vessal_name', $this->bl_vessal_name, true);
        $criteria->compare('bl_shipped_date', $this->bl_shipped_date, true);
        $criteria->compare('bl_container_number', $this->bl_container_number, true);
        $criteria->compare('bl_liner_id', $this->bl_liner_id);
        $criteria->compare('bl_container_count', $this->bl_container_count);
        $criteria->compare('bl_free_days', $this->bl_free_days);
        $criteria->compare('bl_frieght_paid', $this->bl_frieght_paid, true);
        $criteria->compare('bl_documents', $this->bl_documents, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified_at', $this->modified_at);
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
     * @return BillLading the static model class
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

}
