<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 6:07 PM
 */

namespace app\controllers;

abstract class BaseController
{
    /**
     * @var $layout string
     */
    protected $layout;

    /**
     * @return mixed
     */
    abstract function init();

    /**
     * @return mixed
     */
    abstract function actionFilter();

    /**
     * @param $action
     */
    public function redirect($action){
        return header("Location: ?route=$action");
    }

    /**
     * @param $view
     * @param array $variables
     * @return string
     */
    public function render($view, $variables = []) {
        extract($variables);

        ob_start(); include_once "views/$view.php";
        $renderedView = ob_get_clean();
        ob_end_clean();

        echo $renderedView;
    }
}