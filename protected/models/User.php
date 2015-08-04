<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $user_id
 * @property string $user_name
 * @property string $password
 * @property integer $created_by
 * @property string $created_date
 * @property string $modified_date
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $last_login
 * @property string $registered_ip
 * @property string $last_login_ip
 *
 * The followings are the available model relations:
 * @property QuoteApprove $quoteApprove
 * @property UserDepartment[] $userDepartments
 * @property UserProfile[] $userProfiles
 * @property UserReporting[] $userReportings
 * @property UserReporting[] $userReportings1
 * @property UserRole[] $userRoles
 */
class User extends CActiveRecord
{
    public $email;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes() {
	   $alias = $this->getTableAlias(false, false);

	   return array(
	       'active'=>array('condition'=>$alias.'.is_active=1 AND '.$alias.'.is_deleted = 0'),
	   );
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name', 'required','on'=>'insert'),
			array('user_name', 'length','min'=>6,'on'=>'insert'),
			array('user_name', 'unique','on'=>'insert','message'=>'{attribute} has Already Taken'),
		    	
			array('email', 'required','on'=>'forgotpassword'),
			array('email', 'email'),
                        array('email', 'checkEmail','on'=>'forgotpassword'),

			array('modified_date, last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, password, created_by, created_date, modified_date, is_active, is_deleted, last_login, registered_ip, last_login_ip', 'safe', 'on'=>'search'),
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
			'quoteApprove' => array(self::HAS_ONE, 'QuoteApprove', 'quote_approve_id'),
			'userDepartments' => array(self::HAS_MANY, 'UserDepartment', 'user_id'),
			'userProfiles' => array(self::BELONGS_TO, 'UserProfile', 'user_id'),
			'userReportings' => array(self::HAS_MANY, 'UserReporting', 'user_id'),
			'userRoles' => array(self::HAS_MANY, 'UserRole', 'user_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => Myclass::t('User'),
			'user_name' => Myclass::t('User Name'),
			'password' => Myclass::t('Password'),
			'created_by' => Myclass::t('Created By'),
			'created_date' => Myclass::t('Created Date'),
			'modified_date' => Myclass::t('Modified Date'),
			'is_active' => Myclass::t('Is Active'),
			'is_deleted' => Myclass::t('Is Deleted'),
			'last_login' => Myclass::t('Last Login'),
			'registered_ip' => Myclass::t('Registered Ip'),
			'last_login_ip' => Myclass::t('Last Login Ip'),
			'email' => Myclass::t('Email Address')
		);
	}
	
 // class User
    public function getFullName() {
        $userid = $this->user_id;
		$userprofile = UserProfile::model()->find("user_id= :user_id",array("user_id"=>$userid));
		$username = $userprofie->first_name." ".$userprofile->last_name;
		
		return $username;
		
    }

    public function getSuggest($q) {
    	$c = new CDbCriteria();
    	$c->addSearchCondition('email_address', $q, true, 'OR');
    	$c->addSearchCondition('first_name', $q, true, 'OR');
	$c->addSearchCondition('last_name', $q, true, 'OR');
    	return UserProfile::model()->findAll($c);
    }
	
	public function checkEmail($attribute)
        {
            $user = UserProfile::model()->find('email_address="'.$this->email.'"');
	    $usertbl = User::model()->findByPk($user->user_id);

	    if(empty($user)):
                $this->addError($attribute, Yii::t('user','EMAIL_NOT_EXISTS'));
	    else:
		if($usertbl->is_active=='0'):
		    $this->addError($attribute,Yii::t('user', 'ACCOUNT_DEACTIVATE'));		    
		endif;
		if($usertbl->is_deleted=='1'):
		    $this->addError($attribute, Yii::t('user','ACCOUNT_DELETED'));		    
		endif;	
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('registered_ip',$this->registered_ip,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function encrypt($value)
        {
            return hash("sha512",$value);
        }
        
        public function randomPassword($length=8, $strength=0)
        {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEI";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
        }
	
	public $fullname;
	public function afterFind() {
	    parent::afterFind();
	    $this->fullname = $this->userProfiles->first_name." ".$this->userProfiles->last_name;
	}
}