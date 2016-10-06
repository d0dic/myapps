<?php

/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 5:59 PM
 */

namespace app\models;

use app\assets\Database;

/**
 * Class BaseModel
 * @package app\models
 */
abstract class BaseModel
{
    /**
     * @var Database $db_con
     */
    private $db_conn;

    /**
     * BaseModel constructor.
     */
    public function __construct(){}

    /**
     * @return string
     */
    abstract function table();

    /**
     * @return mixed
     */
    abstract function rules();

    /**
     * @return mixed
     */
    abstract function attributes();

    /**
     * @param $id
     * @return mixed
     */
    abstract function delete($id);

    /**
     * @param $data
     * @return mixed
     */
    abstract function create($data);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    abstract function update($id, $data);

    /**
     * @param null $id
     * @return mixed
     */
    abstract function read($id = null);

    /**
     * Return all records from table
     */
    public function readAll()
    {
        return $this->run("SELECT * FROM {$this->table()}")
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return bool
     */
    public function validate(){
        foreach ($this->rules() as $rule){
            if ($rule == null) {
                return false;
            }
        }
        return true;
    }

    /**
     * Execute CRUD operation
     * @param string $query
     * @return mixed
     */
    protected function run($query){
        $this->setConnection();
        return $this->db_conn->query($query);
    }

    /**
     * Database connection setup
     */
    private function setConnection(){
        $this->db_conn =
            Database::getInstance()->connection;
    }
}