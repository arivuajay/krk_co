<?php

/**
 * This is the model class for table "{{permit}}".
 *
 * The followings are the available columns in table '{{permit}}':
 * @property integer $permit_id
 * @property integer $company_id
 * @property string $permit_no
 * @property string $doissue
 * @property string $valupto
 * @property string $permit_regno
 * @property string $permit_poissue
 * @property string $permit_file
 * @property string $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 * @property integer $modified_by
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class Permit extends CActiveRecord {

    const FILE_SIZE = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{permit}}';
    }

    public function getIsExpired() {
        return 'Y';
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
            array('company_id, permit_no, doissue, valupto, created_at, created_by', 'required'),
            array('company_id, created_by, modified_by', 'numerical', 'integerOnly' => true),
            array('permit_no, permit_regno, permit_poissue', 'length', 'max' => 100),
            array('permit_file', 'file', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * self::FILE_SIZE, 'tooLarge' => 'File should be smaller than ' . self::FILE_SIZE . 'MB'),
            array('status', 'length', 'max' => 1),
            array('modified_at,isexpired', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('permit_id, company_id, permit_no, doissue, valupto, permit_regno, permit_poissue, permit_file, status, created_at, created_by, modified_at, modified_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'permit_id' => 'Permit',
            'company_id' => 'Company',
            'permit_no' => 'Permit No',
            'doissue' => 'Date of Issue',
            'valupto' => 'Valid Upto',
            'permit_regno' => 'Reg No',
            'permit_poissue' => 'Place of Issue',
            'permit_file' => 'Upload Permit',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'modified_at' => 'Modified At',
            'modified_by' => 'Modified By',
            'isExpired' => 'Is Expired ?'
        );
    }

    public function behaviors() {
        return array(
            'NUploadFile' => array(
                'class' => 'ext.nuploadfile.NUploadFile',
                'fileField' => 'permit_file',
            )
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

        $criteria->compare('permit_id', $this->permit_id);
        $criteria->compare('company_id', $this->company_id);
        $criteria->compare('permit_no', $this->permit_no, true);
        $criteria->compare('doissue', $this->doissue, true);
        $criteria->compare('valupto', $this->valupto, true);
        $criteria->compare('permit_regno', $this->permit_regno, true);
        $criteria->compare('permit_poissue', $this->permit_poissue, true);
        $criteria->compare('permit_file', $this->permit_file, true);
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
     * @return Permit the static model class
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
        $this->doissue = date('Y-m-d', strtotime($this->doissue));
        $this->valupto = date('Y-m-d', strtotime($this->valupto));

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->doissue = date(PHP_USER_DATE_FORMAT, strtotime($this->doissue));
        $this->valupto = date(PHP_USER_DATE_FORMAT, strtotime($this->valupto));

        return parent::afterFind();
    }

}
