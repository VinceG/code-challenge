<?php

namespace App\Repositories;

use App\Repositories\Client;
use App\Http\Requests\Api\Auth\AuthRequest;

class AuthRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function auth(AuthRequest $request)
    {
        return $this->client->login($request->all());
    }
}