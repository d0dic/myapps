<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 4:05 PM
 */

use patterns\command\RemoteControl;

$remote = new RemoteControl();

$remote->sendSignal('run');
$remote->sendSignal('jump');
$remote->sendSignal('run');

structurePreview(__DIR__);