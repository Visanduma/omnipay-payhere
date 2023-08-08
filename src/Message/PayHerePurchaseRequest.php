<?php 

namespace Visanduma\OmnipayPayhere\Message;

class PayHerePurchaseRequest extends AbstractRequest
{
    protected $apiEndpoint = '/pay/checkout';
    
    public function getData()
    {
        $data = array(
            'merchantId' => $this->getMerchantId(),
            'returnUrl' => $this->getReturnUrl(),
            'cancelUrl' => $this->getCancelUrl(),
            'notifyUrl' => $this->getNotifyUrl(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'firstName' => $this->getFirstName(), 
            'lastName' => $this->getLastName(), 
            'email' => $this->getEmail(), 
            'phone' => $this->getPhone(), 
            'address' => $this->getAddress(), 
            'city' => $this->getCity(), 
            'country' => $this->getCountry(), 
            'orderId' => $this->getOrderId(), 
            'items' =>  $this->getItems(), 
            'hash' => $this->getHash()
        );

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PayHereResponse($this, $data, $this->getApiFullUrl());
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}