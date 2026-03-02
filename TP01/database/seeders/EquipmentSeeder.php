<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $sql = file_get_contents(database_path('sql/equipment.sql'));
        DB::unprepared($sql);
    }
}
