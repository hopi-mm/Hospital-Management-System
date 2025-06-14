<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('password'),
            'age' => 18,
            'address' =>  'Test Address',
            'gender' =>  'male',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message','data', 'status', 'statusCode']);

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('password'),
            'age' => 18,
            'address' =>  'Test Address',
            'gender' =>  'male',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'some@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(422);
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $this->withMiddleware();

        $this->actingAs($user, 'web');

        session()->start();

        $response = $this->withSession([
            '_token' => csrf_token(),
        ])
            ->withHeaders([
                'X-CSRF-TOKEN' => csrf_token(),
                'Accept' => 'application/json',
            ])
            ->postJson('/api/logout');

        if ($response->status() !== 200) {
            dump(json_decode($response->getContent(), true));
        }

        $response->assertStatus(200);

        $this->assertGuest('web');
    }

}
