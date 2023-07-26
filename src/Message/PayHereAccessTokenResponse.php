<?php 

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayHereAccessTokenResponse extends AbstractResponse 
{
    public function isSuccessful() 
    {
        return is_array($this->data)
            && isset($this->data['access_token']) && is_string($this->data['access_token'])
            && isset($this->data['token_type']) && is_string($this->data['token_type']);
    }

    public function getToken() 
    {
        return $this->data['access_token'];
    }
}