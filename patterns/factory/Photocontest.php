<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:41 AM
 */

namespace patterns\factory;

/**
 * Class Photocontest
 * @package factory
 */
class Photocontest extends Application
{
    function create()
    {
        echo get_class($this).' application created!'.PHP_EOL;
    }

    /**
     * @return mixed
     */
    function run()
    {
        echo get_class($this).' application is running!'.PHP_EOL;
    }
}