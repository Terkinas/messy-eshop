<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $randomEmail = [
            "Harry@gmail.com",
            "Bruce@gmail.com",
            "Carolyn@gmail.com",
            "Albert@gmail.com",
            "Randy@gmail.com",
            "Larry@gmail.com",
            "Lois@gmail.com",
            "Jesse@gmail.com",
            "Ernest@gmail.com",
            "Theresa@gmail.com",
            "Henry@gmail.com",
            "Michelle@gmail.com",
            "Frank@gmail.com",
            "Shirley@gmail.com",
        ];

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => $randomEmail[rand(0, count($randomEmail) - 1)],
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // $this->call(UserFactory::class);
        $this->call(ProductsSeeder::class);
        $this->call(ReviewsSeeder::class);
    }
}
