<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 2:30 PM
 */

namespace patterns\observer;

/**
 * Class RadioListener
 * @package observer
 */
class RadioListener implements Listener
{
    /**
     * @param $info
     * @return mixed
     */
    public function notify($info)
    {
        echo get_class($this)." -> Info from news channel: $info".PHP_EOL;
    }
}