<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 11:30 PM
 */

require_once 'vendor/autoload.php';

use app\classes\AppGenerator;

session_start();

if (!$_POST) {
    header('Location: index.php');
}

$appGenerator = new AppGenerator();
$appGenerator->build($_POST['appType']);

try{
    $appGenerator->loadParams($_POST);
} catch (Exception $exc){

    $_SESSION['message'] = $exc->getMessage();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (!$appGenerator->provide(__DIR__.'/../')) {
    die('Application not generated!');
}

$folder = $_POST['dbName'];
$host = $_SERVER['HTTP_HOST'];

$_SESSION['app_link'] = "http://$host/$folder";
header("Location: finish.php");