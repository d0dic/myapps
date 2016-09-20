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
$appFactory = new FbAppFactory();
$fbApp = $appFactory->create('default');

$fbApp->fbId = '246250632436633';
$fbApp->fbSecret = 'fd8cfcd481455ca12f86792cfc323c6e';
$fbApp->fbIdTest = '246251089103254';
$fbApp->fbSecretTest = '79192a9a2555ff990dc024565248c8fa';

$fbApp->fbNamespace = 'test_app';
$fbApp->fbTestNamespace = 'test_app_loc';

$fbApp->appDatabase = 'test_app';
$fbApp->appFolder = 'test_app';
$fbApp->appName = 'Test App';

$appDeployer = new FbAppDeployer($fbApp);
if ($appDeployer->deploy('../')) {
    echo 'Application successfully deployed!';
}

