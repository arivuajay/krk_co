<?php

/**
 * This is the model class for table "{{ship}}".
 *
 * The followings are the available columns in table '{{ship}}':
 * @property integer $ship_id
 * @property integer $pack_qty
 * @property integer $ship_mode
 * @property string $carrier_name
 * @property string $crd_date
 * @property string $srd_date
 * @property string $clrd_date
 * @property string $tracking_ref
 * @property string $port_discharge
 * @property string $port_receive
 * @property string $bl_no
 * @property integer $ship_status
 * @property integer $is_deleted
 */
class Ship extends CActiveRecord
{
    public $crd_date = array();
    public $srd_date = array();
    public $clrd_date = array();
     public $force_proceed = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ship the static model class
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
		return '{{ship}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ship_mode','custom_valid_ship_release','on'=>'release'),
			array('pack_qty,carrier_name,port_discharge,port_receive,bl_no,crd_date, srd_date,tracking_ref, clrd_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ship_id, pack_qty, ship_mode, carrier_name, crd_date, srd_date, clrd_date, tracking_ref, port_discharge, port_receive, bl_no, ship_status, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function check_empty($array)
	{
	    foreach($array as $key => $value):
		if(empty($value))
		    $this->addError('ship_id',Yii::t('default','ALL_FIELDS_REQUIRED'));			
	    endforeach;
	}

	public function custom_valid_ship_release()
	{
	    if($this->force_proceed == null):
		$this->check_empty($this->ship_mode);
		$this->check_empty($this->carrier_name);
		$this->check_empty($this->crd_date);
		$this->check_empty($this->srd_date);
		$this->check_empty($this->clrd_date);
		$this->check_empty($this->ship_status);
		$this->check_empty($this->port_discharge);
		$this->check_empty($this->port_receive);
		$this->check_empty($this->bl_no);
	    else:	
		$this->check_status($this->ship_status);
	    endif;
	}
	
	public function check_status($array)
	{
	    foreach($array as $key => $value):
		if(empty($value))
		    $this->addError('ship_id',Yii::t('default','ALL_FIELDS_REQUIRED'));			
	    endforeach;
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
		    'product'  => array(self::BELONGS_TO,'Product', 'prod_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ship_id' => Myclass::t('Ship'),
			'pack_qty' => Myclass::t('Pack Qty'),
			'ship_mode' => Myclass::t('Ship Mode'),
			'carrier_name' => Myclass::t('Carrier Name'),
			'crd_date' => Myclass::t('Crd Date'),
			'srd_date' => Myclass::t('Srd Date'),
			'clrd_date' => Myclass::t('Clrd Date'),
			'tracking_ref' => Myclass::t('Tracking Ref'),
			'port_discharge' => Myclass::t('Port Discharge'),
			'port_receive' => Myclass::t('Port Receive'),
			'bl_no' => Myclass::t('Bl No'),
			'ship_status' => Myclass::t('Ship Status'),
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

		$criteria->compare('ship_id',$this->ship_id);
		$criteria->compare('pack_qty',$this->pack_qty);
		$criteria->compare('ship_mode',$this->ship_mode);
		$criteria->compare('carrier_name',$this->carrier_name,true);
		$criteria->compare('crd_date',$this->crd_date,true);
		$criteria->compare('srd_date',$this->srd_date,true);
		$criteria->compare('clrd_date',$this->clrd_date,true);
		$criteria->compare('tracking_ref',$this->tracking_ref,true);
		$criteria->compare('port_discharge',$this->port_discharge,true);
		$criteria->compare('port_receive',$this->port_receive,true);
		$criteria->compare('bl_no',$this->bl_no,true);
		$criteria->compare('ship_status',$this->ship_status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}