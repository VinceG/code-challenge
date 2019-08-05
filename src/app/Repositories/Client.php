<?php

namespace App\Repositories;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

class Client
{
    protected $client;

    public function __construct()
    {
        $this->client = new HttpClient([
            'base_uri' => 'https://reqres.in/api/'
        ]);
    }

    public function login(array $params)
    {
        try {
            $response = $this->client->post('login', ['form_params' => $params]);
        } catch(ClientException $e) {
            $responseBody = $e->getResponse()->getBody(true);
            return ['success' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'response' => json_decode($responseBody)];
        }
    
        return ['success' => true, 'code' => $response->getStatusCode(), 'response' => json_decode($response->getBody())];
    }

    public function user()
    {
        try {
            $response = $this->client->get('users/2');
        } catch(ClientException $e) {
            $responseBody = $e->getResponse()->getBody(true);
            return ['success' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'response' => json_decode($responseBody)];
        }
    
        return ['success' => true, 'code' => $response->getStatusCode(), 'response' => data_get(json_decode($response->getBody()), 'data')];
    }

    public function users()
    {
        try {
            $response = $this->client->get('users');
        } catch(ClientException $e) {
            $responseBody = $e->getResponse()->getBody(true);
            return ['success' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'response' => json_decode($responseBody)];
        }
    
        return ['success' => true, 'code' => $response->getStatusCode(), 'response' => data_get(json_decode($response->getBody()), 'data')];
    }
}