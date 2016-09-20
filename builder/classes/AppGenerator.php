<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 20-Sep-16
 * Time: 9:41 PM
 */

namespace app\classes;

/**
 * Class AppGenerator
 * @package app\classes
 */
class AppGenerator
{
    /**
     * @var FbApplication
     */
    private $application;

    /**
     * @var FbAppFactory $appFactory
     */
    private $appFactory;

    /**
     * @var FbAppDeployer $appDeployer
     */
    private $appDeployer;

    /**
     * AppGenerator constructor.
     */
    public function __construct()
    {
        $this->appFactory = new FbAppFactory();
    }

    /**
     * @param string $type
     */
    public function build($type)
    {
        $this->application =
            $this->appFactory->create($type);
    }

    /**
     * @param  array $post
     */
    public function loadParams($post){

        $this->application->fbId = $post['fbId'];
        $this->application->fbSecret = $post['fbSecret'];
        $this->application->fbIdTest = $post['fbIdTest'];
        $this->application->fbSecretTest = $post['fbSecretTest'];

        $this->application->fbNamespace = $post['fbNamespace'];
        $this->application->fbTestNamespace = $post['fbTestNamespace'];

        $this->application->appDatabase = $post['appDatabase'];
        $this->application->appFolder = $post['appDatabase'];
        $this->application->appName = $post['appName'];

        $this->appDeployer =
            new FbAppDeployer($this->application);
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function provide($destination)
    {
        return $this->appDeployer->deploy($destination);
    }
}