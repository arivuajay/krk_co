<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 * @property integer $inv_id
 * @property integer $inv_milestone_id
 * @property integer $inv_so_id
 * @property string $inv_due_date
 * @property string $send_inv_due_date
 * @property double $inv_payment
 * @property integer $inv_status
 * @property string $inv_created_on
 * @property integer $inv_is_active
 * @property integer $inv_is_deleted
 *
 * The followings are the available model relations:
 * @property SalesOrderMilestone $invMilestone
 * @property Salesorder $invSo
 * @property InvoiceRecipient[] $invoiceRecipients
 */
class Invoice extends CActiveRecord
{
    public $sumInv,$mindate;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return '{{invoice}}';
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'invoice'=>array('condition'=>$alias.'.inv_scenario = "salesorder"'),
		'payments'=>array('condition'=>$alias.'.inv_scenario = "poorder"'),
		'active'=>array('condition'=>$alias.'.inv_is_active = 1 AND '.$alias.'.inv_is_deleted = 0'),
		'new'=>array('condition'=>$alias.'.inv_status = 0'),
		'past'=>array('condition'=>$alias.'.inv_status = 1'),
		'paid'=>array('condition'=>$alias.'.inv_status = 2'),
		'indue'=>array('condition'=>$alias.'.inv_status = 0 OR '.$alias.'.inv_status = 1'),
		'sumofinvamount'=>array('select'=>"SUM($alias.inv_payment) as sumInv"),
		'mindate'=>array('select'=>"MIN($alias.inv_created_on) as mindate"),
		
//		'sumofpayamount'=>array('select'=>"SUM($alias.pay_amt) as sumInv")
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
			array('send_inv_due_date,despatch_no','required','on'=>'send_invoice'),
			array('pay_amt,pay_date,past_pay_ref','required','on'=>'update_payment'),
			array('pay_amt,pay_date','required','on'=>'update_po_payment'),
			array('past_pay_ref','required','on'=>'update_po_payment'),
			array('inv_milestone_id, inv_so_id, inv_status, inv_is_active, inv_is_deleted', 'numerical', 'integerOnly'=>true),
			array('inv_payment', 'numerical'),
			array('inv_due_date, past_inv_date,paid_inv_date,send_inv_due_date,inv_created_on,past_pay_remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('inv_id, inv_milestone_id, inv_so_id, inv_due_date,send_inv_due_date, inv_payment, inv_status, inv_created_on, inv_is_active, inv_is_deleted', 'safe', 'on'=>'search'),
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
			'invMilestone' => array(self::BELONGS_TO, 'SalesOrderMilestone', 'inv_milestone_id'),
			'invPOMilestone' => array(self::BELONGS_TO, 'PoOrderMilestone', 'inv_milestone_id'),
			'invSo' => array(self::BELONGS_TO, 'Salesorder', 'inv_so_id'),
			'invPO' => array(self::BELONGS_TO, 'PoOrder', 'inv_so_id'),
			'invoiceRecipients' => array(self::HAS_MANY, 'InvoiceRecipient', 'inv_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'inv_id' => Myclass::t('Invoice ID').' #',
			'inv_milestone_id' => Myclass::t('Milestone'),
			'inv_so_id' => Myclass::t('SO ID').' #',
			'inv_po_id' => Myclass::t('PO ORDER ID'),
			'invoicepo_id'=>Myclass::t('PO ID'),
			'inv_due_date' => Myclass::t('Invoice Due Date'),
			'send_inv_due_date' => Myclass::t('Invoice Due Date'),
			'inv_recipients' => Myclass::t('Invoice Recipients'),
			'inv_payment' => Myclass::t('Invoice Amount'),
			'invoicepo_payment' => Myclass::t('PO Amount'),
			'pay_amt' => Myclass::t('Payment Amount'),
			'pay_date' => Myclass::t('Payment Date'),
			'past_pay_ref' => Myclass::t('Payment Ref').' #',
			'past_pay_remarks' => Myclass::t('Remarks'),
			'inv_status' => Myclass::t('Inv Status'),
			'inv_created_on' => Myclass::t('Inv Created On'),
			'inv_is_active' => Myclass::t('Inv Is Active'),
			'inv_is_deleted' => Myclass::t('Inv Is Deleted'),
			'past_inv_date' => Myclass::t('Sent Invoice On'),
			'paid_inv_date' => Myclass::t('Update Payments On'),
			'despatch_no'   => Myclass::t('Despacho No'),
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

		$criteria->compare('inv_id',$this->inv_id);
		$criteria->compare('inv_milestone_id',$this->inv_milestone_id);
		$criteria->compare('inv_so_id',$this->inv_so_id);
		$criteria->compare('inv_due_date',$this->inv_due_date,true);
		$criteria->compare('send_inv_due_date',$this->send_inv_due_date,true);
		$criteria->compare('inv_payment',$this->inv_payment);
		$criteria->compare('inv_status',$this->inv_status);
		$criteria->compare('inv_created_on',$this->inv_created_on,true);
		$criteria->compare('inv_is_active',$this->inv_is_active);
		$criteria->compare('inv_is_deleted',$this->inv_is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->inv_created_on = new CDbExpression('NOW()');
	    endif;

	    return parent::beforeSave();
                        
	}
}