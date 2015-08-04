<?php

/**
 * This is the model class for table "{{salesorder}}".
 *
 * The followings are the available columns in table '{{salesorder}}':
 * @property integer $so_id
 * @property integer $quote_id
 * @property integer $customer_id
 * @property string $customer
 * @property string $primary_contact
 * @property string $phone
 * @property string $ship_address
 * @property string $ship_city
 * @property string $ship_state
 * @property integer $same_as_shipping
 * @property string $bill_address
 * @property string $bill_city
 * @property string $bill_state
 * @property integer $is_active
 * @property integer $is_deleted
 * @property integer $so_status
 * @property integer $assigned
 * @property integer $pack_assigned
 * @property integer $ship_assigned
 * @property string $pick_created_date
 * @property string $pack_created_date
 * @property string $ship_created_date
 * @property string $so_created_date
 * @property integer $so_created_by
 * @property string $so_ip_address
 *
 * The followings are the available model relations:
 * @property Orderdetail[] $orderdetails
 * @property Pack[] $packs
 */
class Salesorder extends CActiveRecord
{
    public $sumofTotal,$topProduct,$ProductCount,$soMinDate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Salesorder the static model class
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
		return '{{salesorder}}';
	}

	public function scopes() {
	   $alias = $this->getTableAlias(false, false);
	   
	   return array(
	       'latest'=>array('order'=>$alias.'.so_id DESC'),
	       'active'=>array('condition'=>$alias.'.so_status > 0'),
	       'approved'=>array('condition'=>$alias.'.so_status = 1'),
	       'pickreleased'=>array('condition'=>$alias.'.so_status = 2'),
	       'packreleased'=>array('condition'=>$alias.'.so_status = 3'),
	       'completed'=>array('condition'=>$alias.'.so_status = 4'),
	       'so_active'=>array('condition'=>$alias.'.so_status > 0'),
	       'my'=>array('condition'=>$alias.'.so_created_by = '.Yii::app()->user->id),
	       'byme'=>array('condition'=>$alias.'.assigned = '.Yii::app()->user->id),
	       'bypackme'=>array('condition'=>$alias.'.pack_assigned = '.Yii::app()->user->id),
	       'byshipme'=>array('condition'=>$alias.'.ship_assigned = '.Yii::app()->user->id),
	       'not_deleted'=>array('condition'=>$alias.'.is_deleted = 0'),
	       'processing'=>array('condition'=>$alias.'.is_deleted = 0 AND '.$alias.'.so_status BETWEEN 0 AND 4'),
	       'sumTotal'=>array('with'=>'orderdetail','select'=>"SUM(orderdetail.total_order_value) as sumofTotal"),
	       'topProduct'=>array('with'=>'soProducts','condition'=>"soPraoducts.product_id <> '0'",'select'=>"product_id as topProduct, COUNT(*) as ProductCount","group"=>"product_id","order"=>"ProductCount DESC",'together'=>true),
	       'mindate'=>array('select'=>"MIN($alias.so_created_date) as soMinDate"),
	       
//               'topClient'=>array('with'=>array('company','orderdetail'),'select'=>"company.name as TopCompany, COUNT(*) as CountOrder as CountOrder","group"=>"customer_id","order"=>"CountOrder DESC",'together'=>true),
//               SELECT product_id as topProduct, COUNT(*) as ProductCount  FROM `tbl_salesorder` `t`
//LEFT OUTER JOIN `tbl_so_products` `soProducts` ON (`soProducts`.`so_id`=`t`.`so_id`)
//GROUP BY product_id
//ORDER BY ProductCount DESC

//////////
//SELECT category_id as TopCategory,COUNT(*) as Categorycount  FROM `tbl_salesorder` `t`
//LEFT JOIN `tbl_so_products` `soProducts` ON (`soProducts`.`so_id`=`t`.`so_id`)
//LEFT JOIN `tbl_product_category` `ProductCat` ON (`ProductCat`.`product_id`=`soProducts`.`product_id`)
//WHERE category_id <> 'null'
//GROUP BY category_id
//ORDER BY Categorycount DESC

///////////////////
//SELECT company.name as TopCompany, COUNT(*) as CountOrder FROM `tbl_salesorder` `t`
//LEFT OUTER JOIN `tbl_company` `company` ON (`t`.`customer_id`=`company`.`company_id`)
//LEFT OUTER JOIN `tbl_orderdetail` `orderdetail` ON (`t`.`so_id`=`orderdetail`.`od_id`)
//WHERE (t.so_status = 4)
//GROUP BY customer_id
//ORDER BY CountOrder DESC


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
			array('customer_id, customer, primary_contact, phone,ship_address,ship_city,ship_state', 'required','on'=>'insert'),// ship_address, ship_city, ship_state, bill_city, bill_state
			array('pick_created_date, pack_created_date, ship_created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('so_id,assigned,quote_id ,customer_id, customer, primary_contact, so_created_date, quote_approved, phone, ship_address, ship_city, ship_state, same_as_shipping, bill_address, bill_city, bill_state, is_active, is_deleted', 'safe'),
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
                    //'department' => array(self::BELONGS_TO, 'Department', 'departmentId'),
		    'company' => array(self::BELONGS_TO, 'Company', 'customer_id'),
                    'orderdetail' => array(self::BELONGS_TO, 'Orderdetail', 'so_id'),
		    'soProducts' => array(self::HAS_MANY, 'SoProducts', 'so_id'),
                    'SalesOrderMilestone' => array(self::BELONGS_TO, 'SalesOrderMilestone', 'so_id'),
		    'packs' => array(self::HAS_MANY, 'Pack', 'salesord_id'),
		    'picks' => array(self::HAS_MANY, 'Pick', 'salesord_id'),
		    'ships' => array(self::HAS_MANY, 'Ship', 'salesord_id'),
		    'assigned_to'=>array(self::BELONGS_TO, 'User', 'assigned'),
//		    'invoiced' => array(self::HAS_MANY, 'Invoice', 'inv_so_id','condition'=>'inv_scenario = "salesorder" AND inv_status = "2"'),
		    'invoicedAmt' => array(self::STAT,'Invoice','inv_so_id','select'=>'SUM(inv_payment)','condition'=>'inv_scenario = "salesorder" AND inv_status = "2"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'so_id' => Myclass::t('SO ID'),
			'customer_id' => Myclass::t('Customer ID'),
			'customer' => Myclass::t('Customer Name'),
			'primary_contact' => Myclass::t('Primary Contact'),
			'quote_id ' => Myclass::t('Quote ID'),
			'quote_date ' => Myclass::t('Quote Date'),
			'quote_approved' => Myclass::t('Quote Approved By'),
			'phone' => Myclass::t('Phone'),
			'ship_title' => Myclass::t('Ship to location'),
			'ship_address' => Myclass::t('Shipping Address line'),
			'ship_city' => Myclass::t('City'),
			'ship_state' => Myclass::t('State'),
			'bill_to_location' => Myclass::t('Bill to location'),
			'same_as_shipping' => Myclass::t('Same as shipping'),
			'bill_address' => Myclass::t('Billing Address line'),
			'bill_city' => Myclass::t('City'),
			'bill_state' => Myclass::t('State'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'assigned' => Myclass::t('Assigned'),
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

		$criteria->compare('so_id',$this->so_id);
		$criteria->compare('quote_id',$this->quote_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('customer',$this->customer,true);
		$criteria->compare('primary_contact',$this->primary_contact,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('ship_address',$this->ship_address,true);
		$criteria->compare('ship_city',$this->ship_city,true);
		$criteria->compare('ship_state',$this->ship_state,true);
		$criteria->compare('same_as_shipping',$this->same_as_shipping);
		$criteria->compare('bill_address',$this->bill_address,true);
		$criteria->compare('bill_city',$this->bill_city,true);
		$criteria->compare('bill_state',$this->bill_state,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('assigned',$this->assigned);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function onBeforeValidate(CEvent $event)
        {
	    parent::onBeforeValidate($event);

	    if (!$this->same_as_shipping)
	    {  
		    $validator = CValidator::createValidator('required', $this, 'bill_address, bill_city, bill_state');
		    $this->getValidatorList()->add($validator);
	    }
        }

	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->so_created_by = Yii::app()->user->id;
	    endif;

	    $this->so_ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
                        
	}
	
	public function afterSave() {
	    if($this->_oldStatus != $this->so_status):
		Myclass::TriggerInvoice($this->so_id,$this->so_status);
	    endif;
	    
	    parent::afterSave();
	}
	
	private $_oldStatus;
	public $concatwith_prefix;
 
	protected function afterFind()
	{
	    parent::afterFind();
	    $this->_oldStatus=$this->so_status;
	    $this->concatwith_prefix = SO_PREFIX.$this->so_id;
	}
}