<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 22-Sep-16
 * Time: 3:35 PM
 */

namespace app\classes\factories;

/**
 * Class AppFactory
 * @package app\classes
 */
abstract class AppFactory
{
    /**
     * @param $type
     * @return mixed
     */
    abstract function create($type);
}