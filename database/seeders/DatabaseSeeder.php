<?php

namespace Database\Seeders;

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

        $this->call([
            TypefishSeeder::class,
        ]);
    }
}
