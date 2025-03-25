<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightListControllerTest extends TestCase
{
    use RefreshDatabase; 

    public function test_CheckCreateReturnsViewWithPlanes()
    {
        $this->artisan('migrate');

        $admin = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($admin); 
        Plane::factory()->count(3)->create();
        $response = $this->get(route('createFlight'));
        $response->assertStatus(200);
        $response->assertViewIs('createFlight');
        $response->assertViewHas('planes');
    }
}
