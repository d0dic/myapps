<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3cbe0d651c0bb58844e860b67d3bdcaa
{
    public static $classMap = array (
        'EasyPeasyICS' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/EasyPeasyICS.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'app\\assets\\Database' => __DIR__ . '/../..' . '/assets/Database.php',
        'app\\assets\\Identity' => __DIR__ . '/../..' . '/assets/Identity.php',
        'app\\assets\\Router' => __DIR__ . '/../..' . '/assets/Router.php',
        'app\\assets\\Session' => __DIR__ . '/../..' . '/assets/Session.php',
        'app\\controllers\\BaseController' => __DIR__ . '/../..' . '/controllers/BaseController.php',
        'app\\controllers\\FrontController' => __DIR__ . '/../..' . '/controllers/FrontController.php',
        'app\\models\\BaseModel' => __DIR__ . '/../..' . '/models/BaseModel.php',
        'app\\models\\User' => __DIR__ . '/../..' . '/models/User.php',
        'ntlm_sasl_client_class' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/ntlm_sasl_client.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit3cbe0d651c0bb58844e860b67d3bdcaa::$classMap;

        }, null, ClassLoader::class);
    }
}
