<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $category = DB::table('categories')->where('name', 'Jersey Custom')->first();
    // Baru setelah itu, masukkan produk
    $products = [
        ['name' => 'Jersey Real Madrid', 'price' => 70000, 'image' => 'insertpichere.jpg', 'category_id' => $category->id, 'description' => 'jersey terbaik nyaman nyerap keringat', 'kelebihan' => json_encode(['bahan terbaik', 'nyaman dipakai'])],
        ['name' => 'Jersey Man City', 'price' => 50000, 'image' => 'insertpichere.jpg', 'category_id' => $category->id, 'description' => 'jersey terbaik nyaman nyerap keringat', 'kelebihan' => json_encode(['bahan terbaik', 'nyaman dipakai'])],
        ['name' => 'Jersey PSG', 'price' => 50000, 'image' => 'insertpichere.jpg', 'category_id' => $category->id, 'description' => 'jersey terbaik nyaman nyerap keringat', 'kelebihan' => json_encode(['bahan terbaik', 'nyaman dipakai'])],
    ];
    DB::table('products')->insert($products);
}

}
