<?php 

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PayHereRefundResponse extends AbstractResponse implements RedirectResponseInterface 
{
    public function isSuccessful()
    {
        
    }
}