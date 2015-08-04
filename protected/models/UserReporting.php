<?php

/**
 * This is the model class for table "{{user_reporting}}".
 *
 * The followings are the available columns in table '{{user_reporting}}':
 * @property integer $user_reporting_id
 * @property integer $user_id
 * @property integer $reporting_user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $reportingUser
 */
class UserReporting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserReporting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_reporting}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reporting_user_id', 'type','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_reporting_id, user_id, reporting_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'reportingUser' => array(self::BELONGS_TO, 'UserRole', 'reporting_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_reporting_id' => Myclass::t('User Reporting'),
			'user_id' => Myclass::t('User'),
			'reporting_user_id' => Myclass::t('Reporting to'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_reporting_id',$this->user_reporting_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('reporting_user_id',$this->reporting_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}