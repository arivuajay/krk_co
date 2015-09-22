<?php

/**
 * This is the model class for table "{{expenses}}".
 *
 * The followings are the available columns in table '{{expenses}}':
 * @property integer $exp_id
 * @property string $exp_name
 * @property string $exp_amount
 * @property string $exp_remarks
 * @property string $exp_type
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 */
class Expenses extends RActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{expenses}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exp_name, exp_amount, exp_remarks, exp_type', 'required'),
            array('modified_at, modified_by', 'numerical', 'integerOnly' => true),
            array('exp_name', 'length', 'max' => 100),
            array('exp_amount', 'numerical', 'integerOnly' => false),
            array('exp_type', 'length', 'max' => 1),
            array('exp_remarks, created_at, created_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('exp_id, exp_name, exp_amount, exp_remarks, exp_type, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
            'modifiedBy' => array(self::BELONGS_TO, 'User', 'modified_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'exp_id' => 'Exp',
            'exp_name' => 'Expense Name',
            'exp_amount' => 'Amount',
            'exp_remarks' => 'Remarks',
            'exp_type' => 'Type',
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

        $criteria->compare('exp_id', $this->exp_id);
        $criteria->compare('exp_name', $this->exp_name, true);
        $criteria->compare('exp_amount', $this->exp_amount, true);
        $criteria->compare('exp_remarks', $this->exp_remarks, true);
        $criteria->compare('exp_type', $this->exp_type, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified_at', $this->modified_at);
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
     * @return Expenses the static model class
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

    public function getExpensetypelist($key = null) {
        $list = array(
            'C' => 'Cash',
            'N' => 'Non-cash'
        );
        if($key != null)
            return $list[$key];
        return $list;
    }
}
