<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository;
    }

    public function me()
    {
        $response = collect($this->repository->me());

        abort_unless($response->get('success'), $response->get('code'), data_get($response->get('response'), 'error', $response->get('message')));
    
        return new User($response->get('response'));    
    }
}
