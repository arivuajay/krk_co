<?php

/**
 * This is the model class for table "{{so_products}}".
 *
 * The followings are the available columns in table '{{so_products}}':
 * @property integer $pid
 * @property integer $so_id
 * @property integer $od_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $quote_price
 * @property integer $order_value
 *
 * The followings are the available model relations:
 * @property Orderdetail $od
 * @property Product $product
 * @property Salesorder $so
 */
class SoProducts extends CActiveRecord
{
    public $soproductlist = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SoProducts the static model class
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
		return '{{so_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('soproductlist', 'valid_so_product_list'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pid, so_id, od_id, product_id, quantity, quote_price, order_value', 'safe', 'on'=>'search'),
		);
	}
	
	public function valid_so_product_list($productlist)
	{
	    
	    if($productlist):
	    $count_prod = count($productlist['product_id']);
		for($i = 0; $i < $count_prod; $i++):
		    if(!empty($productlist['product_id'][$i]))
		    {
			if(empty($productlist['quantity'][$i])) { $this->addError('product_id', Myclass::t('Please Enter Selected Product Quantity')); }
			if(empty($productlist['quote_price'][$i])) { $this->addError('product_id', Myclass::t('Please Enter Selected Product Quote Price')); }
			if(empty($productlist['order_value'][$i])) { $this->addError('product_id', Myclass::t('Please Enter Selected Product Order Value')); }
		    }
		    else
		    {
			$this->addError('product_id', Myclass::t('Please Add Order Product'));
		    }		   
		endfor;
	    else:
		$this->addError('product_id', Myclass::t('Please Add Order Product'));
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
			'orderdetail' => array(self::BELONGS_TO, 'Orderdetail', 'od_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'so' => array(self::BELONGS_TO, 'Salesorder', 'so_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pid' => Myclass::t('Pid'),
			'so_id' => Myclass::t('So'),
			'od_id' => Myclass::t('Od'),
			'product_id' => Myclass::t('Product'),
			'quantity' => Myclass::t('Quantity'),
			'quote_price' => Myclass::t('Quote Price'),
			'order_value' => Myclass::t('Order Value'),
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

		$criteria->compare('pid',$this->pid);
		$criteria->compare('so_id',$this->so_id);
		$criteria->compare('od_id',$this->od_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('quote_price',$this->quote_price);
		$criteria->compare('order_value',$this->order_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}