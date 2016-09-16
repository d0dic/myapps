<?php

$router = new app\assets\Router();

$router->define(
    'home', 'FrontController', 'actionHome');
$router->define(
    'about', 'FrontController', 'actionAbout');
$router->define(
    'contact', 'FrontController', 'actionContact');
$router->define(
    'login', 'FrontController', 'actionLogin');
$router->define(
    'logout', 'FrontController', 'actionLogout');
$router->define(
    'profile', 'FrontController', 'actionProfile');

$router->run();