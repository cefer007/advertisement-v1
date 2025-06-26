<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(1)->create();



         $user = User::query()
             ->where('email', 'admin@gmail.com')
             ->first();

         if(!$user)
         {
             \App\Models\User::factory()->create([
                 'name' => 'Admin',
                 'email' => 'admin@gmail.com',
                 'password' => bcrypt('password'),
             ]);
         }

        Car::factory(100)->create();
    }
}
