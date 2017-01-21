<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 12-Oct-16
 * Time: 1:07 PM
 */

use patterns\builder\CarFactory;

$factory = new CarFactory();

$car = $factory->createCar('elegance');

var_dump($car);

structurePreview(__DIR__);