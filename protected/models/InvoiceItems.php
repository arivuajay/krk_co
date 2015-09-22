<?php

/**
 * This is the model class for table "{{invoice_items}}".
 *
 * The followings are the available columns in table '{{invoice_items}}':
 * @property integer $inv_det_id
 * @property integer $inv_id
 * @property integer $inv_det_prod_fmly_id
 * @property integer $inv_det_product_id
 * @property integer $inv_det_variety_id
 * @property integer $inv_det_grade
 * @property integer $inv_det_size
 * @property string $inv_det_cotton_qty
 * @property string $inv_det_currency
 * @property string $inv_det_price
 * @property string $inv_det_net_weight
 * @property string $inv_det_gross_weight
 * @property string $inv_det_ctnr_no
 * @property string $is_delivered
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Invoice $inv
 * @property ProductSize $invDetSize
 * @property ProductGrade $invDetGrade
 * @property Product $invDetProduct
 * @property ProductVariety $invDetVariety
 * @property ProductFamily $invDetProdFmly
 */
class InvoiceItems extends RActiveRecord {

    public $CntrQty;
//    public $invoiceamount;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{invoice_items}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('inv_det_prod_fmly_id, inv_det_product_id, inv_det_variety_id, inv_det_grade, inv_det_size', 'required', 'on' => 'add_product,save'),
            array('inv_id', 'required', 'on' => 'save'),
            array('inv_id, inv_det_prod_fmly_id, inv_det_product_id, inv_det_variety_id,inv_det_grade, inv_det_size, modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('inv_det_grade, inv_det_size', 'length', 'max' => 500),
            array('inv_det_cotton_qty, inv_det_price, inv_det_net_weight, inv_det_gross_weight', 'length', 'max' => 10),
            array('inv_det_currency, inv_det_ctnr_no', 'length', 'max' => 100),
            array('is_delivered, status', 'length', 'max' => 1),
            array('inv_det_currency,created_at, created_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('inv_det_id, inv_id, inv_det_prod_fmly_id, inv_det_product_id, inv_det_variety_id, inv_det_grade, inv_det_size, inv_det_cotton_qty, inv_det_currency, inv_det_price, inv_det_net_weight, inv_det_gross_weight, inv_det_ctnr_no, is_delivered, created_at, created_by, modified_at, modified_by, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'inv' => array(self::BELONGS_TO, 'Invoice', 'inv_id'),
            'invDetProduct' => array(self::BELONGS_TO, 'Product', 'inv_det_product_id'),
            'invDetVariety' => array(self::BELONGS_TO, 'ProductVariety', 'inv_det_variety_id'),
            'invDetProdFmly' => array(self::BELONGS_TO, 'ProductFamily', 'inv_det_prod_fmly_id'),
            'invDetSize' => array(self::BELONGS_TO, 'ProductSize', 'inv_det_size'),
            'invDetGrade' => array(self::BELONGS_TO, 'ProductGrade', 'inv_det_grade'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'inv_det_id' => 'Inv Det',
            'inv_id' => 'Inv',
            'inv_det_prod_fmly_id' => 'Product Family',
            'inv_det_product_id' => 'Product',
            'inv_det_variety_id' => 'Variety',
            'inv_det_grade' => 'Grade',
            'inv_det_size' => 'Size',
            'inv_det_cotton_qty' => 'Invoiced Qty in CTN',
            'inv_det_currency' => 'Currency Type',
            'inv_det_price' => 'Invoiced Price/CTN',
            'inv_det_net_weight' => 'Net Weight(kg)',
            'inv_det_gross_weight' => 'Gross Weight(kg)',
            'inv_det_ctnr_no' => 'Container No',
            'is_delivered' => 'Is Delivered',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
            'status' => 'Status',
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

        $criteria->compare('inv_det_id', $this->inv_det_id);
        $criteria->compare('inv_id', $this->inv_id);
        $criteria->compare('inv_det_prod_fmly_id', $this->inv_det_prod_fmly_id);
        $criteria->compare('inv_det_product_id', $this->inv_det_product_id);
        $criteria->compare('inv_det_variety_id', $this->inv_det_variety_id);
        $criteria->compare('inv_det_grade', $this->inv_det_grade, true);
        $criteria->compare('inv_det_size', $this->inv_det_size, true);
        $criteria->compare('inv_det_cotton_qty', $this->inv_det_cotton_qty, true);
        $criteria->compare('inv_det_currency', $this->inv_det_currency, true);
        $criteria->compare('inv_det_price', $this->inv_det_price, true);
        $criteria->compare('inv_det_net_weight', $this->inv_det_net_weight, true);
        $criteria->compare('inv_det_gross_weight', $this->inv_det_gross_weight, true);
        $criteria->compare('inv_det_ctnr_no', $this->inv_det_ctnr_no, true);
        $criteria->compare('is_delivered', $this->is_delivered, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified_at', $this->modified_at);
        $criteria->compare('modified_by', $this->modified_by);
        $criteria->compare('status', $this->status, true);

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
     * @return InvoiceItems the static model class
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

    public function getInvoiceAmount() {
        return $this->inv_det_cotton_qty * $this->inv_det_price;
    }
}
