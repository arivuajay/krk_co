<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'KRK',
    // preloading 'log' component
    'preload' => array('log', 'booster'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
    ),
    'modules' => array(
	'site','user',
	// uncomment the following to enable the Gii tool
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'gii123',
	    'generatorPaths' => array('application.gii'),
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('127.0.0.1', '::1'),
	),
    ),
    // application components
    'components' => array(
        'clientScript' => array(
            'packages' => array(
                'jquery' => array(
                    'baseUrl' => '//code.jquery.com/',
                    'js' => array('jquery-1.10.1.min.js', 'jquery-migrate-1.2.1.min.js'),
                ),
            )
        ),
        'booster' => array(
            'class' => 'application.extensions.yiibooster.components.Booster',
            'yiiCss' => false,
            'bootstrapCss' => false
        ),
	'user' => array('allowAutoLogin' => true),
	// uncomment the following to enable URLs in path-format
	'urlManager' => array(
	    'urlFormat' => 'path',
	    'showScriptName' => false,
	    'rules' => require(dirname(__FILE__) . '/urlManager.php'),
	),

	'db' => require_once 'db_config.php',
	'errorHandler' => array(
            'errorAction' => 'site/default/error',
        ),
	'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        )
    ),
    //setting the basic language value
    'params' => require(dirname(__FILE__) . '/params.php'),
    'language' => 'en',
    'defaultController' => 'site/default/login',
    'theme' => 'adminlte',
);
