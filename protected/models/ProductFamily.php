<?php

/**
 * This is the model class for table "{{product_family}}".
 *
 * The followings are the available columns in table '{{product_family}}':
 * @property integer $pro_family_id
 * @property string $pro_family_name
 * @property string $status
 * @property integer $created_by
 * @property string $created_at
 * @property integer $modified_by
 * @property string $modified_at
 */
class ProductFamily extends CActiveRecord {

    public $MAX_ID;

    /**
     * @return string the associated database table name
     */
    public function getPro_family_code($id = null) {
        if ($this->pro_family_id)
            return "PF" . str_pad($this->pro_family_id, 4, 0, STR_PAD_LEFT);
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => "$alias.status = '1'"),
        );
    }

    public function tableName() {
        return '{{product_family}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pro_family_name, created_by, created_at', 'required'),
            array('created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('pro_family_name', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pro_family_id, pro_family_name, status, created_by, created_at, modified_by, modified_at', 'safe', 'on' => 'search'),
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
            'pro_family_id' => 'Pro Family',
            'pro_family_name' => 'Pro Family Name',
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

        $criteria->compare('pro_family_id', $this->pro_family_id);
        $criteria->compare('pro_family_name', $this->pro_family_name, true);
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
     * @return ProductFamily the static model class
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

        return parent::beforeValidate();
    }

    public static function ProductFamilyList($is_active = TRUE, $key = NULL) {
        if ($is_active && $key == NULL)
            $lists = CHtml::listData(self::model()->active()->findAll(array('order' => 'pro_family_name')), 'pro_family_id', 'pro_family_name');
        else
            $lists = CHtml::listData(self::model()->findAll(array('order' => 'pro_family_name')), 'pro_family_id', 'pro_family_name');
        if ($key != NULL)
            return $lists[$key];
        return $lists;
    }
}
