<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $this->productionSeeders();
        $this->developmentSeeders();
    }

    private function productionSeeders() {
        $this->call(ProjectTypesTableSeeder::class);
        $this->call(ProjectPhotoTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }

    private function developmentSeeders() {
        $this->call(ProjectsTableSeeder::class);
    }
}
