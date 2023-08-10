<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereSubscriptionPaymentRequest extends AbstractRequest 
{
    protected $apiEndpoint = '/merchant/v1/subscription/{subscription_id}/payments';
    
    public function getData()
    {
        return [
            'subscription_id' =>  '420075032251'
        ];
    }

    public function sendData($data)
    {
        
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint;
    } 

    // public function getRecurrence()
    // {
    //     return $this->getParameter('recurrence');
    // }

    // public function setDuration($duration) 
    // {
    //     $this->setParameter('duration', $duration);
    // }
}