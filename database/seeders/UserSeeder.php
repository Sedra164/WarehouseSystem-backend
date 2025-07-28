<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['full_name'=>'admin',           'email'=>  'admin@gmail.com',            'password'=>Hash::make('12345678'),         'role'=>'admin'],
            ['full_name' => 'أحمد محمد',     'email' => 'ahmad@example.com',          'password' => Hash::make('password123'),    'role'=>'manager'],
            ['full_name' => 'سامر علي',      'email' => 'samir@example.com',          'password' => Hash::make('password123'),    'role'=>'manager'],
            ['full_name' => 'سارة علي',      'email' => 'sara@example.com',           'password' => Hash::make('password123'),    'role'=>'staff'],
            ['full_name' => 'خالد يوسف',     'email' => 'khaled@example.com',         'password' => Hash::make('password123'),    'role'=>'staff'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
