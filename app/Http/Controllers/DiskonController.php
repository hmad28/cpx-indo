<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Product;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    // Index: Halaman utama kelola diskon (mirip best seller)
    public function index()
    {
        $products = Product::all(); // Untuk select tambah
        $diskons = Diskon::with('product')->paginate(10); // Daftar diskon dengan relasi product, pagination

        return view('diskons.index', compact('products', 'diskons'));
    }

    // Store: Tambah diskon baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        Diskon::create($validated);

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil ditambahkan!');
    }

    // Destroy: Hapus diskon
    public function destroy(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil dihapus!');
    }
}
