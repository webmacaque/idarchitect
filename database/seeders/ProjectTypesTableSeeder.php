<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectTypesTableSeeder extends Seeder
{
    private const TABLE_NAME = 'project_types';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = 'Архитектурные проекты';
        DB::table(self::TABLE_NAME)->insert([
            'slug' => Str::slug($name),
            'name' => $name,
            'sort' => 10,
            'created_at' => now()
        ]);

        $name = 'Интерьерные проекты';
        DB::table(self::TABLE_NAME)->insert([
            'slug' => Str::slug($name),
            'name' => $name,
            'sort' => 20,
            'created_at' => now()
        ]);
    }
}
