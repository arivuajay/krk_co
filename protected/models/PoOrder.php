<?php

/**
 * This is the model class for table "{{po_order}}".
 *
 * The followings are the available columns in table '{{po_order}}':
 * @property integer $po_ord_id
 * @property integer $po_id
 * @property integer $vendor_id
 * @property string $vendor_name
 * @property string $ref_so
 * @property integer $po_approver
 * @property string $ship_address
 * @property string $ship_city
 * @property string $ship_state
 * @property integer $same_as_shipping
 * @property string $bill_address
 * @property string $bill_city
 * @property string $bill_state
 * @property integer $po_ord_status
 * @property string $po_ord_created_date
 * @property integer $po_ord_created_by
 * @property string $po_ord_ip_address
 * @property string $po_ord_date
 * @property string $po_ship_date
 * @property double $po_ord_line_total
 * @property double $po_ord_tax
 * @property double $po_ord_total_order
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property PoOrdProducts[] $poOrdProducts
 * @property User $poApprover
 * @property User $vendor
 */
class PoOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoOrder the static model class
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
		return '{{po_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('po_id, vendor_id, vendor_name, po_approver, ship_address, ship_city, ship_state', 'required'),
			array('po_ord_date,po_ship_date', 'required','on'=>'order'),
			array('po_ship_date','compare','compareAttribute'=>'po_ord_date','operator'=>'>','allowEmpty'=>false,'message'=>'{attribute} must be greater than {compareAttribute}.','on'=>'order'),
			array('po_id, vendor_id, po_approver, same_as_shipping, po_ord_status, po_ord_created_by, is_deleted', 'numerical', 'integerOnly'=>true),
			array('po_ord_line_total, po_ord_tax, po_ord_total_order', 'numerical'),
			array('vendor_name, ref_so, ship_address, ship_city, ship_state, bill_address, bill_city, bill_state, po_ord_ip_address', 'length', 'max'=>255),
			array('po_ord_date, bill_address, bill_city, bill_state,po_ship_date,po_ord_created_date, po_ord_created_by, po_ord_ip_address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('po_ord_id, po_id, vendor_id, vendor_name, ref_so, po_approver, ship_address, ship_city, ship_state, same_as_shipping, bill_address, bill_city, bill_state, po_ord_status, po_ord_created_date, po_ord_created_by, po_ord_ip_address, po_ord_date, po_ship_date, po_ord_line_total, po_ord_tax, po_ord_total_order, is_deleted', 'safe', 'on'=>'search'),
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
			'poOrdProducts' => array(self::HAS_MANY, 'PoOrdProducts', 'po_ord_id'),
			'poApprover' => array(self::BELONGS_TO, 'User', 'po_approver'),
			'vendor' => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'po_ord_id' => Myclass::t('PO Order ID').' #',
			'po_id' => Myclass::t('PO REQ ID').' #',
			'vendor_id' => Myclass::t('Vendor ID').' #',
			'vendor_name' => Myclass::t('Vendor Name'),
			'ref_so' => Myclass::t('Ref SO'),
			'po_approver' => Myclass::t('PO Approver'),
			'ship_title'  => Myclass::t('Ship to location'),
			'ship_address' => Myclass::t('Ship Address'),
			'ship_city' => Myclass::t('Ship City'),
			'ship_state' => Myclass::t('Ship State'),
			'same_as_shipping' => Myclass::t('Same As Shipping'),
			'address' => Myclass::t('Address'),
			'bill_address' => Myclass::t('Bill Address'),
			'bill_city' => Myclass::t('Bill City'),
			'bill_state' => Myclass::t('Bill State'),
			'po_ord_status' => Myclass::t('PO Order Status'),
			'po_ord_created_date' => Myclass::t('PO Order Created Date'),
			'po_ord_created_by' => Myclass::t('PO Order Created By'),
			'po_ord_ip_address' => Myclass::t('PO Order Ip Address'),
			'po_ord_date' => Myclass::t('Order Date'),
			'po_ship_date' => Myclass::t('Expected Shipment date'),
			'po_ord_line_total' => Myclass::t('Line Total'),
			'po_ord_tax' => Myclass::t('Tax'),
			'po_ord_total_order' => Myclass::t('Total Order Value'),
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

		$criteria->compare('po_ord_id',$this->po_ord_id);
		$criteria->compare('po_id',$this->po_id);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('vendor_name',$this->vendor_name,true);
		$criteria->compare('ref_so',$this->ref_so,true);
		$criteria->compare('po_approver',$this->po_approver);
		$criteria->compare('ship_address',$this->ship_address,true);
		$criteria->compare('ship_city',$this->ship_city,true);
		$criteria->compare('ship_state',$this->ship_state,true);
		$criteria->compare('same_as_shipping',$this->same_as_shipping);
		$criteria->compare('bill_address',$this->bill_address,true);
		$criteria->compare('bill_city',$this->bill_city,true);
		$criteria->compare('bill_state',$this->bill_state,true);
		$criteria->compare('po_ord_status',$this->po_ord_status);
		$criteria->compare('po_ord_created_date',$this->po_ord_created_date,true);
		$criteria->compare('po_ord_created_by',$this->po_ord_created_by);
		$criteria->compare('po_ord_ip_address',$this->po_ord_ip_address,true);
		$criteria->compare('po_ord_date',$this->po_ord_date,true);
		$criteria->compare('po_ship_date',$this->po_ship_date,true);
		$criteria->compare('po_ord_line_total',$this->po_ord_line_total);
		$criteria->compare('po_ord_tax',$this->po_ord_tax);
		$criteria->compare('po_ord_total_order',$this->po_ord_total_order);
		$criteria->compare('is_deleted',$this->is_deleted);

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
		$this->po_ord_created_by = Yii::app()->user->id;
//		$this->po_ord_created_date = new CDbExpression('NOW()');
	    endif;

	    $this->po_ord_ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
	}
	
	public function afterSave() {
	    if($this->_oldStatus != $this->po_ord_status):
		Myclass::TriggerInvoice($this->po_ord_id,$this->po_ord_status+4);
	    endif;
	    
	    parent::afterSave();
	}
	
	private $_oldStatus;
 
	protected function afterFind()
	{
	    parent::afterFind();
	    $this->_oldStatus=$this->po_ord_status;
	}
	
}