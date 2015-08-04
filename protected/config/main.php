<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'CTM-ERP',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap','translate'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
	'application.modules.translate.TranslateModule'
    ),
    'aliases' => array(
	'xupload' => 'ext.xupload'
    ),
    'modules' => array(
	'home', 'user', 'settings', 'sales', 'products', 'production', 'finance', 'procurement','translate',
	'message' => array(
	    'userModel' => 'User',
	    'getNameMethod' => 'getFullName',
	    'getSuggestMethod' => 'getSuggest',
	),
	'importcsv' => array(
	    'path' => 'upload/importCsv/', // path to folder for saving csv file and file with import params
	),
	// uncomment the following to enable the Gii tool
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'ctmerp',
	    'generatorPaths' => array('bootstrap.gii'),
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('127.0.0.1', '::1'),
	),
    ),
    // application components
    'components' => array(
	'user' => array('allowAutoLogin' => true),
	'translate'=>array(//if you name your component something else change TranslateModule
            'class'=>'translate.components.MPTranslate',
            //any avaliable options here
            'acceptedLanguages'=>array(
                  'en'=>'English',
                  'es'=>'Spanish'
            ),
        ),
	'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
//	    'responsiveCss'=>true
	    ),
	// uncomment the following to enable URLs in path-format		
	'urlManager' => array(
	    'urlFormat' => 'path',
	    'showScriptName' => false,
	    'rules' => require(dirname(__FILE__) . '/urlManager.php'),
	),
	'db' => require_once 'db_config.php',
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error, warning',
		),
	    // uncomment the following to show log messages on web pages
	    /*
	      array(
	      'class'=>'CWebLogRoute',
	      ),
	     */
	    ),
	),
	'fusioncharts' => array(
	    'class' => 'ext.fusioncharts.fusionCharts',
	),
	//for language translation
	'messages' => array(
	    'class' => 'CDbMessageSource',
	    'sourceMessageTable' => 'lang_sourcemessage',
	    'translatedMessageTable' => 'lang_message',
	    'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
	),
        'ePdf' => array(
                    'class'         => 'ext.yii-pdf.EYiiPdf',
                    'params'        => array(
                        'mpdf'     => array(
                            'librarySourcePath' => 'application.vendors.mpdf.*',
                            'constants'         => array(
                                '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                            ),
                            'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                            'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                                'mode'              => '', //  This parameter specifies the mode of the new document.
                                'format'            => 'A4', // format A4, A5, ...
                                'default_font_size' => 0, // Sets the default document font size in points (pt)
                                'default_font'      => '', // Sets the default font-family for the new document.
                                'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                                'mgr'               => 15, // margin_right
                                'mgt'               => 15, // margin_top
                                'mgb'               => 15, // margin_bottom
                                'mgh'               => 0, // margin_header
                                'mgf'               => 0, // margin_footer
                                'orientation'       => 'P', // landscape or portrait orientation
                            )
                        ),
                        'HTML2PDF' => array(
                            'librarySourcePath' => 'application.vendors.html2pdf.*',
                            'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                            'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                                'orientation' => 'P', // landscape or portrait orientation
                                'format'      => 'A4', // format A4, A5, ...
                                'language'    => 'en', // language: fr, en, it ...
                                'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                                'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                                'marges'      => array(0, 0, 0, 0), // margins by default, in order (left, top, right, bottom)
                            )
                        )
                    ),
            ),
    ),
    //setting the basic language value
    'language' => 'en',
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);