<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereCaptureRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/payment/capture'; 
    
    public function getData()
    {
        return [
            'authorization_token' => $this->getAuthorizationToken(), // from Authorize API
            'amount' => $this->getAmount(),
            'deduction_details' => $this->getDeductionDetails()
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

        $captureData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response =  new PayHereRestfulResponse($this, $captureData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }

    public function setDeductionDetails($deductionDetails) 
    {
        $this->setParameter('deductionDetails', $deductionDetails);
    }

    public function getDeductionDetails() 
    {
        return $this->getParameter('deductionDetails');
    }
}