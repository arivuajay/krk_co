<?php

class SiteModule extends CWebModule {

    public function init() {
        $this->layoutPath = Yii::getPathOfAlias('webroot.themes.' . Yii::app()->theme->name . '.views.layouts');
        $this->layout = '//layouts/main';
    }

    public function beforeControllerAction($controller, $action) {
        Yii::app()->user->loginUrl = array('/site/default/login');
        $exclude_list = array('default/login','default/error', 'default/requestpasswordreset');

        if (parent::beforeControllerAction($controller, $action)) {
            if(in_array("{$controller->id}/{$action->id}",$exclude_list) || UserIdentity::checkAccess())
                return true;
            else
                throw new CHttpException(403, 'You are not authorized to perform this action.');
            // this method is called before any module controller action is performed
            // you may place customized code here
        } else
            return false;
    }

}
