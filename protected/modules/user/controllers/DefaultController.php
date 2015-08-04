<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	
	public function init()
	{
	    $this->renderPartial('//layouts/_user_mod_left_menu');
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','changestatus','managerole','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User('insert');
		$profmodel=new UserProfile('insert');
		$Userrolemodel=new UserRole('insert');
		$Userreportingmodel = new UserReporting('insert');		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			//Bind Values
			$model->attributes=$_POST['User'];
			$profmodel->attributes=$_POST['UserProfile'];
			$Userrolemodel->attributes=$_POST['UserRole'];
			$Userreportingmodel->attributes=$_POST['UserReporting'];

			//Validate All Model
			$valid = $model->validate();
			$valid = $profmodel->validate() && $valid;
			$valid = $Userrolemodel->validate() && $valid;
			$valid = $Userreportingmodel->validate() && $valid;
			
			if($valid):
			    $password = $model->randomPassword(6,4);
			    $model->password = $model->encrypt($password);
			    $model->created_by = @Yii::app()->user->id;
			    $model->registered_ip = CHttpRequest::getUserHostAddress();
			    $model->save(false);

			    //User Profile Store    
			    $profmodel->user_id = $model->user_id;
			    $profmodel->created_by = @Yii::app()->user->id;
			    $profmodel->save(false);
			    
			    //Set User Role in User_role_model
			    foreach($Userrolemodel->role_id as $roles):
				$Userrolemodel=new UserRole('insert');
				$Userrolemodel->user_id = $model->user_id;
				$Userrolemodel->role_id = $roles;
				$Userrolemodel->save();
			    endforeach;
			    //Set User Reporting in tbl
			    
			    if(!empty($Userreportingmodel->reporting_user_id)):
				foreach($Userreportingmodel->reporting_user_id as $reporter):
				    $Userreportingmodel = new UserReporting('insert');
				    $Userreportingmodel->user_id = $model->user_id;
				    $Userreportingmodel->reporting_user_id = $reporter;
				    $Userreportingmodel->save();
				endforeach;
			    endif;
			//Register Mail    
                        $mail = new Sendmail();
			$nextstep_url  = Yii::app()->createAbsoluteUrl('/site/login');
			$subject = Yii::t( 'user', 'REGISTER_MAIL_SUBJECT',array('{site_name}'=>Yii::app()->name));

                        $trans_array = array(
                                "{NAME}" => ucwords(strtolower(trim($profmodel->first_name." ".$profmodel->last_name))),
                                "{USERNAME}" => $model->user_name,
                                "{USEREPASS}" => $password,
                                "{NEXTSTEPURL}" => $nextstep_url,
                                );
                        
			$message= $mail->getMessage('registration',$trans_array);

			$mail->send($profmodel->email_address,$subject,$message);

			//Yii::app()->user->setFlash('success',Yii::t('user','REGISTRATION_COMPLTE',array('{name}'=>ucwords(strtolower(trim($profmodel->first_name." ".$profmodel->last_name))))));
			Yii::app()->user->setFlash('success',Yii::t('user','REGISTRATION_COMPLTE'));

			$this->redirect(array('index'));
			endif;
			
			
		}
		$this->data = compact('model','profmodel','Userrolemodel','Userreportingmodel');
		$this->render('create',$this->data);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$profmodel = UserProfile::model()->find('user_id='.$model->user_id);
		$Userrolemodel = new UserRole('update');
		$Userreportingmodel = new UserReporting('update');
		
		$model->scenario = 'update';
		$profmodel->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			//Bind Values
			$model->attributes = $_POST['User'];
			$profmodel->attributes = $_POST['UserProfile'];
			$Userrolemodel->attributes = $_POST['UserRole'];
			$Userreportingmodel->attributes = $_POST['UserReporting'];
			$Userrolemodel->role_id =  array_filter($Userrolemodel->attributes['role_id']);
			
			//Validate All Model
			$valid = $model->validate();
			$valid = $profmodel->validate() && $valid;
			$valid = $Userrolemodel->validate() && $valid;
			$valid = $Userreportingmodel->validate() && $valid;
			
			if($valid):
			    
			    if(!empty($_POST['User']['password'])) $model->password = $model->encrypt($_POST['User']['password']);
			    
			    $model->save(false);
			    $profmodel->save(false);
			    
			    UserRole::model()->deleteAll('user_id='.$model->user_id);
			    //Set User Role in User_role_model
			    foreach($Userrolemodel->role_id as $roles):
				$Userrolemodel=new UserRole('update');
				$Userrolemodel->user_id = $model->user_id;
				$Userrolemodel->role_id = $roles;
				$Userrolemodel->save();
			    endforeach;
			    //Set User Reporting in tbl
			    UserReporting::model()->deleteAll('user_id='.$model->user_id);
			    if(!empty($Userreportingmodel->reporting_user_id)):
				foreach($Userreportingmodel->reporting_user_id as $reporter):
				    $Userreportingmodel = new UserReporting('insert');
				    $Userreportingmodel->user_id = $model->user_id;
				    $Userreportingmodel->reporting_user_id = $reporter;
				    $Userreportingmodel->save();
				endforeach;
			    endif;
			    Yii::app()->user->setFlash('success',Yii::t('user','USER_UPDATED'));
			    $this->redirect(array('index'));
			endif;
		}
		$this->data = compact('model','profmodel','Userrolemodel','Userreportingmodel');
		$this->render('update',$this->data);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		User::model()->updateByPk($id, array('is_deleted' => '1'));
		UserProfile::model()->updateAll(array('is_deleted'=>1),'user_id = '.$id);
		UserReporting::model()->updateAll(array('is_deleted'=>1),'user_id = '.$id);
		UserRole::model()->updateAll(array('is_deleted'=>1),'user_id = '.$id);


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $users = User::model()->findAll();
	    $this->render('index',array('users'=>$users));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 *
	 * Change the category status i.e active to inactive and vice versa
	 * @param int $id
	 */
	public function actionChangestatus($id)
	{
		$model= User::model()->findByPk($id);
		$model->is_active=($model->is_active)?0:1;
		$model->save(false);
		Yii::app()->user->setFlash('success',Yii::t('user','USER_STAUS_UPDATED'));		
		$this->redirect(array('index'));
	}
	
	/**
	 *
	 * Change the category status i.e active to inactive and vice versa
	 * @param int $id
	 */
	public function actionManagerole()
	{
		$model = new Role();
		$accessmodel = Access::model()->active()->findAll();
		if(isset($_POST['Role'])):
		    $model->attributes = $_POST['Role'];
		    
		    if($model->validate()):
			if(isset($_POST['role_perm']) && !empty($_POST['role_perm'])):		    
			    $permissions = @array_filter($_POST['role_perm']);
			    RolePermission::model()->deleteAll('role_id='.$model->name);
			    if(!empty($permissions)):
				foreach($permissions as $val):
				    $permmodel = new RolePermission(); 
				    $permmodel->role_id  = $model->name;
				    $permmodel->access_id  = $val;
				    $permmodel->save(false);
				endforeach;
			    endif;
			    Yii::app()->user->setFlash('success',Yii::t('user','MANAGE_ROLE_UPDATED'));
			    $this->redirect(array('managerole','role_id'=>$model->name));
			else:
			    $model->adderror('name',  Yii::t('user','ACCESS_ROLE_CANNOT_BE_EMPTY'));
			endif;    
		    endif;
		endif;
		$this->render('manage_role',array('model'=>$model,'accessmodel'=>$accessmodel));
	}
}
