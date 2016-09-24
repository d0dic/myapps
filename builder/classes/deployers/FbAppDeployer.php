<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 8:41 PM
 */

namespace app\classes\deployers;
use app\classes\applications\FbApplication;

/**
 * Class FbAppDeployer
 * @package app\classes
 */
class FbAppDeployer extends AppDeployer
{
    /**
     * FbAppDeployer constructor.
     * @param FbApplication $application
     */
    public function __construct(FbApplication $application)
    {
        $this->application = $application;
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function deployApplication($destination)
    {
        $destination .=
            $this->application->appFolder;

        $this->deployCore($destination);
        $this->deployConfig($destination);

        $this->deployModels($destination);
        $this->deployMigrations($destination);
        $this->deployControllers($destination);
        $this->deployViews($destination);

        return true;
    }

    /**
     * @return boolean
     */
    public function deployDatabase()
    {
        $dbcon = new \PDO("mysql:host={$this->application->dbHost}",
            $this->application->dbUsername, $this->application->dbPassword);
        $dbcon->exec("CREATE DATABASE {$this->application->dbName} 
            DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        return true;
    }
    
    /**
     * @param string $destination
     */
    private function deployConfig($destination)
    {
        $destination .= '/config/';

        $this->createDbFile($destination);
        $this->createConsoleFile($destination);
        $this->createParamsFile($destination);

    }

    /**
     * @param string $destination
     */
    private function createDbFile($destination)
    {
        $destination .= 'db.php';

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

// TODO Enter the necessary db params
$host = $_SERVER[\'HTTP_HOST\'];

if ($host == \''.$_SERVER['HTTP_HOST'].'\') {
    return [
    
        // Local database params
        \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host='.$this->application->dbHost.
            ';dbname=' . $this->application->dbName . '\',
        \'username\' => \''.$this->application->dbUsername.'\', 
        \'password\' => \''.$this->application->dbPassword.'\',
        \'charset\' => \'utf8\',
    ];
} else {
    return [
    
        // Production database params
        \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=HOST;dbname=DATABASE\',
        \'username\' => \'USERNAME\', 
        \'password\' => \'PASSWORD\',
        \'charset\' => \'utf8\',
    ];
}
';

        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

    /**
     * @param string $destination
     */
    private function createConsoleFile($destination)
    {
        $destination .= 'console.php';

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

$params = require(__DIR__ . \'/params.php\');
$db = [
    \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host='.$this->application->dbHost.
            ';dbname=' . $this->application->dbName . '\',
        \'username\' => \''.$this->application->dbUsername.'\', 
        \'password\' => \''.$this->application->dbPassword.'\',
        \'charset\' => \'utf8\',
    ];

$config = [
    \'id\' => \'basic-console\',
    \'basePath\' => dirname(__DIR__),
    \'bootstrap\' => [\'log\'],
    \'controllerNamespace\' => \'app\commands\',
    \'components\' => [
        \'cache\' => [
            \'class\' => \'yii\caching\FileCache\',
        ],
        \'log\' => [
            \'targets\' => [
                [
                    \'class\' => \'yii\log\FileTarget\',
                    \'levels\' => [\'error\', \'warning\'],
                ],
            ],
        ],
        \'db\' => $db,
    ],
    \'params\' => $params,
    /*
    \'controllerMap\' => [
        \'fixture\' => [ // Fixture generation command line.
            \'class\' => \'yii\faker\FixtureController\',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for \'dev\' environment
    $config[\'bootstrap\'][] = \'gii\';
    $config[\'modules\'][\'gii\'] = [
        \'class\' => \'yii\gii\Module\',
    ];
}

return $config;';


        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

    /**
     * @param string $destination
     */
    private function createParamsFile($destination)
    {
        $destination .= 'params.php';

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

$host = $_SERVER[\'HTTP_HOST\'];

// TODO Enter the necessary app params
$params = [

    // app author params
    \'adminEmail\'    => \'milos_dodic@live.com\',

    // application params
    \'app_name\'    => \'' . $this->application->appName . '\',
    \'fbLogin_url\'  => "https://$host/' . $this->application->appFolder . '/site/login"
];

// TODO Enter the necessary fb params
if ($host == \''.$_SERVER['HTTP_HOST'].'\') {
    $params = array_merge($params,[

        // facebook test app params
        \'fb_app_id\'     => \'' . $this->application->fbIdTest . '\',
        \'fb_app_secret\' => \'' . $this->application->fbSecretTest . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/'
            . $this->application->fbTestNamespace . '/site/home"
    ]);
} else {
    $params = array_merge($params,[

        // facebook live app params
        \'fb_app_id\'     => \'' . $this->application->fbId . '\',
        \'fb_app_secret\' => \'' . $this->application->fbSecret . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/'
            . $this->application->fbNamespace . '/site/home"
    ]);
}

return $params;';

        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

}