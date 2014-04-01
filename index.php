<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/framework/yii.php';

$config = is_dir(dirname(__FILE__).'/installation') 
        ? dirname(__FILE__).'/installation/protected/config/main.php'
        : dirname(__FILE__).'/protected/config/main.php';

//$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();




