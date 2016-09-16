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
    protected $db_conn;

    /**
     * Database connection setup
     */
    private function init(){
        $this->db_conn =
            Database::getConnection();
    }

    /**
     * Database initialization
     */
    public function BaseModel(){
        $this->init();
    }

    /**
     * @return mixed
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
}