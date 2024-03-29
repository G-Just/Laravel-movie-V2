<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'IS1ca7122a5fe82d',
            'email' => '98f87fd651@gmail.com',
            'password' => Hash::make('123')
        ]);

        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        for ($i = 2; $i < 20; $i++) {
            DB::table('ratings')->insert([
                'rating' => 10,
                'comment' => Str::random(50),
                'user_id' => $i,
                'movie_id' => 1
            ]);
        }
    }
}
