<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['simple', 'doble', 'triple', 'matrimonial'];
        return [
            'number' => $this->faker->unique()->numberBetween(100, 999), // Números de habitación únicos entre 100 y 999
            'type' => $this->faker->randomElement($types), // Capacidad entre 1 y 4 personas
            'price' => $this->faker->randomFloat(2, 50, 300), // Precio entre 50.00 y 300.00
        ];
    }
}
