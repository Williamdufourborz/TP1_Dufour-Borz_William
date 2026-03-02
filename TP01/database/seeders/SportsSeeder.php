<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsSeeder extends Seeder
{
    public function run(): void
    {
        $sql = file_get_contents(database_path('sql/sports.sql'));
        DB::unprepared($sql);
    }
}
