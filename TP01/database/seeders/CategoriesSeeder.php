<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $sql = file_get_contents(database_path('sql/categories.sql'));
        DB::unprepared($sql);
    }
}
