<?php

use Illuminate\Database\Seeder;
use App\Retailer;
use App\Product;

class RetailersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Retailer::class, 10)->create()->each(static function ($retailer){

            $retailer->products()->saveMany(
                factory(Product::class,10)->make()
            );

        });
    }
}
