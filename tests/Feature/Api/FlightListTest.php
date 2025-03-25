<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
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

    /*
    public function test_CheckItDisplaysTheFlightListViewWithAllFlights()
    {
        Plane::factory(3)->create();
        $flights = Flight::factory(3)->create();
        $response = $this->get(route('flightList'));
        $response->assertStatus(200);
        $response->assertViewIs('flightList');

        $response->assertViewHas('flightLists', function ($viewFlights) use ($flights) {
            return $viewFlights->count() === 3 &&
                   $viewFlights->pluck('id')->sort()->values()->all() === $flights->pluck('id')->sort()->values()->all();
        });
    }
    */

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


