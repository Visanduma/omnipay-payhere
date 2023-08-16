<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereChargingRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/charge';
    
    public function getData()
    {
        return  [
            'type' => "PAYMENT",
            'order_id' => $this->getOrderId(),
            'items' => $this->getItems(), 
            'currency' => $this->getCurrency(),
            'amount' => $this->getAmount(), 
            'customer_token' => $this->getCustomerToken() // from Preapproval API
            //'custom_1' => , 
            //'custom_2' => , 
            //'notify_url' => $this->getNotifyUrl()
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

        $chargingData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $chargingData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }

    public function setCustomerToken($customerToken) 
    {
         $this->setParameter('customerToken', $customerToken);
    }

    public function getCustomerToken() 
    {
        return $this->getParameter('customerToken');
    }
}