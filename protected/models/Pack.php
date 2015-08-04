<?php

/**
 * This is the model class for table "{{pack}}".
 *
 * The followings are the available columns in table '{{pack}}':
 * @property integer $pack_id
 * @property integer $salesord_id
 * @property integer $product_id
 * @property integer $actual_qty
 * @property integer $pack_qty
 * @property string $box_id
 * @property string $remarks
 * @property string $pack_created_on
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Salesorder $salesord
 */
class Pack extends CActiveRecord
{
     public $force_proceed = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pack the static model class
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
		return '{{pack}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actual_qty,pack_qty','custom_valid_pack','on'=>'save'),
			array('actual_qty, pack_qty','custom_valid_pack_release','on'=>'release'),
			array('salesord_id,box_id,product_id, actual_qty, pack_qty, is_deleted,remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pack_id, salesord_id, product_id, actual_qty, pack_qty, box_id, remarks, pack_created_on, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function custom_valid_pack($attributes)
	{
	    $actual_qty = $this->actual_qty;
	    $pack_qty = $this->pack_qty;
	    foreach($actual_qty as $prod_id => $actual_qty):
		if($pack_qty[$prod_id] > $actual_qty)
		    $this->addError('pack_qty',Yii::t('production','PACKQTY_MAX_ACTUALQTY'));	
	    endforeach;
	}
	
	public function custom_valid_pack_release($attributes)
	{
	    if($this->force_proceed == null):
		$actual_qty = $this->actual_qty;
		$pack_qty = $this->pack_qty;
		$box_id = $this->box_id;
		$remarks = $this->remarks;

		foreach($actual_qty as $prod_id => $actual_qty):
		    if($pack_qty[$prod_id] <> $actual_qty)
			$this->addError('pack_qty',Yii::t('production','PACKQTY_NOT_EQUAL_ACTUALQTY'));	
		endforeach;

		foreach($box_id as $prod_id => $box):
		    if(empty($box))
			$this->addError('pack_qty',Yii::t('production','PALLET_BOX_ID_NOT_EMPTY'));	
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pack_id' => Myclass::t('Pack'),
			'salesord_id' => Myclass::t('Salesord'),
			'product_id' => Myclass::t('Product'),
			'actual_qty' => Myclass::t('Actual Qty'),
			'pack_qty' => Myclass::t('Pack Qty'),
			'box_id' => Myclass::t('Box'),
			'remarks' => Myclass::t('Remarks'),
			'pack_created_on' => Myclass::t('Pack Created On'),
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

		$criteria->compare('pack_id',$this->pack_id);
		$criteria->compare('salesord_id',$this->salesord_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('actual_qty',$this->actual_qty);
		$criteria->compare('pack_qty',$this->pack_qty);
		$criteria->compare('box_id',$this->box_id,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('pack_created_on',$this->pack_created_on,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}