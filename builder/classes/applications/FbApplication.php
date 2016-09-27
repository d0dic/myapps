<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:24 AM
 */

namespace app\classes\applications;

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
 * @property string $appFolder
 * @property string $appName
 */
class FbApplication extends Application
{
    public $fbId;
    public $fbSecret;
    public $fbIdTest;
    public $fbSecretTest;
    public $fbTestNamespace;
    public $fbNamespace;
    public $appFolder;
    public $appName;

    /**
     * Setting initial values
     * @deprecated Sets the initial param values
     */
    public function init(){
        $this->components = ['FacebookComponent'];
        $this->migrations = ['user', 'contact', 'invite', 'share'];

        $this->models = ['User', 'Contact', 'Invite', 'Share'];
        $this->controllers = ['FacebookController', 'SiteController'];
        $this->views = ['site'];
    }

    /**
     * @return mixed
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @return mixed
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * @return mixed
     */
    public function getMigrations()
    {
        return $this->migrations;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

}