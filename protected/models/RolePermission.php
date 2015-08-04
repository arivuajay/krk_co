<?php

/**
 * This is the model class for table "{{role_permission}}".
 *
 * The followings are the available columns in table '{{role_permission}}':
 * @property integer $role_perm_id
 * @property integer $role_id
 * @property integer $access_id
 *
 * The followings are the available model relations:
 * @property Access $access
 * @property Role $role
 */
class RolePermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RolePermission the static model class
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
		return '{{role_permission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, access_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('role_perm_id, role_id, access_id', 'safe', 'on'=>'search'),
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
			'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_perm_id' => Myclass::t('Role Perm'),
			'role_id' => Myclass::t('Role'),
			'access_id' => Myclass::t('Access'),
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

		$criteria->compare('role_perm_id',$this->role_perm_id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('access_id',$this->access_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}