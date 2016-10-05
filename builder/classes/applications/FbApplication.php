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
        $this->components = ['FacebookComponent.php'];
        $this->migrations = ['m160530_092024_user.php', 'm160530_093021_contact.php',
            'm160530_092744_invite.php', 'm160927_150642_share.php'];

        $this->models = ['User.php', 'Contact.php', 'Invite.php', 'Share.php'];
        $this->controllers = ['FacebookController.php', 'SiteController.php'];
        $this->views = ['site'];
    }

    /**
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @return array
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * @return array
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @return array
     */
    public function getMigrations()
    {
        return $this->migrations;
    }

    /**
     * @return array
     */
    public function getViews()
    {
        return $this->views;
    }

}