<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::limit(20)->get();
        return view('products.index', compact('products'));
    }
    public function checkout(Request $request)
    {
        $quantities = $request->input('quantity');
        $productIds = array_keys(array_filter($quantities, function ($qty) {
            return $qty > 0;
        }));
    
        $products = Product::whereIn('id', $productIds)->get()->map(function ($product) use ($quantities) {
            $product->quantity = $quantities[$product->id];
            return $product;
        });
    
        return view('products.checkout', compact('products'));
    }
}
