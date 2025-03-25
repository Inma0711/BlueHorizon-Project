<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Flight;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    /*
    public function test_store_redirects_to_login_if_user_is_not_authenticated()
{
    $flight = Flight::factory()->create();

    $response = $this->post(route('reserveFlight', $flight->id));

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error', 'Debes iniciar sesión para reservar un vuelo.');
}
    */
}
