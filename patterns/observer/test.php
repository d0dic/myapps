<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:20 AM
 */

use patterns\observer\NewsChannel;
use patterns\observer\RadioListener;

$newsChannel = new NewsChannel();

$radioListener1 = new RadioListener();
$radioListener2 = new RadioListener();

$newsChannel->subscribe($radioListener1);
$newsChannel->subscribe($radioListener2);

$newsChannel->publish('This is a test info!');

structurePreview(__DIR__);
