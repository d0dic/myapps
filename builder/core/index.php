<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();

/**
 * @return \yii\console\Request|\yii\web\Request
 */
function request(){
    return Yii::$app->request;
}

/**
 * @return \app\components\FacebookComponent
 */
function facebook(){
    return Yii::$app->facebook;
}

/**
 * @return null|\yii\web\IdentityInterface
 */
function user(){
    return Yii::$app->user->identity;
}

// debug functions
function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

# shell_exec('yii migrate');