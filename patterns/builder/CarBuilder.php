<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:29 AM
 */

namespace patterns\builder;

/**
 * Class CarBuilder
 * @package patterns\builder
 */
abstract class CarBuilder
{
    /**
     * @var Car
     */
    protected $car;

    /**
     * @return Car
     */
    public function getCar(){
        return $this->car;
    }

    /**
     * @return mixed
     */
    public function createCar(){
        $this->car = new Car();
    }

    /**
     * @return mixed
     */
    abstract function buildEngine();

    /**
     * @return mixed
     */
    abstract function buildSchell();

    /**
     * @return mixed
     */
    abstract function buildEnterier();

    /**
     * @return mixed
     */
    abstract function buildWheels();
}