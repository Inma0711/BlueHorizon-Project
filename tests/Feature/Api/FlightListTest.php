<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   /* public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
        */

    use RefreshDatabase;


    public function test_CheckItDisplaysAnEmptyFlightListIfNoFlightsExist()
    {
        $response = $this->get(route('flightList'));
        $response->assertStatus(200);
        $response->assertViewIs('flightList');
        $response->assertViewHas('flightLists', function ($viewFlights) {
            return $viewFlights->isEmpty();
        });
    }
}


