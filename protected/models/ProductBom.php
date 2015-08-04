<?php

/**
 * This is the model class for table "{{product_bom}}".
 *
 * The followings are the available columns in table '{{product_bom}}':
 * @property integer $bomid
 * @property integer $product_id
 * @property integer $item_id
 * @property string $item_value
 * @property integer $created_by
 * @property integer $is_active
 * @property integer $is_deleted
 */
class ProductBom extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductBom the static model class
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
		return '{{product_bom}}';
	}

        
        public function scopes() {
	   $alias = $this->getTableAlias(false, false);
	   $uroles = implode(',',array_keys(Yii::app()->user->getState('_login-userrole')));

	   return array(
	       
	       'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
	       'my'=>array('condition'=>$alias.'.created_by = '.Yii::app()->user->id),
	       'not_deleted'=>array('condition'=>$alias.'.is_deleted = 0'),
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
			array('product_id, item_id, item_value, created_by', 'required'),
			array('product_id, item_id, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('item_value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bomid, product_id, item_id, unit_manufacture,item_value, created_by, is_active, is_deleted,unit_manufacture', 'safe'),
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
		    'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bomid' => Myclass::t('Bomid'),
			'product_id' => Myclass::t('Product'),
			'item_id' => Myclass::t('Item'),
			'item_value' => Myclass::t('Item Value'),
			'created_by' => Myclass::t('Created By'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'unit_manufacture' => Myclass::t('Unit of Manufacture'),
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

		$criteria->compare('bomid',$this->bomid);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('item_value',$this->item_value,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('unit_manufacture',$this->unit_manufacture);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


        public function beforeSave() {
	    
		$this->created_by = Yii::app()->user->id;
	    

	    //$this->so_ip_address	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();

	}
}