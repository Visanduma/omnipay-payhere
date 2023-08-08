<?php

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;

class PayHereNotification implements NotificationInterface
{
    
    private $data = null;
    private $httpRequest;
    private $httpClient;
    private $merchantSecret;


    public function __construct($httpRequest, $httpClient, $merchantSecret)
    {
        $this->httpRequest = $httpRequest; 
        $this->httpClient = $httpClient;
        $this->merchantSecret = $merchantSecret;
    }

    public function getData() 
    {
        $this->data = $this->httpRequest->request->all();

        $merchant_id = $this->data['merchantId'];
        $order_id = $this->data['order_id'];
        $payhere_amount = $this->data['payhere_amount'];
        $payhere_currency = $this->data['payhere_currency'];
        $status_code = $this->data['status_code'];
        $merchant_secret = $this->merchantSecret;

        $md5sig = $this->data['md5sig'];

        $local_md5sig = strtoupper(
        md5(
            $merchant_id . 
                    $order_id . 
                    $payhere_amount . 
                    $payhere_currency . 
                    $status_code . 
                    strtoupper(md5($merchant_secret)) 
                ) 
        );

        if ($local_md5sig != $md5sig) {
            throw new InvalidResponseException("Signature mismatch");
        }

        return $this->data;
    }
    
    public function getTransactionReference() 
    {
        if ($data = $this->getData()) {
            return $data['payment_id'];
        }

        return null;
    }

    public function getTransactionStatus() 
    {
        if ($data = $this->getData()) {
            $status = $data['status_code'];
            if ($status == 2) {
                return NotificationInterface::STATUS_COMPLETED;
            } elseif ($status == 0) {
                return NotificationInterface::STATUS_PENDING;
            }
        }

        return NotificationInterface::STATUS_FAILED;

    }

    public function getMessage() 
    {
        if ($data = $this->getData()) {
            return $data['status_message'];
        }

        return null;
    }
}