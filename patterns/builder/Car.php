<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:37 AM
 */

namespace patterns\builder;

/**
 * Class Car
 * @package patterns\builder
 */
class Car
{
    /**
     * @var string $model
     * @var array $schell
     * @var array $engine
     * @var array $wheels
     * @var array $enterier
     */
    private $model;
    private $schell;
    private $engine;
    private $wheels;
    private $enterier;

    /**
     * @param $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param array $schell
     */
    public function setSchell($schell)
    {
        $this->schell = $schell;
    }

    /**
     * @param array $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * @param array $wheels
     */
    public function setWheels($wheels)
    {
        $this->wheels = $wheels;
    }

    /**
     * @param array $enterier
     */
    public function setEnterier($enterier)
    {
        $this->enterier = $enterier;
    }

}