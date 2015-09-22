<?php

/**
 * This is the model class for table "{{purchase_order_details}}".
 *
 * The followings are the available columns in table '{{purchase_order_details}}':
 * @property integer $po_det_id
 * @property integer $po_id
 * @property integer $po_det_prod_fmly_id
 * @property integer $po_det_product_id
 * @property integer $po_det_variety_id
 * @property string $po_det_grade
 * @property string $po_det_size
 * @property string $po_det_net_weight
 * @property string $po_det_container_qty
 * @property string $po_det_cotton_qty
 * @property string $po_det_currency
 * @property string $po_det_price
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 * @property string $status
 *
 * The followings are the available model relations:
 * @property PurchaseOrder $po
 * @property Product $poDetProduct
 * @property ProductVariety $poDetVariety
 * @property ProductFamily $poDetProdFmly
 */
class PurchaseOrderDetails extends RActiveRecord {

    public $page_size = true;
    public $f_from_date;
    public $f_to_date;
    public $f_purchase_order_code;
    public $f_po_vendor_id;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{purchase_order_details}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('po_det_prod_fmly_id, po_det_product_id, po_det_variety_id, po_det_grade, po_det_size', 'required', 'on' => 'add_product,save'),
            array('po_id', 'required', 'on' => 'save'),
//            array('po_id, po_det_prod_fmly_id, po_det_product_id, po_det_variety_id, po_det_grade, po_det_size', 'required'),
            array('po_id, po_det_prod_fmly_id, po_det_product_id, po_det_variety_id, modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('po_det_grade, po_det_size,po_det_currency', 'length', 'max' => 500),
            array('po_det_net_weight, po_det_container_qty, po_det_cotton_qty, po_det_price', 'numerical', 'integerOnly' => false),
            array('status', 'length', 'max' => 1),
            array('po_det_currency,created_at, created_by', 'safe'),
            array('f_from_date, f_to_date, f_purchase_order_code, f_po_vendor_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('po_det_id, po_id, po_det_prod_fmly_id, po_det_product_id, po_det_variety_id, po_det_grade, po_det_size, po_det_net_weight, po_det_container_qty, po_det_cotton_qty, po_det_currency, po_det_price, created_at, created_by, modified_at, modified_by, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'po' => array(self::BELONGS_TO, 'PurchaseOrder', 'po_id'),
            'poDetProduct' => array(self::BELONGS_TO, 'Product', 'po_det_product_id'),
            'poDetVariety' => array(self::BELONGS_TO, 'ProductVariety', 'po_det_variety_id'),
            'poDetProdFmly' => array(self::BELONGS_TO, 'ProductFamily', 'po_det_prod_fmly_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'po_det_id' => 'Po Det',
            'po_id' => 'Po',
            'po_det_prod_fmly_id' => 'Product Family',
            'po_det_product_id' => 'Product',
            'po_det_variety_id' => 'Variety',
            'po_det_grade' => 'Grade',
            'po_det_size' => 'Size',
            'po_det_net_weight' => 'Net Weight',
            'po_det_container_qty' => 'Container Qty',
            'po_det_cotton_qty' => 'Cotton Qty',
            'po_det_currency' => 'Currency',
            'po_det_price' => 'Price',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
            'createdbyname' => 'Created By',
            'postatus' => 'Status',
            'familyname' => 'Family',
            'productname' => 'Product',
            'varietyname' => 'Variety',
            'sizenames' => 'Size',
            'gradenames' => 'Grade',
            'totalamount' => 'Amount',
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

        $criteria->compare('po_det_id', $this->po_det_id);
        $criteria->compare('po_id', $this->po_id);
        $criteria->compare('po_det_prod_fmly_id', $this->po_det_prod_fmly_id);
        $criteria->compare('po_det_product_id', $this->po_det_product_id);
        $criteria->compare('po_det_variety_id', $this->po_det_variety_id);
        $criteria->compare('po_det_grade', $this->po_det_grade, true);
        $criteria->compare('po_det_size', $this->po_det_size, true);
        $criteria->compare('po_det_net_weight', $this->po_det_net_weight, true);
        $criteria->compare('po_det_container_qty', $this->po_det_container_qty, true);
        $criteria->compare('po_det_cotton_qty', $this->po_det_cotton_qty, true);
        $criteria->compare('po_det_currency', $this->po_det_currency, true);
        $criteria->compare('po_det_price', $this->po_det_price, true);
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
     * @return PurchaseOrderDetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function dataProvider() {
        $criteria = new CDbCriteria;

        $criteria->with = array('po');
        $criteria->compare('po.purchase_order_code', $this->f_purchase_order_code, true);
        $criteria->compare('po.po_vendor_id', $this->f_po_vendor_id);
        
//        echo "<pre>";
//        var_dump($this->f_po_vendor_id);
//        exit;

        if ($this->f_from_date != '' && $this->f_to_date != '') {
            $criteria->addBetweenCondition('po.po_date', date('Y-m-d', strtotime($this->f_from_date)), date('Y-m-d', strtotime($this->f_to_date)));
        }

        if($this->page_size)
            $pagination = array('pageSize' => PAGE_SIZE);
        else
            $pagination = false;
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => $pagination
        ));
    }

    protected function beforeValidate() {
        if ($this->po_det_grade)
            $this->po_det_grade = CJSON::encode($this->po_det_grade);
        if ($this->po_det_size)
            $this->po_det_size = CJSON::encode($this->po_det_size);

        return parent::beforeValidate();
    }

    protected function beforeSave() {
        if ($this->po_det_grade && is_array($this->po_det_grade))
            $this->po_det_grade = CJSON::encode($this->po_det_grade);
        if ($this->po_det_size && is_array($this->po_det_size))
            $this->po_det_size = CJSON::encode($this->po_det_size);

        return parent::beforeSave();
    }

    protected function afterFind() {
        if ($this->po_det_grade)
            $this->po_det_grade = CJSON::decode($this->po_det_grade);
        if ($this->po_det_size)
            $this->po_det_size = CJSON::decode($this->po_det_size);

        return parent::afterFind();
    }

    public function getCompanyname() {
        return $this->po->poCompany->company_name;
    }
    
    public function getVendorname() {
        return $this->po->poVendor->vendor_name;
    }
    
    public function getPostatus() {
        return PurchaseOrder::StatusList($this->po->status);
    }
    
    public function getCreatedbyname() {
        return $this->po->createdBy->first_name;
    }
    
    public function getPurchasecode() {
        return $this->po->purchase_order_code;
    }
    
    public function getPurchasedate() {
        return $this->po->po_date;
    }
    
    public function getFamilyname() {
        return $this->poDetProdFmly->pro_family_name;
    }
    
    public function getProductname() {
        return $this->poDetProduct->pro_name;
    }
    
    public function getVarietyname() {
        return $this->poDetVariety->variety_name;
    }
    
    public function getSizenames() {
        return implode(', ', CHtml::listData(ProductSize::model()->findAllByAttributes(array("size_id" => $this->po_det_size)), 'size_id', 'size_name'));
    }
    
    public function getGradenames() {
        return implode(', ', CHtml::listData(ProductGrade::model()->findAllByAttributes(array("grade_id" => $this->po_det_grade)), 'grade_id', 'grade_long_name'));
    }
    
    public function getTotalamount() {
        return $this->po_det_cotton_qty * $this->po_det_price;
    }
}
