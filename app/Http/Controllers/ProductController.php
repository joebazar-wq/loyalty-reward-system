<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products (Admin/Staff)
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:1',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Edit product
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:1',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }
    // Customer: Buy a product
    public function buy(Product $product)
    {
        $user = auth()->user();

        // Prevent buying if out of stock
        if ($product->stock < 1) {
            return back()->with('error', 'Out of stock');
        }

        // Deduct 1 stock when purchased
        $product->stock -= 1;
        $product->save();

        // Calculate loyalty points
        // 100 pesos = 1 point
        $points = floor($product->price / 100);

        // Add points to user
        $user->loyalty_points += $points;
        $user->save();

        return back()->with('success', "Purchase successful! You earned {$points} loyalty points.");
    }

}
