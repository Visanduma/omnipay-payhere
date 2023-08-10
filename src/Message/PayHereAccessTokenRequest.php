<?php 

namespace Visanduma\OmnipayPayhere\Message; 

class PayHereAccessTokenRequest extends AbstractRequest
{
    protected $apiEndpoint = '/merchant/v1/oauth/token';

    public function getData() 
    {
        return [
            'grant_type' => 'client_credentials'
        ];
    }

    public function sendData($data) 
    {
        $authorization_code = $this->getParameter('appId') . ':' . $this->getParameter('appSecret');
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($authorization_code),
        ];

        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getApiFullUrl(),
            $headers,
            http_build_query($data)
        );

        $tokenData = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response = new PayHereAccessTokenResponse($this, $tokenData);
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}