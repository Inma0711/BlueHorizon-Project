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

    public function test_CheckIfTheApiReturnsAllFlights()
    {
        Flight::factory(3)->create();
        $response = $this->get(route('flightIndex'));
        $response->assertStatus(200)
            ->assertJsonCount(3);
    }


    public function test_CheckIfTheApiReturnsOnlyOneFlights()
    {
        $flight = Flight::factory()->create();
        $response = $this->get(route('flightShow', $flight->id));

        $response->assertStatus(200)
            ->assertJson([
                'plane_id' => $flight->plane_id,
                'date' => $flight->date,
                'departure_location' => $flight->departure_location,
                'arrival_location' => $flight->arrival_location,
            ]);
    }


    public function test_CheckIfYouAreTryingToSearchForAnFlightsThatDoesNotExist()
    {
        $response = $this->getJson(route('flightShow', ['id' => 999]));
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Vuelo no encontrado',
            ]);
    }


    public function test_CheckIfAnFlightsIsCreatedCorrectly()
    {

        $plane = Plane::factory()->create();

        $data = [
            'plane_id' => $plane->id,
            'date' => now()->toDateString(),
            'departure_location' => 'Madrid',
            'arrival_location' => 'Londres',
        ];


        $response = $this->post(route('flightStore'), $data);


        $response->assertStatus(201)
            ->assertJson([
                'plane_id' => $plane->id,
                'date' => $data['date'],
                'departure_location' => $data['departure_location'],
                'arrival_location' => $data['arrival_location'],
            ]);

        $this->assertDatabaseHas('flights', $data);
    }


    public function test_CheckThatAFlightCannotBeCreatedIfMandatoryFieldsAreMissing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson(route('flightStore'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['plane_id', 'date', 'departure_location', 'arrival_location']);
    }


    public function test_ChecksThatAFlightCanBeUpdatedInTheDatabase()
    {
        $flight = Flight::factory()->create([
            'plane_id' => Plane::factory()->create()->id,
            'date' => now()->toDateString(),
            'departure_location' => 'Madrid',
            'arrival_location' => 'Londres',
        ]);

        $updatedData = [
            'plane_id' => $flight->plane_id,
            'date' => now()->addDay()->toDateString(),
            'departure_location' => 'Barcelona',
            'arrival_location' => 'París',
        ];

        $response = $this->putJson(route('flightUpdate', $flight->id), $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('flights', $updatedData);
    }


    public function test_ChecksThatTheApiReturnsAnErrorWhenWeTryToUpdateANonExistentFlight()
    {
        $response = $this->putJson(route('flightUpdate', ['id' => 9999]), [
            'plane_id' => 1,
            'date' => now()->toDateString(),
            'departure_location' => 'Roma',
            'arrival_location' => 'Berlín',
        ]);

        $response->assertStatus(404);
    }

    
    public function test_CheckThatAFlightCanBeDeletedCorrectlyInTheDatabaseViaTheApi()
    {

        $flight = Flight::factory()->create();
        $this->assertDatabaseHas('flights', ['id' => $flight->id]);
        $response = $this->deleteJson(route('flightDelete', $flight->id));
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Vuelo eliminado correctamente',
            ]);
        $this->assertDatabaseMissing('flights', ['id' => $flight->id]);
    }


    public function test_ChecksThatTheApiReturnsA404CodeWhenAnAttemptIsMadeToDeleteAFlightThatDoesNotExist()
    {
        $response = $this->deleteJson(route('flightDelete', 999));
        $response->assertStatus(404);
    }
}
