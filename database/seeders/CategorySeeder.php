<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            ['name' => 'Liquids', 'url' => str_replace(' ', '-', strtolower('Liquids')), 'created_at' => now()],
            ['name' => 'Disposable vapes', 'url' => str_replace(' ', '-', strtolower('Disposable vapes')), 'created_at' => now()],
            ['name' => 'Other', 'url' => str_replace(' ', '-', strtolower('Other')), 'created_at' => now()],
        ];

        if (count(Category::all()) < count($categories)) {
            Category::insert($categories);
        }
    }
}
