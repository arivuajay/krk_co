<?php

/**
 * This is the model class for table "{{role}}".
 *
 * The followings are the available columns in table '{{role}}':
 * @property integer $role_id
 * @property string $name
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $ip_address
 * @property string $created_date
 * @property string $modified_date
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property RolePermission[] $rolePermissions
 * @property UserRole[] $userRoles
 */
class Role extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function scopes()
	{
		$alias = $this->getTableAlias(false, false);
		return array(
		 'not_deleted'=>array('condition'=>$alias.'.is_deleted=0'),
		 'active'=>array('condition'=>$alias.'.is_active=1')
		);
	}



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name','required','on'=>'insert'),
			array('name','required'),
			array('name','checkName'),
			array('is_active, is_deleted, created_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('ip_address', 'length', 'max'=>20),
			array('created_date, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('role_id, name, is_active, is_deleted, ip_address, created_date, modified_date, created_by', 'safe', 'on'=>'search'),
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
			'rolePermissions' => array(self::HAS_MANY, 'RolePermission', 'role_id'),
			'userRoles' => array(self::HAS_MANY, 'UserRole', 'role_id'),
		);
	}

	public function checkName($attribute)
	{
		if(empty($this->role_id)) {
			$role = Role::model()->find('name="'.$this->name.'" and is_deleted = 0');
		} else {		
			$role = Role::model()->find('name="'.$this->name.'" and is_deleted = 0 and role_id != '.$this->role_id);
		}
		 
		if(!empty($role)):
			$this->addError($attribute, Yii::t('user','Role Name "'.$this->name.'" has already been taken.'));		
		endif;
	  
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_id' => Myclass::t('Role'),
			'name' => Myclass::t('Role  Name'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'ip_address' => Myclass::t('Ip Address'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
			'created_by' => Myclass::t('Created By'),
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

		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}