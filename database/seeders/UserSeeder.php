<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super',
            'last_name' => 'Manager',
            'email' => 'supManager@gmail.com',
            'password' => Hash::make('Pass1234'),
            'branch_id' => 1
        ]);

        $user->assignRole('supManager');

        $user = User::create([
            'name' => 'Santiago',
            'last_name' => 'López',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('Pass1234'),
            'branch_id' => 1
        ]);

        $user->assignRole('manager');

        $user = User::create([
            'name' => 'Arturo',
            'last_name' => 'Lessieur',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Pass1234'),
            'branch_id' => 1
        ]);

        $user->assignRole('admin');
    }
}
