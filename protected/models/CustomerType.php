<?php

/**
 * This is the model class for table "{{customer_type}}".
 *
 * The followings are the available columns in table '{{customer_type}}':
 * @property integer $customer_type_id
 * @property string $customer_type
 * @property string $created_date
 * @property integer $created_by
 * @property string $modified_date
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $ip_address
 */
class CustomerType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerType the static model class
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
		return '{{customer_type}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1')
	    );
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_date', 'required'),
			array('created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('customer_type', 'length', 'max'=>200),
			array('ip_address', 'length', 'max'=>20),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_type_id, customer_type, created_date, created_by, modified_date, is_active, is_deleted, ip_address', 'safe', 'on'=>'search'),
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
			'customer_type_id' => Myclass::t('Customer Type'),
			'customer_type' => Myclass::t('Customer Type'),
			'created_date' => Myclass::t('Created Date'),
			'created_by' => Myclass::t('Created By'),
			'modified_date' => Myclass::t('Modified Date'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'ip_address' => Myclass::t('Ip Address'),
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

		$criteria->compare('customer_type_id',$this->customer_type_id);
		$criteria->compare('customer_type',$this->customer_type,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}