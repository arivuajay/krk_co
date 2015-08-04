<?php

/**
 * This is the model class for table "{{po_products}}".
 *
 * The followings are the available columns in table '{{po_products}}':
 * @property integer $prod_po_id
 * @property integer $po_id
 * @property integer $prod_id
 * @property integer $quantity
 * @property double $vendor_unit_price
 * @property double $item_value
 * @property double $discounts
 * @property double $net_cost
 * @property varchar prod_scenario
 *
 * The followings are the available model relations:
 * @property Product $prod
 * @property Po $po
 */
class PoProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoProducts the static model class
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
		return '{{po_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prod_id, quantity, vendor_unit_price, item_value, net_cost', 'required'),
			array('po_id, quantity', 'numerical', 'integerOnly'=>true),
			array('vendor_unit_price, vendor_assigned_price,item_value, net_cost', 'numerical'),
			array('discounts,prod_scenario,vendor_assigned_price','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prod_po_id, po_id, prod_id, quantity, vendor_unit_price, item_value, discounts, net_cost', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'prod_id'),
			'item' => array(self::BELONGS_TO, 'Items', 'prod_id'),
			'po' => array(self::BELONGS_TO, 'Po', 'po_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_po_id' => Myclass::t('Prod Po'),
			'po_id' => Myclass::t('Po'),
			'prod_id' => Myclass::t('PO Products'),
			'quantity' => Myclass::t('Quantity'),
			'vendor_unit_price' => Myclass::t('Vendor Unit Price'),
			'item_value' => Myclass::t('Item Value'),
			'discounts' => Myclass::t('Discounts'),
			'net_cost' => Myclass::t('Net Cost'),
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

		$criteria->compare('prod_po_id',$this->prod_po_id);
		$criteria->compare('po_id',$this->po_id);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('vendor_unit_price',$this->vendor_unit_price);
		$criteria->compare('item_value',$this->item_value);
		$criteria->compare('discounts',$this->discounts);
		$criteria->compare('net_cost',$this->net_cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}