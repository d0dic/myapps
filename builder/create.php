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

session_start();
$appName = $_POST['$appName'];
$host = $_SERVER['HTTP_HOST'];

$appGenerator = new AppGenerator();
$appGenerator->build($_POST['appType']);

$appGenerator->loadParams($_POST);

if ($appGenerator->provide('../')) {
    $_SESSION['app_link'] = "http://$host/$appName";
    header("Location: finish.php");
}