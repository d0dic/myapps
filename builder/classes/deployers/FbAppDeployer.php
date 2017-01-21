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

        $this->deployMigrations($destination);
        $this->deployComponents($destination);

        $this->deployModels($destination);
        $this->deployControllers($destination);
        $this->deployViews($destination);

        return true;
    }

    /**
     * @return boolean
     */
    public function checkSources()
    {
         if(!$this->checkFiles($this->application->getRoot().'/components',
            $this->application->getComponents())){
             return false;
         }

         if(!$this->checkFiles($this->application->getRoot().'/migrations',
             $this->application->getMigrations())){
             return false;
         }

         if(!$this->checkFiles($this->application->getRoot().'/models',
             $this->application->getModels())){
             return false;
         }

         if(!$this->checkFiles($this->application->getRoot().'/controllers',
             $this->application->getControllers())){
             return false;
         }

         if(!$this->checkFiles($this->application->getRoot().'/views',
             $this->application->getViews())) {
             return false;
         }

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

        if (!is_dir($destination)) {
            mkdir($destination);
        }

        $this->createDbFile($destination);
        $this->createConsoleFile($destination);
        $this->createParamsFile($destination);
        $this->createWebFile($destination);

    }

    /**
     * @param string $destination
     */
    private function createDbFile($destination)
    {
        $destination .= 'db.php';

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file $destination! ");

        $contents = '<?php

// TODO Enter the necessary db params
$host = $_SERVER[\'HTTP_HOST\'];

if ($host == \'' . $_SERVER['HTTP_HOST'] . '\') {
    return [
    
        // Local database params
        \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=' . $this->application->dbHost .
            ';dbname=' . $this->application->dbName . '\',
        \'username\' => \'' . $this->application->dbUsername . '\', 
        \'password\' => \'' . $this->application->dbPassword . '\',
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
}';

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
        or die("Unable to open file $destination!");

        $contents = '<?php

$params = require(__DIR__ . \'/params.php\');
$db = [
    \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=' . $this->application->dbHost .
            ';dbname=' . $this->application->dbName . '\',
        \'username\' => \'' . $this->application->dbUsername . '\', 
        \'password\' => \'' . $this->application->dbPassword . '\',
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
        or die("Unable to open file $destination!");

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
if ($host == \'' . $_SERVER['HTTP_HOST'] . '\') {
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

    /**
     * @param $destination
     */
    public function createWebFile($destination)
    {
        $destination .= 'web.php';

        $webFile = fopen($destination, "w")
        or die("Unable to open file $destination!");

        $contents = '<?php

$params = require(__DIR__ . \'/params.php\');

$config = [
    \'id\' => \'basic\',
    \'basePath\' => dirname(__DIR__),
    \'bootstrap\' => [\'log\'],
    \'components\' => [
        \'request\' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            \'cookieValidationKey\' => \'!kljhFvnluierHhc&7sfi13msbdfmnLasdnSS*\',
        ],
        \'cache\' => [
            \'class\' => \'yii\caching\FileCache\',
        ],
        \'user\' => [
            \'identityClass\' => \'app\models\User\',
            \'loginUrl\' => [\'site/index\'],
            \'enableAutoLogin\' => true,
        ],
        \'facebook\' => [
            \'class\' => \'app\components\FacebookComponent\'
        ],
        \'errorHandler\' => [
            \'errorAction\' => \'site/error\',
        ],
        \'mailer\' => [
            \'class\' => \'yii\swiftmailer\Mailer\',
            // send all mails to a file by default. You have to set
            // \'useFileTransport\' to false and configure a transport
            // for the mailer to send real emails.
            \'useFileTransport\' => false,
            \'host\' => \'smtp.gmail.com\',
            \'username\' => \'epostar011\',
            \'password\' => \'lozinka123\',
            \'encryption\' => \'tls\',
            \'port\' => \'587\',
        ],
        \'urlManager\' => [
            \'class\' => \'yii\web\UrlManager\',
            // Disable index.php
            \'showScriptName\' => false,
            // Disable r= routes
            \'enablePrettyUrl\' => true,
            \'rules\' => [],
        ],
        \'log\' => [
            \'traceLevel\' => YII_DEBUG ? 3 : 0,
            \'targets\' => [
                [
                    \'class\' => \'yii\log\FileTarget\',
                    \'levels\' => [\'error\', \'warning\'],
                ],
            ],
        ],
        \'db\' => require(__DIR__ . \'/db.php\'),
    ],
    \'params\' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for \'dev\' environment
    $config[\'bootstrap\'][] = \'debug\';
    $config[\'modules\'][\'debug\'] = [
        \'class\' => \'yii\debug\Module\',
    ];

    $config[\'bootstrap\'][] = \'gii\';
    $config[\'modules\'][\'gii\'] = [
        \'class\' => \'yii\gii\Module\',
    ];
}

return $config;';

        fwrite($webFile, $contents);
        fclose($webFile);
    }
}