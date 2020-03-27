<?php

namespace Tests\Feature;

use App\Retailer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetailersTest extends TestCase
{

    use WithFaker,RefreshDatabase;


    /**
     * Test if a user can create a retailer
     * @test
     * @return void
     */
    public function a_user_can_create_a_retailer(): void
    {

        $this->withExceptionHandling();

        $attributes = [
            'name' => $this->faker->company,
            'logo' => UploadedFile::fake()->image('logo.jpg'),
            'description' => $this->faker->text,
            'website' => $this->faker->url
        ];

        $this->post('/retailers', $attributes);

        $this->assertDatabaseHas('retailers', Arr::except($attributes, ['logo']));

    }


    /**
     * Test if a retailer request doesnt have a name
     * @test
     * @return void
     */
    public function a_retailer_requires_a_name(): void
    {
        $attributes = factory(Retailer::class)->raw([
            'name' => ''
        ]);

        $this->post('/retailers', $attributes)->assertSessionHasErrors('name');
    }

    /**
     * Test if a retailer request doesnt have a logo
     * @test
     * @return void
     */
    public function a_retailer_requires_a_logo(): void
    {
        $attributes = factory(Retailer::class)->raw([
            'logo' => ''
        ]);

        $this->post('/retailers', $attributes)->assertSessionHasErrors('logo');
    }

    /**
     * Test if a retailer request doesnt have a description
     * @test
     * @return void
     */
    public function a_retailer_requires_a_description(): void
    {
        $attributes = factory(Retailer::class)->raw([
            'description' => ''
        ]);

        $this->post('/retailers', $attributes)->assertSessionHasErrors('description');
    }

    /**
     * Test if a retailer request doesnt have a website
     * @test
     * @return void
     */
    public function a_retailer_requires_a_website(): void
    {
        $attributes = factory(Retailer::class)->raw([
            'website' => ''
        ]);

        $this->post('/retailers', $attributes)->assertSessionHasErrors('website');
    }


    /**
     * Test if a user can view Retailer informations
     * @test
     * @return void
     */
    public function a_user_can_view_a_retailer(): void
    {

        $this->withoutExceptionHandling();

        $retailer = factory(Retailer::class)->create();

        $this->get($retailer->path())
        ->assertSee($retailer->name)
        ->assertSee($retailer->logo)
        ->assertSee($retailer->description)
        ->assertSee($retailer->website);

    }

}
