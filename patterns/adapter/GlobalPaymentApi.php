<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 5:13 PM
 */

namespace patterns\adapter;

/**
 * Interface GlobalPaymentApi
 * @package patterns\adapter
 */
interface GlobalPaymentApi
{
    /**
     * @return mixed
     */
    public function getCountry();

    /**
     * @return mixed
     */
    public function getPostal();

    /**
     * @return mixed
     */
    public function getCity();

    /**
     * @return mixed
     */
    public function getRegion();

    /**
     * @return mixed
     */
    public function getCurrency();

    /**
     * @return mixed
     */
    public function getAmount();




}