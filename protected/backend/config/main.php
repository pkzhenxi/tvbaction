<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);
$root = dirname($frontend);
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('frontend', $frontend);
Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('bootstrap', $frontend . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>$frontend,
    'name'=>'System Management',
    'charset' => 'UTF-8',
    // preloading 'log' component
    'language' => 'zh_cn',
    'theme' => 'backend',
    'timeZone' => 'Asia/Chongqing',
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'runtimePath' => $backend . '/runtime',
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import'=>array(
        'backend.models.*',
        'backend.components.*',
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
        'ext.Picture',
        'bootstrap.helpers.*',
        'application.modules.user.models.*',
    ),
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
        ),
        'siteconfig',
        'user',
        'auth' => array(
            'strictMode' => true, // when enabled authorization items cannot be assigned children of the same type.
            'userClass' => 'Admin', // the name of the user model class.
            'userIdColumn' => 'id', // the name of the user id column.
            'userNameColumn' => 'username', // the name of the user name column.
            //'defaultLayout' => 'auth.views.layouts.main', // the layout used by the module.
            'defaultLayout' => 'webroot.themes.backend.views.layouts.siteauth', // the layout used by the module.
        ),
        'source',
    ),

    // application components
    'components'=>array(
        'authManager'=>array(
            'class'=>'CDbAuthManager',//认证类名称
            'defaultRoles'=>array('guest'),
            'itemTable'=>'{{authitem}}',
            'itemChildTable' => '{{authitemchild}}',
            'assignmentTable' => '{{authassignment}}',
            'behaviors' => array(
                'auth' => array(
                    'class' => 'auth.components.AuthBehavior',
                ),
            ),
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class' => 'auth.components.AuthWebUser',
            'admins' => array('admin'),
            'stateKeyPrefix' => '__admin',
            'allowAutoLogin'=>true,
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
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
//            'enableCdn' => true,
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

                /*array(
                    'class'=>'CWebLogRoute',
                ),*/
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);