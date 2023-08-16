<?php

namespace Visanduma\OmnipayPayhere\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $testEndpoint = 'https://sandbox.payhere.lk';
    protected $liveEndpoint = 'https://www.payhere.lk';

    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
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

    public function setSubscriptionId($subscription_id) 
    {
        $this->setParameter('subscriptionId', $subscription_id);
    }

    public function getSubscriptionId() 
    {
        return $this->getParameter('subscriptionId');
    }
    
    public function setReturnUrl($returnUrl)
    {
        $this->setParameter('returnUrl', $returnUrl);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setCancelUrl($cancelUrl)
    {
        $this->setParameter('cancelUrl', $cancelUrl);
    }

    public function getCancelUrl()
    {
        return $this->getParameter('cancelUrl');
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->setParameter('notifyUrl', $notifyUrl);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    public function setFirstName($firstName)
    {
        $this->setParameter('firstName', $firstName);
    }

    public function getFirstName()
    {
        return $this->getParameter('firstName'); 
    }

    public function setLastName($lastName)
    {
        $this->setParameter('lastName', $lastName);
    }

    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    public function setEmail($email)
    {
        $this->setParameter('email', $email);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setPhone($phone)
    {
        $this->setParameter('phone', $phone);
    }

    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    public function setAddress($address) 
    {
        $this->setParameter('address', $address);
    }

    public function getAddress() 
    {
        return $this->getParameter('address');
    }

    public function setCity($city)
    {
        $this->setParameter('city', $city);
    }

    public function getCity()
    {
        return $this->getParameter('city');
    }

    public function setCountry($country)
    {
        $this->setParameter('country', $country);
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function setOrderId($orderId) 
    {
        $this->setParameter('orderId', $orderId);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setItems($invoiceNo) 
    {
        $this->setParameter('invoiceNo', $invoiceNo);
    }

    public function getItems()
    {
        return $this->getParameter('invoiceNo');
    }

    public function setCurrency($currency) 
    {
        $this->setParameter('currency', $currency);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setAmount($amount) 
    {
        $this->setParameter('amount', $amount);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setHash() 
    {
        $hash = strtoupper(
            md5(
                $this->getMerchantId() . 
                $this->getOrderId() . 
                number_format($this->getAmount(), 2, '.', '') . 
                $this->getCurrency() .  
                strtoupper(md5($this->getMerchantSecret())) 
            ) 
        );
        
        $this->setParameter('hash', $hash);
    }

    public function getHash()
    {
        return $this->getParameter('hash');
    }

    public function setAuthorizationToken($authorizationToken) 
    {
         $this->setParameter('authorizationToken', $authorizationToken);
    }

    public function getAuthorizationToken() 
    {
        return $this->getParameter('authorizationToken');
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
