<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 7:02 PM
 */

namespace app\classes;

/**
 * Class DefaultBuilder
 * @package app\classes
 */
class DefaultBuilder extends AppBuilder
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
    function buildModels()
    {
        // TODO: Implement buildModels() method.
    }

    /**
     * @return mixed
     */
    function buildControllers()
    {
        // TODO: Implement buildControllers() method.
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
    function buildViews()
    {
        // TODO: Implement buildViews() method.
    }
}