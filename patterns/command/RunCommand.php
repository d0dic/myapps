<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 3:29 PM
 */

namespace patterns\command;

/**
 * Class RunCommand
 * @package patterns\command
 */
class RunCommand extends Command
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $this->robot->run();
    }
}