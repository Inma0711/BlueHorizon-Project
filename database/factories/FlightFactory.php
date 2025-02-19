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
        return [
            'plane_id' => Plane::factory(), 
            'date' => $this->faker->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'departure_location' => $this->faker->city(),
            'arrival_location' => $this->faker->city(),
        ];
    }
}
