<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 5:50 PM
 */

namespace patterns\adapter;

/**
 * Class SwissPayment
 * @package patterns\adapter
 */
class SwissPayment implements EuroPaymentApi
{

    /**
     * @return mixed
     */
    public function getState()
    {
        return 'Switzerland';
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return rand(12001, 12999);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return 'Zurrich';
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return rand(999.99, 999999.99);
    }
}