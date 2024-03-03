<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_create_a_sale_with_products()
    {
        $sale = Sale::factory()->create([
            'amount' => 100.00,
        ]);

        $products = Product::factory()->count(3)->create();

        foreach ($products as $product) {
            $sale->products()->attach($product, ['amount' => 1]);
        }

        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'amount' => 100.00,
        ]);

        foreach ($products as $product) {
            $this->assertDatabaseHas('sale_product', [
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'amount' => 1,
            ]);
        }

    }
}
