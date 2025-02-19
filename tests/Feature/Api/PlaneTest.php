<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaneTest extends TestCase
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

    public function test_CheckIfTheApiReturnsAllAircraft()
    {
        Plane::factory(3)->create();
        $response = $this->get(route('planesIndex'));
        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_CheckIfTheApiReturnsOnlyOneAircraft()
    {
        $plane = Plane::factory()->create();
        $response = $this->get(route('planesShow', $plane->id));

        $response->assertStatus(200)
            ->assertJson([
                'id' => $plane->id,
                'name' => $plane->name,
                'max_seats' => $plane->max_seats,
            ]);
    }

    public function test_CheckIfYouAreTryingToSearchForAnAircraftThatDoesNotExist()
    {
        $response = $this->getJson(route('planesShow', ['id' => 999]));
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Avión no encontrado',
            ]);
    }

    public function test_CheckIfAnAircraftIsCreatedCorrectly()
    {
        $data = [
            'name' => 'Airbus B420',
            'max_seats' => 160,
        ];

        $response = $this->post(route('planesStore'), $data);
        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Airbus B420',
                'max_seats' => 160,
            ]);

        $this->assertDatabaseHas('planes', $data);
    }

    public function test_CheckThatAnAircraftCannotBeCreatedIfMandatoryFieldsAreMissing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson(route('planesStore'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'max_seats']);
    }

    public function test_ChecksThatAnAircraftCanBeUpdatedInTheDatabase()
    {
        $plane = Plane::factory()->create([
            'name' => 'Super 406',
            'max_seats' => 200,
        ]);

        $updatedData = [
            'name' => 'Super 406',
            'max_seats' => 210,
        ];

        $response = $this->putJson("/api/planes/{$plane->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('planes', $updatedData);
    }

    public function test_ChecksThatTheApiReturnsAnErrorWhenWeTryToUpdateANonExistentAircraft()
    {
        $response = $this->put(route('planesUpdate', ['id' => 9999]), [
            'name' => 'Avioncito 103',
            'max_seats' => 205,
        ]);

        $response->assertStatus(404);
    }

    public function test_it_can_delete_a_plane()
    {
        $plane = Plane::factory()->create();

        $response = $this->delete(route('planesDelete', $plane->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('planes', ['id' => $plane->id]);
    }

    public function test_ChecksThatTheApiReturnsA404CodeWhenAnAttemptIsMadeToDeleteAnAircraftThatDoesNotExist()
    {
        $response = $this->deleteJson('/api/planes/999');
        $response->assertStatus(404);
    }
}
