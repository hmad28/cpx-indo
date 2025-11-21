<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $bestSellers = Product::where('is_best_seller', true)->get();

        return view('admin.best-seller.index', compact('products', 'bestSellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::find($request->product_id);
        $product->is_best_seller = true;
        $product->save();

        return redirect()->route('best-seller.index')->with('success', 'Produk ditambahkan ke Best Seller!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->is_best_seller = false;
        $product->save();

        return redirect()->route('best-seller.index')->with('success', 'Produk dihapus dari Best Seller!');
    }
}
