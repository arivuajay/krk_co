<?php

/**
 * This is the model class for table "{{po_ord_products}}".
 *
 * The followings are the available columns in table '{{po_ord_products}}':
 * @property integer $po_ord_prod_id
 * @property integer $po_ord_id
 * @property integer $product_id
 * @property integer $quantity
 * @property double $vendor_unit_price
 * @property double $item_value
 * @property integer $discounts
 * @property double $netcost
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property VendorProducts $product
 * @property PoOrder $poOrd
 */
class PoOrdProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PoOrdProducts the static model class
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
		return '{{po_ord_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('po_ord_id, product_id, quantity, vendor_unit_price, item_value, discounts, netcost', 'required'),
			array('po_ord_id, product_id, quantity, discounts, is_deleted', 'numerical', 'integerOnly'=>true),
			array('vendor_unit_price, item_value, netcost', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('po_ord_prod_id, po_ord_id, product_id, quantity, vendor_unit_price, item_value, discounts, netcost, is_deleted', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'item' => array(self::BELONGS_TO, 'Items', 'product_id'),
			'poOrd' => array(self::BELONGS_TO, 'PoOrder', 'po_ord_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'po_ord_prod_id' => Myclass::t('Po Ord Prod'),
			'po_ord_id' => Myclass::t('Po Ord'),
			'product_id' => Myclass::t('Product'),
			'quantity' => Myclass::t('Quantity'),
			'vendor_unit_price' => Myclass::t('Vendor Unit Price'),
			'item_value' => Myclass::t('Item Value'),
			'discounts' => Myclass::t('Discounts'),
			'netcost' => Myclass::t('Netcost'),
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

		$criteria->compare('po_ord_prod_id',$this->po_ord_prod_id);
		$criteria->compare('po_ord_id',$this->po_ord_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('prod_scenario',$this->prod_scenario);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('vendor_unit_price',$this->vendor_unit_price);
		$criteria->compare('item_value',$this->item_value);
		$criteria->compare('discounts',$this->discounts);
		$criteria->compare('netcost',$this->netcost);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public $idwithscenario;
	
	public function afterFind() {
	    parent::afterFind();
	    $this->idwithscenario = $this->prod_scenario."_".$this->product_id;
	}
}