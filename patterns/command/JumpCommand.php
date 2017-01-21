<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 4:00 PM
 */

namespace patterns\command;

/**
 * Class JumpCommand
 * @package patterns\command
 */
class JumpCommand extends Command
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $this->robot->jump();
    }
}