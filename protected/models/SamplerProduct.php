<?php

/**
 * This is the model class for table "{{sampler_product}}".
 *
 * The followings are the available columns in table '{{sampler_product}}':
 * @property integer $sam_prod_id
 * @property integer $sam_id
 * @property string $prod_scenario
 * @property integer $prod_id
 * @property integer $qty
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Sampler $sam
 */
class SamplerProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SamplerProduct the static model class
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
		return '{{sampler_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prod_scenario, prod_id, qty', 'required'),
			array('sam_id, prod_id, qty, is_deleted', 'numerical', 'integerOnly'=>true),
			array('prod_scenario', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sam_prod_id, sam_id, prod_scenario, prod_id, qty, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function valid_product_list($productlist)
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
			'sam' => array(self::BELONGS_TO, 'Sampler', 'sam_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'prod_id'),
			'item' => array(self::BELONGS_TO, 'Items', 'prod_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sam_prod_id' => Myclass::t('Sam Prod'),
			'sam_id' => Myclass::t('Sam'),
			'prod_scenario' => Myclass::t('Prod Scenario'),
			'prod_id' => Myclass::t('Prod'),
			'qty' => Myclass::t('Qty'),
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

		$criteria->compare('sam_prod_id',$this->sam_prod_id);
		$criteria->compare('sam_id',$this->sam_id);
		$criteria->compare('prod_scenario',$this->prod_scenario,true);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}