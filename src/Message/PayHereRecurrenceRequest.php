<?php 

namespace Visanduma\OmnipayPayhere\Message;

class PayHereRecurrenceRequest extends AbstractRequest 
{
    protected $apiEndpoint = '/pay/checkout';
    
    public function getData()
    {
        $data = array(
            'merchant_id' => $this->getMerchantId(),
            'return_url' => $this->getReturnUrl(),
            'cancel_url' => $this->getCancelUrl(),
            'notify_url' => $this->getNotifyUrl(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'first_name' => $this->getFirstName(), 
            'last_name' => $this->getLastName(), 
            'email' => $this->getEmail(), 
            'phone' => $this->getPhone(), 
            'address' => $this->getAddress(), 
            'city' => $this->getCity(), 
            'country' => $this->getCountry(), 
            'order_id' => $this->getOrderId(), 
            'items' =>  $this->getItems(), 
            'hash' => $this->getHash(), 
            'recurrence' => $this->getRecurrence(), 
            'duration' => $this->getDuration()
        );

        return $data;
    }

    public function setRecurrence($recurrence) 
    {
        $this->setParameter('recurrence', $recurrence);
    }

    public function getRecurrence()
    {
        return $this->getParameter('recurrence');
    }

    public function setDuration($duration) 
    {
        $this->setParameter('duration', $duration);
    }

    public function getDuration()
    {
        return $this->getParameter('duration');
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