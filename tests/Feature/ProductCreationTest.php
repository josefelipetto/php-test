<?php

namespace Tests\Feature;


use App\Retailer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Validation\Validator;
use Tests\TestCase;

/**
 * Class ProductCreationTest
 * @package Tests\Feature
 */
class ProductCreationTest extends TestCase
{

    use WithFaker, RefreshDatabase;

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
    public function when_creating_name_must_be_valid(): void
    {
        $this->withExceptionHandling();

        $data = $this->getProductMockData();

        unset($data['name']);

        $response = $this->post('/products', $data);

        $this->assertEquals($response->getStatusCode(), 302);

        /* @var Validator $validator */
        $validator = $response->exception->validator;

        $this->assertEquals($validator->messages()->get('name')[0], 'The name field is required.');
    }

    /**
     * @test
     */
    public function when_creating_price_must_be_valid(): void
    {
        $this->withExceptionHandling();

        $data = $this->getProductMockData();

        $data['price'] = 'hello';

        $response = $this->post('/products', $data);

        $this->assertEquals($response->getStatusCode(), 302);

        /* @var Validator $validator */
        $validator = $response->exception->validator;

        $this->assertEquals($validator->messages()->get('price')[0], 'The price must be a number.');
    }
}
