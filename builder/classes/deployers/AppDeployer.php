<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 8:30 PM
 */

namespace app\classes\deployers;
use app\classes\applications\Application;

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
     * @param string $destination
     * @return boolean
     */
    abstract function deployApplication($destination);

    /**
     * @return boolean
     */
    abstract function deployDatabase();

    /**
     * @param string $destination
     */
    protected function deployCore($destination)
    {
        $this->copyFiles('core', $destination);
    }

    /**
     * @param string $destination
     */
    protected function deployMigrations($destination)
    {
        $this->copyFiles($this->application->getRoot().'/migrations',
            $destination.'/migrations');
    }

    /**
     * @param string $destination
     */
    protected function deployModels($destination)
    {
        $this->copyFiles($this->application->getRoot().'/models',
            $destination.'/models');
    }

    /**
     * @param string $destination
     */
    protected function deployControllers($destination)
    {
        $this->copyFiles($this->application->getRoot().'/controllers',
            $destination.'/controllers');
    }

    /**
     * @param string $destination
     */
    protected function deployViews($destination)
    {
        $this->copyFiles($this->application->getRoot().'/views',
            $destination.'/views');
    }

    /**
     * @param string $src
     * @param string $dst
     */
    protected function copyFiles($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->copyFiles($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}