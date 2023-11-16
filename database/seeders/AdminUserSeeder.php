<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Jussy', 
            'email' => 'jussy@gmail.com',
            'password' => bcrypt('jussy0206'),
            'role' => 'admin'
        ]);
    }
}
