<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	public $data = array();
	public $flash_message = '';
	public $baseURL;

        
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $menu2=array();
	public $menu3=array();
	public $menu4=array();
	public $menu5=array();
	public $menuclass = null;
	public $menu2class = null;
	public $menu3class = null;
	public $menu4class = null;
	public $menu5class = null;
	public $hiddenpath = null;	//For Update mode enable menu
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init()
	{
		parent::init();
		
		$app = Yii::app();
		if (isset($_POST['_lang']))
		{
			$app->language = $_POST['_lang'];
			$app->session['_lang'] = $app->language;
		}
		else if (isset($app->session['_lang']))
		{
			$app->language = $app->session['_lang'];
		}
		
	    $this->baseURL = Yii::app()->getBaseUrl(true);
	    CHtml::$errorSummaryCss = 'alert alert-error fade in';
            CHtml::$errorMessageCss = 'alert alert-error';
	}
	
	public function checkAccess()
	{
	    return true;
	}
	
        public  function getDatePicker($name,$model,$value,$showOn= "both")
        {
	    $format = 'yy-mm-dd';
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,   // model object
                'attribute'=>$name,
                'options'=>array('autoSize'=>true,
                    'minDate'=>0,
		    'dateFormat'=>$format,
                    'mode'=>'date',
//                    'defaultDate'=>$model->$name,
                    'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
                    'buttomImageOnly'=>false,
                    'showOn'=>$showOn,
                    'changeMonth'=>true,
                    'changeYear'=>true,
                    'htmlOptions'=>array('readonly'=>"readonly",'value'=>$value),
                )
           ));
        }

}