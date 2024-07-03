<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();        
        User::create([
            'name'=>'Davis Aparicio Palomino',
            'email'=>'dwaparicicio@gmail.com',
            'password'=>bcrypt('B3n3tt0n_')
        ]);
        $this->call([
            ClientSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
