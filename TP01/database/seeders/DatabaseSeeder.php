<?php
//pluck('id'), ->random(), collect(), ->attach() sont des suggestions de l'auto completion copilot, je suis par aillieurs aller voir leur fonctionnement individuel pour mieux les comprendre et les utiliser dans le seeder.
namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Review;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Seeders SQL ordre: tables parents d'abord
        $this->call([
            CategoriesSeeder::class,
            SportsSeeder::class,
            EquipmentSeeder::class,
            EquipmentSportSeeder::class,
        ]);

        // Factories Users
        $users = User::factory(10)->create();

        // Factories Rentals (variété sur les FK)
        $equipmentIds = Equipment::pluck('id'); // The pluck() method is designed to extract values from a single key in a collection. It’s particularly handy when you want to retrieve a specific attribute from a collection of arrays or objects.
        $rentals = collect(); //The collect() function in Laravel is a global PHP helper that creates an instance of Illuminate\Support\Collection from a given array. This class provides a powerful, fluent, and convenient wrapper for working with data, offering dozens of methods for filtering, transforming, and aggregating data without writing manual loops.
        foreach ($users as $user) {
            $userRentals = Rental::factory(3)->create([
                'user_id' => $user->id,
                'equipment_id' => $equipmentIds->random(), //In Laravel and plain PHP, there are several methods for generating random data, but ->random() is a method specific to Laravel Collections and Eloquent queries (as inRandomOrder()), not a universal function for all use cases.
            ]);
            $rentals = $rentals->merge($userRentals);
        }

        // 4. Factories — Reviews (variété sur les FK)
        foreach ($rentals as $rental) {
            Review::factory(rand(0, 2))->create([
                'user_id' => $users->random()->id,
                'rental_id' => $rental->id,
            ]);
        }

        // 5. Sports supplémentaires avec équipements (au moins 10 sports, 2+ équipements chacun)
        $categoryIds = \App\Models\Category::pluck('id');
        $extraSports = Sport::factory(10)->create();
        foreach ($extraSports as $sport) {
            $newEquipment = Equipment::factory(2)->create([
                'category_id' => $categoryIds->random(),
            ]);
            $sport->equipment()->attach($newEquipment->pluck('id')); //The ->attach() method in Laravel Eloquent is primarily used to manage many-to-many relationships by inserting records into the intermediate (pivot) table. It can also refer to the process of including files as email attachments
        }
    }
}
