<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Token;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use App\Http\Requests\Api\Auth\AuthRequest;

class AuthController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new AuthRepository;
    }

    public function auth(AuthRequest $request)
    {
        $response = collect($this->repository->auth($request));

        abort_unless($response->get('success'), $response->get('code'), data_get($response->get('response'), 'error', $response->get('message')));
    
        return new Token($response->get('response'));    
    }
}
