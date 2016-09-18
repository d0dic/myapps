<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 2:23 PM
 */

namespace patterns\observer;

/**
 * Class NewsChannel
 * @package observer
 */
class NewsChannel
{
    private $listeners;

    /**
     * NewsChannel constructor.
     */
    public function __construct()
    {
        $this->listeners = [];
    }

    /**
     * @param Listener $listener
     */
    public function subscribe(Listener $listener){
        $this->publish('We have a new listener!');
        $this->listeners[] = $listener;
    }

    /**
     * @param $info
     */
    public function publish($info){
        foreach ($this->listeners as $listener) {
            $listener->notify($info);
        }
    }
}