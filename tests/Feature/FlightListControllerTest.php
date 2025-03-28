<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;
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

    public function test_CheckEditShowsEditFlightForm()
    {

        $plane = Plane::create(['name' => 'Boeing 737']);
        $flight = Flight::create([
            'plane_id' => $plane->id,
            'date' => now()->addDays(1),
            'departure_location' => 'NEW YORK',
            'arrival_location' => 'LONDON',
            'price' => 1000,
        ]);

        $response = $this->get(route('editFlight', ['search_id' => $flight->id]));

        $response->assertOk();
        $response->assertViewHas('selectedFlight', $flight);
    }

    public function test_CheckUpdatesAFlight()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $plane = Plane::create(['name' => 'Boeing 737']);
        $flight = Flight::create([
            'plane_id' => $plane->id,
            'date' => now()->addDays(1),
            'departure_location' => 'NEW YORK',
            'arrival_location' => 'LONDON',
            'price' => 1000,
        ]);

        $data = [
            'plane_id' => $plane->id,
            'date' => now()->addDays(2)->toDateString(),
            'departure_location' => 'PARIS',
            'arrival_location' => 'TOKYO',
            'price' => 2000,
        ];

        $response = $this->put(route('updateFlight', $flight->id), $data);

        $this->assertDatabaseHas('flights', [
            'departure_location' => 'PARIS',
            'arrival_location' => 'TOKYO',
            'price' => 2000,
        ]);
    }

    public function test_CheckStoreCreatesAFlight()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $plane = Plane::create(['name' => 'Boeing 737']);
        $data = [
            'plane_id' => $plane->id,
            'date' => now()->addDays(1)->toDateString(),
            'departure_location' => 'NEW YORK',
            'arrival_location' => 'LONDON',
            'price' => 1500,
        ];

        $response = $this->post(route('createFlight'), $data);

        $this->assertDatabaseHas('flights', [
            'plane_id' => $plane->id,
            'date' => $data['date'],
            'departure_location' => strtoupper($data['departure_location']),
            'arrival_location' => strtoupper($data['arrival_location']),
            'price' => $data['price'],
            'status' => true,
        ]);

        $response->assertRedirect(route('flightList'));
        $response->assertSessionHas('success', 'Vuelo creado con éxito');
    }


    public function test_CheckDestroyReturnsErrorWhenFlightNotFound()
    {
        $response = $this->delete(route('deleteFlight', 999));

        $response->assertRedirect(route('flightList'));
        $response->assertSessionHas('error', 'Vuelo no encontrado');
    }


    public function test_CheckSearchReturnsErrorWhenFlightNotFound()
    {
        $response = $this->post(route('searchFlight'), ['search_id' => 999]);
        $response->assertRedirect(route('editFlight'));
        $response->assertSessionHas('error', 'Vuelo no encontrado');
    }


    public function test_CheckItRedirectsWithErrorIfFlightNotFound()
    {
        $response = $this->get(route('editFlight', ['search_id' => 999]));
        $response->assertRedirect(route('editFlight'));
        $response->assertSessionHas('error', 'Vuelo no encontrado');
    }


    public function test_CheckItRedirectsWithErrorIfFlightNotFoundOnUpdate()
    {
        $response = $this->put(route('updateFlight', ['id' => 999]), [
            'departure_time' => '2025-04-01 10:00:00'
        ]);

        $response->assertRedirect(route('editFlight'));
        $response->assertSessionHas('error', 'Debe buscar un ID válido antes de editar.');
    }


    public function test_DestroyFlightSuccessfully()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $flight = Flight::factory()->create();

        $response = $this->delete(route('deleteFlight', $flight->id));
        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
       
        $response->assertRedirect(route('flightList'));
        $response->assertSessionHas('success', 'Vuelo eliminado correctamente');
    }


    public function test_DestroyFlightNotFound()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);


        $nonExistentId = 9999;

        $response = $this->delete(route('deleteFlight', $nonExistentId));

        $response->assertRedirect(route('flightList'));
        $response->assertSessionHas('error', 'Vuelo no encontrado');
    }

    
}
