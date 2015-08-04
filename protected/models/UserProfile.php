<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property integer $user_profile_id
 * @property integer $user_id
 * @property integer $title
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $phone
 * @property string $mobile
 * @property string $address
 * @property string $modified_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $is_active
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserProfile extends CActiveRecord
{

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getFullName()
	{
	    return $this->first_name . " " . $this->last_name;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title,first_name,last_name,email_address,mobile','required','on'=>'insert,update'),
		   	array('email_address', 'email'),
			array('email_address', 'unique','on'=>'insert'),
			array('email_address', 'checkExists','on'=>'update'),
			array('user_id, title, created_by, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, address', 'length', 'max'=>200),
			array('email_address', 'length', 'max'=>500),
			array('phone, mobile', 'length', 'max'=>20),
			array('phone, mobile', 'numerical','integerOnly'=>true,'message'=>'{attribute} no must be numbers'),
			array('modified_date, created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_profile_id, user_id, title, first_name, last_name, email_address, phone, mobile, address, modified_date, created_by, created_date, is_active, is_deleted', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkExists($attribute)
        {
            $user = UserProfile::model()->find("user_id <> '{$_REQUEST['id']}' AND email_address  = '{$this->email_address}' ");
            //echo $oldPass."<br>".$user->password;exit;
            if(count($user))
            {
                $this->addError($attribute, Yii::t('user','EMAIL_ALREADY_EXISTS_WITH_ANOTHER_ACCOUNT'));
            }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_profile_id' => Myclass::t('User Profile'),
			'user_id' => Myclass::t('User'),
			'title' => Myclass::t('Name'),
			'first_name' => Myclass::t('First Name'),
			'last_name' => Myclass::t('Last Name'),
			'email_address' => Myclass::t('Email Address'),
			'phone' => Myclass::t('Phone'),
			'mobile' => Myclass::t('Mobile'),
			'address' => Myclass::t('Address'),
			'modified_date' => Myclass::t('Modified Date'),
			'created_by' => Myclass::t('Created By'),
			'created_date' => Myclass::t('Created Date'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
		);
	}
	
	public function checkEmail($attribute)
        {
            $msg='';
            $user = User::model()->count('username="'.$this->username.'"');
            
            if($user == 0):
                $msg = "Email doesn't Exists";
                $this->addError($attribute, $msg);
            endif;
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

		$criteria->compare('user_profile_id',$this->user_profile_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}