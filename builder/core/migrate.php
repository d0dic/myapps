<?php
/**
 * Created by PhpStorm.
 * User: d0dic
 * Date: 9.9.17.
 * Time: 14.37
 */

set_time_limit(0);
shell_exec('php yii migrate y');
unlink('migrate.php');

session_start();
$_SESSION['migrated'] = true;

header('Location: /finish.php');

?>