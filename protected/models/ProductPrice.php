<?php

/**
 * This is the model class for table "{{product_price}}".
 *
 * The followings are the available columns in table '{{product_price}}':
 * @property integer $ppid
 * @property integer $prod_id
 * @property integer $price_range_id
 * @property integer $range_price
 * @property integer $created_by
 * @property integer $modified_by
 * @property integer $is_active
 * @property integer $is_deleted
 */
class ProductPrice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductPrice the static model class
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
		return '{{product_price}}';
	}
	
	 public function scopes()
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0')
	    );
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_range_id,range_price', 'required'),
//                        array('price_range_id,range_price','numerical','min'=>'1'),
			array('prod_id, price_range_id, range_price, created_by, modified_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ppid, prod_id, price_range_id, range_price, created_by, modified_by, is_active, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function validate_by_unique($range_id,$range_array)
	{
	    if (in_array($range_id, $range_array))
	    {
		$dublicate_value = true;
	    }
	    
	    if($dublicate_value) { $this->addError('price_range_id', Myclass::t('Price Range cannot be same value.')); }
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
		    'priceRange' => array(self::BELONGS_TO, 'ProductPriceRange', 'price_range_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ppid' => Myclass::t('Ppid'),
			'prod_id' => Myclass::t('Prod'),
			'price_range_id' => Myclass::t('Price Range'),
			'range_price' => Myclass::t('Price Range'),
			'created_by' => Myclass::t('Created By'),
			'modified_by' => Myclass::t('Modified By'),
			'is_active' => Myclass::t('Is Active'),
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

		$criteria->compare('ppid',$this->ppid);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('price_range_id',$this->price_range_id);
		$criteria->compare('range_price',$this->range_price);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}