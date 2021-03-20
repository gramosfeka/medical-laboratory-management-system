<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'surname' => 'Admin',
            'phone_number' => '049895604',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'address' => 'Vushtrri',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'id' => 2,
            'name' => 'User',
            'surname' => 'User',
            'phone_number' => '049941898',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'address' => 'Prishtine',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'id' => 3,
            'name' => 'Employee',
            'surname' => 'Employee',
            'phone_number' => '049109251',
            'email' => 'employee@gmail.com',
            'role' => 'employee',
            'address' => 'Mitrovice',
            'password' => bcrypt('12345678'),
        ]);
    }
}
