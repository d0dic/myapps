<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 7:02 PM
 */

namespace app\classes\builders;

use app\classes\applications\FbApplication;

/**
 * Class DefaultBuilder
 * @package app\classes
 */
class DefaultAppBuilder extends FbAppBuilder
{

    /**
     * @return mixed
     */
    function createApp()
    {
        $this->app = new FbApplication('default');
    }

    /**
     * @return mixed
     */
    function buildComponents()
    {
        // TODO: Implement buildComponents() method.
    }

    /**
     * @return mixed
     */
    function buildMigrations()
    {
        // TODO: Implement buildMigrations() method.
    }

    /**
     * @return mixed
     */
    function buildModels()
    {
        $this->app->setModels([
            'UserSearch'
        ]);
    }

    /**
     * @return mixed
     */
    function buildControllers()
    {
        $this->app->setControllers([
            'UserController'
        ]);
    }

    /**
     * @return mixed
     */
    function buildViews()
    {
        $this->app->setViews([
            'user'
        ]);
    }
}