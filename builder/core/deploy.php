<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 28-Sep-16
 * Time: 4:03 PM
 */

set_time_limit(0);
shell_exec('composer install');
unlink('deploy.php');

session_start();
$_SESSION['deployed'] = true;

if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' .
        $_SERVER['HTTP_REFERER']);
}

header('Location: /finish.php');

?>