<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            TaxonomiaSeeder::class,
            EspecieSeeder::class,
            UbicacionSeeder::class,
            HabitatSeeder::class,
            EspecieHabitatSeeder::class,
            EspecieUbicacionSeeder::class,
            ImagenesEspeciesSeeder::class,
        ]);
    }
}