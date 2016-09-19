<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:20 AM
 */

namespace app\classes;

/**
 * Class AppBuilder
 * @package app\classes
 */
abstract class AppBuilder
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @return Application
     */
    public function getApp(){
        return $this->app;
    }

    /**
     * @return mixed
     */
    abstract function createApp();

    /**
     * @return mixed
     */
    abstract function buildModels();

    /**
     * @return mixed
     */
    abstract function buildControllers();

    /**
     * @return mixed
     */
    abstract function buildMigrations();

    /**
     * @return mixed
     */
    abstract function buildViews();

}