<?php

class SiteController extends Controller
{
    public function init()
    {
    $this->layout = '//layouts/column1';
    
    }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','forgotpassword'),
				'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('cleancache','index','logout','download'),
				'users'=>array('@'),
		),
		array('deny',  // deny all users
				'users'=>array('*'),
		),    
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->id) {
			$this->redirect(array('/home/default/index'));
		} else {
			$this->redirect(array('/site/login'));
		}
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin($return = null)
	{
		
		if(Yii::app()->user->id) {
			$this->redirect(array('/home/default/index'));	
		}
		$model=new LoginForm;
		$this->layout = '//layouts/login';
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
                   
			$model->attributes=$_POST['LoginForm'];
                        //$model->rememberMe=$_POST['LoginForm']['rememberMe'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()):
			    
//                            if($model->rememberMe == 1){
//
////                              $model->username=$_POST['LoginForm']['username'];
////                              $model->password=$_POST['LoginForm']['password'];exit;
//
//                            }
			    if(isset($return)):
				$ret_url =  str_replace('-','/',$return); 
				$this->redirect(array($ret_url));
			    else:
                               
				$this->redirect(array('/home/default/index'));
			    endif;
			endif;
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('login');
	}
	
	public function actionForgotpassword()
        {
             //$this->layout = 'tb_popup';
		$model = new User('forgotpassword');           
		$this->layout = '//layouts/login';
		
		// collect user input data
                if(isset($_POST['User'])):
                    $model->attributes=$_POST['User'];
		    $user_mail = $_POST['User']['email'];
			// validate user input and redirect to the previous page if valid
		    $valid = $model->validate();
		    
                    if($valid):
                    $userprofile = Userprofile::model()->find('email_address ="'.$user_mail.'"');
		    
		    $model = User::model()->find("user_id = {$userprofile->user_id}");
		    $password = $model->randomPassword('8', '4');
		    $model->password = $model->encrypt($password);
		    $model->save();
		    
                    $loginlink = Yii::app()->createAbsoluteUrl('/site/login');
                    $mail = new Sendmail;

                    $trans_array = array(
                            "{NAME}" => ucwords(strtolower(Myclass::MemberTitles($userprofile->title).$userprofile->first_name." ".$userprofile->last_name)),
                            "{USERNAME}" => $model->user_name,
                            "{USEREPASS}" => $password,
                            "{LOGINLINK}" => $loginlink,
                            );
                    
                    $message= $mail->getMessage('forgotpassword',$trans_array);

                    $Subject = $mail->translate('Reset Password From {SITENAME}');

                    $mail->send($user_mail,$Subject,$message);
                    
                    Yii::app()->user->setFlash('success',Yii::t('user','RESET_PASSWORD'));
                    $this->redirect(array('site/login'));
                    endif;	
                  endif;
					
                $this->render('forgotpassword',array('model'=>$model));	
	}

	public function actionCleancache()
	{
	    $it = new RecursiveDirectoryIterator('assets');
	    $files = new RecursiveIteratorIterator($it,RecursiveIteratorIterator::CHILD_FIRST);
	    foreach($files as $file){
		if ($file->isDir()){
		    rmdir($file->getRealPath());
		} else {
		    unlink($file->getRealPath());
		}
	    }
	    
	    echo 'Cache Cleared';
	}
	
	public function actionDownload($doc)
	{
	    $path = Yii::getPathOfAlias("webroot").'/'.DOWNLOAD_PATH.$doc;
            
            if(file_exists($path))
            {
              return Yii::app()->getRequest()->sendFile($doc, @file_get_contents($path));
            }
	}
}