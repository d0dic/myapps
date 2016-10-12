<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 11:31 AM
 */

namespace patterns\builder;

/**
 * Class MercedesCarBuilder
 * @package patterns\builder
 */
class MercedesCarBuilder extends CarBuilder
{
    /**
     * @return mixed
     */
    function buildModel()
    {
        $this->car->setModel('Mercedes C220');
    }

    /**
     * @return mixed
     */
    function buildEngine()
    {
        $this->car->setEngine(['Diesel', '2.5l', '180hp']);
    }

    /**
     * @return mixed
     */
    function buildSchell()
    {
        $this->car->setSchell(['2x5m', 'Black', 'Iron']);
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
        $this->car->setWheels(['16"', '205/55 R16']);
    }
}