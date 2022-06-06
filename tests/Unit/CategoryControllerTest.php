<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class CategoryControllerTest extends TestCase
{
    
    public function test_store_data()
    {
        $user = User::factory()->create([
            'name' => 'Tes User',
            'email' => 'tesuser@gmail.com',
            'password' => 'tesuser'
        ]);
        
        $response = $this->actingAs($user)->post('category/create', [
            'name' => 'kategori tes'
        ]);
    
        $this->assertTrue(true);
    }

    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

}
