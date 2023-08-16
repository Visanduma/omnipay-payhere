<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereRefundRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/refund';
    
    public function getData() 
    {
        return  [
            'payment_id' => $this->getPaymentId(),
            'description' => $this->getDescription(),
            //'authorization_token' => $this->getAuthorizationToken()
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

        $refundData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $refundData);

    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }

    public function setPaymentId($paymentId) 
    {
        $this->setParameter('paymentId', $paymentId);
    }

    public function getPaymentId() 
    {
        return $this->getParameter('paymentId');
    }

    public function setDescription($description) 
    {
        $this->setParameter('description', $description);
    }

    public function getDescription() 
    {
        return $this->getParameter('description');
    }
}