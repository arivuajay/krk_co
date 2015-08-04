<?php

/**
 * This is the model class for table "{{orderdetail}}".
 *
 * The followings are the available columns in table '{{orderdetail}}':
 * @property integer $od_id
 * @property string $order_date
 * @property string $shipment_date
 * @property string $product_name
 * @property integer $quantity
 * @property integer $unit_price
 * @property integer $order_value
 * @property integer $total_order_value
 */
class Orderdetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orderdetail the static model class
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
		return '{{orderdetail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_date,so_id, shipment_date,line_total,tax, total_order_value', 'required'),
			array('line_total,total_order_value', 'numerical', 'min'=>1 ,'tooSmall'=>'Please Add Order Product'),
			array('so_id', 'numerical', 'integerOnly'=>true),
			array('line_total, tax, total_order_value', 'numerical'),
			array('order_date, shipment_date', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('od_id,so_id, order_date, shipment_date, line_total,tax, total_order_value', 'safe'),
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
                    'soproducts' => array(self::BELONGS_TO, 'SoProducts', 'od_id'),
                    'salesorder' => array(self::BELONGS_TO, 'Salesorder', 'so_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'od_id' => Myclass::t('Od'),
                        'so_id'=>Myclass::t('So id'),
			'order_date' => Myclass::t('Order Date'),
			'shipment_date' => Myclass::t('Shipment Date'),
			'line_total' => Myclass::t('Line Total'),
			'tax' => Myclass::t('Tax'),
			'total_order_value' => Myclass::t('Total Order Value'),
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

		$criteria->compare('od_id',$this->od_id);
		$criteria->compare('so_id',$this->so_id);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('shipment_date',$this->shipment_date,true);
		
		$criteria->compare('line_total',$this->line_total);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('total_order_value',$this->total_order_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}