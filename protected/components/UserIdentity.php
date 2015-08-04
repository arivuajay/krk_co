<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        const ERROR_ACCOUNT_BLOCKED = 3;
    	const ERROR_ACCOUNT_DELETED = 4;        
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
		
	public function authenticate()
	{	

                $user=User::model()->find('user_name = :U', array(':U'=>$this->username) );
				
                if($user===null):
                	$this->errorCode=self::ERROR_USERNAME_INVALID;     // Error Code : 1
                else:
                	$is_correct_password = ($user->password!==$user->encrypt($this->password)) ? false : true;

			if ($is_correct_password):
                            $this->errorCode=self::ERROR_NONE; 
			    if($user->is_active == 0):  $this->errorCode = self::ERROR_ACCOUNT_BLOCKED; endif;
			    if($user->is_deleted == 1): $this->errorCode = self::ERROR_ACCOUNT_DELETED; endif;
                        else:
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;   // Error Code : 2
                        endif;
                endif;

                if ($this->errorCode == self::ERROR_NONE):
                
                     $lastLogin = date('Y-m-d H:i:s'); 
                     $user->last_login=$lastLogin;
		     $user->last_login_ip = CHttpRequest::getUserHostAddress();
                     $user->save();
                     $this->_id = $user->user_id;
		     $this->setState('username',$user->user_name);
		     		     

                     
                     $userprofile=UserProfile::model()->find('user_id = :I', array(':I'=>$user->user_id));
		     $user_role = CHtml::listData(UserRole::model()->findAll('user_id ='.$user->user_id), 'user_role_id', 'role_id');
		     
                     $this->setState('profileid',$userprofile->user_profile_id); // For Profile Table Id
                     $this->setState('_login-userrole',$user_role); 

                     $this->setState('umail',$userprofile->email_address); // For Useremail
		     $user_access = CHtml::listData(Myclass::getAccessByRole($user_role), 'access_id', 'access.access_path');

		    $all_access = array();
		    foreach($user_access as $row) $all_access = array_merge($all_access, explode(",", $row)); //Get Relative Paths

		     $default_page = array(
			 '500'=>'/site/index',
			 '501'=>'/settings/default/index',
			 '502'=>'/home/default/index',
			 '503'=>'/message/inbox/inbox',
			 '504'=>'/message/sent/sent',
			 '505'=>'/message/compose/compose',
			 '506'=>'/settings/productprice/index',
			 '507'=>'/settings/productclass/index',
			 '508'=>'/settings/customer/index',
			 '509'=>'/settings/vendor/index',
			 '510'=>'/settings/shipment/index',
			 '511'=>'/home/default/updates',
			 '512'=>'/home/default/tasks'
			 );
		     
		     $user_access = $all_access + $default_page;
		     $this->setState('useraccess',$user_access);
		     $this->setState('uaccess',$userprofile->email_address); // For Useremail
		     
		     if($this->username== 'admin')
			$this->setState('role','admin'); // For Admin
		     
                endif;

                return !$this->errorCode;
        }

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
        {
                return $this->_id;
        }
        
       /*
	 * autoLogin needs only username , 
	 * This is used in User Registration Activation Link
	 * when user Click the activation link , it turns logged in By using  username . 
	 * Only Difference Between authenticate and autologin is Password checking
	*/	
		
	public function autoLogin()
        {
        $user=User::model()->findByAttributes(array('username'=>$this->username,'status'=>1));
//		echo $this->username;exit;
                if($user===null):
                        $this->errorCode=self::ERROR_USERNAME_INVALID;
               
                else:
                  
                    $this->setState('usertype',$user->usertype);
                    $this->setState('username',$user->username);
                    $lastLogin = date('Y-m-d H:i:s'); 
                    $user->lastlogin=$lastLogin;
                    $user->save();
                    $this->_id = $user->id;
                    $this->setState('lastLoginTime', $lastLogin);
                    $this->errorCode=self::ERROR_NONE;
                    
                endif;
        return !$this->errorCode;
      }

}