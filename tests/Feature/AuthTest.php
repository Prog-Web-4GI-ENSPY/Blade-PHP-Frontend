<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_with_phone_address()
    {
        $response = $this->postJson('/api/v1/register', [
            'name' => 'Test User',
            'email' => 'test@shopcart.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '+225 0701020304',
            'address' => 'Abidjan'
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['token', 'user' => ['phone', 'address']]);
    }

    public function test_login_and_get_user()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'phone' => '+225 0102030405',
            'address' => 'Yopougon'
        ]);

        $login = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $token = $login->json('token');

        $this->withHeader('Authorization', "Bearer $token")
             ->getJson('/api/v1/user')
             ->assertStatus(200)
             ->assertJson(['phone' => $user->phone]);
    }
}