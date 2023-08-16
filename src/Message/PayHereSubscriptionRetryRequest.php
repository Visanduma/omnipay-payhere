<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereSubscriptionRetryRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/subscription/retry'; 
    
    public function getData()
    {
        return [
            'subscription_id' =>  $this->getSubscriptionId()
        ];
    }

    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer' . $this->getParameter('accessToken')
        ];

        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getApiFullUrl(),
            $headers,
            json_encode($data)
        );

        $retry = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $retry);
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}