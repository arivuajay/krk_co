<?php

/**
 * This is the model class for table "{{purchase_expenses}}".
 *
 * The followings are the available columns in table '{{purchase_expenses}}':
 * @property integer $pur_exp_id
 * @property integer $po_id
 * @property string $pur_exp_date
 * @property string $pur_exp_amount
 * @property string $pur_exp_remarks
 * @property string $created_at
 * @property string $created_by
 * @property integer $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property PurchaseOrder $po
 */
class PurchaseExpenses extends RActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{purchase_expenses}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('po_id, pur_exp_date, pur_exp_amount, pur_exp_remarks, created_at', 'required'),
            array('po_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('pur_exp_amount', 'numerical', 'integerOnly' => false),
            array('created_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pur_exp_id, po_id, pur_exp_date, pur_exp_amount, pur_exp_remarks, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'pur_exp_id' => 'Pur Exp',
            'po_id' => 'PO',
            'pur_exp_date' => 'Date',
            'pur_exp_amount' => 'Amount',
            'pur_exp_remarks' => 'Remarks',
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

        $criteria->compare('pur_exp_id', $this->pur_exp_id);
        $criteria->compare('po_id', $this->po_id);
        $criteria->compare('pur_exp_date', $this->pur_exp_date, true);
        $criteria->compare('pur_exp_amount', $this->pur_exp_amount, true);
        $criteria->compare('pur_exp_remarks', $this->pur_exp_remarks, true);
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
     * @return PurchaseExpenses the static model class
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
        $this->pur_exp_date = date('Y-m-d', strtotime($this->pur_exp_date));
        return parent::beforeSave();
    }
    
    protected function afterFind() {
        $this->pur_exp_date = date(PHP_USER_DATE_FORMAT, strtotime($this->pur_exp_date));
        return parent::afterFind();
    }
}
