<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 3:28 PM
 */

namespace patterns\command;

/**
 * Class Command
 * @package patterns\command
 */
abstract class Command
{
    /**
     * @var Robot
     */
    protected $robot;

    /**
     * RunCommand constructor.
     * @param Robot $robot
     */
    public function __construct(Robot $robot)
    {
        $this->robot = $robot;
    }

    /**
     * @return mixed
     */
    abstract function execute();
}