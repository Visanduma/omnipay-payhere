<?php

namespace Visanduma\OmnipayPayhere;

use Omnipay\Common\AbstractGateway;

abstract class PayHereGateway extends AbstractGateway
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
        $this->setParameter('merchantSecret', $merchantSecret);
    }

    public function getMerchantSecret()
    {
        return $this->getParameter('merchantSecret');
    }

    private function setAccessToken($accessToken)
    {
        $this->setParameter('accessToken', $accessToken);
    }

    public function acceptNotification(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereNotificationRequest', $parameters);
    }

    public function getAccessToken(array $parameters = array()) 
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereAccessTokenRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHerePurchaseRequest', $parameters);
    }

    public function authorize(array $parameters = array()) 
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereAuthorizeRequest', $parameters);
    }

    public function recurrence(array $parameters = array()) 
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function preApproval(array $parameters = array()) 
    {
        return $this->createRequest('\Omnipay\PayHere\Message\PayHerePreapprovalRequest', $parameters);
    }

    public function charging(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function retrieval(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereRecurrenceRequest', $parameters);
    }

    public function capture(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Omnipay\PayHere\Message\PayHereRecurrenceRequest', $parameters);
    }
}