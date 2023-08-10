<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereSubscriptionRetryRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/subscription/retry'; 
    
    public function getData()
    {
        return [
            'subscription_id' =>  '420075032251'
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
            http_build_query($data)
        );

        $allSubscriptions = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereSubscriptionResponse($this, $allSubscriptions);
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}