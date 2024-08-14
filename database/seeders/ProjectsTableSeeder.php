<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()
            ->count(30)
            ->hasProjectPhoto(5)
            ->create();
    }
}
