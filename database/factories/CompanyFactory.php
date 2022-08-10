<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'phone' => $this->faker->phoneNumber,
            'description' => $this->faker->title,
        ];
    }
}
