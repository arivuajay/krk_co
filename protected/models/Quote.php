<?php

/**
 * This is the model class for table "{{quote}}".
 *
 * The followings are the available columns in table '{{quote}}':
 * @property integer $quote_id
 * @property integer $company_id
 * @property string $delivery_date
 * @property integer $created_by
 * @property integer $status
 * @property integer $approved_by
 * @property integer $updated_by
 * @property string $created_date
 * @property string $modified_date
 * @property string $ip_address
 * @property integer $is_deleted
 * @property QuoteProduct[] $quoteProducts
 * @property User $approvedBy
 * @property User $createdBy
 * @property Company $company
 * @property QuoteApprove[] $quoteApproves
 * @property QuoteProduct[] $quoteProducts
 */
class Quote extends CActiveRecord
{
   
    public $sumofTotal,$quotemindate;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Quote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() 
	{
	    $alias = $this->getTableAlias(false, false);
	    return array(
		'active'=>array('condition'=>$alias.'.is_deleted = "0"'),
		'confirmed'=>array('condition'=>$alias.'.status > 0'),
                'completed'=>array('condition'=>"$alias.status = '1'"),
                'sumTotal'=>array('with'=>'quoteProducts','select'=>"SUM(quoteProducts.quote_price * quoteProducts.quantity) as sumofTotal"),
		'mindate'=>array('select'=>"MIN($alias.created_date) as quotemindate"),
	    );
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{quote}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id', 'required','on'=>'create,make'),
		    	array('delivery_date', 'required','on'=>'make'),
			array('company_id, created_by, status, approved_by,  is_deleted', 'numerical', 'integerOnly'=>true),
			array('ip_address', 'length', 'max'=>20),
			array('delivery_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('quote_id, company_id, delivery_date, created_by, status, approved_by, created_date, modified_date, ip_address,  is_deleted', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'quoteApproves' => array(self::HAS_MANY, 'QuoteApprove', 'quote_id'),
			'quoteProducts' => array(self::HAS_MANY, 'QuoteProduct', 'quote_id'),
			'approvedBy' => array(self::BELONGS_TO, 'User', 'approved_by'),
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'companyContact' => array(self::BELONGS_TO, 'CompanyContact', 'company_id'),
			'gettotalamt' => array(self::STAT,'QuoteProduct','quote_id','select'=>'SUM(quote_price * quantity)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'quote_id' => Myclass::t('Quote'),
			'company_id' => Myclass::t('Company'),
			'delivery_date' => Myclass::t('Expected Delivery Date'),
			'created_by' => Myclass::t('Created By'),
			'status' => Myclass::t('Status'),
			'approved_by' => Myclass::t('Approved By'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
			'ip_address' => Myclass::t('Ip Address'),
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

		$criteria->compare('quote_id',$this->quote_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('delivery_date',$this->delivery_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('status',$this->status);
		$criteria->compare('approved_by',$this->approved_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->created_date = new CDbExpression('NOW()');
		$this->created_by = Yii::app()->user->id;
	    endif;

	    $this->modified_date = new CDbExpression('NOW()');
	    $this->ip_address	 = CHttpRequest::getUserHostAddress();
	    

	    return parent::beforeSave();
	}
}