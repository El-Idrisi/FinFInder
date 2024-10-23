<?php

namespace Database\Seeders;

use App\Models\FishType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypefishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FishType::insert([
            ['nama' => 'Terubuk'],
            ['nama' => 'Kurau'],
            ['nama' => 'Pari'],
            ['nama' => 'Bawal'],
            ['nama' => 'Kerapu'],
            ['nama' => 'Senangin'],
            ['nama' => 'Tenggiri'],
            ['nama' => 'Kakap'],
            ['nama' => 'Parang'],
            ['nama' => 'Gulama'],
        ]);
    }
}
