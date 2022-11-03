<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cart::factory(3)->create();

        Cart::factory(30)->create();
    }
}
