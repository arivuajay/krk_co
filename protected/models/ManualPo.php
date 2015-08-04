<?php

/**
 * This is the model class for table "{{manual_po}}".
 *
 * The followings are the available columns in table '{{manual_po}}':
 * @property integer $pay_id
 * @property string $pay_vendor
 * @property string $pay_date
 * @property string $pay_services
 * @property double $pay_amt
 * @property string $pay_description
 * @property integer $pay_status
 */
class ManualPo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ManualPo the static model class
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
		return '{{manual_po}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'active'=>array('condition'=>$alias.'.pay_deleted = 0'),
		'new'=>array('condition'=>$alias.'.pay_status = 0'),
		'past'=>array('condition'=>$alias.'.pay_status = 2'),
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
			array('pay_vendor, pay_date, pay_description', 'required','on'=>'update_man_po_payment,update_man_popup_po_payment'),
			array('pay_amt','required','on'=>'update_man_po_payment,update_man_popup_po_payment','message'=>Myclass::t('Please Add Product Info')),
			array('paid_amt','required','on' => 'update_man_popup_po_payment'),
			array('pay_status', 'numerical', 'integerOnly'=>true),
			array('pay_amt', 'numerical'),
			array('pay_vendor' , 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pay_date,paid_inv_date,past_pay_ref,pay_description,paid_inv_date,past_pay_remarks','safe'),
	    		array('pay_id, pay_vendor, pay_date, pay_amt, pay_description, pay_status', 'safe', 'on'=>'search'),
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
		    'manualPoProducts' => array(self::HAS_MANY, 'ManualPoProducts', 'manual_po_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pay_id' => Myclass::t('Payment ID').' #',
			'pay_vendor' => Myclass::t('Vendor Name'),
			'pay_date' => Myclass::t('Payment Date'),
			'pay_amt' => Myclass::t('PO Amount'),
			'paid_amt' => Myclass::t('Payment Amount'),
			'pay_description' => Myclass::t('Payment Description'),
			'pay_status' => Myclass::t('Payment Status'),
			'po_product' => Myclass::t('PO Products')
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

		$criteria->compare('pay_id',$this->pay_id);
		$criteria->compare('pay_vendor',$this->pay_vendor,true);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('pay_amt',$this->pay_amt);
		$criteria->compare('pay_description',$this->pay_description,true);
		$criteria->compare('pay_status',$this->pay_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}