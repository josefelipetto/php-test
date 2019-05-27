<?php

namespace Tests\Feature;

use App\Mail\ClientSubscribed;
use App\Product;
use App\Retailer;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use WithFaker;


    /**
     * A User can create a product
     * @test
     * @return void
     */

    public function a_user_can_create_a_product()
    {

        $this->withExceptionHandling();

        $attributes = [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2,1,2000),
            'image' => $this->faker->imageUrl(80,80),
            'description' => $this->faker->text(),
            'retailer_id' => factory(Retailer::class)->create()->id
        ];

        $this->post('/products', $attributes)->assertRedirect('/products');

        $this->assertDatabaseHas('products', $attributes);
    }

    /**
     * A product must have a name
     * @test
     * @return void
     */
    public  function a_product_must_have_a_name()
    {
        $attributes = factory(Product::class)->raw([
            'name' => ''
        ]);

        $this->post('/products', $attributes)->assertSessionHasErrors('name');
    }

    /**
     * A product must have a price
     * @test
     * @return void
     */
    public  function a_product_must_have_a_price()
    {
        $attributes = factory(Product::class)->raw([
            'price' => ''
        ]);

        $this->post('/products', $attributes)->assertSessionHasErrors('price');
    }


    /**
     * A product must have a image
     * @test
     * @return void
     */
    public  function a_product_must_have_a_image()
    {
        $attributes = factory(Product::class)->raw([
            'image' => ''
        ]);

        $this->post('/products', $attributes)->assertSessionHasErrors('image');
    }

    /**
     * A product must have a description
     * @test
     * @return void
     */
    public  function a_product_must_have_a_description()
    {
        $attributes = factory(Product::class)->raw([
            'description' => ''
        ]);

        $this->post('/products', $attributes)->assertSessionHasErrors('description');
    }


    /**
     * A product must have a retailer_id
     * @test
     * @return void
     */
    public  function a_product_must_have_a_retailer_id()
    {
        $attributes = factory(Product::class)->raw([
            'retailer_id' => ''
        ]);

        $this->post('/products', $attributes)->assertSessionHasErrors('retailer_id');
    }


    /**
     * A user must see a product
     * @test
     * @return void
     */
    public function a_user_must_see_a_product()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();

        $this->get($product->path())
            ->assertSee($product->name)
            ->assertSee($product->price)
            ->assertSee($product->description)
            ->assertSee($product->image)
            ->assertSee($product->retailer_id);

    }

}
