<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSportSeeder extends Seeder
{
    public function run(): void
    {
        $sql = file_get_contents(database_path('sql/equipment_sport.sql'));
        DB::unprepared($sql);
    }
}
