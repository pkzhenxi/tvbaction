<?php
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log messages
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$base=require('./protected/backend/config/main.php');
$local=require('./protected/config/main-local.php');
$config=CMap::mergeArray($base, $local);
Yii::createWebApplication($config)->run();
