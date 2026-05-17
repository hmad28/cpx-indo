<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'Jersey Futsal',
            'Jersey Sepeda',
            'Jersey Custom',
            'Celana Olahraga',
            'Setelan Jersey',
        ])->each(fn (string $name) => Category::firstOrCreate(['name' => $name]));
    }
}
