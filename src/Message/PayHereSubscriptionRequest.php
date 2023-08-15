<?php 

namespace Visanduma\OmnipayPayhere\Message;

class PayHereSubscriptionRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/subscription';

    public function getData() 
    {
        return [];
    }

    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer' . $this->getParameter('accessToken')
        ];

        $httpResponse = $this->httpClient->request(
            'GET',
            $this->getApiFullUrl(),
            $headers,
            http_build_query($data)
        );

        $allSubscriptions = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $allSubscriptions);
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}