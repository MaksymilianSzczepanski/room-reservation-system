<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(
            ['role_name' => 'Administrator'],
            ['role_description' => 'Pelny dostep do zarzadzania systemem.']
        );

        Role::firstOrCreate(
            ['role_name' => 'Student'],
            ['role_description' => 'Standardowy uzytkownik systemu rezerwacji.']
        );

          Role::firstOrCreate(
            ['role_name' => 'Pracownik'],
            ['role_description' => 'Standardowy uzytkownik systemu rezerwacji.']
        );

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'role_id' => $adminRole->id,
                'name' => 'Admin Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
