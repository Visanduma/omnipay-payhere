<?php

namespace Visanduma\OmnipayPayhere\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;

class PayHereResponse extends AbstractResponse implements NotificationInterface
{
    public function isSuccessful()
    {
        # Validate the Hash
        
        $merchant_id = $this->data['merchantId'];
        $order_id = $this->data['order_id'];
        $payhere_amount = $this->data['payhere_amount'];
        $payhere_currency = $this->data['payhere_currency'];
        $status_code = $this->data['status_code'];
        $merchant_secret = 'Tk0Mzk4OTI1NT000000000000000000000pfsFGa2ERSfas';

        $md5sig = $this->data['md5sig'];

        $local_md5sig = strtoupper(
        md5(
            $merchant_id . 
                    $order_id . 
                    $payhere_amount . 
                    $payhere_currency . 
                    $status_code . 
                    strtoupper(md5($merchant_secret)) 
                ) 
        );

        return $local_md5sig == $md5sig;
    }

    public function getTransactionReference() 
    {
        return $this->data['payment_id'];
    }

    public function getTransactionStatus() 
    {
        return $this->data['status_code'];
    }

    public function getMessage() 
    {
        return $this->data['status_message'];
    }
}