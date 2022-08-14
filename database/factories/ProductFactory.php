<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $imageArray = [
        //     '1656746019-Nike-Airforce-1-New-Collection-2019-png',
        //     '1656748812-teatea-png',
        //     '1656748297-Airforce-1-New-Collection-2021-png'
        // ];

        $imageArray = [
            'fume_strawberry_banana_2__disposable_pod_device_181b9f87-2ffe-4b3b-9d74-f328cf50327e_1024x1024@2x.jpg',
            'fume_bluberry_mint_disposable_pod_device_702c9aa9-e57b-4190-917e-e28f254cd454_1024x1024@2x.jpg',
            'fume_blue_razz_2__disposable_pod_device_eca31aac-4668-4c86-ad7b-2dc8ef525b45_1024x1024@2x.jpg',
            'fume_banana_ice_2__disposable_pod_device_a84d8146-bebd-46d0-b976-22dde0b76ad4_1024x1024@2x.jpg',
            'fume_lush_ice_2__disposable_pod_device_463dbe6d-1a70-4215-a7a2-9a6b22d2ba27_1024x1024@2x.jpg',
            'fume_purple_rain_2__disposable_pod_device_db1fde16-eeb4-40af-b6d7-248734ecd662_300x300.jpg',

            '231cd0fc0f8206753f53e8ef7c0d7dd5--mmf350x350.jpg',
            'cucumber-puff-bar.jpg',
            'mixed-berry-ice-puff-bar-xxl.png',
            'mango-orange-pomelo-puff-bar-xxl.png',
            'pineapple-grape-puff-bar-xxl.png',
            'banana-ice-puff-bar-xxl.png',
            'papaya-strawberry-puff-bar-xxl.png',
            'lush-ice-puff-bar-xxl.png',
            'watermelon-cherry-puff-bar-xxl.png',
            'aloe-mango-melon-puff-bar-xxl.png',
            'cool-mint-puff-bar-xxl.png',
            'peach_ice_puff_bar_plus.jpg',
            'watermelon_puff_bar_plus.jpg',
            'cool_mint_puff_bar_plus.jpg',
            'pina_colada_puff_bar_plus.jpg',
            'guava_ice_puff_bar_plus.jpg',
            'lychee_ice_puff_bar_plus.jpg',
            'mixed_berries_puff_bar_plus.jpg',
            'strawberry_watermelon_puff_bar_plus.jpg',
            'salt-switch-grape-paradise-jednorazova-elektronicka-cigareta-hroznove-vino.jpg',
        ];

        $randomNames = [
            "Harry", "Ross",
            "Bruce", "Cook",
            "Carolyn", "Morgan",
            "Albert", "Walker",
            "Randy", "Reed",
            "Larry", "Barnes",
            "Lois", "Wilson",
            "Jesse", "Campbell",
            "Ernest", "Rogers",
            "Theresa", "Patterson",
            "Henry", "Simmons",
            "Michelle", "Perry",
            "Frank", "Butler",
            "Shirley",
        ];

        $randomColors = [
            'red', 'orange', 'yellow', 'blue', 'green', 'indigo', 'pink',
        ];

        return [
            'name' => 'Disposable Vape ' . $randomNames[rand(0, count($randomNames) - 1)],
            'urltag' => $randomNames[rand(0, count($randomNames) - 1)],
            'category' => 'disposable vape',
            'subtitle' => 'lorem da lorem',
            'description' => '<b>Specifications</b>:<br />
                20mg Nicotine Salt (2%) E-Liquid <br />
                Capacity: 2.0ml <br />
                Puffs: Up to 650 <br />
                Nicotine Per Puff: 66mcg <br />
                Battery: 550mAh',
            'color' => $randomColors[rand(0, count($randomColors) - 1)],
            'size' => rand(30, 44),
            'price' => rand(600, 1200),
            'stock_price' => rand(250, 400),
            'subtag1' => 'new',
            'subtag2' => 'faschioned',
            'active' => 1,
            'quantity' => 2,
            'onsale' => false,
            'added_by' => 1,
            'image_path' => $imageArray[rand(0, count($imageArray) - 1)],
        ];







        // return [
        //     'name' => $randomNames[rand(0, count($randomNames) - 1)],
        //     'category' => $this->faker->name,
        //     'subtitle' => 'lorem da lorem',
        //     'description' => 'lorem da da',
        //     'color' => $this->faker->colorName(),
        //     'size' => $this->faker->numberBetween(12, 50),
        //     'price' => $this->faker->numberBetween(5, 250),
        //     'stock_price' => $this->faker->numberBetween(20, 40),
        //     'subtag1' => $this->faker->name(),
        //     'subtag2' => $this->faker->name(),
        //     'active' => 1,
        //     'quantity' => 0,
        //     'onsale' => false,
        //     'added_by' => 1,
        //     'image_path' => $imageArray[rand(0, 2)],
        // ];
    }
}
