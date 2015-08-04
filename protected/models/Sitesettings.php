<?php

/**
 * This is the model class for table "{{site_settings}}".
 *
 * The followings are the available columns in table '{{site_settings}}':
 * @property integer $settings_id
 * @property string $param_key
 * @property integer $param_value
 */
class Sitesettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteSettings the static model class
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
		return '{{site_settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param_key, param_value', 'required'),
			array('param_key,param_value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('settings_id,setting_status, param_key, param_value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'settings_id' => Myclass::t('Settings'),
			'param_key' => Myclass::t('Key'),
			'param_value' => Myclass::t('Value'),
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

		$criteria->compare('settings_id',$this->settings_id);
		$criteria->compare('param_key',$this->param_key,true);
		$criteria->compare('param_value',$this->param_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}