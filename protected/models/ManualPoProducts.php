<?php

/**
 * This is the model class for table "{{manual_po_products}}".
 *
 * The followings are the available columns in table '{{manual_po_products}}':
 * @property integer $id
 * @property integer $manual_po_id
 * @property string $product_name
 * @property integer $quantity
 * @property double $price
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property ManualPo $manualPo
 */
class ManualPoProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ManualPoProducts the static model class
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
		return '{{manual_po_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manual_po_id, product_name, quantity, price', 'required'),
			array('manual_po_id, quantity, is_deleted', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('product_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, manual_po_id, product_name, quantity, price, is_deleted', 'safe', 'on'=>'search'),
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
			'manualPo' => array(self::BELONGS_TO, 'ManualPo', 'manual_po_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Myclass::t('ID'),
			'manual_po_id' => Myclass::t('Manual Po'),
			'product_name' => Myclass::t('Product Name'),
			'quantity' => Myclass::t('Quantity'),
			'price' => Myclass::t('Price'),
			'is_deleted' => Myclass::t('Is Deleted'),
                        'product_info' => Myclass::t('Product Info')
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

		$criteria->compare('id',$this->id);
		$criteria->compare('manual_po_id',$this->manual_po_id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('price',$this->price);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}