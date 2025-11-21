<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = [
        //     ['name' => 'Jersey Futsal'],
        //     ['name' => 'Jersey Sepeda'],
        //     ['name' => 'Jersey Custom'],
        //     ['name' => 'Celana Olahraga'],
        //     ['name' => 'Setelan Jersey'],
        // ];

        // DB::table('categories')->insert();

        Category::whereNull('slug')->orWhere('slug', '')->get()->each(function ($category) {
            $category->slug = Str::slug($category->name);
            $category->save();
        });
    }
}
