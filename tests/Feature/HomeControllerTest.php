<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckRedirectsGuestUsersToLogin()
    {
        $response = $this->get(route('home')); 
        $response->assertRedirect(route('login')); 
    }

    public function test_CheckAuthenticatedUsersCanAccessHome()
    {
        $user = User::factory()->create(); 
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200); 
    }
}
