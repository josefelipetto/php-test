<?php

namespace Tests\Unit;

use App\Retailer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetailerTest extends TestCase
{

    use WithFaker;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function it_has_a_path()
    {
        $retailer = factory(Retailer::class)->create();

        $this->assertEquals('/retailers/' . $retailer->slug, $retailer->path());
    }
}
