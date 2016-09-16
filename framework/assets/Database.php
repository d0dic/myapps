<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 10:05 PM
 */

namespace app\assets;

/**
 * Class Database
 * @package app\assets
 */
class Database
{
    private static $connection;

    private function __clone(){}

    private function __construct(){}

    public static function getConnection(){

        if (self::$connection == null) {
            self::$connection = new \PDO(
                "mysql:host=localhost;dbname=test", 'root', 'root');
            // set the PDO error mode to exception
            self::$connection->setAttribute(
                \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }
}