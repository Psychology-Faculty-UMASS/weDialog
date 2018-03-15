<?php
// change the following paths if necessary
ini_set('display_errors', '0');
error_reporting( E_ALL & ~E_STRICT & ~E_WARNINGS);
date_default_timezone_set('Europe/Belgrade');

$yii = dirname(__FILE__).'/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',false);
require_once($yii);
Yii::createWebApplication($config)->run();
