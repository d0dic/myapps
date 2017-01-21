<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:19 AM
 */

use patterns\adapter\PaymentProvider;
use patterns\adapter\EuroPaymentAdapter;
use patterns\adapter\SwissPayment;

$swissPayment = new SwissPayment();
$paymentAdapter = new EuroPaymentAdapter($swissPayment);

$paymentProvider = new PaymentProvider($paymentAdapter);
echo $paymentProvider->checkData().PHP_EOL;

structurePreview(__DIR__);