<?php

namespace Elx\PennylanePhp;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private string $baseUrl = 'https://app.pennylane.com/api/external/v2/';
    private GuzzleClient $httpClient;

    private string $api_key;

    public function __construct()
    {    
        if ( !$this->api_key = getenv('PENNYLANE_API_KEY') ) {
            throw new \InvalidArgumentException('API key is not set');
        }
        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
            'headers' => [ 
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json',
            ],
            'debug' => false
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

    public function post(string $endpoint, array $data)
    {
        $response = $this->httpClient->post($endpoint, [ 
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ]);
        if ($response->getStatusCode() >= 400) {
            throw new ClientException("API request failed with status code " . $response->getStatusCode() . " and body: " . $response->getBody(), $response);
        };
        return $response;
    }
}

class ClientException extends \Exception
{
    private ResponseInterface $response;

    public function __construct(string $message, ResponseInterface $response)
    {
        parent::__construct($message);
        $this->response = $response;
    }

    public function getResponse() : ResponseInterface
    {
        return $this->response;
    }
}
