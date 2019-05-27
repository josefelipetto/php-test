<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
{
    /**
     * A subscription must have an e-mail
     * @test
     * @return void
     */
    public function a_subscription_must_have_an_email()
    {
        $product = Product::first();

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
        $product = Product::first();

        $attributes = [
            'email' => 'admin@smallcommerce.com',
            'product_id' => ''
        ];

        $this->post($product->path() . '/subscribe', $attributes)->assertSessionHasErrors('product_id');
    }

}
