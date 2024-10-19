<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the super admin already exists to avoid duplicates
        $superAdmin = User::where('email', 'superadmin@example.com')->first();

        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'super-admin',
            ]);

            //Create super-admin role
            Role::create(['name' => 'super-admin']);
            // Assign the super-admin role
            $superAdmin->assignRole('super-admin');

            $this->command->info('Super Admin user created successfully!');
        } else {
            $this->command->info('Super Admin user already exists!');
        }
    }
}
