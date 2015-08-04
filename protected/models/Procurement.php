<?php

/**
 * This is the model class for table "{{procurement}}".
 *
 * The followings are the available columns in table '{{procurement}}':
 * @property integer $pr_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $edd
 * @property integer $created_by
 * @property integer $created_on
 * @property integer $is_active
 * @property integer $is_deleted
 */
class Procurement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Procurement the static model class
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
		return '{{procurement}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, quantity, edd, created_by, created_on', 'required'),
			array('product_id, quantity, created_by, created_on, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pr_id, product_id, quantity, edd, created_by, created_on, is_active, is_deleted', 'safe', 'on'=>'search'),
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
                    'product' =>array(self::BELONGS_TO,'Product','product_id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pr_id' => Myclass::t('Pr'),
			'product_id' => Myclass::t('Product'),
			'quantity' => Myclass::t('Quantity'),
			'edd' => Myclass::t('Edd'),
			'created_by' => Myclass::t('Created By'),
			'created_on' => Myclass::t('Created On'),
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

		$criteria->compare('pr_id',$this->pr_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('edd',$this->edd,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_on',$this->created_on);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}