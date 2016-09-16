<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 7:06 PM
 */

namespace app\assets;

/**
 * Class Router
 * @package app\assets
 */
class Router
{
    private $routes = [];

    /**
     * @param $route
     * @param $controller
     * @param $action
     */
    public function define($route, $controller, $action)
    {
        $this->routes[$route] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * @return mixed
     */
    public function run()
    {
        # dump($_REQUEST); die;

        if (!isset($_REQUEST['route'])) {
            die('Define some routes for start! :)');
        }

        $request = $_REQUEST['route'];

        if (array_key_exists($request, $this->routes)) {

            $route = $this->routes[$request];
            $class = "app\\controllers\\" .
                $route['controller'];

            $ctrl = new $class(); # dump($ctrl); die;

            return $ctrl->$route['action']();
        }

        die('Route does not exist!');
        # dump($this->routes);
    }
}