<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereRetrievalRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/search?order_id=LP8006126139';
    
    public function getData()
    {
        return [
            'order_id' => $this->getOrderId()
        ];
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

        $retrievalData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRetrievalResponse($this, $retrievalData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}