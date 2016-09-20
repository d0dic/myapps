<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 8:41 PM
 */

namespace app\classes;

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
    public function deploy($destination)
    {
        $destination .=
            $this->application->appFolder;

        $this->deployCore($destination);
        $this->deployConfig($destination);

        $this->deployModels($destination);
        $this->deployMigrations($destination);
        $this->deployControllers($destination);
        $this->deployViews($destination);

        $this->createDatabase(
            $this->application->appDatabase);

        return true;
    }
    
    /**
     * @param string $destination
     */
    private function deployConfig($destination)
    {
        $destination .= '/config/';

        $this->createDbFile($destination.'db.php',
            $this->application->appDatabase);
        $this->createConsoleFile($destination.'console.php',
            $this->application->appDatabase);
        $this->createParamsFile($destination.'params.php',
            $this->application->appName, $this->application->appFolder);

    }

    /**
     * @param string $destination
     * @param string $db_name
     */
    private function createDbFile($destination, $db_name)
    {

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

// TODO Enter the necessary db params
$host = $_SERVER[\'HTTP_HOST\'];

if ($host == \'www.codeit.loc\') {
    return [
        \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=localhost;dbname=' . $db_name . '\',
        \'username\' => \'root\', \'password\' => \'root\',
        \'charset\' => \'utf8\',
    ];
} else {
    return [
        \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=localhost;dbname=zadmin_dbname\',
        \'username\' => \'codeitapps\', \'password\' => \'ga2ama4ap\',
        \'charset\' => \'utf8\',
    ];
}
';

        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

    /**
     * @param string $destination
     * @param string $db_name
     */
    private function createConsoleFile($destination, $db_name)
    {
        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

$params = require(__DIR__ . \'/params.php\');
$db = [
    \'class\' => \'yii\db\Connection\',
        \'dsn\' => \'mysql:host=localhost;dbname=' . $db_name . '\',
        \'username\' => \'root\', \'password\' => \'root\',
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
     * @param string $app_name
     * @param string $app_root
     */
    private function createParamsFile($destination, $app_name, $app_root)
    {

        $paramsFile = fopen($destination, "w")
        or die("Unable to open file!");

        $contents = '<?php

$host = $_SERVER[\'HTTP_HOST\'];

// TODO Enter the necessary app params
$params = [

    // app author params
    \'adminEmail\'    => \'milos_dodic@live.com\',

    // application params
    \'app_name\'    => \'' . $app_name . '\',
    \'fbLogin_url\'  => "https://$host/' . $app_root . '/site/login"
];

// TODO Enter the necessary fb params
if ($host == \'www.codeit.loc\') {
    $params = array_merge($params,[

        // facebook test app params
        \'fb_app_id\'     => \'' . $this->application->fbIdTest . '\',
        \'fb_app_secret\' => \'' . $this->application->fbSecretTest . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/' . $app_root . '_loc/site/home"
    ]);
} else {
    $params = array_merge($params,[

        // facebook live app params
        \'fb_app_id\'     => \'' . $this->application->fbId . '\',
        \'fb_app_secret\' => \'' . $this->application->fbSecret . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/' . $app_root . '/site/home"
    ]);
}

return $params;';

        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

}