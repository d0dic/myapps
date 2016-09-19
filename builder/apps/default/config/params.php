<?php

$host = $_SERVER['HTTP_HOST'];

// TODO Enter the necessary app params
$params = [

    // app author params
    'adminEmail'    => 'milos_dodic@live.com',
    'fbLogin_url'  => "https://$host/APP_NAME/site/login",

    // application params
    'app_name'      => 'Facebook App',
    'app_folder'    => 'APP_NAME'
];

// TODO Enter the necessary fb params
if ($host == 'www.codeit.loc') {
    $params = array_merge($params,[

        // facebook test app params
        'fb_app_id'     => 'FB_ID_TEST',
        'fb_app_secret' => 'FB_SECRET_TEST',

        // facebook login redirect params
        'afterLogin_url'  => "https://apps.facebook.com/APP_NAME_LOC/site/home"
    ]);
} else {
    $params = array_merge($params,[

        // facebook live app params
        'fb_app_id'     => 'FB_ID',
        'fb_app_secret' => 'FB_SECRET',

        // facebook login redirect params
        'afterLogin_url'  => "https://apps.facebook.com/APP_NAME/site/home"
    ]);
}

return $params;


