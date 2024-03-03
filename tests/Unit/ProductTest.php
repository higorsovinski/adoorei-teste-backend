<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testProductCreation()
    {

        $product = Product::factory()->create([
            'name' => 'Produto teste',
            'price' => 100.00,
            'description' => 'Descrição produto teste',
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Produto teste',
            'price' => 100.00,
            'description' => 'Descrição produto teste',
        ]);

    }
}

?>