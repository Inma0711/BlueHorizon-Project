<?php

namespace Database\Factories;

use App\Models\Plane;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Flight::class;

    public function definition(): array
    {
        $cities = ['MADRID', 'MÁLAGA', 'BARCELONA', 'NORUEGA', 'VALENCIA', 'BILBAO', 'JAPÓN', 'MÉXICO', 'LONDRES', 'FRANCIA', 'TAILANDIA'];
    
        return [
            'plane_id' => Plane::query()->inRandomOrder()->first()->id ?? Plane::factory()->create()->id,
            'date' => $this->faker->dateTimeBetween('2025-01-01', '2026-12-31')->format('Y-m-d'),
            'departure_location' => $this->faker->randomElement($cities), 
            'arrival_location' => $this->faker->randomElement($cities), 
            'price' => $this->faker->randomFloat(2, 30, 100),
            'status' => 1
        ];
    }
    
}
