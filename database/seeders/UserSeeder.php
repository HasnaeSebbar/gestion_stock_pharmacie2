<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'pharmacien@gmail.com')->exists()) {
        User::create([
            'name' => 'pharmacien',
            'prenom' => 'Douaa',
            'email' => 'pharmacien@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'role' => 'pharmacien',
            'depot_id' => 1,
        ]);
    }
       if (!User::where('email', 'chef@gmail.com')->exists()) {
        User::create([
            'name' => 'Chef',
            'prenom' => 'Pharmacie',
            'email' => 'chef@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('chef123'),
            'role' => 'chef pharmacie',
            'depot_id' => 1,
   ]);
    }
    
    if (!User::where('email', 'radiologie@gmail.com')->exists()) {
        User::create([
            'name' => 'service radiologie',
            'prenom' => 'majeur',
            'email' => 'radiologie@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('radiologie1234'),
            'role' => 'majeur',
            'depot_id' => 2,
        ]);
    }

    }
}


