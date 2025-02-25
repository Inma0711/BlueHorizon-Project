<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfTheApiReturnsAllFlights()
    {
        Flight::factory(3)->create();
        $response = $this->getJson(route('flightIndex'));

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_CheckIfTheApiReturnsOnlyOneFlight()
    {
        $flight = Flight::factory()->create();
        $response = $this->getJson(route('flightShow', $flight->id));

        $response->assertStatus(200)
            ->assertJson([
                'plane_id' => $flight->plane_id,
                'date' => $flight->date,
                'departure_location' => $flight->departure_location,
                'arrival_location' => $flight->arrival_location,
                'price' => $flight->price,
            ]);
    }

    public function test_CheckIfYouAreTryingToSearchForAFlightThatDoesNotExist()
    {
        $response = $this->getJson(route('flightShow', ['id' => 999]));
        $response->assertStatus(404)
            ->assertJson(['message' => 'Vuelo no encontrado']);
    }

    public function test_CheckIfAFlightIsCreatedCorrectly()
    {
        $user = User::factory()->create();
        $plane = Plane::factory()->create();

        $data = [
            'plane_id' => $plane->id,
            'date' => now()->toDateString(),
            'departure_location' => 'Madrid',
            'arrival_location' => 'Londres',
            'price' => 50, // Se agrega price porque es obligatorio en la migración
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson(route('flightStore'), $data);

        $response->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('flights', $data);
    }

    public function test_CheckThatAFlightCannotBeCreatedIfMandatoryFieldsAreMissing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson(route('flightStore'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['plane_id', 'date', 'departure_location', 'arrival_location', 'price']);
    }

    public function test_ChecksThatAFlightCanBeUpdatedInTheDatabase()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create([
            'plane_id' => Plane::factory()->create()->id,
            'date' => now()->toDateString(),
            'departure_location' => 'Madrid',
            'arrival_location' => 'Londres',
            'price' => 50,
        ]);

        $updatedData = [
            'plane_id' => $flight->plane_id,
            'date' => now()->addDay()->toDateString(),
            'departure_location' => 'Barcelona',
            'arrival_location' => 'París',
            'price' => 75,
        ];

        $response = $this->actingAs($user, 'sanctum')->putJson(route('flightUpdate', $flight->id), $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('flights', $updatedData);
    }

    public function test_ChecksThatTheApiReturnsAnErrorWhenWeTryToUpdateANonExistentFlight()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user, 'sanctum')->putJson(route('flightUpdate', ['id' => 9999]), [
            'plane_id' => 1,
            'date' => now()->toDateString(),
            'departure_location' => 'Roma',
            'arrival_location' => 'Berlín',
            'price' => 100,
        ]);

        $response->assertStatus(404);
    }

    public function test_CheckThatAFlightCanBeDeletedCorrectlyInTheDatabaseViaTheApi()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $this->assertDatabaseHas('flights', ['id' => $flight->id]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson(route('flightDelete', $flight->id));

        $response->assertStatus(200)
            ->assertJson(['message' => 'Vuelo eliminado correctamente']);

        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }

    public function test_ChecksThatTheApiReturnsA404CodeWhenAnAttemptIsMadeToDeleteAFlightThatDoesNotExist()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user, 'sanctum')->deleteJson(route('flightDelete', 999));

        $response->assertStatus(404);
    }
}
