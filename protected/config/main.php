<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme'=>'classic',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Welcome to Hasgeek',

	// preloading 'log' component
	'preload'=>array('bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.facebook.php',
        'application.helpers.*',
	),

	'modules'=>array(

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'install',
			'generatorPaths'=>array(
				'bootstrap.gii'
			),
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
		),
	),

	// application components
	'components'=>array(
	'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		'coreCss' => true,
		'responsiveCss' => true,
	),

	'mail' => array(
      	'class' => 'ext.yii-mail.YiiMail',
      	'transportType' => 'smtp',
      	'transportOptions'=>array(
     		'host'=>'smtp.googlemail.com',
      		'encryption'=>'ssl', // use ssl
      		'username'=>'jonnychinna@gmail.com',
      		'password'=>'suraish5600',
      		'port'=>465, // ssl port for gmail
     	 ),
      'viewPath' => 'application.views.mail',
      'logging' => true,
      'dryRun' => false
   ),
		
		'user'=>array(		
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			//'loginUrl'=>array('kprofile/site/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		//'db'=>array(
			//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		//),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=geek',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	/*'params'=>array(
		// this is used in contact page
		'adminEmail'=>'k2labpassrecovery@gmail.com',
	),*/
	'params'=>require(dirname(__FILE__).'/params.php'),
);
