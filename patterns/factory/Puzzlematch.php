<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:37 AM
 */

namespace patterns\factory;

/**
 * Class Puzzlematch
 * @package factory
 */
class Puzzlematch extends Application
{
    public function create()
    {
        echo get_class($this).' application created!'.PHP_EOL;
    }
}