<?php 

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PayHereCaptureResponse extends AbstractResponse implements RedirectResponseInterface 
{
    public function isSuccessful()
    {
        
    }
}