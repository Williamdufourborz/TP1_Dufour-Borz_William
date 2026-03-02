<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ordre : tables parents d'abord
        $this->call([
            CategoriesSeeder::class,
            SportsSeeder::class,
            EquipmentSeeder::class,
            EquipmentSportSeeder::class,
        ]);
    }
}
