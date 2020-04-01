<?php

namespace Tests\Feature;

use App\Mail\ClientSubscribed;
use App\Product;
use App\Retailer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ProductsTest
 * @package Tests\Feature
 */
class ProductsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /**
     * @return array
     */
    private function getProductMockData(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2,1,2000),
            'image' => UploadedFile::fake()->image('logo.jpg'),
            'description' => $this->faker->text(),
            'retailer_id' => factory(Retailer::class)->create()->id
        ];
    }

    /**
     * A User can create a product
     * @test
     * @return void
     */
    public function a_user_can_create_a_product(): void
    {
        $this->withExceptionHandling();

        $attributes = $this->getProductMockData();

        $this->post('/products', $attributes);

        $this->assertDatabaseHas('products', Arr::except($attributes, ['image']));
    }

    /**
     * @test
     */
    public function a_user_can_update_a_product() : void
    {
        $this->withExceptionHandling();

        $data = $this->getProductMockData();

        $product = Product::create($data);

        $data['name'] = 'DumbDumb';

        $this->put("/products/{$product->slug}", $data);

        $updatedProduct = Product::find($product->id);

        $this->assertEquals($updatedProduct->name, $data['name']);
    }

    /**
     * A product must have a name
     * @test
     * @return void
     */
    public  function a_product_must_have_a_name(): void
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
    public  function a_product_must_have_a_price(): void
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
    public  function a_product_must_have_a_image(): void
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
    public  function a_product_must_have_a_description(): void
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
    public function a_product_must_have_a_retailer_id(): void
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
    public function a_user_must_see_a_product(): void
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
