<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Mentor',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'giigantic',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
      'generatorPaths'=>array(
          'bootstrap.gii', // since 0.9.1
      ),
		),
	),

	// application components
	'components'=>array(
    'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions,
        // @todo: Uncomment when solved: https://bitbucket.org/Crisu83/yii-bootstrap/issue/122/
        //'responsiveCss'=>true,
    ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		  'class' => 'MWebUser',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
	    /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mentor',
			'emulatePrepare' => true,
			'username' => 'mentor',
			'password' => 'JQYVUCc2GEecSDMB',
			'charset' => 'utf8',
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
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			    
		    array(
		        'class'=>'CWebLogRoute',
		        //
		        // I include *trace* for the
		        // sake of the example, you can include
		        // more levels separated by commas
		        'levels'=>'trace',
		        //
		        // I include *vardump* but you
		        // can include more separated by commas
		        'categories'=>'vardump',
		        //
		        // This is self-explanatory right?
		        'showInFireBug'=>true
		    ),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'email@davidn.de',
	  // Salt string for password encryption
		'salt'=>'dawuha7apHEmepu4usTa',
	),
);