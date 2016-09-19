<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 12:33 PM
 */

use patterns\factory\AppGenerator;

$appGenerator = new AppGenerator();

$puzzle = $appGenerator->make('puzzle');
$gallery = $appGenerator->make('gallery');
$query = $appGenerator->make('query');

$puzzle->run();

structurePreview(__DIR__);

