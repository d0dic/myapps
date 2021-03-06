<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 5:56 PM
 */

namespace patterns\adapter;


class PaymentProvider
{
    /**
     * @var GlobalPaymentApi
     */
    private $paymentApi;

    /**
     * PaymentProvider constructor.
     * @param GlobalPaymentApi $paymentApi
     */
    public function __construct(GlobalPaymentApi $paymentApi)
    {
        $this->paymentApi = $paymentApi;
    }

    /**
     * @return string
     */
    public function checkData(){
        $data = [
            'region' => $this->paymentApi->getRegion(),
            'country' => $this->paymentApi->getCountry(),
            'city' => $this->paymentApi->getCity(),
            'postal' => $this->paymentApi->getPostal(),
            'amount' => $this->paymentApi->getAmount(),
            'currency' => $this->paymentApi->getCurrency(),
        ];

        return json_encode($data);
    }

}