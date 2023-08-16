<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereSubscriptionPaymentRequest extends AbstractRequest 
{
    protected $apiEndpoint = '/merchant/v1/subscription/';
    
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
            $headers
        );

        $payments = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $payments);
    }

    public function getApiFullUrl() 
    {
        return $this->getEndpoint().$this->apiEndpoint.$this->getSubscriptionId().'/payments';
    } 
}