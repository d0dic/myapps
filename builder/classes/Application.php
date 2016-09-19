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
abstract class Application
{
    /**
     * @var string $root
     * @var array $models
     * @var array $controllers
     * @var array $migrations
     * @var array $views
     * @var string $core
     */
    protected $root;
    protected $models;
    protected $controllers;
    protected $migrations;
    protected $views;
    protected $core;

    /**
     * Setting initial values
     */
    abstract function init();

    /**
     * Application constructor.
     * @param string $root
     */
    public function __construct($root)
    {
        $this->core = 'yii2';
        $this->root = $root;
        $this->init();
    }

    /**
     * @param array $models
     */
    public function setModels($models)
    {
        $this->models = array_merge($this->models, $models);
    }

    /**
     * @param array $controllers
     */
    public function setControllers($controllers)
    {
        $this->controllers =
            array_merge($this->controllers, $controllers);
    }

    /**
     * @param array $migrations
     */
    public function setMigrations($migrations)
    {
        $this->migrations =
            array_merge($this->migrations, $migrations);
    }

    /**
     * @param array $views
     */
    public function setViews($views)
    {
        $this->views = array_merge($this->views, $views);
    }

}