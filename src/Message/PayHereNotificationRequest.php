<?php

namespace Visanduma\OmnipayPayhere\Message;

class PayHereNotificationRequest extends AbstractRequest
{
    public function getData()
    {
        $data = $this->httpRequest->request->all();

        return $data;
    }

    public function sendData($data) 
    {
        return $this->response = new PayHereResponse($this, $data);
    }
}