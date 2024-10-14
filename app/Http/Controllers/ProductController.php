<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product, 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->update($request->all());
            return response()->json($product, 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted'], 200);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
