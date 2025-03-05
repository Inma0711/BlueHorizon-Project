<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    public function bookedFlights(): HasManyThrough
    {
        return $this->hasManyThrough(Flight::class, Reservation::class, 'user_id', 'id', 'id', 'flight_id');
    }

    // Obtener solo las reservas activas (futuras)
    public function activeReservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id')->whereHas('flight', function ($query) {
            $query->where('date', '>=', now());
        });
    }

    // Obtener solo las reservas pasadas
    public function pastReservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id')->whereHas('flight', function ($query) {
            $query->where('date', '<', now());
        });
    }

    // Verificar si el usuario tiene una reserva en un vuelo específico
    public function hasReservationForFlight($flightId): bool
    {
        return $this->reservations()->where('flight_id', $flightId)->exists();
    }
}
