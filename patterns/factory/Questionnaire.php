<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:29 AM
 */

namespace patterns\factory;

/**
 * Class Questionnaire
 * @package factory
 */
class Questionnaire extends Application
{
    public function create()
    {
        echo get_class($this).' application created!'.PHP_EOL;
    }
}