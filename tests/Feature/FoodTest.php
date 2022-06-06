<?php

namespace Tests\Feature;

use App\Models\Food;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class FoodTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_welcome_status()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_createfood_status()
    {
        $response = $this->get('/food/create');

        $response->assertStatus(302);
    }

    public function test_food_with_the_session()
    {
        $response = $this->withSession(['banned' => false])->get('/food');
        $response->assertStatus(302);
    }

    public function test_basic_food_test()
    {
        $response = $this->get('/food');

        $response->dumpHeaders();

        $response->dumpSession();

        $response->dump();
        
        $response->assertStatus(302);
    }
}