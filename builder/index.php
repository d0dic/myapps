<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:19 AM
 */

require_once 'vendor/autoload.php';

use app\classes\FbAppFactory;
use app\classes\FbAppDeployer;

$appName = 'test_app';
$fbAppFactory = new FbAppFactory();
$fbApplication = $fbAppFactory->create('query');

$fbApplication->fbId = '246250632436633';
$fbApplication->fbSecret = 'fd8cfcd481455ca12f86792cfc323c6e';
$fbApplication->fbIdTest = '246251089103254';
$fbApplication->fbSecretTest = '79192a9a2555ff990dc024565248c8fa';
$fbApplication->fbNamespace = 'test_app';
$fbApplication->fbTestNamespace = 'test_app_loc';

$appDeployer = new FbAppDeployer($fbApplication);
$appDeployer->deploy('../'.__DIR__);

