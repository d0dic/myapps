<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 2:43 PM
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
     */
    protected $root;
    protected $models;
    protected $controllers;
    protected $migrations;
    protected $views;

    /**
     * FbApplication constructor.
     * @param string $root
     */
    public function __construct($root)
    {
        $this->root = 'apps/'.$root;
        $this->init();
    }

    /**
     * Setting initial values
     */
    abstract function init();

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
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