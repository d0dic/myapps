<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 16-Sep-16
 * Time: 12:44 AM
 */

namespace app\assets;

/**
 * Class Session
 * @package app\assets
 */
class Session
{
    private static $user;
    private static $params = [];
    private static $instance;

    /**
     * Disable instantiation
     */
    private function Session(){
        $this->init();
    }

    /**
     * Session start
     */
    private function init(){
        session_start();
    }

    public static function getInstance(){
        if (self::$instance == null) {
            self::$instance = new Session();
        }

        self::$instance->init();
        return self::$instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getParam($name){
        return $_SESSION[$name];
    }

    /**
     * @param $name
     * @param $value
     */
    public function setParam($name, $value){
        $_SESSION[$name] = $value;
    }

    /**
     * @param Identity $user
     * @return bool
     */
    public function loginUser(Identity $user){
        $_SESSION['userIdentity'] = serialize($user);
        return true;
    }

    /**
     * @return mixed
     */
    public function userIdentity(){
        if (isset($_SESSION['userIdentity'])) {
            return unserialize($_SESSION['userIdentity']);
        }
        return false;
    }

    /**
     * @param bool $destroy
     * @return bool
     */
    public function logoutUser($destroy = false){
        $_SESSION['userIdentity'] = null;
        if ($destroy) {
            session_destroy();
        }

        return true;
    }
}