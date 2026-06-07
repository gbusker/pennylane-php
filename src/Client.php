<?php

namespace Elx\PennylanePhp;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private string $baseUrl = 'https://app.pennylane.com/api/external/v2';
    private GuzzleClient $httpClient;

    public function __construct()
    {
        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
            'headers' => [ 
                'Authorization' => 'Bearer ' . getenv('PENNYLANE_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    } 

    public function get(string $endpoint)
    {
        
        $response = $this->httpClient->get($endpoint);
        if ($response->getStatusCode() >= 400) {
            throw new ClientException("API request failed with status code " . $response->getStatusCode(), $response);
        };
        return json_decode($response->getBody(), true);
    }   
}

class ClientException extends \Exception
{
    private $response;

    public function __construct($message, $response)
    {
        parent::__construct($message);
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
