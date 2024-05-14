<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products as p')
    ->join('warehouses_products as wp', 'p.id', '=', 'wp.product_id')
    ->select(
        'p.id',
        'p.sku', 
        'p.name', 
        'p.detail_image',  // Asegúrate de incluir esta línea si necesitas acceder a detail_image
        'p.description', 
        'wp.product_id',
        'wp.points',
        'wp.vc_to_suggested', 
        'wp.suggested_price', 
        'wp.country_id', 
        'wp.suggested_tax', 
        DB::raw('wp.suggested_price + wp.suggested_tax AS total'), 
        'wp.active_status'
    )
    ->where('wp.country_id', 2)
    ->where('wp.active_status', 1)
    ->where('p.sku', 'like', '%M')
    ->orderBy('p.id', 'asc')
    ->limit(20)
    ->get();
    
    //dd($products);

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
