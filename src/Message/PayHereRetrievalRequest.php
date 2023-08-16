<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereRetrievalRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/search?order_id=';
    
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

        $retrievalData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $retrievalData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint.$this->getOrderId();
    }
}