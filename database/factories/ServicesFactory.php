<?php

namespace Database\Factories;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Services::class;
    public function definition()
    {
        return [
            "name"=> 'Front-End Developer',
            'icon'=> 'uil uil-brackets=curly',
            "description"=>"Service description ..."
        ];
    }
}
