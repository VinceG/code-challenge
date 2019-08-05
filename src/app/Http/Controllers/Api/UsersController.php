<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use App\Http\Requests\Api\Users\CreateRequest;

class UsersController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository;
    }

    public function list()
    {
        $response = collect($this->repository->all());
        
        abort_unless($response->get('success'), $response->get('code'), data_get($response->get('response'), 'error', $response->get('message')));
    
        return User::collection(collect($response->get('response')));    
    }

    public function save(CreateRequest $request)
    {
        return new User($request->all());
    }
}
