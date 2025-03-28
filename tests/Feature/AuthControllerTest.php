<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfUserRegistersSuccessfully(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount("users", 1);
    }


    public function test_CheckIfUserRegisterFailsDueToMissingConfirmation(): void
    {
        $response = $this->post(route("register"), [
            "name" => "test",
            "email" => "example@example.com",
            "password" => "12345678"
        ]);

        $response->assertStatus(302)->assertRedirect("/");
        $this->assertDatabaseCount("users", 0);
    }


    public function test_CheckIfUserLoginFailsWithWrongPassword(): void
    {
        $user = User::factory()->create([
            "email" => "example@example.com",
            "password" => "12345678"
        ]);
        $response = $this->post(route("login"), [
            "email" => $user->email,
            "password" => "12345677"
        ]);

        $response->assertStatus(302)->assertRedirect("/");
    }
}