<?php

/**
 * This is the model class for table "{{quote_product}}".
 *
 * The followings are the available columns in table '{{quote_product}}':
 * @property integer $prod_quote_id
 * @property integer $quote_id
 * @property integer $product_id
 * @property integer $quantity
 * @property double $quote_price
 * @property string $remarks
  * @property Quote $quote
 */
class QuoteProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuoteProduct the static model class
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
		return '{{quote_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quote_price, quantity','custom_valid','on'=>'insert'),
			//array('quote_id, product_id, quantity', 'numerical', 'integerOnly'=>true),
			//array('quote_price', 'numerical'),
			array('remarks,order_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prod_quote_id,remarks, quote_id, product_id, quantity, quote_price, remarks,order_value', 'safe'),
		);
	}
	
	public function custom_valid($attributes)
	{
	    $product_count = count($_SESSION['add_quote']);
	    $price_count = count(array_filter($this->quote_price));
	    $qty_count = count(array_filter($this->quantity));

	    if(($product_count != $price_count)):
		$this->addError('quote_price',Yii::t('sales','QUOTE_PRICE_CANNOT_EMPTY'));		
	    elseif($product_count != $qty_count):
		$this->addError('quantity',Yii::t('sales','QUOTE_QUANTITY_CANNOT_EMPTY'));
	    endif;
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
		    'quote' => array(self::BELONGS_TO, 'Quote', 'quote_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_quote_id' => Myclass::t('Prod Quote'),
			'quote_id' => Myclass::t('Quote'),
			'product_id' => Myclass::t('Product'),
			'quantity' => Myclass::t('Quantity'),
			'quote_price' => Myclass::t('Quote Price'),
			'order_value' => Myclass::t('Order value'),
			'remarks' => Myclass::t('Remarks'),
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

		$criteria->compare('prod_quote_id',$this->prod_quote_id);
		$criteria->compare('quote_id',$this->quote_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('quote_price',$this->quote_price);
		$criteria->compare('order_value',$this->order_value);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
}