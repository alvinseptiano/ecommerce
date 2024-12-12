<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alvin',
            'email' => 'alvin@mail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'is_admin' => false 
        ]);
    }
}
