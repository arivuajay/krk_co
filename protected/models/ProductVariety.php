<?php

/**
 * This is the model class for table "{{product_variety}}".
 *
 * The followings are the available columns in table '{{product_variety}}':
 * @property integer $variety_id
 * @property integer $product_id
 * @property string $variety_code
 * @property string $variety_name
 * @property string $status
 * @property integer $created_by
 * @property string $created_at
 * @property integer $modified_by
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductVariety extends RActiveRecord {
    /**
     * @return string the associated database table name
     */
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
        return '{{product_variety}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, variety_name, created_by, created_at', 'required'),
            array('product_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('variety_name', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('modified_at,variety_code', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('variety_id,variety_code, product_id, variety_name, status, created_by, created_at, modified_by, modified_at', 'safe', 'on' => 'search'),
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
            'variety_id' => 'Variety',
            'product_id' => 'Product',
            'variety_code' => 'Variety Code',
            'variety_name' => 'Variety Name',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
            'modified_at' => 'Modified At',
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

        $criteria->compare('variety_id', $this->variety_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('variety_code', $this->variety_code, true);
        $criteria->compare('variety_name', $this->variety_name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('modified_by', $this->modified_by);
        $criteria->compare('modified_at', $this->modified_at, true);

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
     * @return ProductVariety the static model class
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

    public function checkVariety_code($id) {
        return "V" . str_pad($id, 3, 0, STR_PAD_LEFT);
    }

    protected function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $this->variety_code = $this->checkVariety_code($this->variety_id);
            $this->isNewRecord = false;
            $this->saveAttributes(array('variety_code'));
        }
    }
}
