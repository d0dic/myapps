<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:19 AM
 */

require_once 'vendor/autoload.php';

use app\classes\AppFactory;

$appFactory = new AppFactory();
$application = $appFactory->create('query');
$application->deploy('query');

echo '<pre>'; var_dump($application);