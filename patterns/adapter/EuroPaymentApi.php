<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 5:09 PM
 */

namespace patterns\adapter;

/**
 * Interface EuroPaymentApi
 * @package patterns\adapter
 */
interface EuroPaymentApi
{
    /**
     * @return mixed
     */
    public function getState();

    /**
     * @return mixed
     */
    public function getZipCode();

    /**
     * @return mixed
     */
    public function getCity();

    /**
     * @return mixed
     */
    public function getAmount();
}