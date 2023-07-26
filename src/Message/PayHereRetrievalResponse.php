<?php 

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PayHereRetrievalResponse extends AbstractResponse implements RedirectResponseInterface 
{
    public function isSuccessful()
    {
        
    }
}