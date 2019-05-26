<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * Check if Model has a path
     * @test
     * @return void
     */
    public function p_it_has_a_path()
    {
        $product = factory(Product::class)->create();

        $this->assertEquals('/products/' . $product->slug, $product->path());
    }

}
