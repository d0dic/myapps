<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 6:23 PM
 */

$db = require_once 'db.php';
$mail = require_once 'mail.php';

$params = [
    'db' => $db,
    'mail' => $mail,
];

return $params;
