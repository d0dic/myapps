<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check if exceptions work');

$I->amOnPage('/');

$I->fillField('appName', 'test_app');

# $I->fillField('dbName', 'test_app');
$I->fillField('dbHost', 'localhost');
$I->fillField('dbUsername', 'root');
$I->fillField('dbPassword', 'root');

$I->fillField('fbId', '246250632436633');
$I->fillField('fbSecret', 'fd8cfcd481455ca12f86792cfc323c6e');
$I->fillField('fbNamespace', 'test_app_prod');

$I->fillField('fbIdTest', '246251089103254');
$I->fillField('fbSecretTest', '79192a9a2555ff990dc024565248c8fa');
$I->fillField('fbTestNamespace', 'test_app_loc');

// Query app intentionally left unconfigured
$I->selectOption('appType', 'query');

$I->click('Create app');

$I->amOnPage('/index.php');

$I->see('Warning!');
