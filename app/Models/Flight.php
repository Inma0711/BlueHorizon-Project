<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
