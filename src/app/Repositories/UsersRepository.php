<?php

namespace App\Repositories;

use App\Repositories\Client;

class UsersRepository
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function all()
    {
        return $this->client->users();
    }
}