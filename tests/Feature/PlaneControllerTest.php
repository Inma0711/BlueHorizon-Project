<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaneControllerTest extends TestCase

{
    use RefreshDatabase;


    public function test_CheckShowCreateAircraftView()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('createAircraft'));
        $response->assertStatus(200);
        $response->assertViewIs('createAircraft');
    }

    public function test_CheckAdminIndexDisplaysPlanes()
    {
        $user = User::factory()->create(['isAdmin' => true]);
        $planes = Plane::factory(3)->create();
        $this->actingAs($user);
        $response = $this->get(route('listAircraftAdmin'));
        $response->assertStatus(200);

        $response->assertViewIs('listAircraftAdmin');

        $response->assertViewHas('planes', function ($viewPlanes) use ($planes) {
            return $viewPlanes->count() === 3 &&
                $viewPlanes->pluck('id')->sort()->values()->all() === $planes->pluck('id')->sort()->values()->all();
        });
    }

    public function test_CheckCreateShowsCreateAircraftView()
    {
        $user = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($user);
        $response = $this->get(route('createAircraft'));
        $response->assertStatus(200);
        $response->assertViewIs('createAircraft');
    }


    public function test_CheckStoreShowsValidationErrors()
    {
        $user = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($user);
        $data = [
            'name' => '',
            'max_seats' => -1,
        ];
        $response = $this->post(route('storeAircraft'), $data);
        $response->assertSessionHasErrors(['name', 'max_seats']);
    }


    public function test_CheckEditShowsEditAircraftViewWithPlaneData()
    {
        $user = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($user);
        $plane = Plane::factory()->create();
        $response = $this->get(route('editAircraft', ['search_id' => $plane->id]));
        $response->assertStatus(200);
        $response->assertViewIs('editAircraft');
        $response->assertViewHas('plane', $plane);
    }

    public function test_CheckEditShowsErrorWhenPlaneNotFound()
    {
        $user = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($user);
        $response = $this->get(route('editAircraft', ['search_id' => 999999]));
        $response->assertRedirect(route('editAircraft'));
        $response->assertSessionHas('error', 'Avión no encontrado');
    }

    public function test_CheckSearchShowsErrorWhenPlaneNotFound()
    {
        $user = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($user);
        $response = $this->post(route('searchAircraft', ['search_id' => 999999]));
        $response->assertRedirect(route('editAircraft'));
        $response->assertSessionHas('error', 'Avión no encontrado');
    }

    
    public function test_CheckDestroyFailsWhenAircraftNotFound()
    {
        $user = User::factory()->create(['isAdmin' => true]);

        $this->actingAs($user);
        $response = $this->delete(route('deleteAircraft', ['id' => 999999]));
        $this->assertDatabaseCount('planes', 0); 
        $response->assertRedirect(route('planeList'));
        $response->assertSessionHas('error', 'Avión no encontrado');
    }
}
