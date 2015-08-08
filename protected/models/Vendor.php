<?php

/**
 * This is the model class for table "{{vendor}}".
 *
 * The followings are the available columns in table '{{vendor}}':
 * @property integer $vendor_id
 * @property integer $vendor_type_id
 * @property string $vendor_code
 * @property string $vendor_name
 * @property string $vendor_address
 * @property string $vendor_city
 * @property string $vendor_country
 * @property string $vendor_contact_person
 * @property string $vendor_mobile_no
 * @property string $vendor_office_no
 * @property string $vendor_email
 * @property string $vendor_website
 * @property string $vendor_trade_mark
 * @property string $vendor_remarks
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 */
class Vendor extends CActiveRecord {

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => "$alias.status = '1'"),
        );
    }

    public function getVendor_code($id = null) {
        if ($this->product_id)
            return "P" . str_pad($this->product_id, 3, 0, STR_PAD_LEFT);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{vendor}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vendor_type_id, vendor_code, vendor_name, vendor_address, vendor_country, vendor_contact_person, vendor_email, created_at', 'required'),
            array('vendor_type_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('vendor_code', 'length', 'max' => 10),
            array('vendor_name', 'length', 'max' => 50),
            array('vendor_city, vendor_country, vendor_contact_person, vendor_email, vendor_website, vendor_trade_mark', 'length', 'max' => 255),
            array('vendor_mobile_no, vendor_office_no', 'length', 'max' => 100),
            array('status', 'length', 'max' => 1),
            array('vendor_remarks, modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('vendor_id, vendor_type_id, vendor_code, vendor_name, vendor_address, vendor_city, vendor_country, vendor_contact_person, vendor_mobile_no, vendor_office_no, vendor_email, vendor_website, vendor_trade_mark, vendor_remarks, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'vendor_id' => 'Vendor',
            'vendor_type_id' => 'Vendor Type',
            'vendor_code' => 'Vendor Code',
            'vendor_name' => 'Vendor Name',
            'vendor_address' => 'Vendor Address',
            'vendor_city' => 'Vendor City',
            'vendor_country' => 'Vendor Country',
            'vendor_contact_person' => 'Vendor Contact Person',
            'vendor_mobile_no' => 'Vendor Mobile No',
            'vendor_office_no' => 'Vendor Office No',
            'vendor_email' => 'Vendor Email',
            'vendor_website' => 'Vendor Website',
            'vendor_trade_mark' => 'Vendor Trade Mark',
            'vendor_remarks' => 'Vendor Remarks',
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

        $criteria->compare('vendor_id', $this->vendor_id);
        $criteria->compare('vendor_type_id', $this->vendor_type_id);
        $criteria->compare('vendor_code', $this->vendor_code, true);
        $criteria->compare('vendor_name', $this->vendor_name, true);
        $criteria->compare('vendor_address', $this->vendor_address, true);
        $criteria->compare('vendor_city', $this->vendor_city, true);
        $criteria->compare('vendor_country', $this->vendor_country, true);
        $criteria->compare('vendor_contact_person', $this->vendor_contact_person, true);
        $criteria->compare('vendor_mobile_no', $this->vendor_mobile_no, true);
        $criteria->compare('vendor_office_no', $this->vendor_office_no, true);
        $criteria->compare('vendor_email', $this->vendor_email, true);
        $criteria->compare('vendor_website', $this->vendor_website, true);
        $criteria->compare('vendor_trade_mark', $this->vendor_trade_mark, true);
        $criteria->compare('vendor_remarks', $this->vendor_remarks, true);
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
     * @return Vendor the static model class
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
