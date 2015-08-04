<?php

class HomeModule extends CWebModule
{
	public function init()
	{
	    if(Yii::app()->user->isGuest):
		CController::redirect(Yii::app()->createAbsoluteUrl('/site/login'));
	    endif;
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'home.models.*',
			'home.components.*',
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
			return true;
		}
		else
			return false;
	}
}
