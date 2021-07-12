<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    //success user
    public function test_success_user()
    {
        $this->seed();

        $this->post('api/login', [
            'email' => 'admin@admin.com',
            'password' => '123456789',
            'name' => 'iphone'
        ], [])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token'
            ]);
    }

    //unauthenticated user
    public function test_unauthenticated_user()
    {
        $user = User::factory()->create();

        $this->post('api/login', [
            'email' => $user->email,
            'password' => $user->password,
            'name' => 'iphone'
        ], [])
            ->assertStatus(401)
            ->assertJsonStructure(['error']);
    }
}
