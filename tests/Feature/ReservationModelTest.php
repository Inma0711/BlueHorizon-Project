<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckItCanCreateAReservation()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id
        ]);

        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'flight_id' => $flight->id
        ]);
    }

    
    public function test_CheckItBelongsToAUser()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id
        ]);

        $this->assertInstanceOf(User::class, $reservation->user);
        $this->assertEquals($user->id, $reservation->user->id);
    }


    public function test_CheckItBelongsToAFlight()
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create();
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id
        ]);

        $this->assertInstanceOf(Flight::class, $reservation->flight);
        $this->assertEquals($flight->id, $reservation->flight->id);
    }
}
