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
        $this->call(RolesAndCategoriesSeeder::class);

        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role_id' => 1,
                'status' => 'active',
                'password' => bcrypt('Admin123!'),
            ],
            [
                'name' => 'Organizer User',
                'email' => 'organizer@example.com',
                'role_id' => 2,
                'status' => 'active',
                'password' => bcrypt('Organizer123!'),
            ],
            [
                'name' => 'Volunteer User',
                'email' => 'volunteer@example.com',
                'role_id' => 3,
                'status' => 'active',
                'password' => bcrypt('Volunteer123!'),
            ],
            [
                'name' => 'Participant User',
                'email' => 'participant@example.com',
                'role_id' => 4,
                'status' => 'active',
                'password' => bcrypt('Participant123!'),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
