<?php

class UserModule extends CWebModule
{
	public function init()
	{
	    if(!defined('SITEURL')) define('SITEURL',Yii::app()->getBaseUrl(true));
	    
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
		
	    CHtml::$errorSummaryCss = 'alert alert-error fade in';
            CHtml::$errorMessageCss = 'alert alert-error';
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
		    if (Yii::app()->user->isGuest) CController::redirect('/site/login');
		    
		    return true;
		}
		else
		{
			return false;
		}
	}
}
