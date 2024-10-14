<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return response()->json(Sale::with('product')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validated['product_id']);
        if ($product->stock < $validated['quantity']) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }

        $totalPrice = $product->price * $validated['quantity'];
        $sale = Sale::create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        $product->decrement('stock', $validated['quantity']);

        return response()->json($sale, 201);
    }
}
