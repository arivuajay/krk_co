<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $product_id
 * @property string $name
 * @property string $sku
 * @property double $weight
 * @property string $description
 * @property integer $product_class_id
 * @property integer $re_order_limit
 * @property string $created_date
 * @property integer $created_by
 * @property string $ip_address
 * @property string $modified_date
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $selcategory
 *
 * The followings are the available model relations:
 * @property ProductClass $productClass
 * @property ProductCategory[] $productCategories
 */
class Product extends CActiveRecord
{
    public $selcategory;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() {
	   $alias = $this->getTableAlias(false, false);

	   return array(

	       'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
//	       'my'=>array('condition'=>$alias.'.created_by = '.Yii::app()->user->id),
	       'not_deleted'=>array('condition'=>$alias.'.is_deleted = 0'),
	   );
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('created_date', 'required'),
			array('name,sku,selcategory,weight,selcategory,product_class_id,re_order_limit,description', 'required'),
			array('sku', 'unique', 'criteria'=>array("condition"=>"is_deleted = '0'")),
			array('product_class_id, re_order_limit, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('sku, ip_address', 'length', 'max'=>20),
			array('description,selcategory, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_id, name, sku, selcategory,weight, description, product_class_id, re_order_limit, created_date, created_by, ip_address, modified_date, is_active, is_deleted', 'safe'),
		);
	}
	
	public function onBeforeValidate(CEvent $event)
        {
	    parent::onBeforeValidate($event);

	    if ($this->selcategory)
	    {  
		    $validator = CValidator::createValidator('unique', $this, 'name',array('criteria'=>array('with'=>'productCat','condition'=>"productCat.category_id='{$this->selcategory}' AND is_active = '1' AND is_deleted = '0'")));
		    $this->getValidatorList()->add($validator);
	    }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'productClass' => array(self::BELONGS_TO, 'ProductClass', 'product_class_id'),
			'productCategories'=>array(self::HAS_MANY, 'ProductCategory', 'product_id'),
			'quoteProducts' => array(self::HAS_MANY, 'QuoteProduct', 'product_id'),
                        'procurement' => array(self::HAS_MANY,'ProductProcurement','prod_id'),
			'AssembleItems' => array(self::HAS_MANY, 'ProductBom', 'product_id'),
                        'productPrice' => array(self::HAS_MANY,'ProductPrice','prod_id','order'=>'price_range_id ASC'),
			'productMinPrice' => array(self::STAT, 'ProductPrice', 'prod_id', 'select'=>'MIN(range_price)'),
			'productMaxPrice' => array(self::STAT, 'ProductPrice', 'prod_id', 'select'=>'MAX(range_price)'),
			'vendorProducts' => array(self::HAS_MANY, 'VendorProducts', 'ven_prod_id'),
			'productImages' => array(self::HAS_MANY, 'ProductImages', 'prod_id'),
			'primary_image' => array(self::STAT,'ProductImages','prod_id','select'=>'prod_image','condition'=>'is_primary=1 AND is_deleted = 0'),
			//For Product cat validation
		        'productCat'=>array(self::HAS_ONE, 'ProductCategory', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => Myclass::t('Product'),
			'name' => Myclass::t('Product Name'),
			'sku' => Myclass::t('SKU').' #',
			'weight' => Myclass::t('Weight'),
			'description' => Myclass::t('Description'),
			'product_class_id' => Myclass::t('Product Class'),
			're_order_limit' => Myclass::t('Re Order Limit'),
			'created_date' => Myclass::t('Created Date'),
			'created_by' => Myclass::t('Created By'),
			'ip_address' => Myclass::t('Ip Address'),
			'modified_date' => Myclass::t('Modified Date'),
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('product_class_id',$this->product_class_id);
		$criteria->compare('re_order_limit',$this->re_order_limit);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function beforeSave() {
	    if ($this->isNewRecord):
		$this->created_date = new CDbExpression('NOW()');
		$this->created_by = Yii::app()->user->id;
	    endif;

	    $this->ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
	}
	
	public $image_path,$idwith_scenario,$name_scenario;
	public function afterFind() {
	    
	    $this->image_path = (empty($this->primary_image)) ? PRO_DEFAULT_IMAGE : $this->primary_image;
	    $this->idwith_scenario = "product_".$this->product_id;
	    $this->name_scenario = "Product => ".ucfirst($this->name);
	    $this->product_amt = $this->productMinPrice;
	    parent::afterFind();
	}
}