<?php

/**
 * This is the model class for table "{{stock}}".
 *
 * The followings are the available columns in table '{{stock}}':
 * @property integer $stock_id
 * @property integer $prod_id
 * @property integer $total_stock
 * @property integer $available_stock
 */
class Stock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return '{{stock}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('available_stock','required'),
			array('prod_id, available_stock', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('stock_id, prod_id, available_stock', 'safe'),
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
			'stock_id' => Myclass::t('Stock'),
			'prod_id' => Myclass::t('Prod'),
			'available_stock' => Myclass::t('Available Stock'),
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

		$criteria->compare('stock_id',$this->stock_id);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('available_stock',$this->available_stock);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}