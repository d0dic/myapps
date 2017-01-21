<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:30 AM
 */

namespace patterns\builder;

/**
 * Class BMWCarBuilder
 * @package patterns\builder
 */
class BMWCarBuilder extends CarBuilder
{
    /**
     * @return mixed
     */
    function buildModel()
    {
        $this->car->setModel("BMW E46");
    }

    /**
     * @return mixed
     */
    function buildEngine()
    {
        $this->car->setEngine(['Diesel', '2.0l', '150hp']);
    }

    /**
     * @return mixed
     */
    function buildSchell()
    {
        $this->car->setSchell(['2x4,5m', 'Gray', 'Iron']);
    }

    /**
     * @return mixed
     */
    function buildEnterier()
    {
        $this->car->setEnterier(['Leather', 'Black']);
    }

    /**
     * @return mixed
     */
    function buildWheels()
    {
        $this->car->setWheels(['17"', '215/55 R17']);
    }
}