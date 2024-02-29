<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::with('products')->get();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_id' => 'required|string|unique:sales',
            'amount' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        $sale = new Sale();
        $sale->sales_id = $request->sales_id;
        $sale->amount = $request->amount;
        $sale->save();

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $sale->products()->attach($product->id, ['amount' => $productData['amount']]);
        }

        return response()->json(['message' => 'Venda registrada com sucesso'], 201);
    }

    public function show($id)
    {
        $sale = Sale::with('products')->findOrFail($id);
        return response()->json($sale);
    }

    public function cancel($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return response()->json(['message' => 'Venda cancelada com sucesso']);
    }

    public function addProducts(Request $request, $id)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        $sale = Sale::findOrFail($id);

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $sale->products()->attach($product->id, ['amount' => $productData['amount']]);
        }

        return response()->json(['message' => 'Produtos adicionados à venda com sucesso']);
    }
}
