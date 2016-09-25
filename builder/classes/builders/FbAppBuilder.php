<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:20 AM
 */

namespace app\classes\builders;

use app\classes\applications\FbApplication;

/**
 * Class FbAppBuilder
 * @package app\classes
 */
abstract class FbAppBuilder
{
    /**
     * @var FbApplication
     */
    protected $app;

    /**
     * @return FbApplication
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
    abstract function buildComponents();

    /**
     * @return mixed
     */
    abstract function buildMigrations();

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
    abstract function buildViews();

}