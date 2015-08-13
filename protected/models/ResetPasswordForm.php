<?php

/**
 * Password reset form
 */
class ResetPasswordForm extends CFormModel
{
    public $password;
    public $confirm_password;

    private $_user;

    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new CHttpException(400, Yii::t('err', 'Password reset token cannot be blank'));
        }
        $this->_user = User::model()->findByAttributes(array('password_reset_token' => $token));
        if (!$this->_user) {
            throw new CHttpException(400, Yii::t('err', 'Wrong password reset token'));
        }
        parent::__construct($config);
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password, confirm_password', 'required'),
            array('password, confirm_password', 'length', 'min' => 6),
            array('confirm_password', 'compare', 'compareAttribute'=>'password'),
            array('password, confirm_password', 'safe'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'password' => 'New Password',
            'confirm_password' => 'Confirm Password',
        );
    }
    
    public function resetPassword()
    {
        $user = $this->_user;
        $user->password_hash = Myclass::encrypt($this->password);
        $user->removePasswordResetToken();

        return $user->save();
    }
}
