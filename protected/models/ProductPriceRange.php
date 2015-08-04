<?php

/**
 * This is the model class for table "{{product_price_range}}".
 *
 * The followings are the available columns in table '{{product_price_range}}':
 * @property integer $prid
 * @property integer $range_from
 * @property integer $range_to
 * @property integer $created_by
 * @property integer $modified_by
 * @property integer $is_active
 * @property integer $is_deleted
 */
class ProductPriceRange extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductPriceRange the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function scopes()
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		 'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
	     'not_deleted'=>array('condition'=>$alias.'.is_deleted=0'),
	    );
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_price_range}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('range_from, range_to', 'required'),
			array('range_from, range_to, created_by, modified_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prid, range_from, range_to, created_by, modified_by, is_active, is_deleted', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prid' => Myclass::t('Prid'),
			'range_from' => Myclass::t('Range From'),
			'range_to' => Myclass::t('Range To'),
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

		$criteria->compare('prid',$this->prid);
		$criteria->compare('range_from',$this->range_from);
		$criteria->compare('range_to',$this->range_to);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}