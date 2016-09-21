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

        $this->application->appFolder = $post['dbName'];
        $this->application->appName = $post['appName'];

        $this->application->dbHost = $post['dbHost'];
        $this->application->dbUsername = $post['dbUsername'];
        $this->application->dbPassword = $post['dbPassword'];
        $this->application->dbName = $post['dbName'];

        $this->appDeployer =
            new FbAppDeployer($this->application);
    }

    /**
     * @param string $destination
     * @throws \Exception
     * @return boolean
     */
    public function provide($destination)
    {

        if (!$this->appDeployer->deployDatabase()
        ) {
            throw new \Exception('Database not deployed to server!');
        }

        if (!$this->appDeployer->deployApplication($destination)) {
            throw new \Exception('Application not deployed to server!');
        }

        return true;

    }
}