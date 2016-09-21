<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 11:30 PM
 */

require_once 'vendor/autoload.php';

use app\classes\AppGenerator;

if (!$_POST) {
    header('Location: index.php');
}

$app_types = ['default', 'query', 'gallery', 'puzzle'];
$app_params = ['appName', 'appType', 'fbId', 'fbSecret',
    'fbIdTest', 'fbSecretTest', 'fbNamespace', 'fbTestNamespace',
    'dbName', 'dbUsername', 'dbPassword', 'dbHost'
];

foreach ($app_params as $param) {
    if (!isset($_POST[$param])) {
        die("Missing required param {$param}!");
    }
}

if (!in_array($_POST['appType'], $app_types)) {
    die('Application type not implemented!');
}

$appGenerator = new AppGenerator();
$appGenerator->build($_POST['appType']);

$appGenerator->loadParams($_POST);

if ($appGenerator->provide(__DIR__.'/../')) {
    session_start();
    $folder = $_POST['dbName'];
    $host = $_SERVER['HTTP_HOST'];

    $_SESSION['app_link'] = "http://$host/$folder";
    header("Location: finish.php");
} else {
    die('Application not generated!');
}