<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_successfully_authenticate()
    {
        $response = $this->post('/api/auth/login', ['email' => 'eve.holt@reqres.in', 'password' => 'cityslicka']);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_fails_auth_validation()
    {
        $response = $this->post('/api/auth/login', ['email' => 'test', 'password' => 'test']);

        $response->assertStatus(422);
        $response->assertJson(['errors' => ['The email must be a valid email address.']]);
    }

    /**
     * @test
     */
    public function it_fails_authentication_based_on_credentials()
    {
        $response = $this->post('/api/auth/login', ['email' => 'test@test.com', 'password' => 'test']);

        $response->assertStatus(400);
    }
}
