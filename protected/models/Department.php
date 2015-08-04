<?php

/**
 * This is the model class for table "{{department}}".
 *
 * The followings are the available columns in table '{{department}}':
 * @property integer $depart_id
 * @property string $name
 * @property integer $is_deleted
 * @property integer $is_active
 * @property string $ip_address
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property SalesOrder[] $salesOrders
 * @property UserDepartment[] $userDepartments
 */
class Department extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Department the static model class
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
		return '{{department}}';
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
			array('name', 'required'),
			array('is_deleted, is_active, created_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('ip_address', 'length', 'max'=>20),
			array('created_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('depart_id, name, is_deleted, is_active, ip_address, created_by, created_date, modified_date', 'safe', 'on'=>'search'),
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
			'salesOrders' => array(self::HAS_MANY, 'SalesOrder', 'department_id'),
			'userDepartments' => array(self::HAS_MANY, 'UserDepartment', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'depart_id' => Myclass::t('Depart'),
			'name' => Myclass::t('Name'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'is_active' => Myclass::t('Is Active'),
			'ip_address' => Myclass::t('Ip Address'),
			'created_by' => Myclass::t('Created By'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
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

		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}