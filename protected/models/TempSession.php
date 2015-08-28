<?php

/**
 * This is the model class for table "{{temp_session}}".
 *
 * The followings are the available columns in table '{{temp_session}}':
 * @property integer $id
 * @property string $session_name
 * @property string $session_key
 * @property string $session_data
 * @property string $created_at
 * @property integer $created_by
 * @property string $modified_at
 *
 * The followings are the available model relations:
 * @property User $createdBy
 */
class TempSession extends CActiveRecord {

    public function scopes() {
        $alias = $this->getTableAlias(false, false);
        $uid = Yii::app()->user->id;

        return array(
            'byMe' => array('condition' => "$alias.created_by = '{$uid}'"),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{temp_session}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('session_name, session_key, created_at, created_by', 'required'),
            array('created_by', 'numerical', 'integerOnly' => true),
            array('session_name', 'length', 'max' => 255),
            array('session_key', 'length', 'max' => 100),
            array('session_data, modified_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, session_name, session_key, session_data, created_at, created_by, modified_at', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'session_name' => 'Session Name',
            'session_key' => 'Session Key',
            'session_data' => 'Session Data',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('session_name', $this->session_name, true);
        $criteria->compare('session_key', $this->session_key, true);
        $criteria->compare('session_data', $this->session_data, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('created_by', $this->created_by);
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
     * @return TempSession the static model class
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
            $this->created_by = Yii::app()->user->id;
            $this->created_at = new CDbExpression('NOW()');
        } else {
            $this->modified_at = new CDbExpression('NOW()');
        }

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->session_data = CJSON::decode($this->session_data);

        return parent::beforeValidate();
    }

}
