<?php 

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayHereRestfulResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return is_array($this->data) && ($this->data['status'] == 1);
    }

    public function getData() 
    {
        return $this->data;
    }
}