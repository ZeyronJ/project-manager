<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->userName();
        return [
            'nombre' => $name,
            'costo_total' => $this->faker->randomDigit() * 10000000,
            'pathfile' => $name,
            'user_id' => 1

            //
        ];
    }
}
