<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 11:24 AM
 */

namespace app\classes;

/**
 * Class Application
 * @package app\classes
 */
class Application
{
    /**
     * @var string $root
     * @var array $models
     * @var array $controllers
     * @var array $migrations
     * @var array $views
     * @var string $core
     */
    private $root;
    private $models;
    private $controllers;
    private $migrations;
    private $views;
    private $core;

    /**
     * Application constructor.
     * @param string $root
     */
    public function __construct($root)
    {
        $this->core = 'Yii 2.0 PHP Framework';
        $this->root = $root;
    }

    /**
     * @param array $models
     */
    public function setModels($models)
    {
        $this->models = $models;
    }

    /**
     * @param array $controllers
     */
    public function setControllers($controllers)
    {
        $this->controllers = $controllers;
    }

    /**
     * @param array $migrations
     */
    public function setMigrations($migrations)
    {
        $this->migrations = $migrations;
    }

    /**
     * @param array $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @param $destination
     */
    public function deploy($destination){
        echo "Application will be deployed to: "
            .__DIR__."../../$destination";
    }

}