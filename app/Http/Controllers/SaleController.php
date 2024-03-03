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

        $formattedSales = [];
        foreach ($sales as $sale) {
            $formattedSale = [
                'sales_id' => $sale->id,
                'amount' => $sale->amount,
                'products' => []
            ];

            foreach ($sale->products as $product) {
                $formattedSale['products'][] = [
                    'product_id' => $product->id,
                    'nome' => $product->name,
                    'price' => $product->price,
                    'amount' => $product->pivot->amount
                ];
            }

            $formattedSales[] = $formattedSale;
        }

        return response()->json($formattedSales);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        $sale = new Sale();
        $sale->amount = $request->amount;
        $sale->save();

        $productsToAdd = [];
        foreach ($request->products as $productData) {
            $productsToAdd[$productData['product_id']] = ['amount' => $productData['amount']];
        }

        $sale->products()->syncWithoutDetaching($productsToAdd);

        return response()->json(['message' => 'Venda registrada com sucesso'], 201);
    }


    public function show($id)
    {
        $sale = Sale::with('products')->findOrFail($id);

        $formattedSale = [
            'sales_id' => $sale->id,
            'amount' => $sale->amount,
            'products' => []
        ];

        foreach ($sale->products as $product) {
            $formattedSale['products'][] = [
                'product_id' => $product->id,
                'nome' => $product->name,
                'price' => $product->price,
                'amount' => $product->pivot->amount
            ];
        }

        return response()->json($formattedSale);
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

        $productsToAdd = [];
        foreach ($request->products as $productData) {
            $productsToAdd[$productData['product_id']] = ['amount' => $productData['amount']];
        }

        $sale->products()->syncWithoutDetaching($productsToAdd);

        return response()->json(['message' => 'Produtos adicionados à venda com sucesso']);
    }

}
