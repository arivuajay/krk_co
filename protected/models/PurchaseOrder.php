<?php

/**
 * This is the model class for table "{{purchase_order}}".
 *
 * The followings are the available columns in table '{{purchase_order}}':
 * @property integer $po_id
 * @property string $po_date
 * @property integer $po_company_id
 * @property integer $po_vendor_id
 * @property integer $po_liner_id
 * @property string $status
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Vendor $poVendor
 * @property Company $poCompany
 * @property Liner $poLiner
 * @property PurchaseOrderDetails[] $purchaseOrderDetails
 */
class PurchaseOrder extends CActiveRecord {

    public function getPurchase_order_code($id = null) {
        if ($this->po_id)
            return "PO" . str_pad($this->po_id, 13, 0, STR_PAD_LEFT);
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => "$alias.status = '1'"),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{purchase_order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('po_date,po_company_id,po_vendor_id', 'required'),
            array('po_company_id, po_vendor_id,po_liner_id, modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('created_at, created_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('po_id,  po_date, po_company_id, po_vendor_id, po_liner_id,status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'poVendor' => array(self::BELONGS_TO, 'Vendor', 'po_vendor_id'),
            'poCompany' => array(self::BELONGS_TO, 'Company', 'po_company_id'),
            'poLiner' => array(self::BELONGS_TO, 'Liner', 'po_liner_id'),
            'purchaseOrderDetails' => array(self::HAS_MANY, 'PurchaseOrderDetails', 'po_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'po_id' => 'Po',
            'purchase_order_code' => 'PO Number',
            'po_date' => 'PO Date',
            'po_company_id' => 'Company',
            'po_vendor_id' => 'Vendor',
            'po_liner_id' => 'Prefered Liner',
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

        $criteria->compare('po_id', $this->po_id);
        $criteria->compare('po_date', $this->po_date, true);
        $criteria->compare('po_company_id', $this->po_company_id);
        $criteria->compare('po_vendor_id', $this->po_vendor_id);
        $criteria->compare('po_liner_id', $this->po_liner_id);
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
     * @return PurchaseOrder the static model class
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
        $this->po_date = date('Y-m-d', strtotime($this->po_date));

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->po_date = date(PHP_USER_DATE_FORMAT, strtotime($this->po_date));

        return parent::afterFind();
    }

}
