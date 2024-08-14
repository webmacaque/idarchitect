<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectPhotoTypesTableSeeder extends Seeder
{
    private const TABLE_NAME = 'project_photo_types';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Фото';
        DB::table(self::TABLE_NAME)->insert([
            'slug' => Str::slug($name),
            'name' => $name,
            'sort' => 10,
            'created_at' => now()
        ]);

        $name = '3D';
        DB::table(self::TABLE_NAME)->insert([
            'slug' => Str::slug($name),
            'name' => $name,
            'sort' => 20,
            'created_at' => now()
        ]);

        $name = '360°';
        DB::table(self::TABLE_NAME)->insert([
            'slug' => Str::slug($name),
            'name' => $name,
            'sort' => 30,
            'created_at' => now()
        ]);
    }
}
