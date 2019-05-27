<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A subscription must have an e-mail
     * @test
     * @return void
     */
    public function a_subscription_must_have_an_email()
    {
        $product = factory(Product::class)->create();

        $attributes = [
            'email' => '',
            'product_id' => $product->id
        ];

        $this->post($product->path() . '/subscribe', $attributes)->assertSessionHasErrors('email');
    }

    /**
     * A subscription must have a product_id
     * @test
     * @return void
     */
    public function a_subscription_must_have_a_product_id()
    {
        $product = factory(Product::class)->create();

        $attributes = [
            'email' => 'admin@smallcommerce.com',
            'product_id' => ''
        ];

        $this->post($product->path() . '/subscribe', $attributes)->assertSessionHasErrors('product_id');
    }

}
