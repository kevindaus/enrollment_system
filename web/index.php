<?php
/**
 * admin
 * y14gK38T6JAb7cH
 */

// error_reporting(E_ALL);
// ini_set("display_errors", true);

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/../config/web.php');


(new yii\web\Application($config))->run();
