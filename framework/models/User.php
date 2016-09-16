<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 9:56 PM
 */

namespace app\models;
use app\assets\Identity;

/**
 * Class User
 * @package app\models
 */
class User extends BaseModel implements Identity
{
    public $id;
    public $role;
    public $name;
    public $surname;
    public $email;
    public $username;
    public $password;
    public $created;

    private $accessToken;

    /**
     * @return mixed
     */
    function table()
    {
        return 'user';
    }

    /**
     * @return mixed
     */
    function rules()
    {
        // TODO: Implement rules() method.
    }

    /**
     * @return mixed
     */
    function attributes()
    {
        return [
            'role', 'name', 'surname', 'email',
            'username', 'password', 'created'
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $data
     * @return mixed
     */
    function create($data)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param null $id
     * @return mixed
     */
    function read($id = null)
    {
        // TODO: Implement read() method.
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->read($this->id);
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return get_class($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}