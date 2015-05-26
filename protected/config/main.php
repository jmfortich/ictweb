<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ICTWeb',
	'theme'=>'twitter_fluid',

	// preloading 'log' component
	'preload'=>array('log'),
		
	'aliases' => array(
			'bootstrap' => 'ext.bootstrap',
	),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'bootstrap.*',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',			
		'application.modules.user.models.*', //added for yii-user
		'application.modules.user.components.*', //added for yii-user		
		'application.modules.docviewer.models.*',	//added for docviewer module
		'application.modules.statusmsg.models.*',	//added for docviewer module
					
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			//'class' => array('boostrap.gii'),
			'password'=>'hello',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' =>array('ext.mpgii'),
				
		),
		//added for yii-user
		'user' => array(
				'tableUsers' => 'users',
				'tableProfiles' => 'profiles',
				'tableProfileFields' => 'profiles_fields',
		
				'hash' => 'md5', #encryption
				'sendActivationMail' => true, # send activation email
				'loginNotActiv' => false, # allow access for non-activated users
				'activeAfterRegister' => false, # activate user on registration (only sendActivationMail = false)
				'autoLogin' => true, # automatically login from registration
				'registrationUrl' => array('/user/registration'), # registration path
				'recoveryUrl' => array('/user/recovery'), # recovery password path
				'loginUrl' => array('/user/login'), # login form path
				'returnUrl' => array('/site/index'), # page after login
				'returnLogoutUrl' => array('/user/login'), # page after logout,
				'profileRelations'=>array(
						'pos'=>array(CActiveRecord::BELONGS_TO, 'Position', 'pid'),
						'rbranch'=>array(CActiveRecord::BELONGS_TO, 'Branch', 'branchid'),
						'rrole'=>array(CActiveRecord::BELONGS_TO, 'Role', 'roleid'),
						'dept'=>array(CActiveRecord::BELONGS_TO, 'Department', 'deptid'),
						
				),
		),

		'docViewer',
		'statusmsg',

		
	),

	// application components
	'components'=>array(
			
		'session' => array(
				'class' => 'CDbHttpSession',
				'timeout' => 300,
		),
			
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
			'loginUrl' => array('/user/login'),
		),

		'bootstrap' => array(
				'class' => 'bootstrap.components.BsApi'
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
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'filepath'=>Yii::app()->basePath.'/files/',
		'filepath2'=>Yii::app()->basePath.'\\files\\',
	),
);
