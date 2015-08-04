<?php

class AlphaController extends Controller
{


    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update','alpha'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
//	public function actionIndex()
//	{
//		$this->render('index');
//	}

        public function actionAlpha(){


            Yii::import('application.extensions.alphapager.ApPagination');

$criteria=new CDbCriteria;
$alphaPages = new ApPagination('name');
// Define the available character set. Here C-X instead of A-Z
$alphaPages->charSet = range('C','X');

$activeCharCriteria=new CDbCriteria;
// Select only the first letter of the attribute used for AlphaPager
$activeCharCriteria->select='DISTINCT(LEFT(`name`,1)) AS `name`';
$chars = Items::model()->findAll($activeCharCriteria);


// Add those characters to an array and assign them to activeCharSet
foreach($chars as $char)
    $activeChars[]=$char->name;
$alphaPages->activeCharSet=$activeChars;

$alphaPages->applyCondition($criteria);

            
            $this->render('view',array(
            'dataProvider'=>$dataProvider,
            'alphaPages'=>$alphaPages,
            ));
            
        }
}