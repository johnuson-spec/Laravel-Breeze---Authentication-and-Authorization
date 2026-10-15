<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'course_code' => strtoupper(fake()->unique()->bothify('CRS-###')),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
        ];
    }
}