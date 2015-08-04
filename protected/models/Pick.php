<?php

/**
 * This is the model class for table "{{pick}}".
 *
 * The followings are the available columns in table '{{pick}}':
 * @property integer $pick_id
 * @property integer $salesord_id
 * @property integer $product_id
 * @property integer $actual_qty
 * @property integer $pick_qty
 * @property string $pick_created_on
 * @property string $pick_modified_on
 * @property integer $pick_status
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Salesorder $salesord
 */
class Pick extends CActiveRecord
{
    public $force_proceed = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pick the static model class
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
		return '{{pick}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('salesord_id,', 'required'),
			array('actual_qty, pick_qty','custom_valid_pick','on'=>'save'),
			array('actual_qty, pick_qty','custom_valid_pick_release','on'=>'release'),
//			array('salesord_id, product_id, actual_qty, pick_qty, pick_status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('product_class', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pick_id, salesord_id, product_id, actual_qty, pick_qty, pick_created_on, pick_modified_on, pick_status, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function custom_valid_pick($attributes)
	{
	    $actual_qty = $this->actual_qty;
	    $pick_qty = $this->pick_qty;

	    foreach($actual_qty as $key=>$actual):
		$prod_id = key($actual);
		$actual_qty = $actual[$prod_id];
		
		if($pick_qty[$key][$prod_id] > $actual_qty)
		    $this->addError('pick_qty',Yii::t('production','PICKQTY_MAX_ACTUALQTY'));	
	    endforeach;
	}
	
	public function custom_valid_pick_release($attributes)
	{
	    if($this->force_proceed == null):
		$actual_qty = $this->actual_qty;
		$pick_qty = $this->pick_qty;

		foreach($actual_qty as $key=>$actual):
		$prod_id = key($actual);
		$actual_qty = $actual[$prod_id];
		    if($pick_qty[$key][$prod_id] != $actual_qty):
			$this->addError('pick_qty',Yii::t('production',$pick_qty[$key][$prod_id]."-".$actual_qty.'PICKQTY_NOT_EQUAL_ACTUALQTY'));	
		    endif;
		endforeach;
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
			'salesord' => array(self::BELONGS_TO, 'Salesorder', 'salesord_id'),
			'product'  => array(self::BELONGS_TO,'Product', 'product_id'),
			'item'  => array(self::BELONGS_TO,'Items', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pick_id' => Myclass::t('Pick'),
			'salesord_id' => Myclass::t('Salesord'),
			'product_id' => Myclass::t('Product'),
			'actual_qty' => Myclass::t('Actual Qty'),
			'pick_qty' => Myclass::t('Pick Qty'),
			'pick_created_on' => Myclass::t('Pick Created On'),
			'pick_modified_on' => Myclass::t('Pick Modified On'),
			'pick_status' => Myclass::t('Pick Status'),
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

		$criteria->compare('pick_id',$this->pick_id);
		$criteria->compare('salesord_id',$this->salesord_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('actual_qty',$this->actual_qty);
		$criteria->compare('pick_qty',$this->pick_qty);
		$criteria->compare('pick_created_on',$this->pick_created_on,true);
		$criteria->compare('pick_modified_on',$this->pick_modified_on,true);
		$criteria->compare('pick_status',$this->pick_status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
