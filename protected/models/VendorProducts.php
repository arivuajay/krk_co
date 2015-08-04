<?php

/**
 * This is the model class for table "{{vendor_products}}".
 *
 * The followings are the available columns in table '{{vendor_products}}':
 * @property integer $ven_list_id
 * @property integer $ven_id
 * @property integer $ven_prod_id
 * @property double $ven_prod_price
 * @property integer $created_by
 * @property string $updated_ip
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property User $modifiedBy
 * @property User $createdBy
 * @property Product $venProd
 * @property Vendor $ven
 */
class VendorProducts extends CActiveRecord
{
    public $prod_max_price;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VendorProducts the static model class
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
		return '{{vendor_products}}';
	}
	
	public function scopes() {
	   $alias = $this->getTableAlias(false, false);

	   return array(
	       'active'=>array('with'=>'venProd','condition'=>'venProd.is_active=1 AND venProd.is_deleted = 0'),
	       'not_deleted'=>array('with'=>'venProd','condition'=>'venProd.is_deleted = 0'),
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
			array('ven_prod_id, ven_prod_price', 'required'),
			array('ven_id, ven_prod_id, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
//			array('ven_prod_price', 'greaterThanZero','min'=>'0'),
//			array('ven_prod_price', 'greaterThanZero','min'=>'0'),
//			array('ven_prod_price','compare','compareAttribute'=>'prod_max_price','operator'=>'<','allowEmpty'=>false,'message'=>'{attribute} must be less than {compareAttribute}.'),
			array('updated_ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ven_list_id, ven_id, ven_prod_id, ven_prod_price, created_by, updated_ip, is_active, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function greaterThan($attribute,$params)
	{
	    if ($this->$attribute<=$params['min'])
		$this->addError($attribute, 'Assign Price has to be greater than 0');

	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'venProd' => array(self::BELONGS_TO, 'Product', 'ven_prod_id'),
			'venItem' => array(self::BELONGS_TO, 'Items', 'ven_prod_id'),
			'ven' => array(self::BELONGS_TO, 'Vendor', 'ven_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ven_list_id' => Myclass::t('Ven List'),
			'ven_id' => Myclass::t('Ven'),
			'ven_prod_id' => Myclass::t('Ven Prod'),
			'ven_prod_price' => Myclass::t('Ven Prod Price'),
			'created_by' => Myclass::t('Created By'),
			'updated_ip' => Myclass::t('Updated Ip'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
		        'prod_max_price' => Myclass::t('Product Original Price')
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

		$criteria->compare('ven_list_id',$this->ven_list_id);
		$criteria->compare('ven_id',$this->ven_id);
		$criteria->compare('ven_prod_id',$this->ven_prod_id);
		$criteria->compare('ven_prod_price',$this->ven_prod_price);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_ip',$this->updated_ip,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    
	    $this->created_by = Yii::app()->user->id;
	    $this->updated_ip	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
	}
	public $idwithscenario;
	
	public function afterFind() {
	    parent::afterFind();
	    $this->idwithscenario = $this->prod_scenario."_".$this->ven_prod_id;
	}
}