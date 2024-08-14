<?php

namespace Database\Factories;

use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug,
            'name' => Str::ucfirst(fake()->word),
            'short_description' => Str::ucfirst(fake()->word),
            'description' => fake()->realText,
            'year' => fake()->numberBetween(2010, 2024),
            'home_page' => false,
            'project_type_id' => ProjectType::all()->shuffle()->first->id,
            'is_published' => fake()->boolean
        ];
    }
}
