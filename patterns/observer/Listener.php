<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 2:25 PM
 */

namespace patterns\observer;

/**
 * Interface Listener
 * @package observer
 */
interface Listener
{
    /**
     * @param $info
     * @return mixed
     */
    public function notify($info);
}