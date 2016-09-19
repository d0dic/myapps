<?php

/** TODO Comment this return statement
 * after creating migrations locally
 * */
//    return [
//        'class' => 'yii\db\Connection',
//        'dsn' => 'mysql:host=localhost;dbname=DB_NAME',
//        'username' => 'root', 'password' => 'root',
//        'charset' => 'utf8',
//    ];

// TODO Enter the necessary db params
$host = $_SERVER['HTTP_HOST'];

if ($host == 'www.codeit.loc') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=DB_NAME',
        'username' => 'root', 'password' => 'root',
        'charset' => 'utf8',
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=zadmin_dbname',
        'username' => 'codeitapps', 'password' => 'ga2ama4ap',
        'charset' => 'utf8',
    ];
}
