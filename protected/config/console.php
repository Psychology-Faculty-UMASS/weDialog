<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(

	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	'name' => 'Wedialog',



	// preloading 'log' component

	'preload'=>array('log'),



	// autoloading model and component classes

	'import'=>array(

		'application.models.*',

		'application.components.*',

        'application.vendors.*',

        //'application.libraries.*',

        //'application.extensions.EScrollableGridView.*',

	),



	//'defaultController'=>'Topics/TopicsList',

    //'defaultController'=>'Site',

    'modules'=>array(

      // uncomment the following to enable the Gii tool

      // Gii tool is to be used during development only.

      // Comment the following in production environment.



      'gii'=>array(

       'class'=>'system.gii.GiiModule',

       'password'=>'gii',

        // If removed, Gii defaults to localhost only. Edit carefully to taste.

       'ipFilters'=>array('*','::1'),

        /*'generatorPaths' => array(

          'bootstrap.gii'

       ),*/

      ),



     ),

		

		

		

		

	// application components

	'components'=>array(

			

			

		'cache'=>array(

            'class'=>'CDbCache',

        ),



		'user'=>array(

			// enable cookie-based authentication

			'allowAutoLogin'=>true,

		),

		/*'db'=>array(

			'connectionString' => 'sqlite:protected/data/blog.db',

			'tablePrefix' => 'tbl_',

		),*/

		// uncomment the following to use a MySQL database

		'db'=>array(

			'connectionString' => 'mysql:host=localhost;dbname=eajpautdkf',

			'emulatePrepare' => true,

			'username' => 'eajpautdkf',

			'password' => 'dZVG34CaxT',

			'charset' => 'utf8',

		),

		'errorHandler'=>array(

			// use 'site/error' action to display errors

			'errorAction'=>'site/error',

		),

		'urlManager'=>array(

			'urlFormat'=>'path',

            'showScriptName'=>false,

			'rules'=>array(

		        //''=>'Topics/TopicsList',

                ''=>'site/loginUser',

                'adminlogin'=>'admin/adminlogin',

                'logout'=>'site/Logout',

                'login'=>'site/Login',

                'post/<id:\d+>/<title:.*?>'=>'post/view',

				'posts/<tag:.*?>'=>'post/index',

				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

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

				array(

					'class'=>'CWebLogRoute',

				),

			),

		),

	),



	// application-level parameters that can be accessed

	// using Yii::app()->params['paramName']

	'params'=>require(dirname(__FILE__).'/params.php'),

);

