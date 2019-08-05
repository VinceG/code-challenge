<?php

namespace App\Repositories;

use App\Repositories\Client;

class UserRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function me()
    {
        return $this->client->user();
    }
}