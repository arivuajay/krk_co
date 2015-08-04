<?php

/**
 * This is the model class for table "{{vendor}}".
 *
 * The followings are the available columns in table '{{vendor}}':
 * @property integer $ven_id
 * @property string $ven_name
 * @property integer $ven_type
 * @property integer $ven_size
 * @property string $off_phone
 * @property string $bill_addr
 * @property string $bill_city
 * @property string $bill_state
 * @property string $same_shipping
 * @property string $ship_addr
 * @property string $ship_city
 * @property string $ship_state
 * @property integer $ven_created_by
 * @property integer $ven_modified_by
 * @property string $mod_ip_address
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property User $venModifiedBy
 * @property User $venCreatedBy
 * @property CustomerType $venType
 * @property VendorContact[] $vendorContacts
 * @property VendorProducts[] $vendorProducts
 */
class Vendor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vendor the static model class
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
		return '{{vendor}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0')
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
			array('ven_name,same_shipping, ven_type, ven_size, off_phone, bill_addr, bill_city, bill_state', 'required'),
//			array('ship_addr, ship_city, ship_state', 'required','className' => 'Vendor','criteria' => array('condition' => 'same_shipping = 0')),
			array('ven_type, ven_size, ven_created_by, ven_modified_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('ven_name, off_phone, mod_ip_address', 'length', 'max'=>255),
			array('ship_addr, ship_city, ship_state,ven_created_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ven_id, ven_name, ven_type, ven_size, off_phone, bill_addr, bill_city, bill_state, ship_addr, ship_city, ship_state, ven_created_by, ven_modified_by, mod_ip_address, is_active, is_deleted', 'safe', 'on'=>'search'),
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
			'venModifiedBy' => array(self::BELONGS_TO, 'User', 'ven_modified_by'),
			'venCreatedBy' => array(self::BELONGS_TO, 'User', 'ven_created_by'),
			'venType' => array(self::BELONGS_TO, 'CustomerType', 'ven_type'),
			'vendorContacts' => array(self::HAS_MANY, 'VendorContact', 'ven_id'),
			'vendorProducts' => array(self::HAS_MANY, 'VendorProducts', 'ven_id'),
			'primaryContact' => array(self::HAS_ONE, 'VendorContact', 'ven_id','condition'=>'is_primary = 1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ven_id' => Myclass::t('Ven'),
			'ven_name' => Myclass::t('Vendor Name'),
			'ven_type' => Myclass::t('Vendor Type'),
			'ven_size' => '# '.Myclass::t('of Staffs'),
			'off_phone' => Myclass::t('Office Phone'),
			'bill_addr' => Myclass::t('Billing Address'),
			'bill_city' => Myclass::t('Bill City'),
			'bill_state' => Myclass::t('Bill State'),
			'same_shipping' => Myclass::t('Shipping Address same as Billing address'),
			'ship_addr' => Myclass::t('Shipping Address'),
			'ship_city' => Myclass::t('Ship City'),
			'ship_state' => Myclass::t('Ship State'),
			'ven_created_by' => Myclass::t('Ven Created By'),
			'ven_modified_by' => Myclass::t('Ven Modified By'),
			'mod_ip_address' => Myclass::t('Mod Ip Address'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
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

		$criteria->compare('ven_id',$this->ven_id);
		$criteria->compare('ven_name',$this->ven_name,true);
		$criteria->compare('ven_type',$this->ven_type);
		$criteria->compare('ven_size',$this->ven_size);
		$criteria->compare('off_phone',$this->off_phone,true);
		$criteria->compare('bill_addr',$this->bill_addr,true);
		$criteria->compare('bill_city',$this->bill_city,true);
		$criteria->compare('bill_state',$this->bill_state,true);
		$criteria->compare('ship_addr',$this->ship_addr,true);
		$criteria->compare('ship_city',$this->ship_city,true);
		$criteria->compare('ship_state',$this->ship_state,true);
		$criteria->compare('ven_created_by',$this->ven_created_by);
		$criteria->compare('ven_modified_by',$this->ven_modified_by);
		$criteria->compare('mod_ip_address',$this->mod_ip_address,true);
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
		    $validator = CValidator::createValidator('required', $this, 'ship_addr, ship_city, ship_state');
		    $this->getValidatorList()->add($validator);
	    }
        }
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->ven_created_by = Yii::app()->user->id;
		$this->ven_created_on = new CDbExpression('NOW()');
	    else:
		$this->ven_modified_by = Yii::app()->user->id;
	    endif;

	    $this->mod_ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
	}

}