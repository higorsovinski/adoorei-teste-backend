<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $sale = Sale::create([
                'amount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $products = Product::inRandomOrder()->limit(rand(1, 3))->get();

            foreach ($products as $product) {
                DB::table('sale_product')->insert([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'amount' => rand(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $totalAmount = 0;
            foreach ($products as $product) {
                $amount = DB::table('sale_product')
                    ->where('sale_id', $sale->id)
                    ->where('product_id', $product->id)
                    ->value('amount');

                $totalAmount += $product->price * $amount;
            }

            $sale->update(['amount' => $totalAmount]);
        }
    }
}
