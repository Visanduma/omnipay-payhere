<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereRefundRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/refund';
    
    public function getData() 
    {
        return  [
            'payment_id' => $this->getTransactionReference(),
            'description' => $this->getRefundDescription(),
            //'authorization_token' => $this->getAuthorizationCode()
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

        $refundData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRefundResponse($this, $refundData);

    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}