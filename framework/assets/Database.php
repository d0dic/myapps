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
 * @property \PDO $connection
 */
class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    public $connection;

    private static $instance;

    /**
     * Database constructor.
     */
    private function __construct(){
        $this->initParams();
    }

    /**
     * Initialize DB Connection params
     */
    private function initParams(){

        $this->host = app()['params']['db']['host'];
        $this->dbname = app()['params']['db']['dbname'];
        $this->username = app()['params']['db']['username'];
        $this->password = app()['params']['db']['password'];

        $this->setConnection();
    }

    /**
     * Get DB Connection
     */
    private function setConnection(){
        $this->connection = new \PDO(
            "mysql:host=$this->host;dbname=$this->dbname",
            $this->username, $this->password);

        // set the PDO error mode to exception
        $this->connection->setAttribute(
            \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return Database
     */
    public static function getInstance(){

        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }
}