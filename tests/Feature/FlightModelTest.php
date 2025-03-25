<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Plane;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckBelongsToAPlane()
    {
        $plane = Plane::factory()->create();
        $flight = Flight::factory()->create(['plane_id' => $plane->id]);

        $this->assertInstanceOf(Plane::class, $flight->plane);
        $this->assertEquals($plane->id, $flight->plane->id);
    }


    public function test_CheckItHasManyFlightBookings()
    {

        $flight = Flight::factory()->create();

        $reservation = new Reservation([
            'user_id' => User::factory()->create()->id,
            'flight_id' => $flight->id,
        ]);
        $reservation->save();

        $this->assertTrue($flight->flightBookings->contains($reservation));
    }

    public function test_CheckCanReserveAFlight()
    {
        $flight = Flight::factory()->create(['status' => false]);
        $flight->reserve();
        $this->assertTrue($flight->status);
    }


    public function test_CheckItCanCancelAFlight()
    {
        $flight = Flight::factory()->create(['status' => true]);
        $flight->cancel();
        $this->assertFalse($flight->status);
    }

    public function test_CheckItHasManyPassengersThroughReservations()
    {
        $flight = Flight::factory()->create();
        $user = User::factory()->create();

        $reservation = new Reservation([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
        ]);
        $reservation->save();
        $this->assertTrue($flight->passengers->contains($user));
    }
}
