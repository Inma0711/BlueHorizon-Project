<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaneControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_CheckAdminCanStoreNewPlane()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $response = $this->actingAs($admin)->post(route('storeAircraft'), [
            'name' => 'Boeing 747',
            'max_seats' => 400,
        ]);

        $response->assertRedirect(route('planeList'));
        $this->assertDatabaseHas('planes', ['name' => 'Boeing 747']);
    }


    public function test_CheckAdminCanUpdatePlane()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($admin);

        $plane = Plane::factory()->create([
            'name' => 'Boeing 737',
            'max_seats' => 200,
        ]);

        $response = $this->put(route('updateAircraft', $plane->id), [
            'name' => 'Airbus A320',
            'max_seats' => 299,
        ]);

        $response->assertRedirect(route('planeList'));

        $this->assertDatabaseHas('planes', ['name' => 'Airbus A320']);
    }


    public function test_CheckAdminCanAccessPlaneList()
    {
        $user = User::factory()->create(['isAdmin' => true]);
        $response = $this->actingAs($user)->get(route('planeList'));
        $response->assertStatus(200);
        $response->assertViewIs('listAircraftAdmin');
        $response->assertViewHas('planes');
    }


    public function test_AdminCanAccessAircraftCreationPage()
    {
        $admin = User::factory()->create(['isAdmin' => true]);

        $response = $this->actingAs($admin)->get(route('createAircraft'));

        $response->assertStatus(200);
        $response->assertViewIs('createAircraft');
    }


    public function test_CheckUserCanAccessEditAircraftPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('editAircraft'));

        $response->assertStatus(200);
        $response->assertViewIs('editAircraft');
        $response->assertViewHas('planes');
    }


    public function test_CheckUserCanSearchAndFindAnAircraft()
    {
        $user = User::factory()->create();
        $plane = Plane::factory()->create();

        $response = $this->actingAs($user)->get(route('editAircraft', ['search_id' => $plane->id]));

        $response->assertStatus(200);
        $response->assertViewIs('editAircraft');
        $response->assertViewHas('plane', $plane);
    }


    public function test_CheckDeletingNonExistentAircraftRedirectsWithError()
    {
        $admin = User::factory()->create(['isAdmin' => true]);
        $nonExistentId = 9999;

        $response = $this->actingAs($admin)->delete(route('deleteAircraft', $nonExistentId));

        $response->assertRedirect(route('planeList'));
        $response->assertSessionHas('error', 'Avión no encontrado');
    }
}
