<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 10:08 PM
 */

namespace app\classes;

/**
 * Class FbApplication
 * @package app\classes
 *
 * @property string $fbId
 * @property string $fbSecret
 * @property string $fbIdTest
 * @property string $fbSecretTest
 * @property string $fbTestNamespace
 * @property string $fbNamespace
 */
class FbApplication extends Application
{
    public $fbId;
    public $fbSecret;
    public $fbIdTest;
    public $fbSecretTest;
    public $fbTestNamespace;
    public $fbNamespace;

    /**
     * Setting initial values
     * @deprecated
     */
    public function init(){
        $this->models = ['User', 'Contact', 'Invite'];
        $this->controllers = ['FacebookController', 'SiteController'];
        $this->migrations = ['user', 'contact', 'invite'];
        $this->views = ['site'];
    }
    
}