<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $email = $faker->email;
            User::create([
                'name' => $faker->name,
                'email' => $email,
                'password' => bcrypt($email),
                'role' => $faker->randomElement(['editor', 'normal']),
            ]);
        }
    }
}
