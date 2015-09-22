<?php

/**
 * This is the model class for table "{{company}}".
 *
 * The followings are the available columns in table '{{company}}':
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_address
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 */
class Company extends RActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{company}}';
    }

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        return array(
            'active' => array('condition' => "$alias.status = '1'"),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('company_name, created_at, created_by', 'required'),
            array('created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('company_name, company_address', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('company_id, company_name, company_address, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
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
            'company_id' => 'Company',
            'company_name' => 'Company Name',
            'company_address' => 'Company Address',
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

        $criteria->compare('company_id', $this->company_id);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('company_address', $this->company_address, true);
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
     * @return Company the static model class
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

//    protected function beforeValidate() {
//        if ($this->isNewRecord) {
//            $this->created_at = new CDbExpression('NOW()');
//            $this->created_by = Yii::app()->user->id;
//        } else {
//            $this->modified_at = new CDbExpression('NOW()');
//            $this->modified_by = Yii::app()->user->id;
//        }
//
//        return parent::beforeValidate();
//    }

    public static function CompanyList($is_active = TRUE, $key = NULL) {
        if ($is_active && $key == NULL)
            $lists = CHtml::listData(self::model()->active()->findAll(array('order' => 'company_name')), 'company_id', 'company_name');
        else
            $lists = CHtml::listData(self::model()->findAll(array('order' => 'company_name')), 'company_id', 'company_name');
        if ($key != NULL)
            return $lists[$key];
        return $lists;
    }
}
