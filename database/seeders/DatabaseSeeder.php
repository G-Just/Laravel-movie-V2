<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'IS1ca7122a5fe82d',
            'email' => '98f87fd651@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
