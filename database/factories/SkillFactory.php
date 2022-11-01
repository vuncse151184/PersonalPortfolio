<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => 'PHP',
            'proficiency' => '90',
            'service_id' => '1'
        ];
    }
}
