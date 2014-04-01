<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Serayu CMS',

	// preloading 'log' component
	'preload'=>array('log'),
    
        'language'=>"en",
        
	// autoloading model and component classes
	'aliases' => array(
            'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
            'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
            'serayuWidget'=> realpath(__DIR__ . '/../widget'),
        ),
    

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'serayuWidget.*',
                'bootstrap.helpers.TbHtml',
	),
        /*
        'catchAllRequest'=>array(
                                is_dir(realpath(__DIR__ . '/../installation')) ? NULL : "installation",
                            ),
        */
        'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array('bootstrap.gii'),
		),
                'sk' => array(
                        'class'=>'application.modules.komponen.KomponenModule',
                ),
                'administrator'=>array(
                        'class'=>'application.vendor.adminserayu.AdminserayuModule',
                        'modules'=>array(
                            'kom'=>array(
                                'class'=>'application.modules.komponen.KomponenModule',
                                'admin'=>true,
                            )
                        )
                ),
                'installation'=>array(
                    'class'=>'application.modules.installation.InstallationModule',
                ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=serayu_cms',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
            
                'authManager'=>array(
                    'class'=>'CDbAuthManager',
                    'connectionID'=>'db',
                    'assignmentTable'=>'tbl_authAssignment',
                    'itemChildTable'=>'tbl_authItemChild',
                    'itemTable'=>'tbl_authItem',
                ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName' => false,
			'rules'=>array(
                                /*
                                //'<module:sk><controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                                
				'artikel/tag/<tag:.*?>'=>'artikel/index',
                            
				'artikel/kategori/<kategori:.*?>'=>'artikel/index',
                            
                                'artikel/index'=>'artikel/index',
				'artikel/<alias:.*?>'=>array('artikel/view','urlSuffix'=>'.html'),
                            
                                '<alias:.*?>.html'=>'halaman/view',
                                //'<controller:\w+>/<action:\w+>' => 'sk/<controller>/<action>',
                                //'<controller:site>/<action:\w+>'=>'<controller>/<action>',
                                
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                */
                            
                                  // Standar aturan mapping '/' ke action 'site/index' 
                                '' => 'site/index',

                                // sebuah aturan mapping standar '/login' ke 'site/login' dan lainnya 
                                '<action:(login|logout|about)>' => 'site/<action>',
                                '<module:sk><controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                                
				'artikel/tag/<tag:.*?>'=>'artikel/index',
                            
				'artikel/kategori/<kategori:.*?>'=>'artikel/index',
                            
                                'artikel/index'=>'artikel/index',
				'artikel/<alias:.*?>'=>array('artikel/view','urlSuffix'=>'.html'),
                                
                                '<parent:.*?>/<alias:.*?>.html'=>'halaman/view',
                                '<alias:.*?>.html'=>'halaman/view',
                                
                                // Aturan standar untuk menangani 'post/update' dan lainnya
                                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                                
                            
                                
                                
                            
			),
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
                 'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',  
                ),
                'yiiwheels' => array(
                    'class' => 'yiiwheels.YiiWheels',   
                ),
            /*
                'cache'=>array( 
                        'class'=>'system.caching.CDbCache',
                        'connectionID'=>'db',
                    )*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params/params.php'),
);