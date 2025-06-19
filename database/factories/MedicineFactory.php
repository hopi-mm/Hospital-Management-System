<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'stock' => 100,
            'price' => 500,
            'dosage'=>$this->faker->word,
            'unit'=>$this->faker->word,
            'description'=>$this->faker->paragraph(),
            'expired_at'=>$this->faker->date
        ];
    }
}
