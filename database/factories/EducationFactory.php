<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'instituation'=>'FPT-University',
            'period'=>'2019-2023',
            'degree'=>'Banchelor of SoftwareEngineering',
            'department'=>'Software Engineering'

        ];
    }
}
