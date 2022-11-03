<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::factory(30)->state(new Sequence(
        //     ['is_active' => true],
        //     ['is_active' => false],
        // ))->create();

        ProductCategory::factory(10)->create();
    }
}
