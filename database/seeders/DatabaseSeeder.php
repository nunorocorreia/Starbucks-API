<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Drink;
use App\Models\Extras;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Drink::factory()->createMany([
            [
                'name' => 'Latte',
                'price' => 3.50,
                'stock' => 10,
                'id_category' => 1,
            ],
            [
                'name' => 'Mocha',
                'price' => 2.50,
                'stock' => 20,
                'id_category' => 1,
            ],
            [
                'name' => 'Mocchiato',
                'price' => 4.00,
                'stock' => 15,
                'id_category' => 1,
            ],
            [
                'name' => 'Cappuccino',
                'price' => 2.00,
                'stock' => 30,
                'id_category' => 1,
            ],
            [
                'name' => 'Americano',
                'price' => 1.50,
                'stock' => 25,
                'id_category' => 1,
            ],
            [
                'name' => 'Filter Coffee',
                'price' => 3.00,
                'stock' => 12,
                'id_category' => 2,
            ],
            [
                'name' => 'Coffe Misto',
                'price' => 1.75,
                'stock' => 40,
                'id_category' => 2,
            ],
            [
                'name' => 'Mint',
                'price' => 2.25,
                'stock' => 18,
                'id_category' => 3,
            ],
            [
                'name' => 'Chamomile Herbal',
                'price' => 3.75,
                'stock' => 22,
                'id_category' => 3,
            ],
            [
                'name' => 'Earl Grey',
                'price' => 4.50,
                'stock' => 8,
                'id_category' => 3,
            ]
        ]);

        Category::factory()->createMany([
            [
                'name' => 'Espresso Drinks',
            ],
            [
                'name' => 'Brewed Coffee',
            ],
            [
                'name' => 'Tea',
            ],
            [
                'name' => 'Extras',
            ]
        ]);

        Extras::factory()->createMany([
            [
                'name' => 'Cinnamon',
                'price' => 0.45,
            ],
            [
                'name' => 'Yellow Sugar',
                'price' => 0.60,
            ],
            [
                'name' => 'Syrup',
                'price' => 0.50,
            ],
            [
                'name' => 'Whipped Cream',
                'price' => 0.25,
            ]
        ]);
    }
}
