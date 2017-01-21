<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 3:30 PM
 */

namespace patterns\command;

/**
 * Class Robot
 * @package command
 */
class Robot
{
    /**
     * Running cmd
     */
    public function run()
    {
        echo 'Robot is running!<br>';
    }

    /**
     * Jumping cmd
     */
    public function jump()
    {
        echo 'Robot is jumping!<br>';
    }
}