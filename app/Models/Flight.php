<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{

    use HasFactory;

    protected $fillable = [
        'plane_id',
        'date',
        'departure_time',
        'arrival_time',
        'departure_location',
        'arrival_location',
        'available_seats',
        'status'
    ];
    public function plane(): BelongsTo
    {
        return $this->belongsTo(Plane::class, 'plane_id');
    }

    public function flightBookings(): HasMany
    {
        return $this->hasMany(Reservation::class, 'flight_id');
    }

    // Verificar si hay asientos disponibles
    public function hasAvailableSeats(): bool
    {
        return $this->available_seats > 0;
    }

    // Obtener todos los usuarios que han reservado este vuelo
    public function passengers()
    {
        return $this->hasManyThrough(User::class, Reservation::class, 'flight_id', 'id', 'id', 'user_id');
    }
}
