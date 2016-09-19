<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 19-Sep-16
 * Time: 10:44 PM
 */

namespace app\classes;

/**
 * Class FbAppDeployer
 * @package app\classes
 *
 * @property FbApplication $application
 */
class FbAppDeployer extends AppDeployer
{
    /**
     * @param string $destination
     */
    function deploy($destination)
    {
        echo '<pre>'; var_dump($this->application);
    }

    /**
     * @param string $name
     */
    private function createDatabase($name)
    {
        $dbcon = new \PDO("mysql:host=localhost;", 'root', 'root');
        $dbcon->exec("CREATE DATABASE $name DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
    }

    /**
     * @param string $src
     * @param string $dst
     * @param string $db_name
     * @param string $app_name
     * @param string $app_root
     */
    private function copyFiles($src, $dst, $db_name, $app_name, $app_root)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->copyFiles($src . '/' . $file, $dst . '/' . $file, $db_name, $app_name, $app_root);
                } else {

                    switch ($file) {
                        case 'db.php':
                            $this->createDbFile($dst . '/' . $file, $db_name);
                            break;
                        case 'console.php':
                            $this->createConsoleFile($dst . '/' . $file, $db_name);
                            break;
                        case 'params.php':
                            $this->createParamsFile($dst . '/' . $file, $app_name, $app_root);
                            break;
                        default:
                            copy($src . '/' . $file, $dst . '/' . $file);
                            break;
                    }
                }
            }
        }
        closedir($dir);
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
        \'fb_app_id\'     => \'' . FB_ID_TEST . '\',
        \'fb_app_secret\' => \'' . FB_SECRET_TEST . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/' . $app_root . '_loc/site/home"
    ]);
} else {
    $params = array_merge($params,[

        // facebook live app params
        \'fb_app_id\'     => \'' . FB_ID . '\',
        \'fb_app_secret\' => \'' . FB_SECRET . '\',

        // facebook login redirect params
        \'afterLogin_url\'  => "https://apps.facebook.com/' . $app_root . '/site/home"
    ]);
}

return $params;';

        fwrite($paramsFile, $contents);
        fclose($paramsFile);
    }

}