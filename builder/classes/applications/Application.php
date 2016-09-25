<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 2:43 PM
 */

namespace app\classes\applications;

/**
 * Class Application
 * @package app\classes
 *
 * @property string $dbHost;
 * @property string $dbName;
 * @property string $dbUsername;
 * @property string $dbPassword;
 */
abstract class Application
{
    public $dbHost;
    public $dbName;
    public $dbUsername;
    public $dbPassword;

    /**
     * @var string $root
     * @var array $models
     * @var array $controllers
     * @var array $components
     * @var array $migrations
     * @var array $views
     */
    protected $root;
    protected $models;
    protected $controllers;
    protected $components;
    protected $migrations;
    protected $views;

    /**
     * @var array
     */
    protected $errors;

    /**
     * FbApplication constructor.
     * @param string $root
     */
    public function __construct($root)
    {
        $this->root = 'apps/' . $root;
        $this->errors = [];
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
     * @param array $components
     */
    public function setComponents($components)
    {
        $this->components =
            array_merge($this->components, $components);
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

    /**
     * @return bool
     */
    public function validate()
    {
        $valid = true;
        $properties = get_object_vars($this);

        foreach ($properties as $name => $value) {
            if ($name != 'errors' && $value == null) {
                $this->errors[$name] = 'undefined';
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * @return string
     */
    public function getErrors()
    {
        $errorsString = "";

        foreach ($this->errors as $name => $value) {
            $errorsString .= "$name is $value; ";
        }

        return $errorsString;
    }

}