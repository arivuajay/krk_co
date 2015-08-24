<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    protected $homeUrl = array('/site/default/index');

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $flashMessages = array();
    public $themeUrl = '';
    public $title = '';

    public function init() {
        parent::init();

        CHtml::$errorSummaryCss = 'alert alert-danger';

        $this->flashMessages = Yii::app()->user->getFlashes();
        $this->themeUrl = Yii::app()->theme->baseUrl;
    }

    public function goHome() {
        $this->redirect($this->homeUrl);
    }

    public function pdfStyles() {
        $theme_path = Yii::getPathOfAlias('webroot.themes.' . Yii::app()->theme->name);
        $stylesheet = file_get_contents($theme_path . '/lib/bs3/css/bootstrap.css');
        $stylesheet .= file_get_contents($theme_path . '/css/font-awesome/css/font-awesome.css');
        $stylesheet .= file_get_contents($theme_path . '/css/AdminLTE.css');
//        $stylesheet .= file_get_contents('http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
        $stylesheet .= file_get_contents($theme_path . '/css/custom.css');
        $stylesheet .= file_get_contents($theme_path . '/css/pdf.css');
        return $stylesheet;
    }

}
