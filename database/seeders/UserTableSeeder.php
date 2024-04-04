<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Nischal Acharya',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Nischal@#060'),
            'user_type' => 'admin',
            'verified' => 'true',
        ]);
    }
}
