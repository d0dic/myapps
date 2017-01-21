<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:28 AM
 */

namespace patterns\factory;

/**
 * Class Application
 * @package factory
 */
abstract class Application
{
    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->create();
    }

    /**
     * @return mixed
     */
    abstract function create();

    /**
     * @return mixed
     */
    abstract function run();
}