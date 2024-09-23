<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    private const TABLE_NAME = 'users';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(self::TABLE_NAME)->insert([
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => now()
        ]);
    }
}
