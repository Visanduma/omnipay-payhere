<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereCaptureRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/capture'; 
    
    public function getData()
    {
        return [
            'authorization_token' => 'e34f3059-7b7d-4b62-a57c-784beaa169f4', // from Authorize API
            'amount' => $this->getAmount(),
            'deduction_details' => $this->getCaptureDetails()
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

        $captureData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $captureData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}