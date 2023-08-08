<?php

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PayHereResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;

    public function __construct(RequestInterface $request, $data, $redirectUrl)
    {
        $this->request = $request;
        $this->data = $data;
        $this->redirectUrl = $redirectUrl;
    }

    public function isSuccessful()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}