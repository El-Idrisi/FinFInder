<?php

namespace Database\Seeders;

use App\Models\SpotIkan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'nelayan',
        ]);

        User::factory()->count(5)->create();

        $this->call([
            TypefishSeeder::class,
        ]);

        // Buat 5 spot dengan status ditunda
        SpotIkan::factory()->count(25)->ditunda()->create();

        // Buat 5 spot dengan status ditolak
        SpotIkan::factory()->count(5)->ditolak()->create();
    }
}
