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
        $authorization_code = $this->getAuthorizationCode();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode($authorization_code),
        ];

        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getApiFullUrl(),
            $headers,
            http_build_query($data)
        );

        $tokenData = json_decode($httpResponse->getBody()->getContents(), true);

        $response = new PayHereAccessTokenResponse($this, $tokenData);
        return $response;
    }

    protected function getApiFullUrl()
    {
        return $this->getEndpoint().$this->apiEndpoint;
    }
}