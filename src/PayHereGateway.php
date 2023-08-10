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

    public function setAppId($app_id) 
    {
        $this->setParameter('appId', $app_id); 
    }

    public function getAppId()
    {
        return $this->getParameter('appId');
    }

    public function setAppSecret($app_secret) 
    {
        $this->setParameter('appSecret', $app_secret);
    }

    public function getAppSecret() 
    {
        return $this->getParameter('appSecret');
    }

    public function setAccessToken($accessToken)
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
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRefundRequest', $parameters);
    }

    public function preApproval(array $parameters = array()) 
    {
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHerePreapprovalRequest', $parameters);
    }

    public function charging(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereChargingRequest', $parameters);
    }

    public function retrieval(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereRetrievalRequest', $parameters);
    }

    public function capture(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereCaptureRequest', $parameters);
    }

    public function subscriptions(array $parameters = null) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereSubscriptionRequest', $parameters);
    }

    public function subscriptionPayment(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereSubscriptionRequest', $parameters);
    }

    public function subscriptionRetry(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereSubscriptionRetry', $parameters);
    }

    public function subscriptionCancel(array $parameters = array()) 
    {
        $this->setAccessToken($this->getAccessToken()->getToken());
        return $this->createRequest('\Visanduma\OmnipayPayhere\Message\PayHereSubscriptionCancel', $parameters);
    }
}