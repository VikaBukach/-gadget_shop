<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\BrandFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Brand::factory(20)->create();

        Product::factory(20)
            ->has(Category::factory(rand(1,3)))
            ->create();

        Category::factory(10)
            ->has(Product::factory(rand(5,15)))
            ->create();



    }
}
