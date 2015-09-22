<?php

/**
 * This is the model class for table "{{expense_type}}".
 *
 * The followings are the available columns in table '{{expense_type}}':
 * @property integer $exp_type_id
 * @property string $exp_type_name
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Expense[] $expenses
 * @property ExpenseSubtype[] $expenseSubtypes 
 */
class ExpenseType extends RActiveRecord {

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
        return '{{expense_type}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exp_type_name', 'required'),
            array('created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('exp_type_name', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('created_at, modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('exp_type_id, exp_type_name, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'expenses' => array(self::HAS_MANY, 'Expense', 'exp_type_id'),
            'expenseSubtypes' => array(self::HAS_MANY, 'ExpenseSubtype', 'exp_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'exp_type_id' => 'Exp Type',
            'exp_type_name' => 'Type Name',
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

        $criteria->compare('exp_type_id', $this->exp_type_id);
        $criteria->compare('exp_type_name', $this->exp_type_name, true);
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
     * @return ExpenseType the static model class
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

    public static function ExpenseTypeList($is_active = TRUE, $key = NULL) {
        if ($is_active && $key == NULL)
            $lists = CHtml::listData(self::model()->active()->findAll(array('order' => 'exp_type_name')), 'exp_type_id', 'exp_type_name');
        else
            $lists = CHtml::listData(self::model()->findAll(array('order' => 'exp_type_name')), 'exp_type_id', 'exp_type_name');
        if ($key != NULL)
            return $lists[$key];
        return $lists;
    }

}
