<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 5:58 PM
 */

$GLOBALS['app'] = [
    'name' => 'Framework',
    'params' => require_once 'config/params.php',
];

require_once __DIR__.'/vendor/autoload.php';

require_once 'config/routes.php';

function dump($data){
    echo '<pre>'; var_dump($data);
}

function app(){
    return $GLOBALS['app'];
}

