<?php

namespace Visanduma\OmnipayPayhere;

use Omnipay\Common\AbstractGateway;
use Visanduma\OmnipayPayhere\Message\PayHereNotification;

class PayHereGateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayHere';
    }

    public function getShortName()
    {
        return 'payhere';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantId' => '',
            'merchantSecret' => '',
            'testMode' => true,
        ];
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantSecret($merchantSecret)
    {
        return $this->setParameter('merchantSecret', $merchantSecret);
    }

    public function getMerchantSecret()
    {
        return $this->getParameter('merchantSecret');
    }

    private function setAccessToken($accessToken)
    {
        $this->setParameter('accessToken', $accessToken);
    }

    public function getAccessToken() 
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereAccessTokenRequest', $this->getParameters());
    }

    public function acceptNotification()
    {
        return new PayHereNotification($this->httpRequest, $this->httpClient, $this->getMerchantSecret());
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHerePurchaseRequest', $parameters);
    }

    public function authorize(array $parameters = array()) 
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereAuthorizeRequest', $parameters);
    }

    public function recurrence(array $parameters = array()) 
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function preApproval(array $parameters = array()) 
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHerePreapprovalRequest', $parameters);
    }

    public function charging(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function retrieval(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function capture(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRecurrenceRequest', $parameters);
    }
}