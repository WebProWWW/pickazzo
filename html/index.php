<?php

// закомментируйте следующие две строки при использовании в рабочем режиме
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../config/bootstrap.php');

use yii\helpers\ArrayHelper;
use yii\web\Application;

(new Application(ArrayHelper::merge(
    require __DIR__ . '/../config/common.php',
    require __DIR__ . '/../config/web.php',
    require __DIR__ . '/../config/debug.php'
)))->run();
