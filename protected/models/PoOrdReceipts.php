<?php

/**
 * This is the model class for table "{{po_ord_receipts}}".
 *
 * The followings are the available columns in table '{{po_ord_receipts}}':
 * @property integer $po_receipt_id
 * @property integer $po_ord_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $ship_mode
 * @property string $carrier_name
 * @property string $crd_date
 * @property string $srd_date
 * @property string $ctmd_date
 * @property string $tracking_ref
 * @property string $port_discharge
 * @property string $port_receive
 * @property string $bl_no
 * @property integer $po_receipt_status
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property PoOrder $poOrd
 * @property Product $product
 */
class PoOrdReceipts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoOrdReceipts the static model class
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
		return '{{po_ord_receipts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('po_ord_id, product_id, quantity, ship_mode, carrier_name, crd_date, srd_date, ctmd_date, tracking_ref, port_discharge, port_receive, bl_no, po_receipt_status', 'required'),
			array('po_ord_id, quantity, ship_mode, po_receipt_status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('carrier_name, tracking_ref, port_discharge, port_receive, bl_no', 'length', 'max'=>255),
			array('product_id','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('po_receipt_id, po_ord_id, product_id, quantity, ship_mode, carrier_name, crd_date, srd_date, ctmd_date, tracking_ref, port_discharge, port_receive, bl_no, po_receipt_status, is_deleted', 'safe', 'on'=>'search'),
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
			'poOrd' => array(self::BELONGS_TO, 'PoOrder', 'po_ord_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'item' => array(self::BELONGS_TO, 'Items', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'po_receipt_id' => Myclass::t('Po Receipt'),
			'po_ord_id' => Myclass::t('Po Ord'),
			'product_id' => Myclass::t('Product'),
			'quantity' => Myclass::t('Quantity'),
			'ship_mode' => Myclass::t('Ship Mode'),
			'carrier_name' => Myclass::t('Carrier Name'),
			'crd_date' => Myclass::t('Crd Date'),
			'srd_date' => Myclass::t('Srd Date'),
			'ctmd_date' => Myclass::t('Ctmd Date'),
			'tracking_ref' => Myclass::t('Tracking Ref'),
			'port_discharge' => Myclass::t('Port Discharge'),
			'port_receive' => Myclass::t('Port Receive'),
			'bl_no' => Myclass::t('Bl No'),
			'po_receipt_status' => Myclass::t('Po Receipt Status'),
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

		$criteria->compare('po_receipt_id',$this->po_receipt_id);
		$criteria->compare('po_ord_id',$this->po_ord_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('ship_mode',$this->ship_mode);
		$criteria->compare('carrier_name',$this->carrier_name,true);
		$criteria->compare('crd_date',$this->crd_date,true);
		$criteria->compare('srd_date',$this->srd_date,true);
		$criteria->compare('ctmd_date',$this->ctmd_date,true);
		$criteria->compare('tracking_ref',$this->tracking_ref,true);
		$criteria->compare('port_discharge',$this->port_discharge,true);
		$criteria->compare('port_receive',$this->port_receive,true);
		$criteria->compare('bl_no',$this->bl_no,true);
		$criteria->compare('po_receipt_status',$this->po_receipt_status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind() {
	    parent::afterFind();
		if($this->crd_date == '0000-00-00') $this->crd_date = '';
		if($this->srd_date == '0000-00-00') $this->srd_date = '';
		if($this->ctmd_date == '0000-00-00') $this->ctmd_date = '';
	}
}