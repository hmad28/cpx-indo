<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = Category::firstOrCreate(['name' => 'Jersey Custom']);

        collect([
            ['name' => 'Jersey Real Madrid', 'price' => 70000],
            ['name' => 'Jersey Man City', 'price' => 50000],
            ['name' => 'Jersey PSG', 'price' => 50000],
        ])->each(function (array $product) use ($category) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'price' => $product['price'],
                    'image' => 'insertpichere.jpg',
                    'category_id' => $category->id,
                    'description' => 'jersey terbaik nyaman nyerap keringat',
                    'kelebihan' => json_encode(['bahan terbaik', 'nyaman dipakai']),
                ],
            );
        });
    }
}
