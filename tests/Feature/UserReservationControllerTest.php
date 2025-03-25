<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_reservations()
    {
        // Crear un usuario administrador
        $admin = User::factory()->create([
            'isAdmin' => true
        ]);

        // Crear un usuario con reservas
        $user = User::factory()->create();

        // Crear un vuelo
        $flight = Flight::factory()->create();

        // Crear una reserva para el usuario
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'flight_id' => $flight->id
        ]);

        // Autenticar como administrador
        $this->actingAs($admin);

        // Hacer la solicitud GET a la ruta de reservas de admin
        $response = $this->get(route('userReservation'));

        // Verificar que la respuesta es 200 (OK)
        $response->assertStatus(200);

        // Verificar que la vista correcta se cargue
        $response->assertViewIs('reserveListAdmin');

        // Verificar que la vista recibe la lista de usuarios con sus reservas
        $response->assertViewHas('users', function ($users) use ($user, $reservation) {
            return $users->contains($user) && 
                   $users->first()->reservations->contains($reservation);
        });
    }
}
