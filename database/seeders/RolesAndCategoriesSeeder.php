<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesAndCategoriesSeeder extends Seeder
{
    public function run()
    {
        // Insert Roles
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'organizer'],
            ['id' => 3, 'name' => 'volunteer'],
            ['id' => 4, 'name' => 'participant'],
        ]);

        // Insert Categories
        DB::table('categories')->insertOrIgnore([
            ['id' => 1, 'name' => 'Environmental'],
            ['id' => 2, 'name' => 'Sports'],
            ['id' => 3, 'name' => 'Health'],
            ['id' => 4, 'name' => 'Cultural'],
            ['id' => 5, 'name' => 'Civic'],
            ['id' => 6, 'name' => 'Arts'],
        ]);
    }
}