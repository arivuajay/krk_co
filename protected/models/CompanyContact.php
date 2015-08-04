<?php

/**
 * This is the model class for table "{{company_contact}}".
 *
 * The followings are the available columns in table '{{company_contact}}':
 * @property integer $contact_id
 * @property string $contact_name
 * @property string $email
 * @property integer $department_id
 * @property string $job_title
 * @property string $office_phone
 * @property string $ext
 * @property string $mobile
 * @property integer $company_id
 * @property integer $primary_contact
 * @property string $created_date
 * @property integer $created_by
 * @property string $ip_address
 * @property string $modified_date
 * @property integer $is_deleted
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property SalesOrder[] $salesOrders
 */
class CompanyContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CompanyContact the static model class
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
		return '{{company_contact}}';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_name,department_id,job_title,email', 'required'),
                        array('ext', 'numerical', 'integerOnly'=>true),
		    
			array('department_id, company_id, primary_contact, created_by, is_deleted, is_active', 'numerical', 'integerOnly'=>true),
			array('job_title', 'length', 'max'=>200),
			
			array('ext', 'length', 'max'=>5),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, department_id,email, job_title, office_phone, ext, mobile, company_id, primary_contact, created_date, created_by, ip_address, modified_date, is_deleted, is_active', 'safe', 'on'=>'search'),
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
			'salesOrders' => array(self::HAS_MANY, 'SalesOrder', 'primary_contact_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contact_id' => Myclass::t('Contact'),
			'department_id' => Myclass::t('Department'),
			'email' => Myclass::t('Email'),
			'job_title' => Myclass::t('Job Title'),
			'office_phone' => Myclass::t('Office Phone'),
			'ext' => Myclass::t('Ext'),
			'mobile' => Myclass::t('Mobile'),
			'company_id' => Myclass::t('Company'),
			'primary_contact' => Myclass::t('Primary Contact'),
			'created_date' => Myclass::t('Created Date'),
			'created_by' => Myclass::t('Created By'),
			'ip_address' => Myclass::t('Ip Address'),
			'modified_date' => Myclass::t('Modified Date'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'is_active' => Myclass::t('Is Active'),
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

		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('email',$this->email);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('primary_contact',$this->primary_contact);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->created_date = new CDbExpression('NOW()');
		$this->created_by = Yii::app()->user->id;
	    endif;
	    
	    if($this->primary_contact):
		$this->model()->updateAll(array('primary_contact'=>'0'),"company_id = '{$this->company_id}'");
	    endif;

	    $this->modified_date = new CDbExpression('NOW()');
	    $this->ip_address = CHttpRequest::getUserHostAddress();
	    
	    return parent::beforeSave();
	}
	
	public $namedept;
	
	public function afterFind() {
	    parent::afterFind();
	    $this->namedept = $this->contact_name." ( ".$this->department->name." )";
	}
	
	
}