<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlaneModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckItCanCreateAPlane()
    {
        $plane = Plane::factory()->create([
            'name' => 'Boeing 747',
            'max_seats' => 300,
        ]);

        $this->assertDatabaseHas('planes', [
            'name' => 'Boeing 747',
            'max_seats' => 300,
        ]);
    }

    public function test_CheckItCanHaveManyFlights()
    {
        $plane = Plane::factory()->create();

        $flight1 = Flight::factory()->create(['plane_id' => $plane->id]);
        $flight2 = Flight::factory()->create(['plane_id' => $plane->id]);

        $flights = $plane->flights;

        $this->assertCount(2, $flights);
        $this->assertTrue($flights->contains($flight1));
        $this->assertTrue($flights->contains($flight2));
    }


    public function test_CheckItHasCorrectPlaneProperties()
    {
        $plane = Plane::factory()->create([
            'name' => 'Airbus A320',
            'max_seats' => 180,
        ]);
        
        $this->assertEquals('Airbus A320', $plane->name);
        $this->assertEquals(180, $plane->max_seats);
    }
}
