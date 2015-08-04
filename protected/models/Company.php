<?php

/**
 * This is the model class for table "{{company}}".
 *
 * The followings are the available columns in table '{{company}}':
 * @property integer $company_id
 * @property string $name
 * @property string $email
 * @property integer $customer_type_id
 * @property integer $staff_size
 * @property string $office_phone
 * @property string $billing_address
 * @property string $billing_city
 * @property string $billing_state
 * @property integer $same_shipping
 * @property string $shipping_address
 * @property string $shipping_city
 * @property string $shipping_state
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 * @property string $ip_address
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property CompanyContact[] $companyContacts
 * @property SalesOrder[] $salesOrders
 */
class Company extends CActiveRecord
{
     public $CmpMinDate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return '{{company}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
		 'mindate'=>array('select'=>"MIN($alias.created_date) as CmpMinDate"),
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
			array('name,customer_type_id,company_rutno,staff_size,office_phone,billing_address, billing_city, billing_state,same_shipping', 'required'),
			array('email','email'),
                        array('company_rutno','unique'),
			array('customer_type_id, staff_size, same_shipping, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('office_phone, billing_state, shipping_state, ip_address', 'length', 'max'=>20),
			array('billing_address, billing_city, shipping_address, shipping_city', 'length', 'max'=>100),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('company_id, name, customer_type_id, staff_size, office_phone, billing_address, billing_city, billing_state, same_shipping, shipping_address, shipping_city, shipping_state, created_by, created_date, modified_date, ip_address, is_active, is_deleted', 'safe', 'on'=>'search'),
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
			'companyContacts' => array(self::HAS_MANY, 'CompanyContact', 'company_id'),
			'salesOrders' => array(self::HAS_MANY, 'SalesOrder', 'company_id'),
			'quotes' => array(self::HAS_MANY, 'Quote', 'company_id'),
                        'customer_type' => array(self::BELONGS_TO, 'CustomerType', 'customer_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'company_id' => Myclass::t('Company'),
			'name' => Myclass::t('Customer Name'),
			'customer_type_id' => Myclass::t('Customer Type'),
			'staff_size' => Myclass::t('No. of Staffs'),
			'office_phone' => Myclass::t('Office Phone'),
			'billing_address' => Myclass::t('Billing Address'),
			'billing_city' => Myclass::t('Billing City'),
			'billing_state' => Myclass::t('Billing State'),
			'same_shipping' => Myclass::t('Shipping Address same as Billing address'),
			'shipping_address' => Myclass::t('Shipping Address'),
			'shipping_city' => Myclass::t('Shipping City'),
			'shipping_state' => Myclass::t('Shipping State'),
			'created_by' => Myclass::t('Created By'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
			'ip_address' => Myclass::t('Ip Address'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'company_rutno' => Myclass::t('R.U.T. No')
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

		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('customer_type_id',$this->customer_type_id);
		$criteria->compare('staff_size',$this->staff_size);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('billing_address',$this->billing_address,true);
		$criteria->compare('billing_city',$this->billing_city,true);
		$criteria->compare('billing_state',$this->billing_state,true);
		$criteria->compare('same_shipping',$this->same_shipping);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('shipping_city',$this->shipping_city,true);
		$criteria->compare('shipping_state',$this->shipping_state,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function onBeforeValidate(CEvent $event)
        {
	    parent::onBeforeValidate($event);

	    if (!$this->same_shipping)
	    {  
		    $validator = CValidator::createValidator('required', $this, 'shipping_address, shipping_city, shipping_state');
		    $this->getValidatorList()->add($validator);
	    }
        }
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->created_date = new CDbExpression('NOW()');
		$this->created_by = Yii::app()->user->id;
	    endif;

	    $this->modified_date = new CDbExpression('NOW()');
	    $this->ip_address	 = CHttpRequest::getUserHostAddress();
	    

	    return parent::beforeSave();
	}
}