<?php

/**
 * This is the model class for table "{{vendor_contact}}".
 *
 * The followings are the available columns in table '{{vendor_contact}}':
 * @property integer $ven_con_id
 * @property integer $ven_id
 * @property string $con_name
 * @property string $ven_email
 * @property integer $dept_name
 * @property string $job_title
 * @property string $off_phone
 * @property string $extn
 * @property string $mobile
 * @property integer $is_primary
 * @property integer $cont_created_by
 * @property integer $cont_modified_by
 * @property string $updated_ip_addr
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Vendor $ven
 * @property Department $deptName
 */
class VendorContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VendorContact the static model class
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
		return '{{vendor_contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ven_id, con_name, ven_email,dept_name, job_title', 'required'),
			array('ven_email','email'),
			array('ven_id, dept_name, is_primary, cont_created_by, cont_modified_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('con_name, job_title, off_phone, extn, mobile, cont_created_by,updated_ip_addr', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ven_con_id,same_shipping, ven_id, con_name, dept_name, job_title, off_phone, extn, mobile, is_primary, cont_created_by, cont_modified_by, updated_ip_addr, is_active, is_deleted', 'safe', 'on'=>'search'),
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
			'ven' => array(self::BELONGS_TO, 'Vendor', 'ven_id'),
			'deptName' => array(self::BELONGS_TO, 'Department', 'dept_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ven_con_id' => Myclass::t('Ven Con'),
			'ven_id' => Myclass::t('Ven'),
			'con_name' => Myclass::t('Con Name'),
			'dept_name' => Myclass::t('Dept Name'),
			'job_title' => Myclass::t('Job Title'),
			'ven_email' => Myclass::t('Email'),
			'off_phone' => Myclass::t('Off Phone'),
			'extn' => Myclass::t('Extn'),
			'mobile' => Myclass::t('Mobile'),
			'is_primary' => Myclass::t('Is Primary'),
			'cont_created_by' => Myclass::t('Cont Created By'),
			'cont_modified_by' => Myclass::t('Cont Modified By'),
			'updated_ip_addr' => Myclass::t('Updated Ip Addr'),
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

		$criteria->compare('ven_con_id',$this->ven_con_id);
		$criteria->compare('ven_id',$this->ven_id);
		$criteria->compare('con_name',$this->con_name,true);
		$criteria->compare('dept_name',$this->dept_name);
		$criteria->compare('ven_email',$this->ven_email);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('off_phone',$this->off_phone,true);
		$criteria->compare('extn',$this->extn,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('is_primary',$this->is_primary);
		$criteria->compare('cont_created_by',$this->cont_created_by);
		$criteria->compare('cont_modified_by',$this->cont_modified_by);
		$criteria->compare('updated_ip_addr',$this->updated_ip_addr,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function beforeSave() {
	    if ($this->isNewRecord):
		$this->cont_created_by = Yii::app()->user->id;
	    else:
		$this->cont_modified_by = Yii::app()->user->id;
	    endif;

	    $this->updated_ip_addr	 = CHttpRequest::getUserHostAddress();

	    return parent::beforeSave();
	}
	
	public $namedept;
	
	public function afterFind() {
	    parent::afterFind();
	    $this->namedept = $this->con_name." ( ".$this->deptName->name." )";
	}
}