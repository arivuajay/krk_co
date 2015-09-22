<?php

/**
 * This is the model class for table "{{sales_expenses}}".
 *
 * The followings are the available columns in table '{{sales_expenses}}':
 * @property integer $sale_exp_id
 * @property integer $product_id
 * @property string $sale_exp_date
 * @property string $sale_exp_amount
 * @property string $sale_exp_remarks
 * @property string $sales_exp_cust_name
 * @property string $sales_exp_address
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class SalesExpenses extends RActiveRecord {
    
    public $sale_exp_fam_id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{sales_expenses}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, sale_exp_date, sale_exp_amount, created_at, sale_exp_fam_id', 'required'),
            array('product_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('sale_exp_amount', 'numerical', 'integerOnly' => false),
            array('sales_exp_cust_name', 'length', 'max' => 100),
            array('sale_exp_remarks, sales_exp_address, modified_at, sale_exp_fam_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sale_exp_id, product_id, sale_exp_date, sale_exp_amount, sale_exp_remarks, sales_exp_cust_name, sales_exp_address, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'sale_exp_fam_id' => 'Product Family',
            'sale_exp_id' => 'Sale Exp',
            'product_id' => 'Product',
            'sale_exp_date' => 'Date',
            'sale_exp_amount' => 'Amount',
            'sale_exp_remarks' => 'Remarks',
            'sales_exp_cust_name' => 'Customer Name',
            'sales_exp_address' => 'Address',
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

        $criteria->compare('sale_exp_id', $this->sale_exp_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('sale_exp_date', $this->sale_exp_date, true);
        $criteria->compare('sale_exp_amount', $this->sale_exp_amount, true);
        $criteria->compare('sale_exp_remarks', $this->sale_exp_remarks, true);
        $criteria->compare('sales_exp_cust_name', $this->sales_exp_cust_name, true);
        $criteria->compare('sales_exp_address', $this->sales_exp_address, true);
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
     * @return SalesExpenses the static model class
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

    protected function beforeSave() {
        $this->sale_exp_date = date('Y-m-d', strtotime($this->sale_exp_date));
        return parent::beforeSave();
    }
    
    protected function afterFind() {
        $this->sale_exp_date = date(PHP_USER_DATE_FORMAT, strtotime($this->sale_exp_date));
        return parent::afterFind();
    }
}
