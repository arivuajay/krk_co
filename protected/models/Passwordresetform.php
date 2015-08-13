<?php

class Passwordresetform extends CFormModel {

    const PASSWORDRESETTOKENEXPIRE = 3600; //In seconds
    const VALIDTIME = '1 Hour';
    public $email_id;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email_id', 'required'),
            array('email_id', 'email'),
            array('email_id', 'checkEmail'),
            array('email_id', 'safe'),
        );
    }

    public function checkEmail($attribute, $params) {
        $user = User::model()->findByAttributes(array('email_id' => $this->email_id, 'status' => '1'));
        if(empty($user))
            $this->addError($attribute, 'This Email Id not exists!');
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail() {
        $user = User::model()->findByAttributes(array('email_id' => $this->email_id, 'status' => '1'));

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $mail = new Sendmail;
                $trans_array = array(
                    "{NAME}" => $user->first_name . ' ' . $user->last_name,
                    "{TIME}" => date('Y-m-d h:i:s:A'),
                    "{RESETLINK}" => Yii::app()->createAbsoluteUrl('/site/default/resetpassword', array('token' => $user->password_reset_token)),
                    "{VALID}" => self::VALIDTIME,
                );
                $message = $mail->getMessage('forgotpassword', $trans_array);
                $mail->send($user->email_id, SITENAME . ": Forgot Password", $message);
                return true;
            }
        }

        return false;
    }

}
