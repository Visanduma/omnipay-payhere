<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHerePreapprovalRequest extends AbstractRequest
{
    protected $apiEndpoint = '/pay/preapprove';
    
    public function getData()
    {
        $data = array(
            'merchantId' => $this->getMerchantId(),
            'returnUrl' => $this->getReturnUrl(),
            'cancelUrl' => $this->getCancelUrl(),
            'notifyUrl' => $this->getNotifyUrl(),
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
        return $this->response = new PayHereResponse($this, $data);
    }
}