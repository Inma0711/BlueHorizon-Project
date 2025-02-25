<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckUserCanViewTheRegistrationForm()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200)
                 ->assertViewIs('auth.register');
    }

    public function test_CheckUserCanRegister()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('register'), $data);

        $response->assertRedirect(route('home')); 
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_CheckRegistrationRequiresValidData()
    {
        $response = $this->post(route('register'), []);

        $response->assertStatus(302) 
                 ->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
