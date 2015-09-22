<?php

/**
 * This is the model class for table "{{product_size}}".
 *
 * The followings are the available columns in table '{{product_size}}':
 * @property integer $size_id
 * @property integer $product_id
 * @property string $size_code
 * @property string $size_name
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductSize extends RActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => " $alias.status = '1'"),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{product_size}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, size_name, created_at, created_by', 'required'),
            array('product_id, created_by, modified_by',
                'numerical', 'integerOnly' => true),
            array('size_name', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('modified_at,size_code', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('size_id,size_code, product_id, size_name, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function

    relations() {
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
            'size_id' => 'Size',
            'product_id' => 'Product',
            'size_code' => 'Size Code',
            'size_name' => 'Size Name',
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
        $criteria->compare('size_id', $this->size_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('size_code', $this->size_code, true);
        $criteria->compare('size_name', $this->size_name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('modified_at', $this->modified_at, true);
        $criteria->compare('modified_by', $this->modified_by);

        return new

                CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => PAGE_SIZE
            ,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductSize the static model class
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

    public function checkSize_code($id) {
        return "S" . str_pad($id, 3, 0, STR_PAD_LEFT);
    }

    protected function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord) {
            $this->size_code = $this->checkSize_code($this->size_id);
            $this->isNewRecord = false;
            $this->saveAttributes(array('size_code'));
        }
    }

}
