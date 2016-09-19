<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 8:41 PM
 */

namespace app\classes;

/**
 * Class AppDeployer
 * @package app\classes
 */
abstract class AppDeployer
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * AppDeployer constructor.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @param $destination
     */
    abstract function deploy($destination);

}