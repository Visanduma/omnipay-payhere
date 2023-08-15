<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereSubscriptionCancelRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/subscription/cancel';
    
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
            http_build_query($data)
        );

        $cancel = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $cancel);
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}