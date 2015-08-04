<?php

/**
 * This is the model class for table "{{product_item}}".
 *
 * The followings are the available columns in table '{{product_item}}':
 * @property integer $prod_item_id
 * @property integer $product_id
 * @property integer $item_id
 * @property integer $item_quantity
 * @property integer $product_quantity
 *
 * The followings are the available model relations:
 * @property Items $item
 */
class ProductItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductItem the static model class
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
		return '{{product_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, item_id, item_quantity, product_quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prod_item_id, product_id, item_id, item_quantity, product_quantity', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Items', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_item_id' => Myclass::t('Prod Item'),
			'product_id' => Myclass::t('Product'),
			'item_id' => Myclass::t('Item'),
			'item_quantity' => Myclass::t('Item Quantity'),
			'product_quantity' => Myclass::t('Product Quantity'),
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

		$criteria->compare('prod_item_id',$this->prod_item_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('item_quantity',$this->item_quantity);
		$criteria->compare('product_quantity',$this->product_quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}