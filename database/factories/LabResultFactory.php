<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabResult>
 */
class LabResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => 1,
            'test_name' => $this->faker->word,
            'result_summary' => $this->faker->paragraph(),
            'detailed_result' => $this->faker->paragraph(),
            'performed_at' => now(),
        ];
    }
}
