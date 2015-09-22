<?php

/**
 * This is the model class for table "{{expense}}".
 *
 * The followings are the available columns in table '{{expense}}':
 * @property integer $exp_id
 * @property integer $exp_type_id
 * @property integer $exp_subtype_id
 * @property string $exp_voucher
 * @property string $exp_pay_mode
 * @property string $exp_ref_no
 * @property string $exp_bank_name
 * @property string $exp_transaction_id
 * @property string $exp_remarks
 * @property string $exp_paid_amount
 * @property integer $exp_bol_no
 * @property string $exp_invoices
 * @property string $exp_containers
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property ExpenseSubtype $expSubtype
 * @property ExpenseType $expType
 */
class Expense extends RActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{expense}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exp_type_id, exp_subtype_id, exp_voucher, exp_bol_no, exp_invoices, exp_containers, exp_pay_mode, exp_ref_no, exp_bank_name, exp_transaction_id, exp_paid_amount', 'required'),
            array('exp_type_id, exp_subtype_id, exp_bol_no, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('exp_voucher, exp_pay_mode, exp_ref_no, exp_bank_name, exp_transaction_id', 'length', 'max' => 50),
            array('exp_paid_amount', 'numerical', 'integerOnly' => false, 'min' => 1),
            array('exp_invoices, exp_containers', 'length', 'max' => 500),
            array('status', 'length', 'max' => 1),
            array('exp_remarks, created_at, modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('exp_id, exp_type_id, exp_subtype_id, exp_voucher, exp_pay_mode, exp_ref_no, exp_bank_name, exp_transaction_id, exp_remarks, exp_paid_amount, exp_bol_no, exp_invoices, exp_containers, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'expSubtype' => array(self::BELONGS_TO, 'ExpenseSubtype', 'exp_subtype_id'),
            'expType' => array(self::BELONGS_TO, 'ExpenseType', 'exp_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'exp_id' => 'Exp',
            'exp_type_id' => 'Expense Type',
            'exp_subtype_id' => 'Expense Sub Type',
            'exp_voucher' => 'Voucher No',
            'exp_pay_mode' => 'Mode of Payment',
            'exp_ref_no' => 'Reference No',
            'exp_bank_name' => 'Bank Name',
            'exp_transaction_id' => 'Transaction ID',
            'exp_remarks' => 'Remarks',
            'exp_paid_amount' => 'Amount Paid',
            'exp_bol_no' => 'BOL No',
            'exp_invoices' => 'Invoice Numbers',
            'exp_containers' => 'Container Numbers',
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

        $criteria->compare('exp_id', $this->exp_id);
        $criteria->compare('exp_type_id', $this->exp_type_id);
        $criteria->compare('exp_subtype_id', $this->exp_subtype_id);
        $criteria->compare('exp_voucher', $this->exp_voucher, true);
        $criteria->compare('exp_pay_mode', $this->exp_pay_mode, true);
        $criteria->compare('exp_ref_no', $this->exp_ref_no, true);
        $criteria->compare('exp_bank_name', $this->exp_bank_name, true);
        $criteria->compare('exp_transaction_id', $this->exp_transaction_id, true);
        $criteria->compare('exp_remarks', $this->exp_remarks, true);
        $criteria->compare('exp_paid_amount', $this->exp_paid_amount, true);
        $criteria->compare('exp_bol_no', $this->exp_bol_no);
        $criteria->compare('exp_invoices', $this->exp_invoices, true);
        $criteria->compare('exp_containers', $this->exp_containers, true);
        $criteria->compare('status', $this->status, true);
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
     * @return Expense the static model class
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
        if ($this->exp_invoices)
            $this->exp_invoices = CJSON::encode($this->exp_invoices);
        if ($this->exp_containers)
            $this->exp_containers = CJSON::encode($this->exp_containers);
        return parent::beforeValidate();
    }

    protected function beforeSave() {
        if ($this->exp_invoices && is_array($this->exp_invoices))
            $this->exp_invoices = CJSON::encode($this->exp_invoices);
        if ($this->exp_containers && is_array($this->exp_containers))
            $this->exp_containers = CJSON::encode($this->exp_containers);
        return parent::beforeSave();
    }
    
    protected function afterFind() {
        if ($this->exp_invoices)
            $this->exp_invoices = CJSON::decode($this->exp_invoices);
        if ($this->exp_containers)
            $this->exp_containers = CJSON::decode($this->exp_containers);

        return parent::afterFind();
    }
}
