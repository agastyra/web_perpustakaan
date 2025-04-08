<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rak>
 */
class RakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = mt_rand(1000000000000000, 9999999999999999);
        return [
            "rak_id" => $id,
            "rak_nama" => $this->faker->colorName(),
            "rak_lokasi" => strtoupper($this->faker->randomLetter()),
            "rak_kapasitas" => $this->faker->randomDigitNotNull()
        ];
    }
}
