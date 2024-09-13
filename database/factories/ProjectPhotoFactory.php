<?php

namespace Database\Factories;

use App\Models\ProjectPhotoType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectPhoto>
 */
class ProjectPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => fake()->imageUrl(),
            'filename' => fake()->word,
            'project_photo_type_id' => ProjectPhotoType::all()->shuffle()->first->id
        ];
    }
}
