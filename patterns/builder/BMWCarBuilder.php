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
        // TODO: Implement buildEngine() method.
    }

    /**
     * @return mixed
     */
    function buildSchell()
    {
        // TODO: Implement buildSchell() method.
    }

    /**
     * @return mixed
     */
    function buildEnterier()
    {
        // TODO: Implement buildEnterier() method.
    }

    /**
     * @return mixed
     */
    function buildWheels()
    {
        // TODO: Implement buildWheels() method.
    }
}