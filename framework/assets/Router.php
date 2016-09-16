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
     * @param $name
     * @return string
     */
    public static function create($name){
        return "?route=$name";
    }

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
        $request = 'home';
        if (isset($_REQUEST['route'])) {
            $request = $_REQUEST['route'];
        }

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