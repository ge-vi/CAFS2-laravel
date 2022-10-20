<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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

        Product::factory(30)->create();
    }
}
