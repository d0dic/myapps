<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:31 AM
 */

namespace patterns\builder;

/**
 * Class AudiCarBuilder
 * @package patterns\builder
 */
class AudiCarBuilder extends CarBuilder
{
    /**
     * @return mixed
     */
    function buildModel()
    {
        $this->car->setModel('Audi A3');
    }

    /**
     * @return mixed
     */
    function buildEngine()
    {
        $this->car->setEngine(['Diesel', '1.8l', '120hp']);
    }

    /**
     * @return mixed
     */
    function buildSchell()
    {
        $this->car->setSchell(['2x3,5m', 'Blue', 'Iron']);
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
        $this->car->setWheels(['17"', '205/55 R16']);
    }
}