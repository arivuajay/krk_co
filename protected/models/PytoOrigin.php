<?php

/**
 * This is the model class for table "{{pyto_origin}}".
 *
 * The followings are the available columns in table '{{pyto_origin}}':
 * @property integer $pyto_id
 * @property integer $pyto_company_id
 * @property integer $pyto_vendor_id
 * @property integer $pyto_po_id
 * @property integer $pyto_invoice_id
 * @property string $pyto_cert_no
 * @property string $doinspection
 * @property string $origin_cert_no
 * @property string $pyto_file
 * @property string $origin_file
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Invoice $pytoInvoice
 * @property Company $pytoCompany
 * @property PurchaseOrder $pytoPo
 * @property Vendor $pytoVendor
 */
class PytoOrigin extends RActiveRecord {

    const FILE_SIZE = 5;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{pyto_origin}}';
    }

    public function behaviors() {
        return array(
            'NUploadFile' => array(
                'class' => 'ext.nuploadfile.NUploadFile',
                'fileField' => array('pyto_file', 'origin_file'),
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pyto_company_id, pyto_vendor_id, pyto_po_id, pyto_invoice_id, doinspection, created_at, created_by', 'required'),
            array('pyto_company_id, pyto_vendor_id, pyto_po_id, pyto_invoice_id, status, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('pyto_file, origin_file', 'file', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * self::FILE_SIZE, 'tooLarge' => 'File should be smaller than ' . self::FILE_SIZE . 'MB'),
            array('pyto_cert_no, origin_cert_no', 'length', 'max' => 150),
            array('pyto_file, origin_file', 'safe'),
            array('modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pyto_id, pyto_company_id, pyto_vendor_id, pyto_po_id, pyto_invoice_id, pyto_cert_no, doinspection, origin_cert_no, pyto_file, origin_file, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pytoInvoice' => array(self::BELONGS_TO, 'Invoice', 'pyto_invoice_id'),
            'pytoCompany' => array(self::BELONGS_TO, 'Company', 'pyto_company_id'),
            'pytoPo' => array(self::BELONGS_TO, 'PurchaseOrder', 'pyto_po_id'),
            'pytoVendor' => array(self::BELONGS_TO, 'Vendor', 'pyto_vendor_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pyto_id' => 'Pyto',
            'pyto_company_id' => 'Company',
            'pyto_vendor_id' => 'Vendor',
            'pyto_po_id' => 'PO Number',
            'pyto_invoice_id' => 'Invoice No',
            'pyto_cert_no' => 'Pyto Certificate No',
            'doinspection' => 'Date Of Inspection',
            'origin_cert_no' => 'Origin Certificate No',
            'pyto_file' => 'Upload Pyto',
            'origin_file' => 'Upload Origin',
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
    public function dataProvider() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('pyto_id', $this->pyto_id);
        $criteria->compare('pyto_company_id', $this->pyto_company_id);
        $criteria->compare('pyto_vendor_id', $this->pyto_vendor_id);
        $criteria->compare('pyto_po_id', $this->pyto_po_id);
        $criteria->compare('pyto_invoice_id', $this->pyto_invoice_id);
        $criteria->compare('pyto_cert_no', $this->pyto_cert_no, true);
        $criteria->compare('doinspection', $this->doinspection, true);
        $criteria->compare('origin_cert_no', $this->origin_cert_no, true);
        $criteria->compare('pyto_file', $this->pyto_file, true);
        $criteria->compare('origin_file', $this->origin_file, true);
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
     * @return PytoOrigin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        $this->doinspection = date('Y-m-d', strtotime($this->doinspection));

        return parent::beforeValidate();
    }
    
    protected function beforeSave() {
        $this->encodeJSON();
        return parent::beforeSave();
    }
    protected function encodeJSON() {
        if ($this->pyto_file && is_array($this->pyto_file))
            $this->pyto_file = CJSON::encode($this->pyto_file);
        if ($this->origin_file && is_array($this->origin_file))
            $this->origin_file = CJSON::encode($this->origin_file);
    }
    protected function afterFind() {
        $this->doinspection = date(PHP_USER_DATE_FORMAT, strtotime($this->doinspection));
                
        if ($this->pyto_file)
            $this->pyto_file = CJSON::decode($this->pyto_file);
        if ($this->origin_file)
            $this->origin_file = CJSON::decode($this->origin_file);
        return parent::afterFind();
    }
    public function getFileview() {
        $download = '';
        if (!empty($this->pyto_file)) {
            foreach ($this->pyto_file as $file) {
                $exp = explode('/', $file);
                $fName = $exp[2];
                $VName = substr($fName, 33);
                $download .= CHtml::link($VName, Yii::app()->createAbsoluteUrl(UPLOAD_DIR . $file), array('target' => '_blank')) . '<br />';
            }
        }
        return $download;
    }
    public function getFileview1() {
        $download = '';
        if (!empty($this->origin_file)) {
            foreach ($this->origin_file as $file) {
                $exp = explode('/', $file);
                $fName = $exp[2];
                $VName = substr($fName, 33);
                $download .= CHtml::link($VName, Yii::app()->createAbsoluteUrl(UPLOAD_DIR . $file), array('target' => '_blank')) . '<br />';
            }
        }
        return $download;
    }
}
