<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 3:42 PM
 */

namespace patterns\command;

/**
 * Class RemoteControl
 * @package patterns\command
 */
class RemoteControl
{
    /**
     * @var Command
     */
    private $command;

    /**
     * @var Robot
     */
    private $robot;

    /**
     * RemoteControl constructor.
     */
    public function __construct()
    {
        $this->robot = new Robot();
    }

    /**
     * @param $type
     */
    public function sendSignal($type)
    {
        switch ($type) {
            case 'run':
                $this->command = new RunCommand($this->robot);
                break;
            case 'jump':
                $this->command = new JumpCommand($this->robot);
                break;

            default:
                die("Signal $type not found in commands!");
        }

        $this->command->execute();
    }
}