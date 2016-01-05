<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property integer $pay_id
 * @property integer $vendor_id
 * @property string $pay_type
 * @property integer $po_id
 * @property integer $invoice_id
 * @property string $invoice_amount
 * @property string $pay_amount
 * @property string $pay_deal_id
 * @property string $pay_inr_rate
 * @property string $pay_date
 * @property string $pay_inr_amount
 * @property string $pay_mode
 * @property string $pay_ref_info
 * @property string $pay_transaction_id
 * @property string $pay_transaction_date
 * @property string $pay_bank_name
 * @property string $pay_remarks
 * @property string $pay_shift_advise
 * @property string $pay_debit_advise
 * @property string $pay_other_doc
 * @property string $pay_deal_id_copy
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 * @property PurchaseOrder $po
 * @property Vendor $vendor
 */
class Payment extends RActiveRecord {

    public $page_size = true;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{payment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vendor_id, pay_type, po_id, invoice_id, pay_amount, pay_deal_id, pay_inr_rate, pay_date, pay_mode', 'required'),
            array('vendor_id, po_id, invoice_id, modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('pay_type', 'length', 'max' => 25),
            array('invoice_amount, pay_amount, pay_inr_rate', 'length', 'max' => 10),
            array('pay_deal_id, pay_ref_info', 'length', 'max' => 100),
            array('pay_mode, pay_transaction_id, pay_bank_name', 'length', 'max' => 50),
            array('invoice_currency', 'length', 'max' => 30),
            array('pay_shift_advise, pay_debit_advise, pay_other_doc, pay_deal_id_copy', 'length', 'max' => 255),
            array('pay_amount, pay_inr_rate', 'numerical', 'integerOnly' => false),
            array('pay_amount','compare','compareAttribute'=>'invoice_amount','operator'=>'<=','message'=>'Paid Amount must be less than Invoice Amount'),
            array('pay_remarks, created_at, created_by, invoice_currency, pay_transaction_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pay_id, vendor_id, pay_type, po_id, invoice_id, invoice_amount, pay_amount, pay_deal_id, pay_inr_rate, pay_date, pay_inr_amount, pay_mode, pay_ref_info, pay_transaction_id, pay_bank_name, pay_remarks, pay_shift_advise, pay_debit_advise, pay_other_doc, pay_deal_id_copy, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
            'po' => array(self::BELONGS_TO, 'PurchaseOrder', 'po_id'),
            'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pay_id' => 'Pay',
            'vendor_id' => 'Vendor Name',
            'pay_type' => 'Payment Type',
            'po_id' => 'PO Number',
            'invoice_id' => 'Invoice Number',
            'invoice_amount' => 'Total Invoice Amount',
            'pay_amount' => 'Payment Amount',
            'pay_deal_id' => 'Deal ID No',
            'pay_inr_rate' => 'INR Rate',
            'pay_date' => 'Payment Date',
            'pay_inr_amount' => 'Amount in INR',
            'pay_mode' => 'Mode of Payment',
            'pay_ref_info' => 'Reference Info',
            'pay_transaction_id' => 'Transaction ID',
            'pay_bank_name' => 'Bank Name',
            'pay_remarks' => 'Remarks',
            'pay_shift_advise' => 'Shift Advise',
            'pay_debit_advise' => 'Debit Advise',
            'pay_other_doc' => 'Other Relevant Document',
            'pay_deal_id_copy' => 'Deal ID Copy',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
            'vendorname' => 'Vendor Name', 
            'paymenttype' => 'Payment Type', 
            'ponumber' => 'PO Number', 
            'invoicenumber'=> 'Invoice Number',
            'pay_transaction_date'=> 'Transaction Date'
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
//    public function search() {
//        // @todo Please modify the following code to remove attributes that should not be searched.
//
//        $criteria = new CDbCriteria;
//
//        $criteria->compare('pay_id', $this->pay_id);
//        $criteria->compare('vendor_id', $this->vendor_id);
//        $criteria->compare('pay_type', $this->pay_type, true);
//        $criteria->compare('po_id', $this->po_id);
//        $criteria->compare('invoice_id', $this->invoice_id);
//        $criteria->compare('invoice_amount', $this->invoice_amount, true);
//        $criteria->compare('pay_amount', $this->pay_amount, true);
//        $criteria->compare('pay_deal_id', $this->pay_deal_id, true);
//        $criteria->compare('pay_inr_rate', $this->pay_inr_rate, true);
//        $criteria->compare('pay_date', $this->pay_date, true);
//        $criteria->compare('pay_inr_amount', $this->pay_inr_amount, true);
//        $criteria->compare('pay_mode', $this->pay_mode, true);
//        $criteria->compare('pay_ref_info', $this->pay_ref_info, true);
//        $criteria->compare('pay_transaction_id', $this->pay_transaction_id, true);
//        $criteria->compare('pay_bank_name', $this->pay_bank_name, true);
//        $criteria->compare('pay_remarks', $this->pay_remarks, true);
//        $criteria->compare('pay_shift_advise', $this->pay_shift_advise, true);
//        $criteria->compare('pay_debit_advise', $this->pay_debit_advise, true);
//        $criteria->compare('pay_other_doc', $this->pay_other_doc, true);
//        $criteria->compare('pay_deal_id_copy', $this->pay_deal_id_copy, true);
//        $criteria->compare('created_at', $this->created_at, true);
//        $criteria->compare('created_by', $this->created_by, true);
//        $criteria->compare('modified_at', $this->modified_at);
//        $criteria->compare('modified_by', $this->modified_by);
//
//        return new CActiveDataProvider($this, array(
//            'criteria' => $criteria,
//            'pagination' => array(
//                'pageSize' => PAGE_SIZE,
//            )
//        ));
//    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Payment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function dataProvider() {
        $criteria = new CDbCriteria;

        $criteria->with = array('invoice');
        $criteria->compare('pay_id', $this->pay_id);
        $criteria->compare('t.vendor_id', $this->vendor_id);
        $criteria->compare('pay_type', $this->pay_type, true);
        $criteria->compare('po_id', $this->po_id);
        $criteria->compare('invoice.inv_no', $this->invoice_id, true);
//        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('invoice_amount', $this->invoice_amount, true);
        $criteria->compare('pay_amount', $this->pay_amount, true);
        $criteria->compare('pay_deal_id', $this->pay_deal_id, true);
        $criteria->compare('pay_inr_rate', $this->pay_inr_rate, true);
        $criteria->compare('pay_date', $this->pay_date, true);
        $criteria->compare('pay_inr_amount', $this->pay_inr_amount, true);
        $criteria->compare('pay_mode', $this->pay_mode, true);
        $criteria->compare('pay_ref_info', $this->pay_ref_info, true);
        $criteria->compare('pay_transaction_id', $this->pay_transaction_id, true);
        $criteria->compare('pay_bank_name', $this->pay_bank_name, true);
        $criteria->compare('pay_remarks', $this->pay_remarks, true);
        $criteria->compare('pay_shift_advise', $this->pay_shift_advise, true);
        $criteria->compare('pay_debit_advise', $this->pay_debit_advise, true);
        $criteria->compare('pay_other_doc', $this->pay_other_doc, true);
        $criteria->compare('pay_deal_id_copy', $this->pay_deal_id_copy, true);
        $criteria->compare('t.created_at', $this->created_at, true);
        $criteria->compare('t.created_by', $this->created_by, true);
        $criteria->compare('t.modified_at', $this->modified_at);
        $criteria->compare('t.modified_by', $this->modified_by);

        if($this->page_size)
            $pagination = array('pageSize' => PAGE_SIZE);
        else
            $pagination = false;
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => $pagination
        ));
    }

    public static function PaymentTypelist($key = NULL) {
        $list = array(
            'Advance' => 'Advance',
            'DP' => 'DP',
            'DA' => 'DA',
        );
        if($key != NULL)
            return $list[$key];
        return $list;
    }
    
    public function behaviors() {
        return array(
            'NUploadFile' => array(
                'class' => 'ext.nuploadfile.NUploadFile',
                'fileField' => array('pay_shift_advise', 'pay_debit_advise', 'pay_other_doc', 'pay_deal_id_copy'),
            )
        );
    }
    
    protected function beforeSave() {
        $this->pay_date = date('Y-m-d', strtotime($this->pay_date));
        $this->pay_transaction_date = date('Y-m-d', strtotime($this->pay_transaction_date));
        return parent::beforeSave();
    }
    
    protected function afterFind() {
        $this->pay_date = date(PHP_USER_DATE_FORMAT, strtotime($this->pay_date));
        $this->pay_transaction_date = date(PHP_USER_DATE_FORMAT, strtotime($this->pay_transaction_date));
        return parent::afterFind();
    }
    
    public function getVendorname() {
        return $this->vendor->vendor_name;
    }
    
    public function getPaymenttype() {
        return self::PaymentTypelist($this->pay_type);
    }
    
    public function getPonumber() {
        return $this->po->purchase_order_code;
    }
    
    public function getInvoicenumber() {
        return $this->invoice->inv_no;
    }
}
