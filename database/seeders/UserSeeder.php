<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        
         // Define user details with roles
        $users = [
            ['name' => 'Super Admin', 'email' => 'superadmin@gmail.com', 'password' => 'password', 'role' => 'superadmin'],
            ['name' => 'Admin User', 'email' => 'admin@gmail.com', 'password' => 'password', 'role' => 'admin'],
            ['name' => 'Sumon', 'email' => 'patient@gmail.com', 'password' => 'password', 'role' => 'patient'],
            ['name' => 'Dr. Smith', 'email' => 'doctor@gmail.com', 'password' => 'password', 'role' => 'doctor'],
            ['name' => 'Hospital Manager', 'email' => 'hospital@gmail.com', 'password' => 'password', 'role' => 'hospital'],
            ['name' => 'Clinic Manager', 'email' => 'clinic@gmail.com', 'password' => 'password', 'role' => 'clinic'],
            ['name' => 'Sumon', 'email' => 'beautician@gmail.com', 'password' => 'password', 'role' => 'beautician'],
            ['name' => 'Astro Guru', 'email' => 'astrologist@gmail.com', 'password' => 'password', 'role' => 'astrologist'],
            ['name' => 'Marketing Expert', 'email' => 'marketer@gmail.com', 'password' => 'password', 'role' => 'marketer'],
            ['name' => 'IT Specialist', 'email' => 'it@gmail.com', 'password' => 'password', 'role' => 'it'],
        ];

        foreach ($users as $userData) {
            // Create a new user
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['12345678']),
            ]);

            // Assign the specified role
            $role = Role::firstOrCreate(['name' => $userData['role']]);
            $user->assignRole($role);
        }

    }
  
}
