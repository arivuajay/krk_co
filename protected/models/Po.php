<?php

/**
 * This is the model class for table "{{po}}".
 *
 * The followings are the available columns in table '{{po}}':
 * @property integer $po_id
 * @property integer $po_ven_id
 * @property string $po_delivery_date
 * @property integer $po_created_by
 * @property integer $po_modified_by
 * @property integer $po_status
 * @property integer $po_approved_by
 * @property string $po_created_on
 * @property string $po_modified_on
 * @property string $po_update_ip
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property User $poApprovedBy
 * @property User $poCreatedBy
 * @property User $poModifiedBy
 * @property Vendor $poVen
 * @property PoProducts[] $poProducts
 */
class Po extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Po the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() {
	   $alias = $this->getTableAlias(false, false);
	   
	   return array(
	       'po_active'=>array('condition'=>$alias.'.po_status >= 0 AND '.$alias.'.is_deleted = 0'),
	       'my'=>array('condition'=>$alias.'.po_created_by = '.Yii::app()->user->id),
	       'not_deleted'=>array('condition'=>$alias.'.is_deleted = 0'),
	   );
	}	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{po}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('po_ven_id', 'required','on'=>'set'),
			array('po_ven_id, po_delivery_date, po_created_by, po_created_on, po_update_ip', 'required','on'=>'create'),
			array('po_ven_id, po_created_by, po_modified_by, po_status, po_approved_by, is_deleted', 'numerical', 'integerOnly'=>true),
			array('po_update_ip', 'length', 'max'=>255),
			array('po_modified_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('po_id, po_ven_id, po_delivery_date, po_created_by, po_modified_by, po_status, po_approved_by, po_created_on, po_modified_on, po_update_ip, is_deleted', 'safe', 'on'=>'search'),
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
			'poApprovedBy' => array(self::BELONGS_TO, 'User', 'po_approved_by'),
			'poCreatedBy' => array(self::BELONGS_TO, 'User', 'po_created_by'),
			'poModifiedBy' => array(self::BELONGS_TO, 'User', 'po_modified_by'),
			'poVen' => array(self::BELONGS_TO, 'Vendor', 'po_ven_id'),
			'poProducts' => array(self::HAS_MANY, 'PoProducts', 'po_id'),
			'poOrders' => array(self::HAS_ONE, 'PoOrder', 'po_id'),
			'poTotalAmt' => array(self::STAT, 'PoProducts', 'po_id','select'=>'SUM(net_cost)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'po_id' => Myclass::t('Po'),
			'po_ven_id' => Myclass::t('Po Ven'),
			'po_delivery_date' => Myclass::t('Expected date of delivery'),
			'po_created_by' => Myclass::t('Po Created By'),
			'po_modified_by' => Myclass::t('Po Modified By'),
			'po_status' => Myclass::t('Po Status'),
			'po_approved_by' => Myclass::t('Po Approved By'),
			'po_created_on' => Myclass::t('Po Created On'),
			'po_modified_on' => Myclass::t('Po Modified On'),
			'po_update_ip' => Myclass::t('Po Update Ip'),
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

		$criteria->compare('po_id',$this->po_id);
		$criteria->compare('po_ven_id',$this->po_ven_id);
		$criteria->compare('po_delivery_date',$this->po_delivery_date,true);
		$criteria->compare('po_created_by',$this->po_created_by);
		$criteria->compare('po_modified_by',$this->po_modified_by);
		$criteria->compare('po_status',$this->po_status);
		$criteria->compare('po_approved_by',$this->po_approved_by);
		$criteria->compare('po_created_on',$this->po_created_on,true);
		$criteria->compare('po_modified_on',$this->po_modified_on,true);
		$criteria->compare('po_update_ip',$this->po_update_ip,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeValidate() {
	    
	    if($this->isNewRecord):
		$this->po_created_by = Yii::app()->user->id;
		$this->po_created_on = new CDbExpression('NOW()');
	    else:	
		$this->po_modified_by = new CDbExpression('NOW()');
		$this->po_modified_on = new CDbExpression('NOW()');
	    endif;
	    
	    $this->po_update_ip = CHttpRequest::getUserHostAddress();
	    
	    return parent::beforeValidate();
	}
}