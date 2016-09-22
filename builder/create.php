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

$appGenerator = new AppGenerator();
$appGenerator->build($_POST['appType']);

try{
    $appGenerator->loadParams($_POST);
} catch (Exception $exc){
    die('Loading params error! '.$exc->getMessage());
}

if (!$appGenerator->provide(__DIR__.'/../')) {
    die('Application not generated!');
}

session_start();
$folder = $_POST['dbName'];
$host = $_SERVER['HTTP_HOST'];

$_SESSION['app_link'] = "http://$host/$folder";
header("Location: finish.php");