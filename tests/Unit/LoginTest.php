<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_login()
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'admin@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    public function test_failed_login():void
    {
        $response = $this->json('POST', '/api/login', [
            'email' => 'admin@email.com',
            'password' => 'password1'
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'error',
            ]);
    }
}
