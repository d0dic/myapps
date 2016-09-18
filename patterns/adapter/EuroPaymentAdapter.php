<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 5:16 PM
 */

namespace patterns\adapter;
/**
 * Class EuroPaymentAdapter
 * @package patterns\adapter
 */
class EuroPaymentAdapter implements GlobalPaymentApi
{
    private $euroPaymentApi;

    /**
     * EuroPaymentAdapter constructor.
     * @param EuroPaymentApi $euroPaymentApi
     */
    public function __construct(
        EuroPaymentApi $euroPaymentApi)
    {
        $this->euroPaymentApi = $euroPaymentApi;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->euroPaymentApi->getAmount();
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->euroPaymentApi->getCity();
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->euroPaymentApi->getState();
    }

    /**
     * @return mixed
     */
    public function getPostal()
    {
        return $this->euroPaymentApi->getZipCode();
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return 'EUROPE';
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return 'EUR';
    }
}